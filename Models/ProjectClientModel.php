<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\ProjectClient;

class ProjectClientModel extends Model {
    protected $table = 'projectclient';
    protected $primaryKey = 'projectclient_id';
    protected $returnType    = 'App\Entities\ProjectClient';
    protected $allowedFields = [
        "projectclient_id",
        "projectclient_usuario_id",
        "projectclient_project_id",
        "projectclient_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
