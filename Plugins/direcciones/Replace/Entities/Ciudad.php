<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\CiudadModel;
use App\Models\CombinacionPagoModel;
use App\Models\GrupoTransporteModel;
use App\Models\GrupoPagoModel;

class Ciudad extends BaseEntity{
    protected $model;

    protected $attributes = [
        "ciudad_id" => null,
        "ciudad_provincia_id" => null,
        "ciudad_nombre" => null,
        "ciudad_iva" => null,
        "ciudad_grupopago_id" => null,
        "ciudad_grupoenvio_id" => null,
        "ciudad_metodoenvio" => null,
        "ciudad_estado" => null,
    ];

    public static $tiposEnvios = [
        0 => "Enviar",
        1 => "Enviar o Recoger",
        2 => "Recoger",
    ];

    public $fields = [
        "ciudad_nombre" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
                "placeholder" => "Nombre de la ciudad"
            ],
        ],
        "ciudad_estado" => [
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
        $this->model = new CiudadModel();
    }

    public function getMetodosPago(){
        if ($this->_get("grupopago_id") > 0) {
            return $this->combinacionpago_model
                ->where("combinacionpago_grupopago_id", $this->_get("grupopago_id"))
                ->findAll();
        }
    }

    public function getGruposPago(){
        if (class_exists("\\App\\Models\\GrupoPagoModel")) {
            $grupopago_model = new \App\Models\GrupoPagoModel();
            return $grupopago_model
                ->where("grupopago_estado", 1)
                ->findAll();
        }
        return [];
    }

    public function getGruposEnvio(){
        if (class_exists("\\App\\Models\\GrupoTransporteModel")) {
            $grupotransporte_model = new \App\Models\GrupoTransporteModel();
            return $grupotransporte_model
                ->where("grupotransporte_estado", 1)
                ->findAll();
        }
        return [];
    }

}
