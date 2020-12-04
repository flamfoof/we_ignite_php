<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\ContactoModel;
use App\Entities\Contacto;

class Contactos extends AdminController {

	protected $contactoModel;
	public function __construct(){
		$this->contactoModel = new ContactoModel();
	}

	public function list() {
		$this->data["list_title"] = "Contactos";
		$this->data["list_base_link"] = base_url("admin/contacto");
		$this->data["list_table"] = ["id", "fecha"];
		$this->data["entity"] = new Contacto();
		$this->data["fichas"] = $this->contactoModel
			->where("contacto_estado", 1)
			->orderBy("contacto_id", "DESC")
			->paginate(10);
		$this->data["pagination"] = $this->contactoModel->pager;
		$this->contactoModel->pager->setPath("admin/contactos");
		$this->data["content"] = view("templates/custom_list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		if ($id > 0) {
			$contacto = $this->contactoModel->find($id);
		} else {
			$contacto = new Contacto();
		}
		$this->data["request"] = $this->input;
		$this->data["ficha"] = $contacto;
		$this->data["content"] = view("admin/contactos/ficha", $this->data);
		return $this->printPage();
	}
	public function guardar($id = 0){
		$contacto = new Contacto();
		if ($id > 0) {
			$contacto = $this->contactoModel->find($id);
		}
		$ficha = $this->input->getPostGet("ficha");
		if ($contacto->save($ficha) === true) {
			$this->notification("success", "Contacto Guardado");
			return redirect()->to(base_url("admin/contacto/{$contacto->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/contacto/{$contacto->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/contacto/nuevo"));
			}
		}
	}

	public function borrar($id){
		$contacto = $this->contactoModel->find($id);
		$contacto->_set("estado", 0);
		$contacto->update();
		return redirect()->to(base_url("admin/contactos"));
	}
}
