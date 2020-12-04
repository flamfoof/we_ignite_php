<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\TransporteModel;

class Transporte extends BaseEntity{
    protected $model;

    protected $attributes = [
        "transporte_id" => null,
        "transporte_grupotransporte_id" => null,
        "transporte_nombre" => null,
        "transporte_peso_maximo" => null,
        "transporte_volumen_maximo" => null,
        "transporte_precio" => null,
        "transporte_estado" => null,
    ];

    public $fields = [
        "transporte_nombre" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
                "placeholder" => "Nombre del costo de transporte"
            ],
        ],
        "transporte_peso_maximo" => [
            "html" => [
                "type" => "number",
                "label" => "Peso Máximo",
                "placeholder" => "",
                "steps" => "0.01",
                "min" => "0"
            ],
        ],
        "transporte_volumen_maximo" => [
            "html" => [
                "type" => "number",
                "label" => "Volúmen Máximo",
                "placeholder" => "",
                "step" => "0.01",
                "min" => "0"
            ],
        ],
        "transporte_precio" => [
            "html" => [
                "type" => "number",
                "label" => "Precio",
                "placeholder" => "",
                "step" => "0.01",
                "min" => "0"
            ],
        ],
        "grupopago_estado" => [
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
        $this->model = new TransporteModel();
    }

}
