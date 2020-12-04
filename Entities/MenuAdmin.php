<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\MenuAdminModel;

class MenuAdmin extends BaseEntity{
    protected $model;

    protected $attributes = [
        "menuadminadmin_id" => null,
        "menuadmin_menuadmin_id" => null,
        "menuadmin_type" => null,
        "menuadmin_name" => null,
        "menuadmin_url" => null,
        "menuadmin_icon" => null,
        "menuadmin_custom" => null,
        "menuadmin_posicion" => null,
        "menuadmin_estado" => null,
        "menuadmin_plugin" => null,
    ];

    public $fields = [
        "menuadmin_name" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
            ],
        ],
        "menuadmin_type" => [
            "html" => [
                "type" => "select",
                "label" => "Estado del banner",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "types"
        ],
        "menuadmin_url" => [
            "html" => [
                "type" => "text",
                "label" => "URL",
            ],
        ],
        "menuadmin_posicion" => [
            "html" => [
                "type" => "text",
                "label" => "Posicion",
            ],
        ],
        "menuadmin_estado" => [
            "html" => [
                "type" => "select",
                "label" => "Estado del banner",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "estados"
        ],

    ];

    public static $types = [
        0 => "Menu",
        1 => "Submenu",
        2 => "Header",
    ];

    public static $estados = [
        0 => "Borrar",
        1 => "Activo",
        2 => "Inactivo",
        3 => "Favorito",
    ];

    public $_children = [];

    public function __construct(){
        $this->model = new MenuAdminModel();
    }

    public function getChildren(){
        return $this->_children;
    }

    public function hasChildren(){
        if (empty($this->_children)) {
            $this->_children = $this->getChildren();
        }
        return $this->_children;
    }

}
