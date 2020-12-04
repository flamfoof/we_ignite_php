<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\ArchivoModel;
use App\Entities\Archivo;

class Galeria extends AdminController {

	public $archivoModel;

	public function __construct(){
		$this->archivoModel = new ArchivoModel();
	}

	public function imagen_list() {
		if (isset($_GET["query"])) {
			$this->archivoModel
				->like("archivo_alt", $_GET["query"])
				->orLike("archivo_nombre", $_GET["query"])
				->orLike("archivo_nombreoriginal", $_GET["query"]);
		}
		$this->data["fichas"] = $this->archivoModel
			->where("archivo_tipo", 0)
			->paginate(10);
		$this->data["pagination"] = $this->archivoModel->pager;
		$this->data["content"] = view("admin/galeria/list_imagenes", $this->data);
		return $this->printPage();
	}

	public function iamgen_ver($id = 0){
		if ($id > 0) {
			$archivo = $this->archivoModel->find($id);
		} else {
			$archivo = new Archivo();
		}
		$this->data["ficha"] = $archivo;
		$this->data["content"] = view("admin/galeria/imagen_ficha", $this->data);
		return $this->printPage();
	}

	public function imagen_guardar($id = 0){
		$archivo = new Archivo();
		if ($id > 0) {
			$archivo = $this->archivoModel->find($id);
		}
		$ficha = $this->input->getPostGet("ficha");
		$result = $archivo->save($ficha);
		if ($result === true) {
			if ($archivo->_get("nombre") != "") {
				$archivo->editFile("file", FCPATH."assets/images");
			} else {
				$archivo->insertFile("file", FCPATH."assets/images");
			}
			$this->notification("success", "Archivo Guardado");
			return redirect()->to(base_url("admin/galeria/imagen/{$archivo->_id()}/editar"));
		} else {
			if (is_array($result)) {
				foreach ($result as $error) {
					$this->notification("danger", $error);
				}
			} else {
				$this->notification("danger", "Error");
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/galeria/imagen/{$archivo->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/galeria/imagenes"));
			}
		}
	}

	/********************************************************************************/

	public function documento_list() {
		$this->data["fichas"] = $this->archivoModel
			->where("archivo_tipo", 1)
			->paginate(10);
		$this->data["pagination"] = $this->archivoModel->pager;
		$this->data["content"] = view("admin/galeria/list_documentos", $this->data);
		return $this->printPage();
	}

	public function documento_ver($id = 0){
		if ($id > 0) {
			$archivo = $this->archivoModel->find($id);
		} else {
			$archivo = new Archivo();
		}
		$this->data["ficha"] = $archivo;
		$this->data["content"] = view("admin/galeria/documento_ficha", $this->data);
		return $this->printPage();
	}

	public function documento_guardar($id = 0){
		$archivo = new Archivo();
		if ($id > 0) {
			$archivo = $this->archivoModel->find($id);
		}
		$ficha = $this->input->getPostGet("ficha");
		$result = $archivo->save($ficha);
		if ($result === true) {
			if ($archivo->_get("nombre") != "") {
				$archivo->editFile("file", FCPATH."assets/documentos");
			} else {
				$archivo->insertFile("file", FCPATH."assets/documentos");
			}
			$this->notification("success", "Archivo Guardado");
			return redirect()->to(base_url("admin/galeria/documento/{$archivo->_id()}/editar"));
		} else {
			if (is_array($result)) {
				foreach ($result as $error) {
					$this->notification("danger", $error);
				}
			} else {
				$this->notification("danger", "Error");
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/galeria/documento/{$archivo->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/galeria/documentos"));
			}
		}
	}

	/********************************************************************************/

	public function video_list() {
		$this->data["fichas"] = $this->archivoModel
			->where("archivo_tipo", 2)
			->paginate(10);
		$this->data["pagination"] = $this->archivoModel->pager;
		$this->data["content"] = view("admin/galeria/list_videos", $this->data);
		return $this->printPage();
	}

	public function video_ver($id = 0){
		if ($id > 0) {
			$archivo = $this->archivoModel->find($id);
		} else {
			$archivo = new Archivo();
		}
		$this->data["ficha"] = $archivo;
		$this->data["content"] = view("admin/galeria/video_ficha", $this->data);
		return $this->printPage();
	}

	public function video_guardar($id = 0){
		$archivo = new Archivo();
		if ($id > 0) {
			$archivo = $this->archivoModel->find($id);
		}
		$ficha = $this->input->getPostGet("ficha");
		$result = $archivo->save($ficha);
		if ($result === true) {
			if ($archivo->_get("nombre") != "") {
				$archivo->editFile("file", FCPATH."assets/documentos");
			} else {
				$archivo->insertFile("file", FCPATH."assets/documentos");
			}
			$this->notification("success", "Archivo Guardado");
			return redirect()->to(base_url("admin/galeria/video/{$archivo->_id()}/editar"));
		} else {
			if (is_array($result)) {
				foreach ($result as $error) {
					$this->notification("danger", $error);
				}
			} else {
				$this->notification("danger", "Error");
			}
			if ($id > 0) {
				return redirect()->to(base_url("admin/galeria/video/{$archivo->_id()}/editar"));
			} else {
				return redirect()->to(base_url("admin/galeria/videos"));
			}
		}
	}

	public function video_subir($id){
		if (empty($_POST['file'])) {
			echo "POST EMPTY";
			exit();
		}

		$title = $_POST['title'];
		$start = $_POST['start'];

		$basePth = "assets/videos/";
		$path = FCPATH.$basePth;
		if (!is_dir($path)) {
			mkdir($path, 0755, true);
		}
		$file = $title;
		$fullPath = $path.$file;

		// Decode base64 data
		list($type, $data) = explode(';', $_POST['file']);
		list(, $data) = explode(',', $data);
		list($filename, $ext) = explode(".", $title);
		$file_data = base64_decode($data);

		if ($start == 0) {//crear archivo
			$archivo = $this->archivoModel->find($id);
			$archivo->_set("nombre", $file);
			$archivo->_set("nombreoriginal", $file);
			$archivo->_set("raw", $title);
			$archivo->_set("path", $basePth);
			$archivo->_set("ext", $ext);
			$archivo->_set("mime", "");
			$archivo->_set("tipo", 2);
			$archivo->update();

			if (file_exists($fullPath)) {
				unlink($fullPath);
			}
		} else {//rellenar

		}

		// Decode base64 data
		list($type, $data) = explode(';', $_POST['file']);
		list(, $data) = explode(',', $data);
		$file_data = base64_decode($data);

		$fp = fopen($fullPath, 'a+');//opens file in append mode
		fwrite($fp, $file_data);
		fclose($fp);

		echo "uploaded";
	}

	public function archivos(){
		$this->data["fichas"] = $this->archivoModel
			->where("archivo_tipo", 0)
			->paginate(10);
		echo view("admin/galeria/list", $this->data);
	}

	public function archivos_mas(){
		if (isset($_GET["query"])) {
			$this->archivoModel
				->like("archivo_alt", $_GET["query"])
				->orLike("archivo_nombre", $_GET["query"])
				->orLike("archivo_nombreoriginal", $_GET["query"]);
		}
		$fichas = $this->archivoModel
			->where("archivo_tipo", 0)
			->paginate(10);
		foreach ($fichas as $ficha) {
			echo view("admin/galeria/partes/imagenes", ["ficha" => $ficha]);
		}
	}

	public function subir_archivos(){
		if (empty($_POST['file'])) {
			echo "POST EMPTY";
			exit();
		}

		$title = $_POST['title'];
		$start = $_POST['start'];
		$destination = $_POST['destination'];

		$basePth = "assets/documents/uploads/";
		$path = FCPATH.$basePth;
		if (is_dir($destination)) {
			$path = $destination;
		}
		if (!is_dir($path)) {
			mkdir($path, 0755, true);
		}
		$file = $title;
		$fullPath = $path.$file;

		// Decode base64 data
		list($type, $data) = explode(';', $_POST['file']);
		list(, $data) = explode(',', $data);
		list($filename, $ext) = explode(".", $title);
		$file_data = base64_decode($data);

		if ($start == 0) {//crear archivo
			$archivo = new Archivo();
			$archivo->_set("nombre", $file);
			$archivo->_set("nombreoriginal", $file);
			$archivo->_set("raw", $title);
			$archivo->_set("path", $basePth);
			$archivo->_set("ext", $ext);
			$archivo->_set("mime", "");
			if ($ext == "pdf") {
				$archivo->_set("tipo", 1);
			} else {
				$archivo->_set("tipo", 0);
			}
			$archivo->update();

			if (file_exists($fullPath)) {
				unlink($fullPath);
			}
		} else {//rellenar

		}

		// Decode base64 data
		list($type, $data) = explode(';', $_POST['file']);
		list(, $data) = explode(',', $data);
		$file_data = base64_decode($data);

		$fp = fopen($fullPath, 'a+');//opens file in append mode
		fwrite($fp, $file_data);
		fclose($fp);

		echo "uploaded";
	}

	public function boton_html(){
		echo view("admin/galeria/boton_html", $this->data);
	}

	public function imagen_sincronizar(){
		$imagePath = FCPATH."/{$this->carpeta}/images";
		if (is_dir($imagePath)) {
			$this->recursive_sinc($imagePath, 0);
		}
		$imagePath = FCPATH."/{$this->carpeta}/img";
		if (is_dir($imagePath)) {
			$this->recursive_sinc($imagePath, 0);
		}
		$imagePath = FCPATH."/assets/images";
		$this->recursive_sinc($imagePath, 0);
		$this->notification("success", "Imagenes sincronizadas");
		return redirect()->to(base_url("admin/galeria/imagenes"));
	}

	public function documento_sincronizar(){
		$docPath = FCPATH."/assets/documents";
		$this->recursive_sinc($docPath, 1);
		$this->notification("success", "Documentos sincronizados");
		return redirect()->to(base_url("admin/galeria/documentos"));
	}

	public function video_sincronizar(){
		$docPath = FCPATH."/assets/videos";
		$this->recursive_sinc($docPath, 2);
		$this->notification("success", "Videos sincronizados");
		return redirect()->to(base_url("admin/galeria/videos"));
	}

	function recursive_sinc($src, $type) {
        $dir = opendir($src);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $this->recursive_sinc($src . '/' . $file, $type);
                }
                else {
                    $this->updateImagen($src, $file, $type);
                }
            }
        }
        closedir($dir);
    }

	public function updateImagen($src, $filename, $type){
		$path = str_replace(FCPATH, "", $src);
		$ext = explode(".", $filename);
		$archivo = $this->archivoModel
			->where("archivo_nombre", $filename)
			->where("archivo_path", "$path/")
			->first();
		if (empty($archivo)) {
			$archivo = new \App\Entities\Archivo();
			$archivo->_set("nombre", $filename);
			$archivo->_set("path", "$path/");
			$archivo->_set("alt", "vacio");
			$archivo->_set("raw", "vacio");
			$archivo->_set("ext", end($ext));
			$archivo->_set("mime", mime_content_type("$src/$filename"));
			$archivo->_set("tipo", $type);
			$archivo->update();
		}
	}
}
