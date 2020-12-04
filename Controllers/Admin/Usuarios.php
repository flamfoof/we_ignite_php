<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;
use App\Models\UsuarioRoleModel;
use App\Models\RoleModel;
use App\Entities\Usuario;
use App\Entities\UsuarioRole;

class Usuarios extends AdminController {

	protected $usuarioModel;
	public $roleModel;
	public $usuarioRoleModel;

	public function __construct(){
		$this->usuarioModel = new UsuarioModel();
		$this->roleModel = new RoleModel();
		$this->usuarioRoleModel = new UsuarioRoleModel();
	}

	public function list() {
		$this->data["list_title"] = "Usuario";
		$this->data["list_btn_nuevo"] = "Nuevo Usuario";
		$this->data["list_btn_nuevo_link"] = base_url("admin/usuario/nuevo");
		$this->data["list_base_link"] = base_url("admin/usuario");
		$this->data["list_table"] = ["nombre", "apellidos", "email"];
		$this->data["entity"] = new Usuario();
		if (isset($_GET["query"])) {
			$this->usuarioModel
				->like("usuario_nombre", $_GET["query"])
				->orLike("usuario_apellidos", $_GET["query"]);
		}
		$this->data["fichas"] = $this->usuarioModel->paginate(10);
		$this->data["pagination"] = $this->usuarioModel->pager;
		$this->usuarioModel->pager->setPath("admin/usuario");
		$this->data["content"] = view("templates/custom_list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		if ($id > 0) {
			$usuario = $this->usuarioModel->find($id);
		} else {
			$usuario = new Usuario();
		}
		$this->data["request"] = $this->input;
		$this->data["tiendas"] = [];
		$this->data["roleModel"] = $this->roleModel;
		$this->data["ficha"] = $usuario;
		$this->data["content"] = view("admin/usuarios/ficha", $this->data);
		return $this->printPage();
	}

	public function guardar($id = 0){
		$usuario = new Usuario();
		if ($id > 0) {
			$usuario = $this->usuarioModel->find($id);
		}
		$ficha = $this->input->getPostGet("ficha");
		if (isset($ficha["password"])) {
			if ($ficha["password"] != "") {
				$ficha["usuario_password"] = password_hash($ficha["password"], PASSWORD_DEFAULT);
			}
		}
		$result = $usuario->save($ficha);
		if ($result === true) {
			$fichaRole = $this->input->getPostGet("ficharol");
			$this->usuarioRoleModel->where("usuariorole_usuario_id", $usuario->_id())->delete();
			if (!empty($fichaRole)) {
				foreach ($fichaRole as $role_id => $value) {
					$usuariorole = $this->usuarioRoleModel
						->where("usuariorole_role_id", $role_id)
						->where("usuariorole_usuario_id", $usuario->_id())->first();
					if (empty($usuariorole)) {
						$usuariorole = new UsuarioRole();
						$usuariorole->_set("role_id", $role_id);
						$usuariorole->_set("usuario_id", $usuario->_id());
						$usuariorole->_set("estado", 1);
						$usuariorole->update();
					} else {
						$usuariorole->_set("estado", 1);
						$usuariorole->update();
					}
				}
			}

			$this->notification("success", "Rol Guardado");
			return redirect()->to(base_url("admin/usuario/{$usuario->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/usuario/{$usuario->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/usuario/nuevo"));
			}
		}

	}

	public function borrar($id){
		$usuario = $this->usuarioModel->find($id);
		$usuario->_set("estado", 0);
		$usuario->update();
		return redirect()->to(base_url("admin/usuarios"));
	}

	public function recuperar($id){
		$usuario = $this->usuarioModel->find($id);
		$usuario->_set("estado", 1);
		$usuario->update();
		if ($usuario->sendRecuperacion($this->configuracion)) {
			$this->notification("success", "Email enviado");
		} else {
			$this->notification("danger", "Email ERROR");
		}
		return redirect()->to(base_url("admin/usuario/{$usuario->_id()}/editar"));
	}

	public function filter(){
		$usuarioModel = new \App\Models\UsuarioModel();
		$value = mb_strtolower($this->input->getPostGet("value"));
		$class = mb_strtolower($this->input->getPostGet("class"));
		$usuarios = $usuarioModel
			->where("usuario_estado", 1)
			->like("LOWER(usuario_nombre)", $value)
			->orLike("LOWER(usuario_apellidos)", $value)
			->orLike("LOWER(usuario_email)", $value)
			->orLike("LOWER(usuario_dni)", $value)
			->findAll(50);
		return view("admin/usuarios/partes/filter", ["usuarios" => $usuarios, "class" => $class]);
	}
}
