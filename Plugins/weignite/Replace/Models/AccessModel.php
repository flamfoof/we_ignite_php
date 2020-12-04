<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Access;

class AccessModel extends Model {
    protected $table = 'access';
    protected $primaryKey = 'access_id';
    protected $returnType    = 'App\Entities\Access';
    protected $allowedFields = [
        "access_id",
        "access_project_id",
        "access_email",
        "access_date",
        "access_horainicio",
        "access_horafin",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
