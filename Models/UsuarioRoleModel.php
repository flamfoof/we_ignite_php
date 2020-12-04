<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\UsuarioRole;

class UsuarioRoleModel extends Model {
    protected $table = 'usuariorole';
    protected $primaryKey = 'usuariorole_id';
    protected $returnType    = 'App\Entities\UsuarioRole';
    protected $allowedFields = [
        'usuariorole_id',
        'usuariorole_usuario_id',
        'usuariorole_role_id',
        'usuariorole_estado',
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/

}
