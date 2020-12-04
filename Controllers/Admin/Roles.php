<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\RoleModel;
use App\Models\PermissionModel;
use App\Models\RolePermissionModel;
use App\Entities\Role;

class Roles extends AdminController {

	protected $roleModel;
	public function __construct(){
		$this->roleModel = new RoleModel();
	}

	public function list() {
		$this->data["list_title"] = "Roles";
		$this->data["list_btn_nuevo"] = "Nuevo Rol";
		$this->data["list_btn_nuevo_link"] = base_url("admin/role/nuevo");
		$this->data["list_base_link"] = base_url("admin/role");
		$this->data["list_table"] = ["nombre"];
		$this->data["entity"] = new Role();
		if (isset($_GET["query"])) {
			$this->roleModel->like("role_nombre", $_GET["query"]);
		}
		$this->data["fichas"] = $this->roleModel->paginate(10);
		$this->data["pagination"] = $this->roleModel->pager;
		$this->roleModel->pager->setPath("admin/roles");
		$this->data["content"] = view("templates/custom_list", $this->data);
		return $this->printPage();
	}

	public function ver($id = 0){
		if ($id > 0) {
			$role = $this->roleModel->find($id);
		} else {
			$role = new Role();
		}
		$role->getRolePerms();
		$this->data["ficha"] = $role;
		$this->data["permissionModel"] = new PermissionModel();
		$this->data["content"] = view("admin/roles/ficha", $this->data);
		return $this->printPage();
	}

	public function guardar($id = 0){
		$role = new Role();
		if ($id > 0) {
			$role = $this->roleModel->find($id);
		}
		$result = $role->save($this->input->getPostGet("ficha"));
		if ($result === true) {
			$role->setPermissions($this->input->getPostGet("fichaPermission"));

			$this->notification("success", "Rol Guardado");
			return redirect()->to(base_url("admin/role/{$role->_id()}/editar"));
		} else {
			foreach ($result as $error) {
				$this->notification("danger", $error);
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/role/{$role->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/role/nuevo"));
			}
		}

	}

	public function borrar($id){
		$role = $this->roleModel->find($id);
		$role->_set("estado", 0);
		$role->update();
		return redirect()->to(base_url("admin/roles"));
	}
}
