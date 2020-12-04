<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\ProvinciaModel;
use App\Models\CombinacionPagoModel;
use App\Models\GrupoPagoModel;
use App\Models\GrupoTransporteModel;

class Provincia extends BaseEntity{
    protected $model;

    protected $attributes = [
        "provincia_id" => null,
        "provincia_pais_id" => null,
        "provincia_nombre" => null,
        "provincia_iva" => null,
        "provincia_grupopago_id" => null,
        "provincia_grupoenvio_id" => null,
        "provincia_metodoenvio" => null,
        "provincia_estado" => null,
    ];

    public $fields = [
        "provincia_nombre" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
                "placeholder" => "Nombre de la provincia/region"
            ],
        ],
        "provincia_metodoenvio" => [
            "html" => [
                "type" => "select",
                "label" => "Formas de envio",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "tiposEnvios"
        ],
        "provincia_estado" => [
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

    public static $tiposEnvios = [
        0 => "Enviar",
        1 => "Enviar o Recoger",
        2 => "Recoger",
    ];

    public function __construct(){
        $this->model = new ProvinciaModel();
    }

    public function getMetodosPago(){
        if ($this->_get("grupopago_id") > 0) {
            $combinacionpago_model = new \App\Models\CombinacionPagoModel();
            $result = $combinacionpago_model
                ->where("combinacionpago_grupopago_id", $this->_get("grupopago_id"))
                ->findAll();
            return $result;
        }
    }

    public function getGruposPago(){
        if (class_exists("\\App\\Models\\GrupoPagoModel")) {
            $grupoPagoModel = new \App\Models\GrupoPagoModel();
            return $grupoPagoModel
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
