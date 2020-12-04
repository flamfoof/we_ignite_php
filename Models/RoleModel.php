<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Role;

class RoleModel extends Model {
    protected $table = 'role';
    protected $primaryKey = 'role_id';
    protected $returnType    = 'App\Entities\Role';
    protected $allowedFields = [
        'role_id',
        'role_nombre',
        'role_estado',
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules = [
        'role_nombre' => 'required|is_unique[role.role_nombre,role_id,{role_id}]'
    ];
    protected $validationMessages = [
        'role_nombre' => [
            'is_unique' => 'Lo sentimos. El nombre del rol ya existe.'
        ]
    ];
    protected $skipValidation     = false;

    /***************************************/

}
