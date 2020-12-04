<?php
namespace App\Controllers\Admin;
use App\Models\UsuarioModel;
use App\Models\PedidoModel;
use CodeIgniter\Controller;

class Dashboard extends Admin {

	public function __construct(){

	}

	public function index() {
		$this->data["content"] = view("admin/dashboard/home", $this->data);
		return $this->printPage();
	}

	public function easy_menu(){
		$this->data["content"] = view("admin/dashboard/easy_menu", $this->data);
		return $this->printPage();
	}
}
