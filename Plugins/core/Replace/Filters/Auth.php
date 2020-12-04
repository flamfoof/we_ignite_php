<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Models\UsuarioModel;
use App\Entities\Usuario;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null){
        $usuario_model = new UsuarioModel();
		$usuario = $usuario_model->isLoggedIn();
		if ($usuario === false) {
			//log_message('info', 'User not found, redirect most be taken');
            $redirect = redirect()->route('login')->with('url', uri_string());
			return $redirect;
		}
        if (!$usuario->hasRole("Admin")) {
            $redirect = redirect()->route('login')->with('url', uri_string());
			return $redirect;
		}
        $_COOKIE["auth"] = $usuario;
    }

    //--------------------------------------------------------------------
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
