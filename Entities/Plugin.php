<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\PluginModel;
use App\Models\MenuAdminModel;

class Plugin extends BaseEntity{
    protected $model;

    protected $attributes = [
        "plugin_id" => null,
        "plugin_name" => null,
        "plugin_filename" => null,
        "plugin_custom" => null,
        "plugin_estado" => null,
    ];

    public $fields = [

    ];

    protected $_imagen;
    protected $menuadmin_model;

    public static $estados = [
        0 => "Borrar",
        1 => "Activo",
        2 => "Inactivo",
    ];


    public function __construct(){
        $this->model = new PluginModel();
        $this->menuadmin_model = new MenuAdminModel();
    }

    public function PLUGINPATH($subdir = ""){
        if ($subdir != "") {
            return  APPPATH."Plugins/$subdir";
        }
        return  APPPATH."Plugins";
    }

    public function getImage($plugin){
        $file = $this->PLUGINPATH("$plugin/picture.jpg");
        if (!file_exists($file)) {
            return "";
        }
        $imagen = file_get_contents($file);
        if ($imagen === false) {
            return "";
        }
        return "data:".$this->_get("mime").";base64,".base64_encode($imagen);
    }

    public function getConfigValue($plugin, $value){
        $configDir = $this->PLUGINPATH("$plugin/config.php");
        include_once $configDir; //load $config
        if (isset($config[$value])) {
            return $config[$value];
        }
        return "";
    }

    public function getFolders(){
        $directory = $this->PLUGINPATH();
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));
        return $scanned_directory;
    }

    public function findBySlug($slug){
        $directory =$this->PLUGINPATH();
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));
        foreach ($scanned_directory as $folder) {
            $slugFolder = slug($folder);
            if ($slugFolder == mb_strtolower($slug)) {
                return $folder;
            }
        }
        return false;
    }

    function recurse_copy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            return false;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public function lightInstall($slug){
        $folder = $this->findBySlug($slug);
        $directory = APPPATH."Plugins/$folder";
        include_once "$directory/config.php"; //load $config
        $this->updateMenuAdmin($config["menuadmin"], $config, $folder);
        return $config;
    }

    public function install($slug){
        $configuracionModel = new \App\Models\ConfiguracionModel();
        $configuracion = $configuracionModel->first();

        $folder = $this->findBySlug($slug);
        $directory = APPPATH."Plugins/$folder";
        include_once "$directory/config.php"; //load $config
        //check requirements
        if (isset($config["requirements"])) {
            if (!$this->checkRequirements($config["requirements"])) {
                return false;
            }
        }
        if (isset($config["roles"])) {
            foreach ($config["roles"] as $_role) {
                $roleModel = new \App\Models\RoleModel();
				$role = $roleModel->where("role_nombre", $_role)->first();
                if (empty($role)) {
                    $role = new \App\Entities\Role();
                    $role->_set("nombre", $_role);
                    $role->_set("estado", 1);
                    $role->update();
                }
            }
        }
        $this->updateMenuAdmin($config["menuadmin"], $config, $folder);
        //update files*/
        $config["updates"] = $this->updateFiles($config["updates"], $config, $folder);
        $this->recurse_copy("$directory/Replace", APPPATH);
        $this->updateDatabase(APPPATH."Plugins/$folder/Migrations", $config, $folder);
        //$newRoute = file_get_contents(APPPATH."Plugins/$folder/".$routes["from"]);
        //install modules, se guarda en el config información sobre modulos que deben ejecutarse al iniciar el programa
        $data = json_decode($configuracion->_get("data"), true);
        if (isset($config["load_modules"])) {
            $modules = explode(",", $config["load_modules"]);
            foreach ($modules as $key => $module) {
                $data["modelos"][$module] = $module;
            }
        }
        $data["plugins"][$folder] = $config["precio"];
        $configuracion->_set("data", json_encode($data));
        $configuracion->update(true);
        return $config;
    }

    public function lightUnistall(){
        $config = json_decode($this->_get("custom"), true);
        //Remove menu
        $this->uninstallMenuAdmin($config["menuadmin"], $config, $config["name"]);
    }

    public function uninstall(){
        $configuracionModel = new \App\Models\ConfiguracionModel();
        $configuracion = $configuracionModel->first();

        $config = json_decode($this->_get("custom"), true);

        $folder = $this->findBySlug($config["name"]);
        $directory = APPPATH."Plugins/$folder";

        //Remove menu
        $this->uninstallMenuAdmin($config["menuadmin"], $config, $config["name"]);
        //Remove Files
        $this->recurse_copy_downgrade("$directory/Replace", APPPATH);
        $this->downgradeFiles($config["updates"], $config, $config["name"]);
        $this->downgradeDatabase(APPPATH."Plugins/$folder/Migrations", $config, $folder);

        $data = json_decode($configuracion->_get("data"), true);
        unset($data["plugins"][$folder]);
        $configuracion->_set("data", json_encode($data));
        $configuracion->update(true);
    }

    public function updatePlugin(){
        $configuracionModel = new \App\Models\ConfiguracionModel();
        $configuracion = $configuracionModel->first();

        $dbconfig = json_decode($this->_get("custom"), true);
        $folder = $this->findBySlug($dbconfig["name"]);
        $directory = APPPATH."Plugins/$folder";
        $update = [
            "from" => "Updates/Config/Routes.php",
            "to" => "Config/Routes.php",
            "Type" => "update",
        ];
        include_once "$directory/config.php";

        $data = json_decode($configuracion->_get("data"), true);
        $data["plugins"][$folder] = $config["precio"];
        $configuracion->_set("data", json_encode($data));
        $configuracion->update(true);

        if (isset($config["roles"])) {
            foreach ($config["roles"] as $_role) {
                $roleModel = new \App\Models\RoleModel();
				$role = $roleModel->where("role_nombre", $_role)->first();
                if (empty($role)) {
                    $role = new \App\Entities\Role();
                    $role->_set("nombre", $_role);
                    $role->_set("estado", 1);
                    $role->update();
                }
            }
        }

        $this->updateRoutes($update, $dbconfig, $folder);
        $this->recurse_copy_downgrade("$directory/Replace", APPPATH);
        $this->recurse_copy("$directory/Replace", APPPATH);
        $this->updateDatabase(APPPATH."Plugins/$folder/Migrations", $dbconfig, $folder);
        $this->uninstallMenuAdmin($dbconfig["menuadmin"], $dbconfig, $dbconfig["name"]);
        $this->updateMenuAdmin($config["menuadmin"], $config, $folder);

        $data = json_decode($configuracion->_get("data"), true);
        $data["plugins"][$folder] = $config["precio"];
        $configuracion->_set("data", json_encode($data));
        $configuracion->update(true);
    }

    public function checkRequirements($requirements){
        $db = \Config\Database::connect();
        $meetAll = true;
        foreach ($requirements as $requirement) {
            if (isset($requirement["table"])) {
                if (!$db->tableExists($requirement["table"])) {
                    $meetAll = false;
                }
            } elseif (isset($requirement["field"])) {
                if (!$db->fieldExists($requirement["field"]["field"], $requirement["field"]["table"])){
                    $meetAll = false;
                }
            } elseif (isset($requirement["model"])) {
                if (!file_exists(APPPATH."Models/".$requirement["model"].".php")) {
                    $meetAll = false;
                }
            }
        }
        return $meetAll;
    }

    public function updateMenuAdmin($menuadmins, $config, $folder){
        if ($folder == "core") {
            $this->menuadmin_model
                ->where("menuadmin_plugin IS NULL", null, false)
                ->delete();
        }
        $menus = $this->menuadmin_model
            ->where("menuadmin_plugin", $folder)
            ->findAll();
        $menu = [];
        foreach ($menus as $_menu) {
            $menu[$_menu->_get("name")] = $_menu;
        }
        foreach ($menuadmins as $menuadmin) {
            if (isset($menu[$menuadmin["menuadmin_name"]])) {//nunca esta set porque estan borrados
                $menuadmin["menuadmin_id"] = $menu[$menuadmin["menuadmin_name"]]->_id();
            }
            if (isset($menuadmin["menuadmin_parent"])) {//siempre debe estar set
                if ($menuadmin["menuadmin_parent"] == "") {
                    //buscar si ya existe un padre con ese nombre
                    $parent =$this->menuadmin_model
                        ->where("menuadmin_name", $menuadmin["menuadmin_name"])
                        ->where("menuadmin_estado", 1)
                        ->first();
                    if (empty($parent)) {
                        $menuadmin["menuadmin_plugin"] = $folder;
                        $this->menuadmin_model->save($menuadmin);
                    }
                } else {
                    $parent = $this->menuadmin_model
                        ->where("menuadmin_name", $menuadmin["menuadmin_parent"])
                        ->where("menuadmin_estado", 1)
                        ->first();
                    if (!empty($parent)) {
                        $menuadmin["menuadmin_menuadmin_id"] = $parent->_id();
                    }
                    $menuadmin["menuadmin_plugin"] = $folder;
                    $this->menuadmin_model->save($menuadmin);
                }
            }
        }
    }

    public function uninstallMenuAdmin($menuadmins, $config, $folder){
        $this->menuadmin_model
            ->where('menuadmin_plugin', $folder)
            ->where("menuadmin_menuadmin_id <>", "");
        $this->menuadmin_model->delete();
    }

    public function updateFiles($updates, $config, $folder){
        foreach ($updates as $update) {
            $src = APPPATH."Plugins/$folder/".$update["from"];
            $dst = APPPATH.$update["to"];
            if ($update["Type"] == "update") {
                $this->updateRoutes($update, $config, $folder);
            } elseif ($update["Type"] == "replace") {
                if (file_exists($dst)) {
                    unlink($dst);
                }
                copy($src, $dst);
            } elseif ($update["Type"] == "replace_dir") {
                $this->recurse_copy($src, $dst);
            } elseif ($update["Type"] == "replace_migration") {
                //find al migration file with same name
                $directory = APPPATH."Database/Migrations";
                $scanned_directory = array_diff(scandir($directory), array('..', '.'));
                foreach ($scanned_directory as $migrateFile) {
                    $file = substr($migrateFile, 15);
                    $current = substr($update["to"], 28);
                    if ($file == $current) {
                        $delFile = str_replace("{fecha}_$current",$migrateFile,$update["to"]);
                        if (isset($update["class"])) {
                            include_once APPPATH.$delFile;
                            $migrate = new $update["class"]();
                            $migrate->down();
                        }
                        if (file_exists($delFile)) {
                            unlink($delFile);
                        }
                    }
                }
                $time = date("YmdHis");
                $dst = str_replace("{fecha}", $time, $dst);
                $update["to"] =  str_replace("{fecha}", $time, $update["to"]);
                if (file_exists($dst)) {
                    unlink($dst);
                }
                copy($src, $dst);
                if (!isset($migrate)) {
                    include_once $dst;
                    $migrate = new $update["class"]();
                }
                $migrate->up();
            }
        }
        return $updates;
    }

    public function recurse_copy_downgrade($src, $dst){
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                echo "revisando: ".$src . '/' . $file."<br>";
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy_downgrade($src . '/' . $file,$dst . '/' . $file);
                } else {
                    echo "its a FILE: ".$dst . '/' . $file."<br>";
                    if (file_exists($dst . '/' . $file)) {
                        unlink ($dst . '/' . $file);
                        echo "<span style='color:red;'>borrando archivo: </span>".$dst . '/' . $file."<br>";
                    }
                }
            }
        }
        closedir($dir);
    }

    public function downgradeFiles($updates, $config, $folder){
        foreach ($updates as $update) {
            $src = APPPATH."Plugins/$folder/files/".$update["from"];
            $dst = APPPATH.$update["to"];
            if ($update["Type"] == "update") {
                $this->removeUpdateRoutes($update, $config, $folder);
            } elseif ($update["Type"] == "replace") {
                if (file_exists($dst)) {
                    unlink($dst);
                }
            } elseif ($update["Type"] == "replace_dir") {
                $this->deleteDir($dst);
            } elseif ($update["Type"] == "replace_migration") {
                if (isset($update["class"])) {
                    if (file_exists(APPPATH.$update["to"])) {
                        include_once APPPATH.$update["to"];
                        $migrate = new $update["class"]();
                        $migrate->down();
                    }
                }
                if (file_exists(APPPATH.$update["to"])) {
                    unlink(APPPATH.$update["to"]);
                }
            }
        }
    }

    public function updateRoutes($routes, $config, $folder){
        $name = mb_strtoupper($config["name"]);
        $indicator = "/* PLUGIN | $name */";
        $indicatorEnd = "/* PUGLIN | $name | END */\n";
        $newRoute = file_get_contents(APPPATH."Plugins/$folder/".$routes["from"]);
        $newRoute = str_replace("<?php", "", $newRoute);
        $newRoute = str_replace("?>", "", $newRoute);
        $originalRoute = file_get_contents(APPPATH.$routes["to"]);
        $postFirst = strpos($originalRoute, $indicator);
        $postLast = strpos($originalRoute, $indicatorEnd);
        $inicio = "";
        $fin = "";
        if ($postFirst !== false) {
            $inicio = substr($originalRoute, 0, $postFirst);
            if ($postLast !== false) {
                $fin = substr($originalRoute, $postLast+strlen($indicatorEnd));
            } else {
                $fin = substr($originalRoute, "//PLUGINS ENDS");
            }
        } else {//PLUGINS ENDS
            $pluginEnd = strpos($originalRoute, "//PLUGINS ENDS");
            $inicio = substr($originalRoute, 0, $pluginEnd);
            $fin = substr($originalRoute, $pluginEnd);
        }
        //echo "INICIO<br>$inicio<br>INDI<br>$indicator<br>NEW<br>$newRoute<br>INDEND<br>$indicatorEnd<br>$fin";
        $newRoute = $inicio.$indicator.$newRoute.$indicatorEnd.$fin;

        $fp = fopen(APPPATH.$routes["to"], 'w+');
        fwrite($fp, $newRoute);
        fclose($fp);
    }

    public function removeUpdateRoutes($routes, $config, $folder){
        $name = mb_strtoupper($config["name"]);
        $indicator = "/* PLUGIN | $name */";
        $indicatorEnd = "/* PUGLIN | $name | END */\n";
        $originalRoute = file_get_contents(APPPATH.$routes["to"]);

        $postFirst = strpos($originalRoute, $indicator);
        $postLast = strpos($originalRoute, $indicatorEnd);

        if ($postFirst !== false) {
            $inicio = substr($originalRoute, 0, $postFirst);
            $fin = substr($originalRoute, ($postLast+strlen($indicatorEnd)) );

            $newRoute = $inicio.$fin;
            //echo "INICIO<br>$inicio<br>FIN<br>$fin<hr>";
            $newFile = $newRoute;
            print_r($newFile);
            $fp = fopen(APPPATH.$routes["to"], 'w+');
            fwrite($fp, $newFile);
            fclose($fp);
        }
    }

    public function findPlugin($name){
        $plugin = $this->model->where("plugin_name", $name)->first();
        if (empty($plugin)) {
            $plugin = new Plugin;
        }
        return $plugin;
    }

    public function updateDatabase($src, $config, $folder){
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    $migrationPath = $src . '/' . $file;
                    $fileName = explode("_", $file);
                    $data["version"] = $fileName[0];
                    $data["group"] = $folder;
                    $data["namespace"] = "App";
                    $data["time"] = strtotime(date("Y-m-d H:i:s"));
                    $data["batch"] = 1;
                    $migrationModel = new \App\Models\MigrationsModel();
                    $migration = $migrationModel->where("version", $data["version"])->first();
                    if (empty($migration)) {

                        include_once($migrationPath);
                        $migrationFile = file_get_contents($migrationPath);
                        $findingClass = explode("\CodeIgniter\Database\Migration", $migrationFile);
                        $findingClass = $findingClass[0];
                        $findingClass = explode("class", $findingClass);
                        $class = end($findingClass);
                        $class = str_replace("extends","", $class);
                        $class = trim($class);
                        $className = "\App\Database\Migrations\\".$class;
                        $mComentarios = new $className();
                        $mComentarios->up();
                        $data["class"] = "App\Database\Migrations\\{$class}";
                        $result = $migrationModel->save($data);
                    }
                }
            }
        }
        closedir($dir);
    }

    public function downgradeDatabase($src, $config, $folder){
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    $migrationPath = $src . '/' . $file;
                    $fileName = explode("_", $file);
                    $data["version"] = $fileName[0];
                    $data["group"] = $folder;
                    $data["namespace"] = "App";
                    $data["time"] = strtotime(date("Y-m-d H:i:s"));
                    $data["batch"] = 1;
                    $migrationModel = new \App\Models\MigrationsModel();
                    $migration = $migrationModel->where("version", $data["version"])->first();
                    if (!empty($migration)) {
                        include_once($migrationPath);
                        $migrationFile = file_get_contents($migrationPath);
                        $findingClass = explode("\CodeIgniter\Database\Migration", $migrationFile);
                        $findingClass = $findingClass[0];
                        $findingClass = explode("class", $findingClass);
                        $class = end($findingClass);
                        $class = str_replace("extends","", $class);
                        $class = trim($class);
                        $className = "\App\Database\Migrations\\".$class;
                        $mComentarios = new $className();
                        $mComentarios->down();
                        $migration = $migrationModel->where("version", $data["version"])->delete();
                    }
                }
            }
        }
        closedir($dir);
    }

}
