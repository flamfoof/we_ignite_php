<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\AccessModel;

class Access extends BaseEntity{
    protected $model;

    public $attributes = [
        "access_id" => null,
        "access_project_id" => null,
        "access_email" => null,
        "access_date" => null,
        "access_horainicio" => null,
        "access_horafin" => null,
    ];

    public $fields = [

    ];


    public static $estados = [
        0 => "Borrar",
        1 => "Activo",
        2 => "Inactivo",
    ];

    public function __construct(){
        $this->model = new AccessModel();
    }

}
