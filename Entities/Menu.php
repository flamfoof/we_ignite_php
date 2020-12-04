<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\MenuModel;
use App\Models\PaginaModel;

class Menu extends BaseEntity{
    protected $model;

    protected $attributes = [
        "menu_id" => null,
        "menu_menu_id" => null,
        "menu_menugrupo_id" => null,
        "menu_pagina_id" => null,
        "menu_posicion" => null,
        "menu_name" => null,
        "menu_url" => null,
        "menu_enlace" => null,
        "menu_icon" => null,
        "menu_custom" => null,
        "menu_estado" => null,
    ];

    public $fields = [
        "menu_name" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre",
            ],
        ],
        "menu_url" => [
            "html" => [
                "type" => "text",
                "label" => "URL",
            ],
        ],
        "menu_enlace" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre del enlace",
            ],
        ],
        "menu_estado" => [
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

    public function __construct(){
        $this->model = new MenuModel();
        $this->pagina_model = new PaginaModel();
    }

    public function getChildren(){
        if (empty($this->_children)) {
            $this->_children = $this->model
                ->where("menu_menu_id", $this->_id())
                ->where("menu_estado", 1)
                ->findAll();
        }
        return $this->_children;
    }

    public function hasChildren(){
        if (empty($this->_children)) {
            $this->_children = $this->getChildren();
        }
        return $this->_children;
    }

    public function getLink(){
        if ($this->_get("url") == "") {
            return base_url();
        }
        if (strpos($this->_get("url"),"http") !== false) {
            return $this->_get("url");
        }
        return base_url($this->_get("url"));
    }

    public function currentURL($lang, $string){
        $current = current_url();
        $getvars = strpos($current, "?");
        if ($getvars > 0) {
            $current = substr($current, 0, $getvars);
        }
        $current = str_replace("/$lang", "", $current);
        if ($current == $this->_get("url")) {
            return $string;
        }
        if (
            ($this->_get("url") == "") &&
            ("$current/" == base_url())
        ) {
            return $string;
        }
        return "";
    }

    public function getPagina(){
        if ($this->_get("pagina_id") > 0) {
            return $this->pagina_model->find(intval($this->_get("pagina_id")));
        }
        return new \App\Entities\Pagina();
    }

}
