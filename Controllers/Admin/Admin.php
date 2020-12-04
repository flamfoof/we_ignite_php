<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Admin extends AdminController {

	public function index() {
		$this->data["content"] = view("admin/dashboard/home", $this->data);
		return $this->printPage();
	}

	public function temporada(){
		$productoModel = new \App\Models\ProductoModel();
		$productos = $productoModel->where("producto_estado", 1)->findAll();
		foreach ($productos as $producto) {
			$productoColeccion = new \App\Entities\ProductoColeccion();
			$productoColeccion->_set("producto_id", $producto->_id());
			$productoColeccion->_set("coleccion_id", 2);
			$productoColeccion->_set("estado", 1);
			$productoColeccion->update();

			$productoColeccion = new \App\Entities\ProductoColeccion();
			$productoColeccion->_set("producto_id", $producto->_id());
			$productoColeccion->_set("coleccion_id", 3);
			$productoColeccion->_set("estado", 1);
			$productoColeccion->update();
		}
		echo "update finish";
	}

	public function menuadmin_favorito(){
		$dataHref = $this->input->getPostGet("dataHref");
		$menuAdmin = $this->menuadmin_model
			->where("menuadmin_url", $dataHref)
			->groupStart()
				->where("menuadmin_estado", 1)
				->orWhere("menuadmin_estado", 3)
			->groupEnd()
			->first();
		$result = [
			"favorito" => "false",
			"query" => (string)$this->menuadmin_model->getLastQuery(),
		];
		if (!empty($menuAdmin)) {
			if ($menuAdmin->_get("estado") == 1) {
				$menuAdmin->_set("estado", 3);
				$result["favorito"] = "true";
			} else {
				$menuAdmin->_set("estado", 1);
			}
			$menuAdmin->update();
		}
		echo json_encode($result);
	}

	public function menuadmin_list(){
		$this->data["list_title"] = "Links del menu administrador";
		$this->data["list_base_link"] = base_url("admin/menuadmin");
		$this->data["list_table"] = ["name"];
		$this->data["entity"] = new \App\Entities\MenuAdmin();
		$menuAdminModel = new \App\Models\MenuAdminModel();
		if (isset($_GET["query"])) {
			$menuAdminModel->like("menuadmin_name", $_GET["query"]);
		}
		$this->data["fichas"] = $menuAdminModel
			->where("menuadmin_estado", 1)->paginate(10);
		$this->data["pagination"] = $menuAdminModel->pager;
		$menuAdminModel->pager->setPath("admin/menusadmin");
		$this->data["content"] = view("templates/custom_list", $this->data);
		return $this->printPage();
	}

	public function menuadmin_ver($id){
		$menuAdminModel = new \App\Models\MenuAdminModel();
		if ($id > 0) {
			$menuAdmin = $menuAdminModel->find($id);
		} else {
			$menuAdmin = new \App\Entities\Banner();
		}
		$this->data["request"] = $this->input;
		$this->data["ficha"] = $menuAdmin;
		$this->data["content"] = view("admin/menuadmin/ficha", $this->data);
		return $this->printPage();
	}

	public function menuadmin_borrar($id){
		$menuAdminModel = new \App\Models\MenuAdminModel();
		if ($id > 0) {
			$menuAdminModel->where('menuadmin_id', $id);
			$menuAdminModel->delete();
			$this->notification("success", "MenuAdmin Borrado");
			return redirect()->to(base_url("admin/menusadmin"));
		}
	}
}
