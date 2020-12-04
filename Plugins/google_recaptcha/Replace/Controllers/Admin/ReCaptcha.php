<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class ReCaptcha extends AdminController {

	public function __construct(){
	}

	public function config() {
		$predata = $this->configuracion->_get("data");
		$data = json_decode($predata, true);
		if (isset($data["reCaptcha"])) {
			$this->data["data"] = $data["reCaptcha"];
		}
		$this->data["content"] = view("admin/recaptcha/ficha", $this->data);
		return $this->printPage();
	}

	public function config_post(){
		$ficha = $this->input->getPostGet("ficha");
		$predata = $this->configuracion->_get("data");
		$data = json_decode($predata, true);
		$data["reCaptcha"] = $ficha;
		$this->configuracion->_set("data", json_encode($data));
		$this->configuracion->update();
		$this->notification("success", "reCaptcha Guardado");
		return redirect()->to(base_url("admin/recaptcha"));
	}

}
