<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\ArchivoModel;
use App\Models\ConfiguracionModel;

class Webs extends PublicController{

	protected $archivoModel;
	public function __construct(){
		$this->archivoModel = new ArchivoModel();
	}

	public function ver_archivo($archivo_id){
		$archivo = $this->archivoModel->find($archivo_id);
		$this->response->setContentType($archivo->_get("mime"));
		$image = file_get_contents($archivo->getHRef());
	    echo $image;
	}

	public function pagina($url = ""){
		$menu_model = new \App\Models\MenuModel();
		$current = $menu_model->where("menu_url", $url)->first();
		if (!empty($current)) {
			$pagina = $current->getPagina();
			if (!empty($pagina)) {
				if ($current->_get("url") == "") {
					$this->data["isHome"] = true;
				}
				$this->data["content"] = $pagina->getContent($this->data);
				$this->data["pagina"] = $pagina;
			} else {
				header('Location: '.$current->_Get("url"));
				exit;
			}
		} else {
			return redirect()->to(base_url("404"));
		}
		return $this->printPage(true);
	}

}
