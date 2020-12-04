<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\PermissionModel;

class Permission extends BaseEntity{
    protected $model;

    protected $attributes = [
        'permission_id' => null,
        'permission_nombre' => null,
        'permission_description' => null,
        'permission_estado' => null,
    ];

    public $fields = [
        "permission_nombre" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
                "placeholder" => "Nombre del permiso"
            ]
        ],
        "permission_description" => [
            "html" => [
                "type" => "textarea",
                "label" => "Descripcion",
                "placeholder" => "Descripcion del permiso"
            ]
        ],
        "permission_estado" => [
            "options" => "estados"
        ],
    ];

    public function __construct(){
        $this->model = new PermissionModel();
    }

}
