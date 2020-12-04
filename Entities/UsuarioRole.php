<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\UsuarioRoleModel;

class UsuarioRole extends BaseEntity{
    protected $model;

    protected $attributes = [
        "usuariorole_id" => null,
        "usuariorole_usuario_id" => null,
        "usuariorole_role_id" => null,
        "usuariorole_estado" => null,
    ];

    public function __construct(){
        $this->model = new UsuarioRoleModel();
    }

}
