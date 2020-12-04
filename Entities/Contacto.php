<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\ContactoModel;

class Contacto extends BaseEntity{
    protected $model;
    public $myroles;

    protected $attributes = [
        "contacto_id" => null,
        "contacto_fecha" => null,
        "contacto_data" => null,
        "contacto_estado" => null,
    ];

    public $fields = [
        "contacto_id" => [
            "html" => [
                "type" => "text",
                "label" => "ID",
            ],
        ],
        "contacto_fecha" => [
            "html" => [
                "type" => "datetime",
                "label" => "Fecha",
            ],
        ],
        "contacto_estado" => [
            "html" => [
                "type" => "select",
                "label" => "Estado",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "estados"
        ],
    ];

    public static $estados = [
        0 => "Borrar",
        1 => "Activo",
        2 => "Leido",
    ];


    public function __construct(){
        $this->model = new ContactoModel();
    }

}
