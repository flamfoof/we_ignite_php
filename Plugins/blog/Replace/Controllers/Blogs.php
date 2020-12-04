<?php
namespace App\Controllers;

class Blogs extends PublicController{

	public function __construct(){
	}

	public function blog($url){
		$blogModel = new \App\Models\BlogModel();
		$blog = $blogModel
			->where("blog_estado", 1)
			->where("blog_url", $url)
			->first();
		$this->data["blog"] = $blog;
		$this->data["content"] = view("{$this->carpeta}/blog/content", $this->data);
		return $this->printPage(true);
	}

	public function blogs(){
		$blogModel = new \App\Models\BlogModel();
		$blogs = $blogModel
			->where("blog_estado", 1)
			->orderBy("blog_fecha", "DESC")
			->paginate(10);
		$this->data["pagination"] = $blogModel->pager;
		$blogModel->pager->setPath("admin/blogs");
		$this->data["blogs"] = $blogs;
		$this->data["content"] = view("{$this->carpeta}/blog/list", $this->data);
		return $this->printPage(true);
	}

}
