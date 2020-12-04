<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\MenuGrupo;

class MenuGrupoModel extends Model {
    protected $table = 'menugrupo';
    protected $primaryKey = 'menugrupo_id';
    protected $returnType    = 'App\Entities\MenuGrupo';
    protected $allowedFields = [
        "menugrupo_id",
        "menugrupo_name",
        "menugrupo_custom",
        "menugrupo_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
