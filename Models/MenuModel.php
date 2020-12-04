<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Menu;

class MenuModel extends Model {
    protected $table = 'menu';
    protected $primaryKey = 'menu_id';
    protected $returnType    = 'App\Entities\Menu';
    protected $allowedFields = [
        "menu_id",
        "menu_menu_id",
        "menu_menugrupo_id",
        "menu_pagina_id",
        "menu_posicion",
        "menu_name",
        "menu_url",
        "menu_enlace",
        "menu_icon",
        "menu_custom",
        "menu_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/

    public function getMenuByGrupo($menurGrupo){
        return $this
            ->join("menugrupo", "menu_menugrupo_id = menugrupo_id")
            ->where("menu_estado", 1)
            ->where("LOWER(menugrupo_name)", mb_strtolower($menurGrupo))
            ->orderBy("menu_posicion", "ASC")
            ->findAll();
    }
}
