<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Entities\Pais;
use App\Models\DireccionModel;
use App\Models\PaisModel;
use App\Models\ProvinciaModel;
use App\Models\CiudadModel;

class Direccion extends BaseEntity{
    protected $model;
    protected $pais_model;
    protected $provincia_model;
    protected $ciudad_model;

    protected $attributes = [
        "direccion_id" => null,
        "direccion_usuario_id" => null,
        "direccion_pais_id" => null,
        "direccion_provincia_id" => null,
        "direccion_provincia_texto" => null,
        "direccion_ciudad_id" => null,
        "direccion_ciudad_texto" => null,
        "direccion_zona_id" => null,
        "direccion_zona_texto" => null,
        "direccion_via" => null,
        "direccion_direccion" => null,
        "direccion_piso" => null,
        "direccion_numero" => null,
        "direccion_codigopostal" => null,
        "direccion_google" => null,
        "direccion_estado" => null,
    ];

    public $fields = [
        "direccion_via" => [
            "html" => [
                "type" => "select",
                "label" => "Via",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "vias"
        ],
        "direccion_direccion" => [
            "html" => [
                "type" => "text",
                "label" => "Dirección",
                "placeholder" => "Nombre de la calle"
            ],
        ],
        "direccion_piso" => [
            "html" => [
                "type" => "text",
                "label" => "Piso",
                "placeholder" => "Piso"
            ],
        ],
        "direccion_numero" => [
            "html" => [
                "type" => "text",
                "label" => "Número",
                "placeholder" => "número"
            ],
        ],
        "direccion_provincia_texto" => [
            "html" => [
                "type" => "text",
                "label" => "Provincia",
                "placeholder" => "Provincia"
            ],
        ],
        "direccion_ciudad_texto" => [
            "html" => [
                "type" => "text",
                "label" => "Ciudad",
                "placeholder" => "Ciudad"
            ],
        ],
        "direccion_codigopostal" => [
            "html" => [
                "type" => "text",
                "label" => "Código Postal",
                "placeholder" => "CP"
            ],
        ],
    ];

    public static $vias = [
        0 => "",
        1 => "Avenida",
        2 => "Calle",
        3 => "Plaza",
    ];

    public static $vias_en = [
        0 => "Avenue",
        1 => "Street",
        2 => "Road",
    ];

    public function __construct(){
        $this->model = new DireccionModel();
        $this->pais_model = new PaisModel();
        $this->provincia_model = new ProvinciaModel();
        $this->ciudad_model = new CiudadModel();
    }

    public function getPais(){
        if ($this->_get("pais_id") > 0) {
            $pais =  $this->pais_model->find(intval($this->_get("pais_id")));
        }
        if (empty($pais)) {
            $pais = new Pais();
        }
        return new Pais();
    }

    public function getProvinciaName(){
        if ($this->_get("provincia_id") > 0) {
            $provincia = $this->provincia_model->find($this->_get("provincia_id"));
            return $provincia->_get("nombre");
        }
        return $this->_get("provincia_texto");
    }

    public function getCiudadName(){
        if ($this->_get("ciudad_id") > 0) {
            $ciudad = $this->ciudad_model->find($this->_get("ciudad_id"));
            return $ciudad->_get("nombre");
        }
        return $this->_get("ciudad_texto");
    }

    public function completa(){
        $direccion = self::$vias[intval($this->_get("via"))]." ".$this->_get("direccion").", ".$this->_get("numero").", ".$this->_get("piso").". ";
        $direccion .= $this->getCiudadName().", ".$this->getProvinciaName().", ".$this->getPais()->_get("nombre");
        return $direccion;
    }

}
