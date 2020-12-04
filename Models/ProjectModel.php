<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Project;

class ProjectModel extends Model {
    protected $table = 'project';
    protected $primaryKey = 'project_id';
    protected $returnType    = 'App\Entities\Project';
    protected $allowedFields = [
        "project_id",
        "project_name",
        "project_url",
        "project_secretkey",
        "project_accesstoken",
        "project_expiration",
        "project_archivo_id",
        "project_windows",
        "project_mac",
        "project_playstore",
        "project_appstore",
        "project_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
