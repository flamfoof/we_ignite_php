<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\UsuarioModel;
use App\Models\RoleModel;
use App\Models\UsuarioRoleModel;
use App\Models\DireccionModel;
use App\Models\FavoritoModel;
use App\Entities\Direccion;
use App\Entities\Favorito;

class Usuario extends BaseEntity{
    protected $model;
    protected $role_model;
    public $myroles;
    public $myfavorites = [];

    protected $attributes = [
        'usuario_id' => null,
        "usuario_tienda_id" => null,
        'usuario_nombre' => null,       //nombre o nombre fiscal
        'usuario_apellidos' => null,    //apellidos o razon social
        "usuario_dni" => null,          //dni o cif
        'usuario_password' => null,
        'usuario_telefono' => null,
        'usuario_tipo' => null,         //cliente, empleado, empresa
        'usuario_estado' => null,
        "usuario_log" => null,
        'usuario_failed_log' => null,
        "usuario_archivo_id" => null,

        'usuario_email' => null,
        'usuario_emailpass' => null,
    ];

    public $fields = [
        "usuario_alta" => [
            "html" => [
                "label" => "Alta",
            ],
        ],
        "usuario_nombre" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
                "placeholder" => "Nombre del usuario",
            ],
        ],
        "usuario_apellidos" => [
            "html" => [
                "type" => "text",
                "label" => "Apellidos",
                "placeholder" => "Apellidos del usuario",
            ],
        ],
        "usuario_email" => [
            "html" => [
                "type" => "email",
                "label" => "Email",
                "placeholder" => "email del usuario",
            ],
        ],
        "usuario_emailpass" => [
            "html" => [
                "type" => "text",
                "label" => "Email Password",
                "placeholder" => "Password para leer emails",
            ],
        ],
        "usuario_telefono" => [
            "html" => [
                "type" => "tel",
                "label" => "Telefono",
                "placeholder" => "telefono del usuario",
            ],
        ],
        "usuario_dni" => [
            "html" => [
                "type" => "text",
                "label" => "DNI",
                "placeholder" => "DNI del usuario"
            ],
        ],
        "usuario_password" => [
            "custom_set" => "setPassword",
            "html" => [
                "type" => "password",
                "label" => "Password",
                "placeholder" => "Password del usuario"
            ],
        ],
        "usuario_puntos" => [
            "html" => [
                "type" => "number",
                "label" => "Puntos",
                "placeholder" => "Puntos del usuario"
            ],
        ],
        "usuario_tipo" => [
            "html" => [
                "type" => "select",
                "label" => "Tipo",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "tipos",
        ],
        "usuario_estado" => [
            "html" => [
                "type" => "select",
                "label" => "Estado",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "estados",
        ],
        "usuario_log" => [
            "custom_set" => "setLog",
            "custom_get" => "getLog",
        ],
        "usuario_failed_log" => [
            "custom_set" => "setLogFailed",
            "custom_get" => "getLogFailed",
        ],
    ];

    public static $estados = [
        0 => "Inactivo",
        1 => "Activo",
        3 => "Banneado",
    ];

    public static $tipos = [
        0 => "Cliente",
        1 => "Empleado",
    ];

    public static $cookies = [
        "K5wPLpTEXD",
        "AjkZwDm8AC",
        "FsajNZhcNX",
    ];

    public function __construct(){
        $this->model = new UsuarioModel();
        $this->role_model = new RoleModel();
    }

    public function setPassword(){
        password_hash($ficha["usuario_password"], PASSWORD_DEFAULT);
    }

    public function hasPermission($password){
        if($this->usuario_failed_log != ""){
            $failed_log = json_decode($this->_get("failed_log"), true);
            if(isset($failed_log[self::get_client_ip_server()])){
                if(!isset($failed_log[self::get_client_ip_server()]["penalty"])){
                    $failed_log[self::get_client_ip_server()]["penalty"] = 0;
                }
                if($failed_log[self::get_client_ip_server()]["penalty"] < time()){
                    if($failed_log[self::get_client_ip_server()]["try"] > 5){
                        $failed_log[self::get_client_ip_server()]["try"] = 0;
                    }
                    return $this->checkPassword($password, $failed_log);
                } else {
                    $this->addFail($failed_log);
                    return false;
                }
            } else {
                $failed_log[self::get_client_ip_server()]["try"] = 0;
                $failed_log[self::get_client_ip_server()]["penalty"] = 0;
                return $this->checkPassword($password, $failed_log);
            }
        } else {
            $failed_log[self::get_client_ip_server()]["try"] = 0;
            $failed_log[self::get_client_ip_server()]["penalty"] = 0;
            return $this->checkPassword($password, $failed_log);
        }
    }

    private function checkPassword($password, $failed_log){
        //$hashed_password = password_hash($this->_get("password"),PASSWORD_DEFAULT);
        $result = password_verify($password, $this->_get("password"));
        if($result){
            return true;
        } else {
            $failed_log = $this->addFail($failed_log);
            return false;
        }
    }

    private function addFail($failed_log){
        $failed_log[self::get_client_ip_server()]["try"] ++;
        if($failed_log[self::get_client_ip_server()]["try"] >= 5){
            $failed_log[self::get_client_ip_server()]["penalty"] = time() + 7200;
        }
        $this->_set("usuario_failed_log", json_encode($failed_log));
        $this->update();
        return $failed_log;
    }

    public function getLogFailed(){
        return json_decode(base64_decode($this->usuario_failed_log), true);
    }

    public function createCookie(){
        $debug = false;
        $info = [
            'id' => $this->usuario_id,
            'inicio' => time(),
            'expira' => time() + 86400,
            'ip' => self::get_client_ip_server(),
        ];
        $fullhash = bin2hex(json_encode($info));

        $block = floor(strlen($fullhash)/3);
        $hash =[
            substr($fullhash,0,$block),
            substr($fullhash,$block,$block),
            substr($fullhash,$block*2)
        ];
        echo ($debug) ? "log = $fullhash <br>" : "";
        $this->_set("log", $fullhash);

        $time = time()+86400;
        $mainURL = base_url();
        $mainURL = str_replace("https://", "", $mainURL);
        $mainURL = str_replace("http://", "", $mainURL);
        $mainURL = str_replace("/", "", $mainURL);
        for ($i=0; $i < 3 ; $i++) {
            echo ($debug) ? "setcookie(".self::$cookies[$i].", ".$hash[$i].", $time, '/', $mainURL, true, true) <br>" : "";
            $parts = explode(".", $this->getHost());
            $secure = true;
            if($parts[1] == "local"){
                $secure = false;
            }
            setcookie(self::$cookies[$i], $hash[$i], $time, '/', $mainURL, $secure, true);
        }
        //setcookie("fullhas", $fullhash, time()+86400);
        return $fullhash;
    }

    public function getHost(){
        $host = $_SERVER['HTTP_HOST'];
        $host = str_replace("www.","", $host);
        return $host;
    }

    public function getRoles() {
        $usuarioRole = new UsuarioRoleModel();
        $this->myroles = array();
        $roles = $this->role_model
            ->join($usuarioRole->table, "usuariorole_role_id = role_id")
            ->where("usuariorole_usuario_id", $this->_id())->findAll();
        foreach ($roles as $role) {
            //$role->getRolePerms();
            $this->myroles[$role->_get("nombre")] = $role;
        }
    }

    public function hasRole($findRole){
        if (!empty($this->myroles)) {
            if (is_array($findRole)) {
                foreach ($this->myroles as $role) {
                    if (in_array($role->_get("nombre"), $findRole)) {
                        return true;
                    }
                }
            } else {
                foreach ($this->myroles as $role) {
                    if ($role->_get("nombre") == $findRole) {
                        return true;
                    }
                }
            }

        }
        return false;
    }

    public function hasPrivilege($perm) {
        if (!empty($this->myroles)) {
            foreach ($this->myroles as $role) {
                $role->getRolePerms();
                if ($role->hasPerm($perm)) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getNombre(){
        return $this->_get("nombre")." ".$this->_get("apellidos");
    }

    public static function get_client_ip_server() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } elseif(isset($_SERVER['HTTP_X_FORWARDED'])){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        }elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }elseif(isset($_SERVER['HTTP_FORWARDED'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        }elseif(isset($_SERVER['REMOTE_ADDR'])){
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }else{
            $ipaddress = 'UNKNOWN';
        }
        return strval($ipaddress);
    }

    public static function match_ip($ip) {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            if ($ip == $_SERVER['HTTP_CLIENT_IP']) {
                return true;
            }
        } elseif(isset($_SERVER['HTTP_X_FORWARDED'])){
            if ($ip == $_SERVER['HTTP_X_FORWARDED']) {
                return true;
            }
        }elseif(isset($_SERVER['HTTP_FORWARDED_FOR'])){
            if ($ip == $_SERVER['HTTP_FORWARDED_FOR']) {
                return true;
            }
        }elseif(isset($_SERVER['HTTP_FORWARDED'])){
            if (strpos($_SERVER['HTTP_FORWARDED'], $ip) !== false) {
                return true;
            }
        }elseif(isset($_SERVER['REMOTE_ADDR'])){
            if ($ip == $_SERVER['REMOTE_ADDR']) {
                return true;
            }
        }else{
            if ($ip == $_SERVER['UNKNOWN']) {
                return true;
            }
        }
        return $ipaddress;
    }

    public function createDirFromCarrito($carrito){
        $direccion = new Direccion();
        $direccion->_set("usuario_id", $this->_id());
        $direccion->_set("pais_id", $carrito->_get("direccionpais_id"));
        $direccion->_set("provincia_id", $carrito->_get("direccionprovincia_id"));
        $direccion->_set("provincia_texto", $carrito->_get("direccionprovincia"));
        $direccion->_set("ciudad_id", $carrito->_get("direccionciudad_id"));
        $direccion->_set("ciudad_texto", $carrito->_get("direccionciudad"));
        $direccion->_set("via", $carrito->_get("direccionvia"));
        $direccion->_set("direccion", $carrito->_get("direcciondireccion"));
        $direccion->_set("piso", $carrito->_get("direccionpiso"));
        $direccion->_set("numero", $carrito->_get("direccionnumero"));
        $direccion->_set("codigopostal", $carrito->_get("direccioncp"));
        $direccion->_set("estado", 1);
        $direccion->update();
    }

    private $langTxt = [
        "en" => [
            "activate_account"          => "Activate account",
            "recover_password"          => "Recover password",
        ],
        "es" => [
            "activate_account"          => "Activar cuenta",
            "recover_password"          => "Recuperar password",
        ]
    ];

    public function sendActivacion($config, $locale = 'es'){
        if ($config->_get("emailtype") == 1) {
            $this->_set("log", md5($this->_get("email").date("ymdHis").$this->_get("nombre")));
            $this->update();
            $email = \Config\Services::email();
            $email->initialize([
                "mailType"      => "html",
                "protocol"      => "mail",//mail, sendmail, or smtp
            ]);

            $email->setFrom($config->_get("email"), $config->_get("nombretienda"));
            $email->setTo($this->_get("email"));

            $email->setSubject($this->langTxt[$locale]["activate_account"]." ".$config->_get("nombretienda"));
            $email->setMessage(view("{$config->getCarpeta()}/mensajes/emails/activar", ["config" => $config, "usuario" => $this, "carpeta" => $config->getCarpeta()]));

            return $email->send(false);
        } else {
            $para      = $this->_get("email");
            $titulo    = $this->langTxt[$locale]["activate_account"]." ".$config->_get("nombretienda");
            $mensaje   = view("{$config->getCarpeta()}/mensajes/emails/activar", ["config" => $config, "usuario" => $this, "carpeta" => $config->getCarpeta()]);

            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cabeceras .= 'From: '.$config->_get("email") . "\r\n" .
                'Reply-To: '. $config->_get("email") . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            return mail($para, $titulo, $mensaje, $cabeceras);
        }
    }

    public function sendRecuperacion($config, $locale = 'es'){
        if ($config->_get("emailtype") == 1) {
            $this->_set("log", md5($this->_get("email").date("ymdHis").$this->_get("nombre")));
            $this->update();
            $email = \Config\Services::email();
            $email->initialize([
                "mailType"      => "html",
                "protocol"      => "mail",//mail, sendmail, or smtp
            ]);

            $email->setFrom($config->_get("email"), $config->_get("nombretienda"));
            $email->setTo($this->_get("email"));

            $email->setSubject($this->langTxt[$locale]["recover_password"]." ".$config->_get("nombretienda"));
            $email->setMessage(view("{$config->getCarpeta()}/mensajes/emails/recuperar", ["config" => $config, "usuario" => $this, "carpeta" => $config->getCarpeta()]));

            return $email->send();
        } else {
            $para      = $this->_get("email");
            $titulo    = $this->langTxt[$locale]["recover_password"]." ".$config->_get("nombretienda");
            $mensaje   = view("{$config->getCarpeta()}/mensajes/emails/recuperar", ["config" => $config, "usuario" => $this, "carpeta" => $config->getCarpeta()]);

            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cabeceras .= 'From: '.$config->_get("email") . "\r\n" .
                'Reply-To: '. $config->_get("email") . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            return mail($para, $titulo, $mensaje, $cabeceras);
        }
    }

    public function countDirections($value=''){
        $direccion_model = new \App\Models\DireccionModel();
        $result = $direccion_model
            ->selectCount("direccion_id", "cantidad")
            ->where("direccion_usuario_id", $this->_id())
            ->where("direccion_estado", 1)
            ->first();
        return $result->cantidad;
    }

    public function hasDirections(){
        if (class_exists('\\App\\Models\\DireccionModel')) {
            $cantidad = $this->countDirections();
            if ($cantidad > 0) {
                return true;
            }
            return false;
        }
    }

    public function getDirecciones(){
        if (class_exists('\\App\\Models\\DireccionModel')) {
            $direccion_model = new \App\Models\DireccionModel();
            return $direccion_model
                ->where("direccion_usuario_id", $this->_id())
                ->where("direccion_estado", 1)->findAll();
        }
    }

    public function getImagen(){
        $imagen = base_url("assets/images/launch.svg");
        if($this->_id()>0){
            if(($this->_id() > 0)&&($this->_get("archivo_id") > 0)){
                $archivo_model = new \App\Models\ArchivoModel();
                $archivo = $archivo_model->find($this->_get("archivo_id"));
                $imagen = $archivo->getAsBase64();
            }
        }
        return $imagen;
    }

    public function subirImagen($fileName){
        $root = FCPATH."assets/images/banners";
        if($this->_get("archivo_id") > 0){
            $archivo_model = new \App\Models\ArchivoModel();
            $archivo = $archivo_model->find($this->_get("archivo_id"));
            $archivo->_set("alt", ($this->_get("imagen_alt") != "") ? $this->_get("imagen_alt") : "vacio");
            $archivo->editFile($fileName, $root);
        } else {
            $archivo = new Archivo();
            $archivo->_set("alt", ($this->_get("imagen_alt") != "") ? $this->_get("imagen_alt") : "vacio");
            $archivo->insertFile($fileName, $root);
        }
        $this->_set("archivo_id", $archivo->_id());
        $this->update();
    }

}
