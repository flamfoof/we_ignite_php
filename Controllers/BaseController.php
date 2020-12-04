<?php
namespace App\Controllers;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [
		'models_helper',
		'operaciones_helper',
		'cookie',
		'filesystem',
		'array',
		'text'
	];
	public $input;
	public $structure;
	public $session;
	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		$this->session = session();
		$this->input = $this->request;
		$this->data["request"] = $this->request;
		$GLOBALS['helper_models'] = array();
		$this->loadModels();
		$this->moveToSecure();
	}

	public function loadModels(){

	}

	public function moveToSecure(){
        $parts = explode(".", $this->getHost());
        if($parts[1] == "local"){
            return true;
        }

        $location = 'https://' . $this->getHost() . $_SERVER['REQUEST_URI'];

        if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $location);
            exit;
        }

        if(substr($_SERVER['HTTP_HOST'],0,3)=="www"){
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $location);
            exit;
        }
    }

	public function getHost(){
        $host = $_SERVER['HTTP_HOST'];
        $host = str_replace("www.","", $host);
        return $host;
    }

	public function notification($status = "primary", $mensaje = ""){
        $this->session->setFlashdata('message',
            view("templates/alerts",array(
                "classType" => $status,
                "mensaje" => $mensaje,
            ))
        );
    }

	protected function printPage($addCarpeta = false, $flashData = true){
		$html = "";
        $this->data["mensaje"] = ($flashData) ? $this->session->getFlashdata('message') : "";
        foreach ($this->structure["parts"] as $field => $location) {
			$url = $location;
			if ($addCarpeta) {
				$url = $this->configuracion->getCarpeta()."/".$location;
			}
			if (file_exists(APPPATH."Views/$url.php")) {
				$this->data[$field] = view($url,$this->data);
			} else {
				$url = "staronline/".$location;
				if (file_exists(APPPATH."Views/$url.php")) {
					$this->data[$field] = view($url,$this->data);
				} else {
					$this->data[$field] = "file not found: $url";
				}
			}

        }
		$url = $this->structure["result"];
		if ($addCarpeta) {
			$url = $this->configuracion->getCarpeta()."/".$this->structure["result"];
		}
		if (file_exists(APPPATH."Views/$url.php")) {
			return view($url,$this->data);
		} else {
			$url = "staronline/".$this->structure["result"];
			if (file_exists(APPPATH."Views/$url.php")) {
				return view($url,$this->data);
			} else {
				$url = ($addCarpeta) ? APPPATH."Views/".$this->configuracion->getCarpeta()."/".$this->structure["result"].".php" : APPPATH."Views/staronline/".$this->structure["result"].".php";
				return "file not found (result): $url";
			}
		}

    }

}
