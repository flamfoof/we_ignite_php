<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\ContactoCRMModel;

class ContactoCRM extends BaseEntity{
    protected $model;
    public $myroles;

    protected $attributes = [
        "contactocrm_id" => null,
        "contactocrm_contacto_id" => null,
        "contactocrm_observaciones" => null,
        "contactocrm_fecha" => null,
        "contactocrm_estado" => null,
    ];

    public $fields = [

    ];


    public function __construct(){
        $this->model = new ContactoCRMModel();
    }

}
