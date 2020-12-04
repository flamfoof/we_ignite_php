<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\GrupoTransporte;

class GrupoTransporteModel extends Model {
    protected $table = 'grupotransporte';
    protected $primaryKey = 'grupotransporte_id';
    protected $returnType    = 'App\Entities\GrupoTransporte';
    protected $allowedFields = [
        "grupotransporte_id",
        "grupotransporte_nombre",
        "grupotransporte_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
