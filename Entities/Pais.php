<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\PaisModel;
use App\Models\ProvinciaModel;
use App\Models\CombinacionPagoModel;
use App\Models\GrupoPagoModel;
use App\Models\GrupoTransporteModel;

class Pais extends BaseEntity{
    protected $model;

    protected $attributes = [
        "pais_id" => null,
        "pais_nombre" => null,
        "pais_alpha2" => null,
        "pais_alpha3" => null,
        "pais_iva" => null,
        "pais_grupopago_id" => null,
        "pais_grupoenvio_id" => null,
        "pais_metodoenvio" => null, // 0 - solo enviar, 1 - enviar o recoger, 2 - solo recoger
        "pais_estado" => null,
    ];

    public static $tiposEnvios = [
        0 => "Enviar",
        1 => "Enviar o Recoger",
        2 => "Recoger",
    ];

    public $fields = [
        "pais_nombre" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
                "placeholder" => "Nombre del pais"
            ],
        ],
        "pais_alpha2" => [
            "html" => [
                "type" => "text",
                "label" => "Alfa 2",
                "placeholder" => ""
            ],
        ],
        "pais_alpha3" => [
            "html" => [
                "type" => "text",
                "label" => "Alfa 3",
                "placeholder" => ""
            ],
        ],
        "pais_iva" => [
            "html" => [
                "type" => "select",
                "label" => "IVA",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "sinos"
        ],
        "pais_metodoenvio" => [
            "html" => [
                "type" => "select",
                "label" => "Metodo Envio",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "envios"
        ],
        "pais_estado" => [
            "html" => [
                "type" => "select",
                "label" => "Estado",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "estados"
        ],
    ];

    public static $envios= [
        0 => "Solo enviar",
        1 => "Enviar o recoger",
        2 => "Recoger",
    ];

    public static $sinos= [
        0 => "No",
        1 => "Si",
    ];

    public static $estados= [
        0 => "Inactivo",
        1 => "Activo",
    ];

    public function __construct(){
        $this->model = new PaisModel();
    }

    public function getProvincias(){
        $provincia_model = new \App\Models\ProvinciaModel();
        return $provincia_model
            ->where("provincia_pais_id", $this->_id())
            ->orderBy("provincia_nombre", "ASC")
            ->findAll();
    }

    public function getMetodosPago(){
        if ($this->_get("grupopago_id") > 0) {
            $combinacionpago_model = new \App\Models\CombinacionPagoModel();
            return $combinacionpago_model
                ->where("combinacionpago_grupopago_id", $this->_get("grupopago_id"))
                ->findAll();
        }
    }

    public function getGruposPago(){
        $grupopago_model = new \App\Models\GrupoPagoModel();
        if (class_exists("\\App\\Models\\GrupoPagoModel")) {
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
