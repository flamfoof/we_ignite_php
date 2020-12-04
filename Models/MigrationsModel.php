<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Migrations;

class MigrationsModel extends Model {
    protected $table = 'migrations';
    protected $primaryKey = 'id';
    protected $returnType    = 'App\Entities\Migrations';
    protected $allowedFields = [
        "id",
        "version",
        "class",
        "group",
        "namespace",
        "time",
        "batch",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
