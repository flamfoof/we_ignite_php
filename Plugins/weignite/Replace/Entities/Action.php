<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\ActionModel;

class Action extends BaseEntity{
    protected $model;
    protected $archivo_model;

    public $attributes = [
        "action_id" => null,
        "action_project_id" => null,
        "action_email" => null,
        "action_type" => null,
        "action_data" => null,
        "action_date" => null,
    ];

    public $fields = [

    ];

    protected $_imagen;

    public static $estados = [
        0 => "Borrar",
        1 => "Activo",
        2 => "Inactivo",
    ];

    public function __construct(){
        $this->model = new ActionModel();
    }

}
