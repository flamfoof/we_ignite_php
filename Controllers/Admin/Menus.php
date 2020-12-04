<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\MenuModel;
use App\Models\MenuGrupoModel;
use App\Entities\Menu;

class Menus extends AdminController {

	protected $menuModel;
	protected $menuGrupoModel;
	public function __construct(){
		$this->menuModel = new MenuModel();
		$this->menuGrupoModel = new MenuGrupoModel();
	}

	public function list() {
		if (isset($_GET["query"])) {
			$this->menuModel->like("menu_name", $_GET["query"]);
		}
		$this->data["fichas"] = $this->menuGrupoModel
			->where("menugrupo_estado", 1)
			->findAll();
		$this->data["content"] = view("admin/menus/list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0, $ajax = 0){
		if ($id > 0) {
			$menu = $this->menuModel->find($id);
		} else {
			$menu = new Menu();
		}
		$this->data["ficha"] = $menu;
		if ($ajax == 0) {
			$this->data["content"] = view("admin/menus/ficha", $this->data);
			return $this->printPage();
		} else {
			echo view("admin/menus/partes/ficha", $this->data);
		}
	}

	public function guardar($id = 0){
		$menu = new Menu();
		if ($id > 0) {
			$menu = $this->menuModel->find($id);
		}
		$ficha = $this->input->getPostGet("ficha");
		if ($ficha["menu_pagina_id"] == -1) {
			$pagina = new \App\Entities\Pagina();
			$pagina->_set("name", "Pagina ".$ficha["menu_name"]);
			$pagina->_set("estado", 1);
			$pagina->update();
			$ficha["menu_pagina_id"] = $pagina->_id();
		}
		$result = $menu->save($ficha);
		if ($result === true) {
			$this->notification("success", "Menu Guardado");
			if (isset($ficha["redirect"])) {
				return redirect()->to(base_url($ficha["redirect"]));
			} else {
				return redirect()->to(base_url("admin/menu/{$menu->_id()}/editar"));
			}
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if (isset($ficha["redirect"])) {
				return redirect()->to(base_url($ficha["redirect"]));
			} else {
				if ($id > 0) {
					return redirect()->to(base_url("admin/menu/{$menu->_id()}/editar"));
				} else {
					return redirect()->to(base_url("admin/menu/nuevo"));
				}
			}

		}

	}

	public function borrar($id){
		$menu = $this->menuModel->find($id);
		$menu->_set("estado", 0);
		$menu->update();
		return redirect()->to(base_url("admin/menus"));
	}

	public function borrar_post($id){
		$redirect = $this->input->getPostGet("redirect");
		$menu = $this->menuModel->find($id);
		$menu->_set("estado", 0);
		$menu->update();
		if ($redirect != "") {
			return redirect()->to(base_url($redirect));
		}
		return redirect()->to(base_url("admin/menus"));
	}

	public function list_install(){
		$this->data["menu"] = new Menu();
		$this->data["menus"] = $this->menuModel->findAll();
		$this->data["content"] = view("admin/menus/list_install", $this->data);
		return $this->printPage();
	}

	public function sort($menugrupo_id){
		$myJSON = $this->input->getPostGet("myJSON");
		$menus = json_decode($myJSON, true);
		$menuGrupo = $this->menuGrupoModel->find($menugrupo_id);
		foreach ($menus as $_menu) {
			if (
				($_menu["source"] != $_menu["destination"]) ||
				($_menu["parent"] != $menugrupo_id)
			) {
				$menu = $this->menuModel->find($_menu["id"]);
				$menu->_set("posicion", $_menu["destination"]);
				$menu->_set("menugrupo_id", $menugrupo_id);
				$menu->update();
			}
		}
	}
}
