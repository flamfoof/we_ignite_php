<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;

class Role extends BaseEntity{
    protected $model;
    protected $permission_model;
    protected $rolepermission_model;
    public $permissions = array();

    protected $attributes = [
        'role_id' => null,
        'role_nombre' => null,
        'role_estado' => null,
    ];

    public $fields = [
        "role_nombre" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
                "placeholder" => "Nombre del rol"
            ],
        ],
        "role_estado" => [
            "options" => "estados"
        ],
    ];

    public static $estados = [
        0 => "Inactivo",
        1 => "Activo",
    ];

    public function __construct(){
        $this->model = new RoleModel();
        $this->permission_model = new PermissionModel();
        $this->rolepermission_model = new RolePermissionModel();
    }

    public function getRolePerms() {
        $rolePermission = new RolePermissionModel();
        $permisos = $this->permission_model
            ->join($rolePermission->table, "rolepermission_permission_id = permission_id")
            ->where("rolepermission_role_id", $this->_id())
            ->where("rolepermission_estado", 1)
            ->findAll();
        foreach ($permisos as $permiso) {
            $this->permissions[$permiso->_get("nombre")] = true;
        }
        return $this->permissions;
    }

    public function hasPerm($permission) {
        return isset($this->permissions[$permission]);
    }

    public function setPermissions($fichaPermission){
        if (empty($this->permissions)) {
            $this->getRolePerms();
        }
        if (empty($fichaPermission)) {
            $fichaPermission = array();
        }
        //agregar
        foreach ($fichaPermission as $permission_nombre => $value) {
            if (array_key_exists($permission_nombre, $this->permissions) === false) {
                $permiso = $this->permission_model
                    ->where("permission_nombre", $permission_nombre)
                    ->where("permission_estado", 1)->first();
                $rolePermission = $this->rolepermission_model
                    ->join($this->permission_model->table, "permission_id = rolepermission_permission_id")
                    ->where("rolepermission_role_id", $this->_id())
                    ->where("permission_id", $permiso->_id())->first();
                if (empty($rolePermission)) {
                    $rolePermission = new RolePermission();
                    $rolePermission->_set("role_id", $this->_id());
                    $rolePermission->_set("permission_id", $permiso->_id());
                    $rolePermission->_set("estado", 1);
                    $this->rolepermission_model->save($rolePermission);
                } else {
                    if ($rolePermission->_get("estado") == 0) {
                        $rolePermission->_set("estado", 1);
                        $this->rolepermission_model->save($rolePermission);
                    }
                }
            }
        }
        //borrar
        foreach ($this->permissions as $permission_nombre => $value) {
            if (array_key_exists($permission_nombre, $fichaPermission) === false) {
                $permiso = $this->permission_model
                    ->where("permission_nombre", $permission_nombre)
                    ->where("permission_estado", 1)->first();
                $rolePermission = $this->rolepermission_model
                    ->join($this->permission_model->table, "permission_id = rolepermission_permission_id")
                    ->where("permission_id", $permiso->_id())->first();
                if (!empty($rolePermission)) {
                    if ($rolePermission->_get("estado") == 1) {
                        $rolePermission->_set("estado", 0);
                        $this->rolepermission_model->save($rolePermission);
                    }
                }
            }
        }
    }

}
