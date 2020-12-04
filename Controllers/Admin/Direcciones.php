<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Direcciones extends AdminController {


	public function __construct(){
	}

	public function ver_direcciones($direccion_id){
		$direccionModel = new \App\Models\DireccionModel();
		$direccion = $direccionModel->find($direccion_id);
		$this->data["ficha"] = $direccion;
		echo view("admin/direcciones/ficha", $this->data);
	}

	public function direccion_ver($id = 0, $direccion_id = 0){
		$usuarioModel = new \App\Models\UsuarioModel();
		$direccionModel = new \App\Models\DireccionModel();
		$paisModel = new \App\Models\PaisModel();
		$usuario = $usuarioModel->find($id);
		if ($direccion_id > 0) {
			$direccion = $direccionModel->find($direccion_id);
		} else {
			$direccion = new \App\Entities\Direccion();
		}
		$this->data["request"] = $this->input;
		$this->data["curusuario"] = $usuario;
		$this->data["ficha"] = $direccion;
		$this->data["paises"] = $paisModel->findAll(5);
		$this->data["content"] = view("admin/direcciones/ficha_direccion", $this->data);
		return $this->printPage();
	}

	public function direccion_guardar($id = 0, $direccion_id = 0){
		$direccionModel = new \App\Models\DireccionModel();
		$usuarioModel = new \App\Models\UsuarioModel();
		$usuario = $usuarioModel->find($id);
		$direccion = new \App\Entities\Direccion();
		$ficha = $this->input->getPostGet("ficha");
		if ($direccion_id > 0) {
			$direccion = $direccionModel->find($direccion_id);
		} else {
			$ficha["direccion_usuario_id"] = $id;
		}
		$result = $direccion->save($ficha);
		if ($result === true) {
			$this->notification("success", "Direccion Guardada");
			return redirect()->to(base_url("admin/usuario/{$usuario->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/usuario/{$usuario->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/usuario/nuevo"));
			}
		}
	}

	public function direccion_borrar($id = 0, $direccion_id = 0){
		$direccionModel = new \App\Models\DireccionModel();
		$usuarioModel = new \App\Models\UsuarioModel();
		$usuario = $usuarioModel->find($id);
		$direccion = $direccionModel->find($direccion_id);
		$direccion->_set("estado", 0);
		$direccion->update();
		return redirect()->to(base_url("admin/usuario/{$usuario->_id()}/editar"));
	}

	public function pais_modal($usuario_id, $pais_id){
		$paisModel = new \App\Models\PaisModel();
		if ($pais_id > 0) {
			$pais = $paisModel->find($pais_id);
		} else {
			$pais = new \App\Entities\Pais();
		}
		$this->data["request"] = $this->input;
		$this->data["ficha"] = $pais;
		echo view("admin/paises/ficha_ajax", $this->data);
	}

	public function pais_modal_post($usuario_id, $pais_id){
		$paisModel = new \App\Models\PaisModel();
		$pais = new \App\Entities\Pais();
		if ($pais_id > 0) {
			$pais = $paisModel->find($pais_id);
		}
		if ($pais->save($this->input->getPostGet("ficha")) === true) {
			$this->notification("success", "Pais Guardado");
			return redirect()->to(base_url("admin/usuario/$usuario_id/direccion/nueva"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			return redirect()->to(base_url("admin/usuario/$usuario_id/direccion/nueva"));
		}
	}

	public function provincia_modal($usuario_id, $provincia_id){
		$paisModel = new \App\Models\PaisModel();
		$provinciaModel = new \App\Models\ProvinciaModel();
		if ($provincia_id > 0) {
			$provincia = $provinciaModel->find($provincia_id);
		} else {
			$provincia = new \App\Entities\Provincia();
		}
		$this->data["request"] = $this->input;
		$this->data["paises"] = $paisModel->where("pais_estado", 1)->findAll();
		$this->data["ficha"] = $provincia;
		echo view("admin/provincias/ficha_ajax", $this->data);
	}

	public function provincia_modal_post($usuario_id, $provincia_id){
		$provinciaModel = new \App\Models\ProvinciaModel();
		$provincia = new \App\Entities\Provincia();
		if ($provincia_id > 0) {
			$provincia = $provinciaModel->find($provincia_id);
		}
		if ($provincia->save($this->input->getPostGet("ficha")) === true) {
			$this->notification("success", "Provincia Guardada");
			return redirect()->to(base_url("admin/usuario/$usuario_id/direccion/nueva"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			return redirect()->to(base_url("admin/usuario/$usuario_id/direccion/nueva"));
		}
	}
}
