<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\PaginaModel;
use App\Entities\Pagina;

class Paginas extends AdminController {

	protected $paginaModel;
	public function __construct(){
		$this->paginaModel = new PaginaModel();
	}

	public function list() {
		$this->data["list_title"] = "Paginas";
		$this->data["list_btn_nuevo"] = "Nueva Pagina";
		$this->data["list_btn_nuevo_link"] = base_url("admin/pagina/nueva");
		$this->data["list_base_link"] = base_url("admin/pagina");
		$this->data["list_table"] = ["name", "slug"];
		$this->data["entity"] = new Pagina();
		if (isset($_GET["query"])) {
			$this->paginaModel->like("pagina_name", $_GET["query"]);
		}
		$this->data["fichas"] = $this->paginaModel
			->where("pagina_estado", 1)
			->paginate(10);
		$this->data["pagination"] = $this->paginaModel->pager;
		$this->paginaModel->pager->setPath("admin/paginas");
		$this->data["content"] = view("admin/paginas/list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0, $ajax = 0){
		if ($id > 0) {
			$pagina = $this->paginaModel->find($id);
		} else {
			$pagina = new Pagina();
		}
		$this->data["ficha"] = $pagina;
		if ($ajax == 0) {
			$this->data["content"] = view("admin/paginas/ficha", $this->data);
			return $this->printPage();
		} else {
			echo view("admin/paginas/partes/ficha", $this->data);
		}
	}

	public function guardar($id = 0){
		$pagina = new Pagina();
		if ($id > 0) {
			$pagina = $this->paginaModel->find($id);
		}
		$ficha = $this->input->getPostGet("ficha");
		$result = $pagina->save($ficha);
		if ($result === true) {
			$this->notification("success", "Pagina Guardada");
			if (isset($ficha["redirect"])) {
				return redirect()->to(base_url($ficha["redirect"]));
			} else {
				return redirect()->to(base_url("admin/pagina/{$pagina->_id()}/editar"));
			}
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if (isset($ficha["redirect"])) {
				return redirect()->to(base_url($ficha["redirect"]));
			} else {
				if ($id > 0) {
					return redirect()->to(base_url("admin/pagina/{$pagina->_id()}/editar"));
				} else {
					return redirect()->to(base_url("admin/pagina/nueva"));
				}
			}
		}

	}

	public function borrar($id){
		$pagina = $this->paginaModel->find($id);
		$pagina->_set("estado", 0);
		$pagina->update();
		return redirect()->to(base_url("admin/paginas"));
	}

	public function list_install(){
		$this->data["pagina"] = new Pagina();
		$this->data["paginas"] = $this->paginaModel->findAll();
		$this->data["content"] = view("admin/paginas/list_install", $this->data);
		return $this->printPage();
	}

	public function guardar_content($id){
		$pagina = $this->paginaModel->find($id);
		$content = $this->input->getPostGet("content");
		$prevContent = $this->input->getPostGet("prevContent");

		$root = $pagina->getRoot($this->configuracion);
		$file = file_get_contents($root);
		$pos = strpos($file, $prevContent);
		if ($pos !== false) {
			$content = str_replace($prevContent, $content, $file);
			$myfile = fopen($root, "w+") or die("Unable to open file!");
			fwrite($myfile, $content);
			fclose($myfile);
			echo "Página guardada";
		} else {
			echo "String no encontrado $prevContent";
		}
	}
}
