<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\BannerModel;
use App\Models\ArchivoModel;

class Banner extends BaseEntity{
    protected $model;
    protected $archivo_model;

    protected $attributes = [
        "banner_id" => null,
        "banner_lang_id" => null,
        "banner_ubicacion" => null,
        "banner_posicion" => null,
        "banner_ancho" => null,
        "banner_alto" => null,
        "banner_imagen" => null,
        "banner_video" => null,
        "banner_titulo" => null,
        "banner_descripcion" => null,
        "banner_link" => null,
        "banner_estado" => null,
    ];

    public $fields = [
        "banner_titulo" => [
            "html" => [
                "type" => "text",
                "label" => "Titulo",
                "placeholder" => "Titulo del banner"
            ],
        ],
        "banner_descripcion" => [
            "html" => [
                "type" => "textarea",
                "label" => "Descripcion",
                "placeholder" => "Descripcion del banner"
            ],
        ],
        "banner_link" => [
            "html" => [
                "type" => "text",
                "label" => "Link",
                "placeholder" => "/link/del/banner"
            ],
        ],
        "banner_ubicacion" => [
            "html" => [
                "type" => "select",
                "label" => "¿Donde irá el banner?",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "ubicaciones"
        ],
        "banner_posicion" => [
            "html" => [
                "type" => "number",
                "label" => "Posicion",
                "placeholder" => "Orden en la que aparece el banner"
            ],
        ],
        "banner_ancho" => [
            "html" => [
                "type" => "select",
                "label" => "¿Donde irá el banner?",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "anchos"
        ],
        "banner_alto" => [
            "html" => [
                "type" => "select",
                "label" => "¿Donde irá el banner?",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "altos"
        ],
        "banner_estado" => [
            "html" => [
                "type" => "select",
                "label" => "Estado del banner",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "estados"
        ],
    ];

    protected $_imagen;

    public static $estados = [
        0 => "Borrar",
        1 => "Activo",
        2 => "Inactivo",
    ];

    public static $ubicaciones = [
        0 => "Pantalla de inicio",
        1 => "Bloques",
    ];

    public static $anchos = [
        "col-12 col-lg-2" => "1/6 de la pantalla",
        "col-12 col-lg-3" => "1/4 de la pantalla",
        "col-12 col-lg-4" => "1/3 de la pantalla",
        "col-12 col-lg-6" => "1/2 de la pantalla",
        "col-12 col-lg-8" => "2/3 de la pantalla",
        "col-12 col-lg-10" => "5/6 de la pantalla",
        "col-12" => "toda la pantalla",
    ];

    public static $altos = [
        "auto" => "Automatico",
        "10vh" => "10% de la pantalla",
        "20vh" => "20% de la pantalla",
        "30vh" => "30% de la pantalla",
        "40vh" => "40% de la pantalla",
        "50vh" => "50% de la pantalla",
        "60vh" => "60% de la pantalla",
        "70vh" => "70% de la pantalla",
        "80vh" => "80% de la pantalla",
        "90vh" => "90% de la pantalla",
        "100vh" => "100% de la pantalla",
    ];

    public function __construct(){
        $this->model = new BannerModel();
        $this->archivo_model = new ArchivoModel();
    }

    public function getImagen(){
        $this->_imagen = base_url("assets/images/launch.svg");
        if($this->_id()>0){
            if(($this->_id() > 0)&&($this->_get("imagen") > 0)){
                $archivo = $this->archivo_model->find($this->_get("imagen"));
                $this->_imagen = $archivo->getAsBase64();
            }
        }
        return $this->_imagen;
    }

    public function subirImagen($fileName){
        $root = FCPATH."assets/images/banners";
        if($this->_get("imagen") > 0){
            $archivo = $this->archivo_model->find($this->_get("imagen"));
            $archivo->_set("alt", ($this->_get("imagen_alt") != "") ? $this->_get("imagen_alt") : "vacio");
            $archivo->editFile($fileName, $root);
        } else {
            $archivo = new Archivo();
            $archivo->_set("alt", ($this->_get("imagen_alt") != "") ? $this->_get("imagen_alt") : "vacio");
            $archivo->insertFile($fileName, $root);
        }
        $this->_set("imagen", $archivo->_id());
        $this->update();
    }

}
