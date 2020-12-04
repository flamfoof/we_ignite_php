<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\ConfiguracionModel;

class ProjectClients extends PublicController{
	public function __construct(){

	}

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		$this->structure = array(
			"parts"=>array(

			),
			"result" => "templates/admin"
		);
		if (!$this->usuario->hasRole("Client")) {
			header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . base_url("project/login"));
            exit;
		}
	}

	public function dashboard(){
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel
			->join("projectclient", "projectclient_project_id = project_id")
			->where("projectclient_usuario_id", $this->usuario->_id())
			->first();
		$this->data["project"] = $project;
		if (empty(!$project)) {
			$this->data["graph"] = $project->getGraph();
		}
		$this->data["content"] = view("{$this->carpeta}/pages/dashboard", $this->data);
		return $this->printPage(true);
	}

	public function list(){
		$projectModel = new \App\Models\ProjectModel();
		$this->data["entity"] = new \App\Entities\Project();
		if (isset($_GET["query"])) {
			$projectModel->like("project_nombre", $_GET["query"]);
		}
		$this->data["fichas"] = $projectModel
			->where("project_estado", 1)->paginate(10);
		$this->data["pagination"] = $projectModel->pager;
		$projectModel->pager->setPath("project/list");
		$this->data["content"] = view("{$this->carpeta}/projects/list", $this->data);
		return $this->printPage(true);
	}

	public function view($id){
		$projectModel = new \App\Models\ProjectModel();
		if ($id > 0) {
			$project = $projectModel->find($id);
		} else {
			$project = new \App\Entities\Project();
		}
		$this->data["request"] = $this->input;
		$this->data["ficha"] = $project;
		$this->data["content"] = view("{$this->carpeta}/projects/ficha", $this->data);
		return $this->printPage(true);
	}

	public function add_user($id){
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
			return redirect()->to(base_url("project/$id/view"));
		} else {
			if ($projectClient->_get("estado") == 0) {
				$projectClient->_set("estado", 1);
				$projectClient->update();
				$this->notification("success", "User reactivated");
				return redirect()->to(base_url("project/$id/view"));
			} else {
				$this->notification("success", "User already active");
				return redirect()->to(base_url("project/$id/view"));
			}
		}
	}

	public function users_delete($project_id, $projectclient_id)	{
		$projectClientModel = new \App\Models\ProjectClientModel();
		$projectClient = $projectClientModel->find($projectclient_id);
		$projectClient->_set("estado", 0);
		$projectClient->update();

		$this->notification("success", "User deleted");
		return redirect()->to(base_url("project/$project_id/view"));
	}
}
