<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Transporte;

class TransporteModel extends Model {
    protected $table = 'transporte';
    protected $primaryKey = 'transporte_id';
    protected $returnType    = 'App\Entities\Transporte';
    protected $allowedFields = [
        "transporte_id",
        "transporte_grupotransporte_id",
        "transporte_nombre",
        "transporte_peso_maximo",
        "transporte_volumen_maximo",
        "transporte_precio",
        "transporte_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
