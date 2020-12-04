<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Entities\Provincia;

class ProvinciaModel extends Model {
    protected $table = 'provincia';
    protected $primaryKey = 'provincia_id';
    protected $returnType    = 'App\Entities\Provincia';
    protected $allowedFields = [
        "provincia_id",
        "provincia_pais_id",
        "provincia_nombre",
        "provincia_iva",
        "provincia_grupopago_id",
        "provincia_grupoenvio_id",
        "provincia_metodoenvio",
        "provincia_estado",
    ];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

}
