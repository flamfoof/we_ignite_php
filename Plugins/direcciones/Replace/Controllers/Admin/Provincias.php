<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\ProvinciaModel;
use App\Models\PaisModel;
use App\Entities\Provincia;

class Provincias extends AdminController {

	protected $provinciaModel;
	protected $paisModel;

	public function __construct(){
		$this->provinciaModel = new ProvinciaModel();
		$this->paisModel = new PaisModel();
	}

	public function list() {
		$this->data["entity"] = new Provincia();
		if (isset($_GET["query"])) {
			$this->provinciaModel->like("provincia_nombre", $_GET["query"]);
		}
		$this->data["fichas"] = $this->provinciaModel
			->where("provincia_estado", 1)->paginate(10);
		$this->data["pagination"] = $this->provinciaModel->pager;
		$this->provinciaModel->pager->setPath("admin/provincias");
		$this->data["content"] = view("admin/provincias/list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		if ($id > 0) {
			$provincia = $this->provinciaModel->find($id);
		} else {
			$provincia = new Provincia();
		}
		$this->data["request"] = $this->input;
		$this->data["paises"] = $this->paisModel->where("pais_estado", 1)->findAll();
		$this->data["ficha"] = $provincia;
		$this->data["content"] = view("admin/provincias/ficha", $this->data);
		return $this->printPage();
	}

	public function guardar($id = 0){
		$provincia = new Provincia();
		if ($id > 0) {
			$provincia = $this->provinciaModel->find($id);
		}
		if ($provincia->save($this->input->getPostGet("ficha")) === true) {
			$this->notification("success", "Provincia Guardado");
			return redirect()->to(base_url("admin/provincia/{$provincia->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/provincia/{$provincia->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/provincia/nuevo"));
			}
		}
	}

	public function borrar($id){
		$provincia = $this->provinciaModel->find($id);
		$provincia->_set("estado", 0);
		$provincia->update();
		return redirect()->to(base_url("admin/provincias"));
	}

	public function editar_todos(){
		$metodo = $this->input->getPostGet("metodo");
		$estado = $this->input->getPostGet("estado");
		$grupopago = $this->input->getPostGet("grupopago");
		$grupoenvio = $this->input->getPostGet("grupoenvio");

		$data = [
	        'provincia_estado' 			=> $estado,
	        'provincia_metodoenvio'  	=> $metodo,
	        'provincia_grupopago_id'  	=> $grupopago,
			'provincia_grupoenvio_id' 	=> $grupoenvio
		];
		$set = [];
		foreach ($data as $key => $field) {
			$set[] = "$key = '{$field}'";
		}

		$db = \Config\Database::connect();
		$sql = 'UPDATE '.$db->prefixTable('provincia').' SET '.implode(", ", $set);
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
			'provincia_estado' 			=> $estado,
	   		'provincia_metodoenvio'  	=> $metodo,
		   	'provincia_grupopago_id'  	=> $grupopago,
		   	'provincia_grupoenvio_id' 	=> $grupoenvio
		];

		$this->provinciaModel
			->whereIn("provincia_id", $formatos)
		    ->set($data)
		    ->update();
		echo $this->provinciaModel->getLastQuery();
	}

	public function options($pais_id, $default_id){
		$provinciaModel = new \App\Models\ProvinciaModel();
		$provincias = $provinciaModel->where("provincia_pais_id", $pais_id)->where("provincia_estado", 1)->findAll();
		$html = "<option>-- SELECCIONA UNA PROVINCIA -- </option>";
		foreach ($provincias as $key => $provincia) {
			$selected = ($default_id == $provincia->_id()) ? "selected" : "";
			$html .= "<option value='{$provincia->_id()}' $selected>{$provincia->_get("nombre")}</option>";
		}
		echo $html;
	}
}
