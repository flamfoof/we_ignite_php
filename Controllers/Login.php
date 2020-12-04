<?php
namespace App\Controllers;

class Login extends PublicController{


	public function __construct(){
	}

	public function login(){
		$this->data["content"] = view("{$this->carpeta}/login/session", $this->data);
		return $this->printPage(true);
	}

	public function login_post(){
		$debug = false;
		$ficha = $this->input->getPostGet("ficha");
		$usuario = $this->usuario_model->login($ficha);
		if (empty($usuario)) {
			if ($debug) {
				die("EMTY USER <br>");
			} else {
				return redirect()->to('login');
			}
		}
		echo ($debug) ? "CREATING COOKIE<br>" : "";
		$fullhash = $usuario->createCookie();
		$userHash = $usuario->_get("log");
		$this->usuario_model->save($usuario);
		echo ($debug) ? $this->usuario_model->getLastQuery()."<br>" : "";


		if ($debug) {
			die ("redirect to micuenta <a href='".base_url("micuenta")."'> go </a>");
		} else {
			if ($this->session->getFlashdata('url') !== null) {
				$url = $this->session->getFlashdata('url');
				return redirect()->to($url);
			}
			//header( "refresh:5;url=".base_url("micuenta") );
			header("location: ".base_url("micuenta") );
			exit();
		}
	}

	public function logout(){
		$mainURL = base_url();
        $mainURL = str_replace("https://", "", $mainURL);
        $mainURL = str_replace("http://", "", $mainURL);
        $mainURL = str_replace("/", "", $mainURL);
		$time =  time() - 3600;
		for ($i=0; $i < 3; $i++) {
			setcookie(\App\Entities\Usuario::$cookies[$i], "", $time, '/', $mainURL, true, true);
			unset($_COOKIE[\App\Entities\Usuario::$cookies[$i]]);
		}
		return redirect()->to(base_url());
	}

	public function registrar(){
		$ficha = $this->input->getPostGet("ficha");

		$usuario = $this->usuario_model->where("LOWER(usuario_email)", mb_strtolower($ficha["email"]))->first();
		if (empty($usuario)) {
			$usuario = new \App\Entities\Usuario();
			$usuario->_set("nombre", $ficha["nombre"]);
			$usuario->_set("apellidos", $ficha["apellidos"]);
			$usuario->_set("email", $ficha["email"]);
			$usuario->_set("telefono", isset($ficha["telefono"]) ? $ficha["telefono"] : "");
			$usuario->_set("log", md5($ficha["email"].date("ymdHis").$ficha["nombre"]));
			$usuario->_set("estado", 0);
			$usuario->update();

			$usuario->sendActivacion($this->configuracion, $this->locale);
			$this->notification("success", lang("app.checkemail"));
			return redirect()->to(base_url("mensaje/registro/ok"));
		} else {
			$this->notification("danger", "El correo electrónico ya existe, intenta recuperar tu contraseña");
			return redirect()->to(base_url("micuenta/login"));
		}
	}

}
