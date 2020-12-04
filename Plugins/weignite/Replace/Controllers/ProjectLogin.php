<?php
namespace App\Controllers;
use App\Models\UsuarioModel;

class ProjectLogin extends PublicController{

	public function __construct(){

	}

	public function login($project_url){
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel->where("project_url", $project_url)->first();
		$this->data["project"] = $project;
		$this->data["project_url"] = $project_url;
		if (empty($project)) {
			return redirect()->to(base_url());
		}

		$this->structure = array(
			"parts"=>array(
			),
	        "result" => "login/login"
		);
		if ($this->session->getFlashdata('url')!==null) {
			$this->session->keepFlashdata('url');
			echo $this->session->getFlashdata('url');
		}
		$this->data["name"] = "We Ignite";
		$this->data["logo"] = base_url("weignite/assets/images/logo.png");
		return $this->printPage(true);
	}

	public function login_post($project_url){
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel->where("project_url", $project_url)->first();
		$this->data["project"] = $project;
		$this->data["project_url"] = $project_url;
		if (empty($project)) {
			return redirect()->to(base_url());
		}

		$usuario = $this->usuario_model->login($this->input->getPostGet('ficha'));
		if (empty($usuario)) {
			$this->notification("danger", "User not found");
			return redirect()->to(base_url("$project_url/admin"));
		}
		$usuario->getRoles();
		if (!$usuario->hasRole(["Client", "Admin"])) {
			$this->notification("danger", "You do not have permission to access");
			return redirect()->to(base_url("$project_url/admin"));
		}
		$usuario->createCookie();
		$this->usuario_model->save($usuario);
		if ($this->session->getFlashdata('url') !== null) {
			$url = $this->session->getFlashdata('url');
			$this->notification("success", "Session granted");
		}
		$this->notification("success", "Session granted");
		return redirect()->to(base_url('project/dashboard'));
	}

	public function login_client($project_url){
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel->where("project_url", $project_url)->first();
		$this->data["project_url"] = $project_url;
		$this->data["project"] = $project;
		if (empty($project)) {
			return redirect()->to(base_url());
		}

		$this->structure = array(
			"parts"=>array(
			),
	        "result" => "login/login_client"
		);
		if ($this->session->getFlashdata('url')!==null) {
			$this->session->keepFlashdata('url');
			echo $this->session->getFlashdata('url');
		}
		if (!empty($project)) {
			$this->data["name"] = $project->_get("name");
			$this->data["logo"] = $project->getImagen();
			return $this->printPage(true);
		}
		return redirect()->to(base_url());
	}

	public function login_client_post($project_url){
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel->where("project_url", $project_url)->first();
		$this->data["project"] = $project;
		$this->data["project_url"] = $project_url;
		if (empty($project)) {
			return redirect()->to(base_url());
		}

		$usuario = $this->usuario_model->login($this->input->getPostGet('ficha'));
		if (empty($usuario)) {
			$this->notification("danger", "User not found");
			return redirect()->to(base_url("$project_url/login"));
		}
		$usuario->getRoles();
		if (!$usuario->hasRole(["User"])) {
			$roleModel = new \App\Models\RoleModel();
			$role = $roleModel->where("role_nombre", "User")->first();
			if (empty($role)) {
				$role = new \App\Entities\Role();
				$role->_set("nombre", "User");
				$role->_set("estado", 1);
				$role->update();
			}

			$usuariorole = new \App\Entities\UsuarioRole();
			$usuariorole->_set("role_id", $role->_id());
			$usuariorole->_set("usuario_id", $usuario->_id());
			$usuariorole->_set("estado", 1);
			$usuariorole->update();
		}
		$usuario->createCookie();
		$this->usuario_model->save($usuario);
		$this->notification("success", "Session granted");
		return redirect()->to(base_url("$project_url/user/{$usuario->_id()}"));
	}

	public function register($project_url){
		$this->structure = array(
			"parts"=>array(
			),
	        "result" => "login/register_client"
		);
		if ($this->session->getFlashdata('url')!==null) {
			$this->session->keepFlashdata('url');
			echo $this->session->getFlashdata('url');
		}//$project_name
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel->where("project_url", $project_url)->first();
		$this->data["project"] = $project;
		$this->data["project_url"] = $project_url;
		if (!empty($project)) {
			$this->data["name"] = $project->_get("name");
			$this->data["logo"] = $project->getImagen();
			return $this->printPage(true);
		}
		return redirect()->to(base_url());
	}

	public function register_post($project_url){
		$ficha = $this->input->getPostGet('ficha');

		$usuarioModel = new \App\Models\UsuarioModel();
		$usuario = $usuarioModel
			->where("usuario_email", $ficha["usuario_email"])
			->where("usuario_estado", 1)
			->first();
		if (!empty($usuario)) {
			$this->notification("danger", "User already exist");
			return redirect()->to(base_url("$project_url/register"));
		}
		$usuario = new \App\Entities\Usuario();
		$usuario->save($ficha);
		$usuario->subirImagen("file");

		$roleModel = new \App\Models\RoleModel();
		$role = $roleModel->where("role_nombre", "User")->first();
		if (empty($role)) {
			$role = new \App\Entities\Role();
			$role->_set("nombre", "User");
			$role->_set("estado", 1);
			$role->update();
		}

		$usuariorole = new \App\Entities\UsuarioRole();
		$usuariorole->_set("role_id", $role->_id());
		$usuariorole->_set("usuario_id", $usuario->_id());
		$usuariorole->_set("estado", 1);
		$usuariorole->update();

		$direccion = new \App\Entities\Direccion();
		$direccion->_set("usuario_id", $usuario->_id());
		$direccion->_set("pais_id", 1);
		$direccion->_set("provincia_id", $ficha["state"]);
		$direccion->_set("ciudad_id", $ficha["city"]);
		$direccion->_set("direccion", $ficha["address"]);
		$direccion->_set("codigopostal", $ficha["zip"]);
		$direccion->update();

		$usuario->sendActivacion($this->configuracion, 'en');

		$this->notification("success", "User registered");
		return redirect()->to(base_url("$project_url/user/{$usuario->_id()}/verify"));
	}

	public function verify($project_url, $usuario_id){
		$this->structure = array(
			"parts"=>array(
			),
	        "result" => "login/check_your_email"
		);
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel->where("project_url", $project_url)->first();
		$this->data["project"] = $project;
		$this->data["project_url"] = $project_url;
		if (!empty($project)) {
			$this->data["name"] = $project->_get("name");
			$this->data["logo"] = $project->getImagen();
			return $this->printPage(true);
		}
		return redirect()->to(base_url());
	}

	public function recover($project_url){
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel->where("project_url", $project_url)->first();
		$this->data["project"] = $project;
		$this->data["project_url"] = $project_url;
		if (empty($project)) {
			return redirect()->to(base_url());
		}

		$this->structure = array(
			"parts"=>array(
			),
	        "result" => "login/recovery_client"
		);
		if ($this->session->getFlashdata('url')!==null) {
			$this->session->keepFlashdata('url');
			echo $this->session->getFlashdata('url');
		}//$project_name
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel->where("project_url", $project_url)->first();
		$this->data["project"] = $project;
		$this->data["project_url"] = $project_url;
		if (!empty($project)) {
			$this->data["name"] = $project->_get("name");
			$this->data["logo"] = $project->getImagen();
			return $this->printPage(true);
		}
		return redirect()->to(base_url());
	}

	public function recover_post($project_url){
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel->where("project_url", $project_url)->first();
		$this->data["project"] = $project;
		$this->data["project_url"] = $project_url;
		if (empty($project)) {
			return redirect()->to(base_url());
		}


		$ficha = $this->input->getPostGet('ficha');

		$usuarioModel = new \App\Models\UsuarioModel();
		$usuario = $usuarioModel
			->where("usuario_email", $ficha["usuario_email"])
			->where("usuario_estado", 1)
			->first();
		if (empty($usuario)) {
			$this->notification("danger", "User not found");
			return redirect()->to(base_url("$project_url/register"));
		}

		/***********************************/
		$usuario->_set("log", md5($usuario->_get("email").date("ymdHis").$usuario->_get("nombre")));
		$usuario->update();

		$configuracion = $this->configuracion;
		$de				= $configuracion->_get("email");
		$nombreTienda	= $configuracion->_get("nombretienda");
		$para			= $usuario->_get("email");
		$titulo			= " Revore you password - {$project_url}";
		$mensaje		= view("{$configuracion->getCarpeta()}/mensajes/emails/recuperar", ["config" => $configuracion, "usuario" => $usuario, "carpeta" => $configuracion->getCarpeta(), "project_url" => $project_url]);

		$configuracion->sendEmail($de, $nombreTienda, $para, $titulo, $mensaje);
		/**********************************/

		$this->notification("success", "Password recovery email was sent");
		return redirect()->to(base_url("$project_url/login"));
	}

	public function activation($project_url, $log){
		$usuario = $this->usuario_model
			->where("usuario_log", $log)
			->where("usuario_log IS NOT NULL", null, false)
			->first();
		if (empty($usuario)) {
			$this->notification("danger", "User not found, try to register first");
			return redirect()->to(base_url("{$project_url}/login"));
		} else {
			$usuario->_set("estado", 1);
			$usuario->update();
			$this->notification("success", "Congratulation your account has been validated and can set a new password now");

			$this->data["ignore_banner"] = true;
			$this->data["log"] = $log;
			$this->data["content"] = view("{$this->carpeta}/login/password", $this->data);
			return $this->printPage(true);
		}
	}

	public function activation_post($project_url, $log){
		$usuario = $this->usuario_model
			->where("usuario_log", $log)
			->where("usuario_log IS NOT NULL", null, false)
			->first();
		if (empty($usuario)) {
			$this->notification("danger", "Oops something went wrong, try to repeat the operation or get in contact with us.");
			return redirect()->to(base_url("{$project_url}/login"));
		} else {
			$ficha = $this->input->getPostGet("ficha");
			if ($ficha["password"] == $ficha["password2"]) {
				$usuario->_set("password", password_hash($ficha["password"], PASSWORD_DEFAULT));
				$usuario->_set("estado", 1);
				$usuario->_set("log", "");
				$usuario->update();
				$this->notification("success", "You can login now");
				return redirect()->to(base_url("{$project_url}/login"));
			}
			$this->notification("danger", "Password does not match, try again");
			return redirect()->to(base_url("{$project_url}/account/activation/{$log}"));
		}
	}
}
