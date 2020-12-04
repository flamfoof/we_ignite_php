<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Usuario;

class UsuarioModel extends Model {
    protected $table = 'usuario';
    protected $primaryKey = 'usuario_id';
    protected $returnType    = 'App\Entities\Usuario';
    protected $allowedFields = [
        'usuario_id',
        "usuario_tienda_id",
        "usuario_dni",
        'usuario_nombre',
        'usuario_apellidos',
        'usuario_password',
        'usuario_telefono',
        "usuario_estado",
        'usuario_log',
        'usuario_failed_log',
        "usuario_archivo_id",

        'usuario_email',
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
    public function login($ficha = null){
        if (empty($ficha)) {
            echo "usuariomodel - no ficha<br>";
            return null;
        }
        if (!isset($ficha["usuario_email"])) {
            echo "usuariomodel - no email<br>";
            return null;
        }
        if (
            !isset($ficha["usuario_password"]) ||
            ($ficha["usuario_password"] == "")
        ) {
            echo "usuariomodel - no password<br>";
            return null;
        }
        $usuario = $this->where("usuario_email", $ficha["usuario_email"])->first();
        if (empty($usuario)) {
            echo "usuariomodel - no user<br>";
            return null;
        }
        if ($usuario->hasPermission($ficha["usuario_password"])) {
            return $usuario;
        }
        return null;
    }

    public function isLoggedIn($getRoles = true){
        $debug = false;
        echo ($debug) ? "START<br>" : "";
        if (empty($_COOKIE)) {
            echo ($debug) ? "EMPTY COOKIE<br>" : "";
            return FALSE;
        }
        echo ($debug) ? "COOKIE FOUND<br>" : "";
        $usuario = new  Usuario();
        $cookie = "";
        for ($i=0 ; $i < 3 ; $i++) {
            if (!isset($_COOKIE[Usuario::$cookies[$i]])) {
                echo ($debug) ? "COOKIE PIECE NOT FOUND COOKIE($i) = ".Usuario::$cookies[$i]." <br>" : "";
                return FALSE;
            }
            $cookie .= $_COOKIE[Usuario::$cookies[$i]];
            echo ($debug) ? "COLECTING COOKIE = $cookie <br>" : "";
        }
        echo ($debug) ? "CREATING USER FROM STRING<br>" : "";
        $user = json_decode(hex2bin($cookie), true);
        if (!empty($user)) {
            echo ($debug) ? "USER CREATED<br>" : "";
            $time = time();
            if($user["expira"] > time()){
                echo ($debug) ? "TIME OK<br>" : "";
                if($user["ip"] == Usuario::get_client_ip_server()){
                    $sesion = $this->where([
                                'usuario_id' => $user["id"],
                                'usuario_log' => $cookie,
                            ])
                            ->first();
                    echo ($debug) ? "QUERY MADE<br>" : "";
                    if (empty($sesion)) {
                        echo ($debug) ? "QUERY ->".$this->db->getLastQuery()."<br>" : "";
                        return FALSE;
                    }
                    $sesion->getRoles();
                    echo ($debug) ? "LOGGIN OK!!!!<br>" : "";
                    return $sesion;
                } else {
                    echo ($debug) ? "BAD IP<br>" : "";
                    return false;
                }
            } else {
                echo ($debug) ? "TIME EXPIRED<br>" : "";
                return false;
            }
        }
        echo "EMPTY USER<br>";
        return FALSE;
    }

    public function getByEmail($email = ""){
        return $this->db->table($this->table)
        ->where(['usuario_email' => $email])
        ->get()->getCustomRowObject(0, $this->returnType);
    }

}
