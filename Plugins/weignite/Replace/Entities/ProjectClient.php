<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\ProjectClientModel;

class ProjectClient extends BaseEntity{
    protected $model;

    public $attributes = [
        "projectclient_id" => null,
        "projectclient_usuario_id" => null,
        "projectclient_project_id" => null,
        "projectclient_estado" => null,
    ];

    public $fields = [

    ];

    public static $estados = [
        0 => "Borrar",
        1 => "Activo",
        2 => "Inactivo",
    ];

    public function __construct(){
        $this->model = new ProjectClientModel();
    }

}
