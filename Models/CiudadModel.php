<?php
namespace App\Models;
use CodeIgniter\Model;

class CiudadModel extends Model {
    protected $table = 'ciudad';
    protected $primaryKey = 'ciudad_id';
    protected $returnType    = 'App\Entities\Ciudad';
    protected $allowedFields = [
        "ciudad_id",
        "ciudad_provincia_id",
        "ciudad_nombre",
        "ciudad_iva",
        "ciudad_grupopago_id",
        "ciudad_grupoenvio_id",
        "ciudad_metodoenvio",
        "ciudad_estado",
    ];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

}
