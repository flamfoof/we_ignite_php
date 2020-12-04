<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\ContactoCRM;

class ContactoCRMModel extends Model {
    protected $table = 'contactocrm';
    protected $primaryKey = 'contactocrm_id';
    protected $returnType    = 'App\Entities\ContactoCRM';
    protected $allowedFields = [
        "contactocrm_id",
        "contactocrm_contacto_id",
        "contactocrm_observaciones",
        "contactocrm_fecha",
        "contactocrm_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
