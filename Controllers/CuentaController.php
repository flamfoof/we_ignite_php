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
use App\Models\CarritoModel;
use App\Entities\Usuario;
use App\Entities\Configuracion;
use App\Entities\Carrito;

class CuentaController extends BaseController{

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
	public $idioma_model;
	public $marca_model;
	public $familia_model;
	public $usuario;
	public $carpeta;
	public $locale;
	public $locale_id;
	public $data = array();
	public $structure = array();
	public $carrito;
	public $carritoModel;

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
		$debug = false;
		$this->usuario_model = new UsuarioModel();
		$this->idioma_model = new IdiomaModel();
		$this->marca_model = new MarcaModel();
		$this->familia_model = new FamiliaModel();

		$usuario = $this->usuario_model->isLoggedIn();
		if (empty($usuario)) {
			if ($debug) {
				echo $this->usuario_model->getLastQuery();
				die("NO USER! <br>");
			} else {
				$loginURL = base_url("$this->locale/micuenta/login");
				header("Location: {$loginURL}");
				exit;
			}
		} else {
			$this->usuario = $usuario;
		}

		$this->configuracion_model = new ConfiguracionModel();
		$configuracion = $this->configuracion_model->first();
		$this->configuracion = $configuracion;
		$carpeta = $configuracion->getCarpeta();
		$locale = strtolower(service('request')->getLocale());

		//$this->LangRedirect();

		$this->structure = array(
			"parts"=>array(
				"side_menu" => "templates/side_menu",
				"head" => "templates/head",
				"header" => "templates/header",
				"footer" => "templates/footer",
			),
	        "result" => "templates/home"
		);

		$lang = $this->idioma_model
			->where("LOWER(idioma_code)", strtolower($locale))
			->where("idioma_estado", 1)
			->first();
		$this->data["marcas"] = $this->marca_model
			->where("marca_estado", 2)
			->orderBy("marca_nombre", "ASC")
			->findAll();
		$this->data["familias"] = $this->familia_model
			->join("familialang", "familialang_familia_id = familia_id")
			->join("idioma", "idioma_id = familialang_lang_id")
			->where("familia_estado", 1)
			->where("familia_familia_id", 0)
			->orderBy("familialang_nombre", "ASC")
			->findAll();

		$this->locale = $locale;
		$this->carpeta = $carpeta;
		$this->data["usuario"] = $this->usuario;
		$this->data["carpeta"] = $carpeta;
		$this->data["configuracion"] = $configuracion;
		$this->data["locale"] = $this->locale;
		$this->locale_id = 1;
		if (!empty($lang)) {
			$this->locale_id = $lang->_id();
		}
		$this->data["locale_id"] = $this->locale_id;

		$this->carritoModel = new CarritoModel();
		$this->carrito = $this->getCarrito();
		$this->data["carrito"] = $this->carrito;

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

	/********************************************/
	public function getCarrito(){
		if ($this->usuario->_id() > 0) {
			$carrito = $this->carritoModel
				->where("carrito_usuario_id", $this->usuario->_id())
				->where("carrito_usuario_id_vendedor", 0)
				->where("carrito_tienda_id", 0)
				->first();
			if (empty($carrito)) {
				$carrito = new Carrito();
				$carrito->_set("usuario_id", $this->usuario->_id());
				$carrito->_set("id_vendedor", 0);
				$carrito->_set("tienda_id", 0);
				$carrito->_set("estado", 1);
				return $carrito;
			} else {
				return $carrito;
			}
		} else {
			$carrito_sessid = isset($_COOKIE["carrito"]) ? $_COOKIE["carrito"] : null;
			if (
				isset($carrito_sessid) &&
				($carrito_sessid != "")
			) {
				$carrito = $this->carritoModel
					->where("carrito_sessid", $carrito_sessid)
					->where("carrito_usuario_id", 0)
					->where("carrito_usuario_id_vendedor", 0)
					->where("carrito_tienda_id", 0)
					->first();
				if (empty($carrito)) {
					return $this->carritoSession();
				} else {
					return $carrito;
				}
			} else {
				return $this->carritoSession();
			}
		}
	}

	public function carritoSession($carrito = null){
		$sessid = date("YmdHis");
		if ($carrito == null) {
			$carrito = new Carrito();
			$carrito->_set("usuario_id", $this->usuario->_id());
			$carrito->_set("usuario_id_vendedor", 0);
			$carrito->_set("tienda_id", 0);
			$carrito->_set("estado", 1);
		}
		$carrito->_set("sessid", $sessid);
		$this->response->setCookie("carrito", $sessid, (60*60*24*30));
		$carrito->update();
		return $carrito;
	}

}
