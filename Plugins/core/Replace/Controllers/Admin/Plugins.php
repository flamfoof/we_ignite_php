<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\PluginModel;
use App\Entities\Plugin;

class Plugins extends AdminController {

	protected $pluginModel;
	public function __construct(){
		$this->pluginModel = new PluginModel();
	}

	public function list() {
		if (isset($_GET["query"])) {
			$this->pluginModel->like("plugin_nombre", $_GET["query"]);
		}
		$this->data["fichas"] = $this->pluginModel
			->where("plugin_estado", 1)
			->paginate(10);
		$this->data["pagination"] = $this->pluginModel->pager;
		$this->pluginModel->pager->setPath("admin/plugins");
		$this->data["content"] = view("admin/plugins/list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		if ($id > 0) {
			$plugin = $this->pluginModel->find($id);
		} else {
			$plugin = new Plugin();
		}
		$this->data["ficha"] = $plugin;
		$this->data["content"] = view("admin/plugins/ficha", $this->data);
		return $this->printPage();
	}

	public function guardar($id = 0){
		$plugin = new Plugin();
		if ($id > 0) {
			$plugin = $this->pluginModel->find($id);
		}
		$result = $plugin->save($this->input->getPostGet("ficha"));
		if ($result === true) {
			$this->notification("success", "plugin Guardado");
			return redirect()->to(base_url("admin/plugin/{$plugin->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/plugin/{$plugin->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/plugin/nuevo"));
			}
		}

	}

	public function borrar($id){
		$plugin = $this->pluginModel->find($id);
		$plugin->_set("estado", 0);
		$plugin->update();
		return redirect()->to(base_url("admin/plugins"));
	}

	public function list_install(){
		$this->data["plugin"] = new Plugin();
		$this->data["plugins"] = $this->pluginModel->findAll();
		$this->data["content"] = view("admin/plugins/list_install", $this->data);
		return $this->printPage();
	}

	public function install($slug){
		$plugin = new Plugin();
		$config = $plugin->install($slug);
		$plugin->_set("custom", json_encode($config));
		$plugin->_set("name", $config["name"]);
		$plugin->_set("filename", $plugin->findBySlug($slug));
		$plugin->_set("estado", 1);
		$plugin->update();
		return redirect()->to(base_url("admin/plugins/install"));
	}

	public function uninstall($plugin_id){
		$plugin = $this->pluginModel->find($plugin_id);
		if (!empty($plugin)) {
			$plugin->uninstall();
			$plugin->_set("estado", 0);
			$plugin->update();
		}
		return redirect()->to(base_url("admin/plugins"));
	}

	public function reset(){
		$db      = \Config\Database::connect();
		$menuAdmin = $db->table('menuadmin');
		$menuAdmin->truncate();
		$plugin = $db->table('plugin');
		$plugin->truncate();
		return redirect()->to(base_url("admin/plugins"));
	}

	public function update($plugin_id){
		$plugin = $this->pluginModel->find($plugin_id);
		if (!empty($plugin)) {
			$plugin->updatePlugin();
		}
		$this->notification("success", "Plugin actualizado");
		return redirect()->to(base_url("admin/plugins"));
	}
}
