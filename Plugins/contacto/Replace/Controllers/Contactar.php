<?php
namespace App\Controllers;

class Contactar extends PublicController{

	public function __construct(){
	}

	public function contacto_post(){
		$ficha = $this->input->getPostGet("ficha");
		$this->data["ficha"] = $ficha;

		$email = \Config\Services::email();
        $email->initialize([
            "mailType" => "html",
        ]);

        $email->setFrom($this->configuracion->_get("email"), $this->configuracion->_get("nombretienda"));
        $email->setTo($this->configuracion->_get("email"));

        $email->setSubject("[Contacto] ".$this->configuracion->_get("nombretienda"));
        $email->setMessage(view("{$this->carpeta}/mensajes/emails/contacto", $this->data));

        $email->send();


		$contacto = new \App\Entities\Contacto();
		$data = [];
		$i = 0;
		foreach ($ficha as $key => $value) {
			$data[$i]["titulo"] = $key;
			$data[$i]["data"] = $value;
			$i ++;
		}
		$contacto->_set("data", json_encode($data));
		$contacto->_set("fecha", date("Y-m-d H:i:s"));
		$contacto->_set("estado", 1);
		$contacto->update();

		return redirect()->to("contacto/ok");
	}

}
