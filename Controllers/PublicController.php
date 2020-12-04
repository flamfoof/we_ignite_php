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
use App\Models\UsuarioModel;
use App\Models\ConfiguracionModel;
use App\Models\IdiomaModel;
use App\Models\MarcaModel;
use App\Models\FamiliaModel;
use App\Entities\Usuario;
use App\Entities\Configuracion;
use App\Entities\Carrito;

class PublicController extends BaseController{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [
		'cookie',
		"operaciones_helper"
	];
	public $usuario_model;
	public $configuracion_model;
	public $usuario;
	public $carpeta;
	public $locale;
	public $locale_id;
	public $data = array();
	public $structure = array();
	public $carrito;
	public $configuracion;

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
		$this->usuario_model = new UsuarioModel();

		$usuario = $this->usuario_model->isLoggedIn(false);
		if (empty($usuario)) {
			$this->usuario = new Usuario();
		} else {
			$this->usuario = $usuario;
		}

		$this->configuracion_model = new ConfiguracionModel();
		$configuracion = $this->configuracion_model->first();
		$this->configuracion = $configuracion;
		$carpeta = $configuracion->getCarpeta();

		$this->data["usuario"] = $this->usuario;
		$this->data["carpeta"] = $carpeta;
		$this->data["configuracion"] = $configuracion;
		$this->data["response"] = $response;
		$this->locale = "es";
		$this->data["locale"] = "";
		$this->data["locale_id"] = 1;

		$modulos = json_decode($configuracion->_get("data"), true);
		if (isset($modulos["modelos"])) {
			foreach ($modulos["modelos"] as $modeloName) {
				$cname = "App\\Models\\".$modeloName;
				if (class_exists($cname)) {
					$modelo = new $cname;
					$modelo->PublicController($this->data, $this);
				}
			}
		}
		//$this->LangRedirect();

		$this->structure = array(
			"parts"=>array(
				"head" => "templates/head",
				"header" => "templates/header",
				"footer" => "templates/footer",
			),
	        "result" => "templates/home"
		);
		$this->carpeta = $carpeta;

		$this->locale_id = 1;
		if (!empty($lang)) {
			$this->locale_id = $lang->_id();
		}
		$this->data["locale_id"] = $this->locale_id;

		$this->data["request"] = $this->request;
	}

	public function LangRedirect(){
		$locale = strtolower(service('request')->getLocale());
		$uri = $this->request->uri;
		if (
			($uri->getSegment(1) != $locale) &&
			($uri->getSegment(1) != "admin")
		) {
			$newURL = base_url("{$locale}/".implode("/", $uri->getSegments()));
			header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $newURL);
            exit;
		}
		$this->locale = $locale;
		$this->data["locale"] = $this->locale;
	}

}
