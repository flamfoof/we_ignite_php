<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;

class Projects extends AdminController {

	public function __construct(){
	}

	public function list() {
		$projectModel = new \App\Models\ProjectModel();
		$this->data["entity"] = new \App\Entities\Project();
		if (isset($_GET["query"])) {
			$projectModel->like("project_nombre", $_GET["query"]);
		}
		$this->data["fichas"] = $projectModel
			->where("project_estado", 1)->paginate(10);
		$this->data["pagination"] = $projectModel->pager;
		$projectModel->pager->setPath("admin/projects");
		$this->data["content"] = view("admin/projects/list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		$projectModel = new \App\Models\ProjectModel();
		if ($id > 0) {
			$project = $projectModel->find($id);
		} else {
			$project = new \App\Entities\Project();
		}
		$this->data["request"] = $this->input;
		$this->data["ficha"] = $project;
		$this->data["content"] = view("admin/projects/ficha", $this->data);
		return $this->printPage();
	}

	public function guardar($id = 0){
		$projectModel = new \App\Models\ProjectModel();
		$project = new \App\Entities\Project();
		if ($id > 0) {
			$project = $projectModel->find($id);
		}
		$ficha = $this->input->getPostGet("ficha");
		if ($ficha["project_url"] == "") {
			$ficha["project_url"] = slug($ficha["project_name"]);
		}
		if ($ficha["project_secretkey"] == "") {
			$ficha["project_secretkey"] = random_string('alnum', 21);
			$ficha["project_expiration"] = date("Y-m-d H:i:s", time() + (86400 * 30));
		}
		if ($project->save($ficha) === true) {
			$this->notification("success", "Project Guardado");
			return redirect()->to(base_url("admin/project/{$project->_id()}/edit"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/project/{$project->_id()}/edit"));
			} else {
				return redirect()->to(base_url("admin/project/nuevo"));
			}
		}
	}

	public function borrar($id){
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel->find($id);
		$project->_set("estado", 0);
		$project->update();
		return redirect()->to(base_url("admin/projects"));
	}

	public function users($id){
		$usuario_email = $this->input->getPostGet("usuario_email");
		$usuarioModel = new \App\Models\UsuarioModel();
		$usuario = $usuarioModel->where("usuario_email", $usuario_email)->where("usuario_estado", 1)->first();
		if (empty($usuario)) {
			$this->notification("danger", "User not found");
			return redirect()->to(base_url("admin/project/$id/edit"));
		}

		$projectClientModel = new \App\Models\ProjectClientModel();
		$projectClient = $projectClientModel
			->where("projectclient_usuario_id", $usuario->_id())
			->where("projectclient_project_id", $id)
			->first();
		if (empty($projectClient)) {
			$projectClient = new \App\Entities\ProjectClient();
			$projectClient->_set("usuario_id", $usuario->_id());
			$projectClient->_set("project_id", $id);
			$projectClient->_set("estado", 1);
			$projectClient->update();
			$this->notification("success", "User added");
			return redirect()->to(base_url("admin/project/$id/edit"));
		} else {
			if ($projectClient->_get("estado") == 0) {
				$projectClient->_set("estado", 1);
				$projectClient->update();
				$this->notification("success", "User reactivated");
				return redirect()->to(base_url("admin/project/$id/edit"));
			} else {
				$this->notification("success", "User already active");
				return redirect()->to(base_url("admin/project/$id/edit"));
			}
		}
	}

	public function users_delete($project_id, $projectclient_id)	{
		$projectClientModel = new \App\Models\ProjectClientModel();
		$projectClient = $projectClientModel->find($projectclient_id);
		$projectClient->_set("estado", 0);
		$projectClient->update();

		$this->notification("success", "User deleted");
		return redirect()->to(base_url("admin/project/$project_id/edit"));
	}
}
