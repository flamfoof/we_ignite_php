<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Plugin;

class PluginModel extends Model {
    protected $table = 'plugin';
    protected $primaryKey = 'plugin_id';
    protected $returnType    = 'App\Entities\Plugin';
    protected $allowedFields = [
        "plugin_id",
        "plugin_name",
        "plugin_filename",
        "plugin_custom",
        "plugin_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/

    public function findPlugin($name){
        return $this->model->where("plugin_name", $name)->first();
    }
}
