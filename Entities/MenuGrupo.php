<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\MenuGrupoModel;
use App\Models\MenuModel;
use App\Models\PaginaModel;

class MenuGrupo extends BaseEntity{
    protected $model;

    protected $attributes = [
        "menugrupo_id" => null,
        "menugrupo_name" => null,
        "menugrupo_custom" => null,
        "menugrupo_estado" => null,
    ];

    public $fields = [
        "menugrupo_name" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
            ],
        ],
        "menugrupo_estado" => [
            "html" => [
                "type" => "select",
                "label" => "Estado",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "estados",
        ],
    ];

    public static $estados = [
        0 => "Borrar",
        1 => "Activo",
        2 => "Inactivo",
    ];

    protected $_children;
    protected $pagina_model;
    protected $menu_model;

    public function __construct(){
        $this->model = new MenuGrupoModel();
        $this->pagina_model = new PaginaModel();
        $this->menu_model = new MenuModel();
    }

    public function getMenus(){
        return $this->menu_model
            ->where("menu_menugrupo_id", $this->_id())
            ->where("menu_estado", 1)
            ->orderBy("menu_posicion", "ASC")
            ->findAll();
    }

}
