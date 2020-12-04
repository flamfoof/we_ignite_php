<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\ArchivoModel;
use App\Models\PaginaModel;
use App\Entities\Usuario;

class Core extends PublicController{

	protected $archivoModel;

	public function __construct(){
		$this->archivoModel = new ArchivoModel();
		$this->menu_model = new \App\Models\MenuModel();
	}

	public function mostrar_archivo($archivo_id = 0){
		$archivo = $this->archivoModel->find($archivo_id);
		if (!empty($archivo)) {
			$file = FCPATH.$archivo->_get("path").$archivo->_get("nombre");
			if (file_exists($file)) {
				$imagen = file_get_contents($file);
				if ($imagen !== false) {
					header('Content-type: ' . $archivo->_get("mime"));
	                echo $imagen;
	            }
			}
		}
		$file = base_url("assets_admin/images/stories/256_rsz_ross-sneddon-798476-unsplash.jpg");
		$imagen = file_get_contents($file);
		if ($imagen !== false) {
			header('Content-type: image/jpg');
			echo $imagen;
		}
	}

	public function index($url = ""){
		echo "Instalar Star Online Vega";
	}

	public function notFound(){
		header("HTTP/1.0 404 Not Found");
		$path = APPPATH."{$this->carpeta}/error/404.php";
		if (file_exists(APPPATH."views/{$this->carpeta}/error/404.php")) {
			$this->data["content"] = view("{$this->carpeta}/error/404", $this->data);
			return $this->printPage(true);
		} else {
			echo "Page not found ($path)";
		}
	}

}
