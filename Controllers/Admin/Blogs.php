<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\BlogModel;
use App\Entities\Blog;

class Blogs extends AdminController {

	protected $blogModel;
	public function __construct(){
		$this->blogModel = new BlogModel();
	}

	public function list() {
		$this->data["list_title"] = "Blogs";
		$this->data["list_btn_nuevo"] = "Nuevo Blog";
		$this->data["list_btn_nuevo_link"] = base_url("admin/blog/nuevo");
		$this->data["list_base_link"] = base_url("admin/blog");
		$this->data["list_table"] = ["titulo"];
		$this->data["entity"] = new Blog();
		if (isset($_GET["query"])) {
			$this->blogModel->like("blog_titulo", $_GET["query"]);
		}
		$this->data["fichas"] = $this->blogModel
			->where("blog_estado", 1)->paginate(10);
		$this->data["pagination"] = $this->blogModel->pager;
		$this->blogModel->pager->setPath("admin/blogs");
		$this->data["content"] = view("templates/custom_list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		if ($id > 0) {
			$blog = $this->blogModel->find($id);
		} else {
			$blog = new Blog();
		}
		$this->data["request"] = $this->input;
		$this->data["ficha"] = $blog;
		$this->data["content"] = view("admin/blogs/ficha", $this->data);
		return $this->printPage();
	}

	public function guardar($id = 0){
		$blog = new Blog();
		if ($id > 0) {
			$blog = $this->blogModel->find($id);
		}
		$ficha = $this->input->getPostGet("ficha");
		if ($ficha["blog_url"] == "") {
			$ficha["blog_url"] = slug($ficha["blog_titulo"]);
		}
		if ($blog->save($ficha) === true) {
			$blog->subirImagen("file");
			$this->notification("success", "Blog Guardado");
			return redirect()->to(base_url("admin/blog/{$blog->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/blog/{$blog->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/blog/nuevo"));
			}
		}
	}

	public function borrar($id){
		$blog = $this->blogModel->find($id);
		$blog->_set("estado", 0);
		$blog->update();
		return redirect()->to(base_url("admin/blogs"));
	}
}
