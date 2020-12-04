<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\EmpresaModel;
use App\Models\ConfiguracionModel;
use App\Models\PedidoModel;

class Configuracion extends AdminController {


	public function __construct(){

	}

	public function configuracion(){
		$configuracion = $this->configuracion;
		if (empty($configuracion)) {
			$configuracion = new Configuracion();
		}
		$this->data["request"] = $this->input;
		$this->data["ficha"] = $configuracion;
		$this->data["content"] = view("admin/configuracion/configuracion", $this->data);
		return $this->printPage();
	}

	public function configuracion_post(){
		$configuracion = $this->configuracion;
		if (empty($configuracion)) {
			$configuracion = new Configuracion();
		}
		$result = $configuracion->save($this->input->getPostGet("ficha"));
		if ($result === true) {
			if ($configuracion->_get("ivageneral") == 1) {
				$configuracion->resetIVAProducts();
			}
			$this->notification("success", "Configuracion Guardada");
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
		}
		return redirect()->to(base_url("admin/configuracion"));
	}

	public function emails(){
		$this->data["content"] = view("admin/configuracion/emails", $this->data);
		return $this->printPage();
	}

	public function email_confirmar(){
		$this->data["content"] = view("admin/configuracion/email_confirmar", $this->data);
		return $this->printPage();
	}

	public function email_confirmar_ver(){
		echo view("{$this->configuracion->getCarpeta()}/mensajes/emails/activar", ["config" => $this->configuracion, "usuario" => $this->usuario, "carpeta" => $this->configuracion->getCarpeta()]);
	}

	public function email_recuperar(){
		$this->data["content"] = view("admin/configuracion/email_recuperar", $this->data);
		return $this->printPage();
	}

	public function email_recuperar_ver(){
		echo view("{$this->configuracion->getCarpeta()}/mensajes/emails/recuperar", ["config" => $this->configuracion, "usuario" => $this->usuario, "carpeta" => $this->configuracion->getCarpeta()]);
	}

	public function email_compra(){
		$this->data["content"] = view("admin/configuracion/email_compra", $this->data);
		return $this->printPage();
	}

	public function email_compra_ver(){
		$pedidoModel = new PedidoModel();
		$pedido = $pedidoModel->first();
		if (!empty($pedido)) {
			echo view("{$this->configuracion->getCarpeta()}/mensajes/emails/pedidorealizado", ["config" => $this->configuracion, "pedido" => $pedido, "carpeta" => $this->configuracion->getCarpeta()]);
		} else {
			echo "No hay pedido";
		}
	}

	public function wizard(){
		$this->data["content"] = view("admin/configuracion/wizard/home", $this->data);
		return $this->printPage();
	}

	public function temas(){
		$directory = APPPATH."Views";
        $files = array_diff(scandir($directory), array('..', '.', 'admin', 'errors', 'templates'));
		$this->data["files"] = $files;
		$this->data["content"] = view("admin/configuracion/temas", $this->data);
		return $this->printPage();
	}

	public function tema_activar($slug){
		$this->configuracion->_set("template", $slug);
		$this->configuracion->update();
		$this->notification("success", "Tema activado");
		return redirect()->to(base_url("admin/configuracion/temas"));
	}
}
