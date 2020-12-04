<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\ConfiguracionModel;

class API extends BaseController{

	public function __construct(){
	}

	public function getProject($project_id, $field){
		$header = getallheaders();
		if (!isset($header["Authorization"])) {
			$response = [
				'status'   => 404,
				'code'     => 'abc16',
				'messages' => [
					'Auth needed',
				]
			];
			header("HTTP/1.0 404 Not Found");
			echo json_encode($response);
			exit();
		}
		if (strpos($header["Authorization"], "Basic") === false) {
			$response = [
				'status'   => 404,
				'code'     => 'abc26',
				'messages' => [
					'No Access',
				]
			];
			header("HTTP/1.0 404 Not Found");
			echo json_encode($response);
			exit();
		}
		$auth = $header["Authorization"];
		$auths = explode(" ", $auth);
		$auth = base64_decode(end($auths));
		$auth = explode(":", $auth);
		if ($auth[0] != $field) { //$auth[0] != "project_secretkey"/"project_accesstoken"
			$response = [
				'status'   => 404,
				'code'     => 'abc40',
				'messages' => [
					'No Access',
				]
			];
			header("HTTP/1.0 404 Not Found");
			echo json_encode($response);
			exit();
		}
		$secretKey = end($auth);
		$projectModel = new \App\Models\ProjectModel();
		$project = $projectModel
			->where("project_id", $project_id)
			->where($field, $secretKey) //->where("project_secretkey", $secretKey)
			->first();
		if (empty($project)) {
			$response = [
				'status'   => 404,
				'code'     => 'abc56',
				'messages' => [
					'No Access',
				]
			];
			header("HTTP/1.0 404 Not Found");
			echo json_encode($response);
			exit();
		}
		return $project;
	}

	public function getAccessToken($project_id){
		$project = $this->getProject($project_id, "project_secretkey");
		/*********************************************************************/
		$token = "";
		if ($project->_get("accesstoken") == "") {
			$token = random_string('alnum', 21);
			$expitarionDate = time() + (86400 * 30);//30 days
			$project->_set("accesstoken", $token);
			$project->_set("expiration",  date("Y-m-d H:i:s", $expitarionDate));
			$project->update();
		} else {
			if (strtotime($project->_get("expiration")) < time()) {
				$token = random_string('alnum', 21);
				$expitarionDate = time() + (86400 * 30);//30 days
				$project->_set("accesstoken", $token);
				$project->_set("expiration",  date("Y-m-d H:i:s", $expitarionDate));
				$project->update();
			} else {
				$token = $project->_get("accesstoken");
				$expitarionDate = strtotime($project->_get("expiration"));
			}
		}
		$data = [
			'status'   => 200,
			"tokenAccess" => $token,
			"expiration" => $expitarionDate,
		];
		header("HTTP/1.0 200 OK");
		return json_encode($data);
	}

	public function setAccess($project_id){
		$project = $this->getProject($project_id, "project_accesstoken");
		/*******************************************************************/
		$data = json_decode(file_get_contents('php://input'), true);
		$access = new \App\Entities\Access();
		$access->_set("project_id", $project_id);
		$access->_set("email", $data["access_email"]);
		$access->_set("date", $data["access_date"]);
		$access->_set("horainicio", $data["access_horainicio"]);
		$access->_set("horafin", $data["access_horafin"]);
		$access->update();

		$response = [
			'status'   => 200,
			'code'     => 'abc154',
			'messages' => [
				'Access created',
				$access->attributes
			]
		];
		header("HTTP/1.0 200 OK");
		return json_encode($response);
	}

	public function setAction($project_id){
		$project = $this->getProject($project_id, "project_accesstoken");
		/*******************************************************************/
		$data = json_decode(file_get_contents('php://input'), true);
		$action = new \App\Entities\Action();
		$action->_set("project_id", $project_id);
		$action->_set("email", $data["action_email"]);
		$action->_set("type", $data["action_type"]);
		$action->_set("data", $data["action_data"]);
		$action->_set("date", $data["action_date"]);
		$action->update();

		$response = [
			'status'   => 200,
			'code'     => 'abc141',
			'messages' => [
				'Action created',
				$action->attributes
			]
		];
		header("HTTP/1.0 200 OK");
		return json_encode($response);
	}

	public function login($project_id){
		$project = $this->getProject($project_id, "project_accesstoken");
		/*******************************************************************/
		$data = json_decode(file_get_contents('php://input'), true);
		$email = $data["user_email"];
		$password = base64_decode($data["user_password"]);
		$usuarioModel = new \App\Models\UsuarioModel();
		$usuario = $usuarioModel
			->where("usuario_email", $email)
			->first();

		if (empty($usuario)) {
			$response = [
				'status'   => 404,
				'code'     => 'abc166',
				'messages' => [
					'No User',
				]
			];
			header("HTTP/1.0 404 Not Found");
			echo json_encode($response);
			exit();
		}

		$result = password_verify($password, $usuario->_get("password"));
        if(!$result){
			$response = [
				'status'   => 404,
				'code'     => 'abc181',
				'messages' => [
					'No User',
				]
			];
			header("HTTP/1.0 404 Not Found");
			echo json_encode($response);
			exit();
        }

		$response = [
			'status'   => 200,
			'code'     => 'abc193',
			'messages' => [
				'USer Found',
				'user' => [
					'First Name' 	=> $usuario->_get("nombre"),
					'Last Name' 	=> $usuario->_get("apellidos"),
					'image' 		=> $usuario->getImagen(),
					'email'			=> $usuario->_get("email"),
				]
			]
		];
		header("HTTP/1.0 200 OK");
		return json_encode($response);
	}
}
