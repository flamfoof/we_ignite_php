<?php
namespace App\Controllers\Admin;
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
use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;
use App\Models\ConfiguracionModel;
use App\Models\MenuAdminModel;
use App\Entities\Usuario;

class AdminController extends BaseController{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	public $usuario_model;
	public $menuadmin_model;
	public $configuracion;
	public $usuario;
	public $data = array();
	public $links = [];
	public $structure = array(
		"parts"=>array(
			"header" => "templates/header",
			"sub_header" => "templates/sub_header"
		),
        "result" => "templates/admin"
	);

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
		if (isset($_COOKIE["auth"])) {
			$this->usuario = $_COOKIE["auth"];
			unset($_COOKIE["auth"]);
		}
		$this->data["uri"] = $this->request->uri;
		$this->data["usuario"] = $this->usuario;

		$configuracionModel = new ConfiguracionModel();
		$this->configuracion = $configuracionModel->getDataConfig($this->data);
		$this->data["configuracion"] = $this->configuracion;

		$this->loadLinks($this->configuracion);
	}

	public function loadLinks($configuracion){
		$this->menuadmin_model = new MenuAdminModel();
		$this->data["menuadmin_model"] = $this->menuadmin_model;
		$this->links = $this->menuadmin_model->getDataLinks($this->data);
		$this->data["links"] = $this->links;

		$favoritos = $this->menuadmin_model
			->where("menuadmin_estado", 3)
			->orderBy("menuadmin_posicion", "ASC")
			->findAll();
		$this->data["links_favoritos"] = $favoritos;
	}
}
