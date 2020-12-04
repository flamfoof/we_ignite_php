<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\RolePermissionModel;

class RolePermission extends BaseEntity{
    protected $model;

    protected $attributes = [
        'rolepermission_id' => null,
        'rolepermission_role_id' => null,
        'rolepermission_permission_id' => null,
        'rolepermission_estado' => null,
    ];

    public function __construct(){
        $this->model = new RolePermissionModel();
    }

}
