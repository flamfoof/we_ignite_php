<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;
use App\Entities\Usuario;

class Login extends LoginController {
	public function index() {
		if ($this->session->getFlashdata('url')!==null) {
			$this->session->keepFlashdata('url');
			echo $this->session->getFlashdata('url');
		}
		return view('admin/login/login');
	}

	public function session() {
		$usuario = $this->usuario_model->login($this->input->getPostGet('ficha'));
		if (empty($usuario)) {
			return redirect()->to('login');
		}
		$usuario->createCookie();
		$this->usuario_model->save($usuario);
		if ($this->session->getFlashdata('url') !== null) {
			$url = $this->session->getFlashdata('url');
			return redirect()->to($url);
		}
		return redirect()->to('admin');
	}

	public function logout(){
		for ($i=0; $i < 3; $i++) {
			unset($_COOKIE[Usuario::$cookies[$i]]);
			setcookie(Usuario::$cookies[$i], null, -1, '/');
		}
		return redirect()->to(base_url());
	}

	//--------------------------------------------------------------------

}
