<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Contacto;

class ContactoModel extends Model {
    protected $table = 'contacto';
    protected $primaryKey = 'contacto_id';
    protected $returnType    = 'App\Entities\Contacto';
    protected $allowedFields = [
        "contacto_id",
        "contacto_fecha",
        "contacto_data",
        "contacto_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
