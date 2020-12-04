<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\MenuAdmin;

class MenuAdminModel extends Model {
    protected $table = 'menuadmin';
    protected $primaryKey = 'menuadmin_id';
    protected $returnType    = 'App\Entities\MenuAdmin';
    protected $allowedFields = [
        "menuadminadmin_id",
        "menuadmin_menuadmin_id",
        "menuadmin_type",
        "menuadmin_url",
        "menuadmin_name",
        "menuadmin_icon",
        "menuadmin_custom",
        "menuadmin_posicion",
        "menuadmin_estado",
        "menuadmin_plugin",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/

    public function getDataLinks(&$data){
        $links = [];
        $prelinks = $this
            ->orderBy("menuadmin_posicion", "ASC")
            ->findAll();
        $links = $this->buildTree($prelinks);
        return $links;
    }

    public function buildTree(Array $data, $parent = 0) {
        $tree = array();
        foreach ($data as $d) {
            if ($d->_get("menuadmin_id") == $parent) {
                $children = $this->buildTree($data, $d->_id());
                // set a trivial key
                if (!empty($children)) {
                    $d->_children = $children;
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }

    public function isFavorit($url){
        $menuAdmin = $this
            ->where("menuadmin_url", $url)
			->groupStart()
				->where("menuadmin_estado", 1)
				->orWhere("menuadmin_estado", 3)
			->groupEnd()
			->first();
        if (!empty($menuAdmin)) {
			if ($menuAdmin->_get("estado") == 3) {
                return true;
            }
		}
        return false;
    }
}
