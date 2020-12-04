<?php
namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\ArchivoModel;
use App\Models\PaginaModel;
use App\Entities\Usuario;

class Home extends PublicController{

	protected $archivoModel;

	public function __construct(){
		$this->archivoModel = new ArchivoModel();
		$this->menu_model = new \App\Models\MenuModel();
	}

	public function pagina($url = ""){
		$current = $this->menu_model->where("menu_url", $url)->first();
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
