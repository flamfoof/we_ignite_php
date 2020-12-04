<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\GrupoTransporteModel;

class GrupoTransporte extends BaseEntity{
    protected $model;

    protected $attributes = [
        "grupotransporte_id" => null,
        "grupotransporte_nombre" => null,
        "grupotransporte_estado" => null,
    ];

    public $fields = [
        "grupotransporte_nombre" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
                "placeholder" => "Nombre del grupo de transporte"
            ],
        ],
        "grupotransporte_estado" => [
            "html" => [
                "type" => "select",
                "label" => "Estado",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "estados"
        ],
    ];

    public static $estados= [
        0 => "Inactivo",
        1 => "Activo",
    ];

    public function __construct(){
        $this->model = new GrupoTransporteModel();
    }

}
