<?php
namespace App\Models;
use CodeIgniter\Model;

class ZonaModel extends Model {
    protected $table = 'zona';
    protected $primaryKey = 'zona_id';
    protected $returnType    = 'App\Entities\Zona';
    protected $allowedFields = [
        "zona_id",
        "zona_ciudad_id",
        "zona_nombre",
        "zona_estado",
    ];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

}
