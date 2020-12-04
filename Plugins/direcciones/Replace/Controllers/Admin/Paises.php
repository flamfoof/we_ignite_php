<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\PaisModel;
use App\Entities\Pais;

class Paises extends AdminController {

	protected $paisModel;
	public function __construct(){
		$this->paisModel = new PaisModel();
	}

	public function list() {
		$this->data["entity"] = new Pais();
		if (isset($_GET["query"])) {
			$this->paisModel->like("pais_nombre", $_GET["query"]);
		}
		$this->data["fichas"] = $this->paisModel
			->where("pais_estado", 1)->paginate(10);
		$this->data["pagination"] = $this->paisModel->pager;
		$this->paisModel->pager->setPath("admin/paises");
		$this->data["content"] = view("admin/paises/list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		if ($id > 0) {
			$pais = $this->paisModel->find($id);
		} else {
			$pais = new Pais();
		}
		$this->data["request"] = $this->input;
		$this->data["ficha"] = $pais;
		$this->data["content"] = view("admin/paises/ficha", $this->data);
		return $this->printPage();
	}

	public function guardar($id = 0){
		$pais = new Pais();
		if ($id > 0) {
			$pais = $this->paisModel->find($id);
		}
		if ($pais->save($this->input->getPostGet("ficha")) === true) {
			$this->notification("success", "Pais Guardado");
			return redirect()->to(base_url("admin/pais/{$pais->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/pais/{$pais->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/pais/nuevo"));
			}
		}
	}

	public function borrar($id){
		$pais = $this->paisModel->find($id);
		$pais->_set("estado", 0);
		$pais->update();
		return redirect()->to(base_url("admin/paises"));
	}

	public function editar_todos(){
		$metodo = $this->input->getPostGet("metodo");
		$estado = $this->input->getPostGet("estado");
		$grupopago = $this->input->getPostGet("grupopago");
		$grupoenvio = $this->input->getPostGet("grupoenvio");

		$data = [
	        'pais_estado' 			=> $estado,
	        'pais_metodoenvio'  	=> $metodo,
	        'pais_grupopago_id'  	=> $grupopago,
			'pais_grupoenvio_id' 	=> $grupoenvio
		];
		$set = [];
		foreach ($data as $key => $field) {
			$set[] = "$key = '{$field}'";
		}

		$db = \Config\Database::connect();
		$sql = 'UPDATE '.$db->prefixTable('pais').' SET '.implode(", ", $set);
		$db->query($sql);
		echo $sql;
	}

	public function editar_grupo(){
		$metodo = $this->input->getPostGet("metodo");
		$estado = $this->input->getPostGet("estado");
		$grupopago = $this->input->getPostGet("grupopago");
		$grupoenvio = $this->input->getPostGet("grupoenvio");

		$formatosJSON = $this->input->getPostGet("formatos");
		$formatos = json_decode($formatosJSON, true);/**/

		$data = [
	        'pais_estado' 			=> $estado,
	        'pais_metodoenvio'  	=> $metodo,
	        'pais_grupopago_id'  	=> $grupopago,
			'pais_grupoenvio_id' 	=> $grupoenvio
		];

		$this->paisModel
			->whereIn("pais_id", $formatos)
		    ->set($data)
		    ->update();
		echo $this->paisModel->getLastQuery();
	}

	public function options($default_id){
		$paisModel = new \App\Models\PaisModel();
		$paises = $paisModel->where("pais_estado", 1)->findAll();
		$html = "<option>-- SELECCIONA UN PAIS -- </option>";
		foreach ($paises as $key => $pais) {
			$selected = ($default_id == $pais->_id()) ? "selected" : "";
			$html .= "<option value='{$pais->_id()}' $selected>{$pais->_get("nombre")}</option>";
		}
		echo $html;
	}
}
