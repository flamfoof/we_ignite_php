<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\RolePermission;

class RolePermissionModel extends Model {
    protected $table = 'rolepermission';
    protected $primaryKey = 'rolepermission_id';
    protected $returnType    = 'App\Entities\RolePermission';
    protected $allowedFields = [
        'rolepermission_id',
        'rolepermission_role_id',
        'rolepermission_permission_id',
        'rolepermission_estado',
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/

}
