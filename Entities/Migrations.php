<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\MigrationsModel;

class Migrations extends BaseEntity{
    public $model;

    protected $attributes = [
        "id" => null,
        "version" => null,
        "class" => null,
        "group" => null,
        "namespace" => null,
        "time" => null,
        "batch" => null,
    ];

    public $fields = [

    ];


    public function __construct(){
        $this->model = new MigrationsModel();
    }

}
