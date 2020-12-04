<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Entities\Usuario;

class Mensajes extends PublicController{


	public function __construct(){

	}

	public function registro_ok() {
		$this->data["content"] = view("{$this->carpeta}/mensajes/otros/registro_ok", $this->data);
		return $this->printPage(true);
	}

	public function contacto_ok(){
		$this->data["content"] = view("{$this->carpeta}/mensajes/otros/contacto_ok", $this->data);
		return $this->printPage(true);
	}

	public function contacto_ko($value=''){
		$this->data["content"] = view("{$this->carpeta}/mensajes/otros/contacto_ko", $this->data);
		return $this->printPage(true);
	}

}
