<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\CiudadModel;
use App\Entities\Ciudad;

class Ciudades extends AdminController {

	protected $ciudadModel;
	protected $provinciaModel;

	public function __construct(){
		$this->ciudadModel = new CiudadModel();
		$this->provinciaModel = new \App\Models\ProvinciaModel();
	}

	public function list() {
		$this->data["entity"] = new Ciudad();
		if (isset($_GET["query"])) {
			$this->ciudadModel->like("ciudad_nombre", $_GET["query"]);
		}
		$this->data["fichas"] = $this->ciudadModel
			->where("ciudad_estado", 1)->paginate(10);
		$this->data["pagination"] = $this->ciudadModel->pager;
		$this->ciudadModel->pager->setPath("admin/ciudades");
		$this->data["content"] = view("admin/ciudades/list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		if ($id > 0) {
			$ciudad = $this->ciudadModel->find($id);
		} else {
			$ciudad = new Ciudad();
		}
		$this->data["request"] = $this->input;
		$this->data["provincias"] = $this->provinciaModel->where("provincia_estado", 1)->findAll();
		$this->data["ficha"] = $ciudad;
		$this->data["content"] = view("admin/ciudades/ficha", $this->data);
		return $this->printPage();
	}

	public function guardar($id = 0){
		$ciudad = new Ciudad();
		if ($id > 0) {
			$ciudad = $this->ciudadModel->find($id);
		}
		if ($ciudad->save($this->input->getPostGet("ficha")) === true) {
			$this->notification("success", "Ciudad Guardada");
			return redirect()->to(base_url("admin/ciudad/{$ciudad->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/ciudad/{$ciudad->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/ciudad/nueva"));
			}
		}
	}

	public function borrar($id){
		$ciudad = $this->ciudadModel->find($id);
		$ciudad->_set("estado", 0);
		$ciudad->update();
		return redirect()->to(base_url("admin/ciudades"));
	}

	public function editar_todos(){
		$metodo = $this->input->getPostGet("metodo");
		$estado = $this->input->getPostGet("estado");
		$grupopago = $this->input->getPostGet("grupopago");
		$grupoenvio = $this->input->getPostGet("grupoenvio");

		$data = [
	        'ciudad_estado' 			=> $estado,
	        'ciudad_metodoenvio'  	=> $metodo,
	        'ciudad_grupopago_id'  	=> $grupopago,
			'ciudad_grupoenvio_id' 	=> $grupoenvio
		];
		$set = [];
		foreach ($data as $key => $field) {
			$set[] = "$key = '{$field}'";
		}

		$db = \Config\Database::connect();
		$sql = 'UPDATE '.$db->prefixTable('ciudad').' SET '.implode(", ", $set);
		$db->query($sql);
		echo $sql;
	}

	public function options($provincia_id, $default_id){
		$ciudadModel = new \App\Models\CiudadModel();
		$ciudades = $ciudadModel->where("ciudad_provincia_id", $provincia_id)->where("ciudad_estado", 1)->findAll();
		$html = "<option>-- SELECCIONA UNA CIUDAD -- </option>";
		foreach ($ciudades as $key => $ciudad) {
			$selected = ($default_id == $ciudad->_id()) ? "selected" : "";
			$html .= "<option value='{$ciudad->_id()}' $selected>{$ciudad->_get("nombre")}</option>";
		}
		echo $html;
	}
}
