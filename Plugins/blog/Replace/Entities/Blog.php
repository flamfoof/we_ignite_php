<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\BlogModel;

class Blog extends BaseEntity{
    protected $model;
    protected $archivo_model;
    protected $_imagen;

    protected $attributes = [
        "blog_id" => null,
        "blog_tema" => null,
        "blog_url" => null,
        "blog_fecha" => null,
        "blog_titulo" => null,
        "blog_descripcion" => null,
        "blog_contenido" => null,
        "blog_imagen" => null,
        "blog_video" => null,
        "blog_meta_titulo" => null,
        "blog_meta_description" => null,
        "blog_meta_keywords" => null,
        "blog_estado" => null,
    ];

    public $fields = [
        "blog_tema" => [
            "html" => [
                "type" => "text",
                "label" => "Tema",
            ],
        ],
        "blog_fecha" => [
            "html" => [
                "type" => "date",
                "label" => "Fecha",
            ],
        ],
        "blog_titulo" => [
            "html" => [
                "type" => "text",
                "label" => "Titulo",
            ],
        ],
        "blog_url" => [
            "html" => [
                "type" => "text",
                "label" => "URL",
            ],
        ],
        "blog_descripcion" => [
            "html" => [
                "type" => "textarea",
                "label" => "Descripcion",
            ],
        ],
        "blog_contenido" => [
            "html" => [
                "type" => "textarea",
                "label" => "Contenido",
            ],
        ],
        "blog_meta_titulo" => [
            "html" => [
                "type" => "text",
                "label" => "Meta titulo",
            ],
        ],
        "blog_meta_description" => [
            "html" => [
                "type" => "text",
                "label" => "Meta description",
            ],
        ],
        "blog_estado" => [
            "options" => "estados"
        ],
    ];

    public function __construct(){
        $this->model = new BlogModel();
        $this->archivo_model = new \App\Models\ArchivoModel();
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
        $root = FCPATH."assets/images/blogs";
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
