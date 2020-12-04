<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\ConfiguracionModel;

class ProjectUsers extends PublicController{
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
		if (!$this->usuario->hasRole("User")) {
			header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . base_url(""));
            exit;
		}
	}

	public function download($project_url, $usuario_id){
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
	        "result" => "client/download"
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
}
