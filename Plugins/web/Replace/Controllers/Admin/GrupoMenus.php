<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\MenuGrupoModel;
use App\Entities\MenuGrupo;

class GrupoMenus extends AdminController {

	protected $menuModel;
	public function __construct(){
		$this->menuModel = new MenuGrupoModel();
	}

	public function list() {
		$this->data["list_title"] = "Grupos de Menus";
		$this->data["list_btn_nuevo"] = "Nuevo Grupo de Menu";
		$this->data["list_btn_nuevo_link"] = base_url("admin/grupomenu/nuevo");
		$this->data["list_base_link"] = base_url("admin/grupomenu");
		$this->data["list_table"] = ["name", "url"];
		$this->data["entity"] = new MenuGrupo();
		if (isset($_GET["query"])) {
			$this->menuModel->like("grupomenu_name", $_GET["query"]);
		}
		$this->data["fichas"] = $this->menuModel
			->where("menugrupo_estado", 1)
			->paginate(10);
		$this->data["pagination"] = $this->menuModel->pager;
		$this->menuModel->pager->setPath("admin/grupomenus");
		$this->data["content"] = view("templates/custom_list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0, $ajax = 0){
		if ($id > 0) {
			$menu = $this->menuModel->find($id);
		} else {
			$menu = new MenuGrupo();
		}
		$this->data["ficha"] = $menu;

		if ($ajax == 0) {
			$this->data["content"] = view("admin/grupomenus/ficha", $this->data);
			return $this->printPage();
		} else {
			echo view("admin/grupomenus/partes/ficha", $this->data);
		}
	}

	public function guardar($id = 0){
		$menu = new MenuGrupo();
		if ($id > 0) {
			$menu = $this->menuModel->find($id);
		}
		$ficha = $this->input->getPostGet("ficha");
		$result = $menu->save($ficha);
		if ($result === true) {
			$this->notification("success", "Menu Guardado");
			if (isset($ficha["redirect"])) {
				return redirect()->to(base_url($ficha["redirect"]));
			} else {
				return redirect()->to(base_url("admin/grupomenu/{$menu->_id()}/editar"));
			}
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if (isset($ficha["redirect"])) {
				return redirect()->to(base_url($ficha["redirect"]));
			} else {
				if ($id > 0) {
					return redirect()->to(base_url("admin/grupomenu/{$menu->_id()}/editar"));
				} else {
					return redirect()->to(base_url("admin/grupomenus/nuevo"));
				}
			}
		}

	}

	public function borrar($id){
		$menu = $this->menuModel->find($id);
		$menu->_set("estado", 0);
		$menu->update();
		return redirect()->to(base_url("admin/grupomenus"));
	}

	public function borrar_post($id){
		$redirect = $this->input->getPostGet("redirect");
		$menu = $this->menuModel->find($id);
		$menu->_set("estado", 0);
		$menu->update();
		if ($redirect != "") {
			return redirect()->to(base_url($redirect));
		}
		return redirect()->to(base_url("admin/grupomenus"));
	}
}
