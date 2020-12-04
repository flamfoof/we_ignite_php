<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\ZonaModel;
use App\Models\CombinacionPagoModel;
use App\Models\GrupoTransporteModel;
use App\Models\GrupoPagoModel;

class Zona extends BaseEntity{
    protected $model;
    protected $producto_model;
    protected $combinacionpago_model;
    protected $grupotransporte_model;

    protected $attributes = [
        "zona_id" => null,
        "zona_ciudad_id" => null,
        "zona_nombre" => null,
        "zona_estado" => null,
    ];

    public static $tiposEnvios = [
        0 => "Enviar",
        1 => "Enviar o Recoger",
        2 => "Recoger",
    ];

    public $fields = [
        "zona_nombre" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
                "placeholder" => "Nombre de la ciudad"
            ],
        ],
        "zona_estado" => [
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
        $this->model = new ZonaModel();
    }

}
