<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\ZonaModel;
use App\Entities\Zona;

class Zonas extends AdminController {

	protected $zonaModel;
	protected $ciudadModel;

	public function __construct(){
		$this->zonaModel = new ZonaModel();
		$this->ciudadModel = new \App\Models\CiudadModel();
	}

	public function list() {
		$this->data["entity"] = new Zona();
		if (isset($_GET["query"])) {
			$this->zonaModel->like("zona_nombre", $_GET["query"]);
		}
		$this->data["fichas"] = $this->zonaModel
			->where("zona_estado", 1)->paginate(10);
		$this->data["pagination"] = $this->zonaModel->pager;
		$this->zonaModel->pager->setPath("admin/zonas");
		$this->data["content"] = view("admin/zonas/list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		if ($id > 0) {
			$zona = $this->zonaModel->find($id);
		} else {
			$zona = new Zona();
		}
		$this->data["request"] = $this->input;
		$this->data["ciudades"] = $this->ciudadModel->where("ciudad_estado", 1)->findAll();
		$this->data["ficha"] = $zona;
		$this->data["content"] = view("admin/zonas/ficha", $this->data);
		return $this->printPage();
	}

	public function guardar($id = 0){
		$zona = new Zona();
		if ($id > 0) {
			$zona = $this->zonaModel->find($id);
		}
		if ($zona->save($this->input->getPostGet("ficha")) === true) {
			$this->notification("success", "Zona Guardada");
			return redirect()->to(base_url("admin/zona/{$zona->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/zona/{$zona->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/zona/nueva"));
			}
		}
	}

	public function borrar($id){
		$zona = $this->zonaModel->find($id);
		$zona->_set("estado", 0);
		$zona->update();
		return redirect()->to(base_url("admin/zonas"));
	}

	public function editar_todos(){
		$metodo = $this->input->getPostGet("metodo");
		$estado = $this->input->getPostGet("estado");
		$grupopago = $this->input->getPostGet("grupopago");
		$grupoenvio = $this->input->getPostGet("grupoenvio");

		$data = [
	        'zona_estado' 			=> $estado,
	        'zona_metodoenvio'  	=> $metodo,
	        'zona_grupopago_id'  	=> $grupopago,
			'zona_grupoenvio_id' 	=> $grupoenvio
		];
		$set = [];
		foreach ($data as $key => $field) {
			$set[] = "$key = '{$field}'";
		}

		$db = \Config\Database::connect();
		$sql = 'UPDATE '.$db->prefixTable('zona').' SET '.implode(", ", $set);
		$db->query($sql);
		echo $sql;
	}

	public function options($ciudad_id, $default_id){
		$zonaModel = new \App\Models\ZonaModel();
		$zonas = $zonaModel->where("zona_ciudad_id", $ciudad_id)->where("zona_estado", 1)->findAll();
		$html = "<option>-- SELECCIONA UNA ZONA -- </option>";
		foreach ($zonas as $key => $zona) {
			$selected = ($default_id == $zona->_id()) ? "selected" : "";
			$html .= "<option value='{$zona->_id()}' $selected>{$zona->_get("nombre")}</option>";
		}
		echo $html;
	}
}
