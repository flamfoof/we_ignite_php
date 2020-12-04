<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\PaginaModel;
use App\Models\ArchivoModel;

class Pagina extends BaseEntity{
    protected $model;

    protected $attributes = [
        "pagina_id" => null,
        "pagina_name" => null,
        "pagina_slug" => null,
        "pagina_custom" => null,
        "pagina_estado" => null,

        "pagina_meta_index" => null,
        "pagina_meta_title" => null,
        "pagina_meta_description" => null,
        "pagina_meta_keywords" => null,
        "pagina_facebook_url" => null,
        "pagina_facebook_type" => null,
        "pagina_facebook_title" => null,
        "pagina_facebook_description" => null,
        "pagina_facebook_image" => null,
    ];

    public $fields = [
        "pagina_name" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
            ],
        ],
        "pagina_slug" => [
            "html" => [
                "type" => "text",
                "label" => "Pagina path",
            ],
        ],
        "pagina_estado" => [
            "html" => [
                "type" => "select",
                "label" => "Estado",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "estados",
        ],

        "pagina_meta_index" => [
            "html" => [
                "type" => "select",
                "label" => "Index",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "indexes",
        ],
        "pagina_meta_title" => [
            "html" => [
                "type" => "text",
                "label" => "Meta Titulo",
            ],
        ],
        "pagina_meta_description" => [
            "html" => [
                "type" => "text",
                "label" => "Meta Descripcion",
            ],
        ],
        "pagina_meta_keywords" => [
            "html" => [
                "type" => "text",
                "label" => "Met Keywords",
            ],
        ],
        "pagina_facebook_type" => [
            "html" => [
                "type" => "select",
                "label" => "Index",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "types",
        ],
        "pagina_custom" => [
            "html" => [
                "type" => "text",
                "label" => "Precargar Clases",
            ],
        ],
    ];

    public static $estados = [
        0 => "Borrar",
        1 => "Activo",
        2 => "Inactivo",
    ];

    public static $indexes = [
        0 => "index",
        1 => "noindex,nofollow",
    ];

    public static $types = [
        "website",
        "article",
        "video.movie",
        "book",
        "profile"
    ];

    protected $_children;
    protected $_imagen;
    protected $archivo_model;

    public function __construct(){
        $this->model = new PaginaModel();
        $this->archivo_model = new ArchivoModel();
    }

    public function getType(){
        return self::$types[intval($this->_get("facebook_type"))];
    }

    public function getIndex(){
        return self::$indexes[intval($this->_get("meta_index"))];
    }

    public function getContent($data){
        if ($this->_get("custom") != "") {
            return $this->_get("custom");
        }
        $url = $data["carpeta"]."/".$this->_get("slug");
        if (file_exists(APPPATH."Views/$url.php")) {
            return view($url, $data);
        }
        $url = "staronline/".$this->_get("slug");
        if (file_exists(APPPATH."Views/$url.php")) {
            return view($url, $data);
        }
        $url = "staronline/error/404";
        return view($url, $data);
    }

    public function getRoot($configuracion){
        $url = $configuracion->getCarpeta()."/".$this->_get("slug");
        $file = APPPATH."Views/$url.php";
        if (file_exists($file)) {
            return $file;
        }
        return false;
    }

    public function getImagen(){
        $this->_imagen = base_url("assets/images/launch.svg");
        if($this->_id()>0){
            if(($this->_id() > 0)&&($this->_get("facebook_image") > 0)){
                $archivo = $this->archivo_model->find($this->_get("facebook_image"));
                $this->_imagen = $archivo->getHRef();
            }
        }
        return $this->_imagen;
    }

    public function subirImagen($fileName){
        $root = FCPATH."assets/images/paginas";
        if($this->_get("facebook_image") > 0){
            $archivo = $this->archivo_model->find($this->_get("facebook_image"));
            $archivo->_set("alt", ($this->_get("imagen_alt") != "") ? $this->_get("imagen_alt") : "vacio");
            $archivo->editFile($fileName, $root);
        } else {
            $archivo = new Archivo();
            $archivo->_set("alt", ($this->_get("imagen_alt") != "") ? $this->_get("imagen_alt") : "vacio");
            $archivo->insertFile($fileName, $root);
        }
        $this->_set("facebook_image", $archivo->_id());
        $this->update();
    }

}
