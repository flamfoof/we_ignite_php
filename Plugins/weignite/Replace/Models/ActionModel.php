<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Action;

class ActionModel extends Model {
    protected $table = 'action';
    protected $primaryKey = 'action_id';
    protected $returnType    = 'App\Entities\Action';
    protected $allowedFields = [
        "action_id",
        "action_project_id",
        "action_email",
        "action_type",
        "action_data",
        "action_date",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
