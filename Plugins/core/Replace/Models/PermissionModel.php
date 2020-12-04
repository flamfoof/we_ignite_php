<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Permission;

class PermissionModel extends Model {
    protected $table = 'permission';
    protected $primaryKey = 'permission_id';
    protected $returnType    = 'App\Entities\Permission';
    protected $allowedFields = [
        'permission_id',
        'permission_nombre',
        'permission_description',
        'permission_estado',
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/

}
