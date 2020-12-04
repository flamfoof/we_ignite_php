<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\BannerModel;
use App\Models\IdiomaModel;
use App\Entities\Banner;

class Banners extends AdminController {

	protected $bannerModel;
	public function __construct(){
		$this->bannerModel = new BannerModel();
	}

	public function list() {
		$this->data["list_title"] = "Banners";
		$this->data["list_btn_nuevo"] = "Nuevo Banner";
		$this->data["list_btn_nuevo_link"] = base_url("admin/banner/nuevo");
		$this->data["list_base_link"] = base_url("admin/banner");
		$this->data["list_table"] = ["titulo"];
		$this->data["entity"] = new Banner();
		if (isset($_GET["query"])) {
			$this->bannerModel->like("banner_nombre", $_GET["query"]);
		}
		$this->data["fichas"] = $this->bannerModel
			->where("banner_estado", 1)->paginate(10);
		$this->data["pagination"] = $this->bannerModel->pager;
		$this->bannerModel->pager->setPath("admin/banners");
		$this->data["content"] = view("templates/custom_list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		if ($id > 0) {
			$banner = $this->bannerModel->find($id);
		} else {
			$banner = new Banner();
		}
		$this->data["request"] = $this->input;
		$this->data["ficha"] = $banner;
		$this->data["content"] = view("admin/banners/ficha", $this->data);
		return $this->printPage();
	}

	public function guardar($id = 0){
		$banner = new Banner();
		if ($id > 0) {
			$banner = $this->bannerModel->find($id);
		}
		if ($banner->save($this->input->getPostGet("ficha")) === true) {
			$banner->subirImagen("file");
			$this->notification("success", "Banner Guardado");
			return redirect()->to(base_url("admin/banner/{$banner->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/banner/{$banner->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/banner/nuevo"));
			}
		}
	}

	public function borrar($id){
		$banner = $this->bannerModel->find($id);
		$banner->_set("estado", 0);
		$banner->update();
		return redirect()->to(base_url("admin/banners"));
	}
}
