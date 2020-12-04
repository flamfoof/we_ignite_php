<?php
namespace App\Controllers\Admin;
use CodeIgniter\Controller;
use App\Models\ProductoModel;
use App\Models\FamiliaModel;
use App\Models\MarcaModel;
use App\Models\CombinacionModel;
use App\Models\AtributoModel;
use App\Models\FormatoModel;
use App\Models\ProductoFotoModel;

class Importar extends AdminController {

	public function __construct(){
	}

	public function menu() {
		$this->data["content"] = view("admin/importar/menu", $this->data);
		return $this->printPage();
	}

	public function menu_post(){
		$tmpName = $_FILES['file']['tmp_name'];
		$csvAsArray = array_map(function($v){return str_getcsv($v, "\t");}, file($tmpName));
		$_SESSION['uploaded_csv'] = serialize($csvAsArray);
		$ficha = $this->input->getPostGet("ficha");
		switch ($ficha["actualizar"]) {
			case 'productos':
				return redirect()->to(base_url("admin/importar/productos"));
				break;
			case 'formatos_atributos':
				return redirect()->to(base_url("admin/importar/formatos-atributos"));
				break;
			case 'coches':
				return redirect()->to(base_url("admin/importar/coches"));
				break;
			case 'compatible':
				return redirect()->to(base_url("admin/importar/compatible"));
				break;
			default:
				return redirect()->to(base_url("admin/importar/productos"));
				break;
		}
	}

	public function importar_coches(){
		$this->data["content"] = view("admin/importar/coches", $this->data);
		return $this->printPage();
	}

	public function importar_config_coches(){
		$ficha = $this->input->getPostGet("ficha");
		$_SESSION['configuracion_productos'] = serialize($ficha);
		return redirect()->to(base_url("admin/importar/coches/proceso"));
	}

	public function importar_coches_proceso(){
		$this->data["data"] = unserialize($_SESSION['uploaded_csv']);
		$this->data["ficha"] = unserialize($_SESSION['configuracion_productos']);
		$this->data["url"] = "admin/importar/coches/proceso";
		$this->data["content"] = view("admin/importar/proceso", $this->data);
		return $this->printPage();
	}

	public function importar_coches_post(){
		echo "Empieza proceso<br>";
		$marcaModel = new \App\Models\CocheMarcaModel();
		$modeloModel = new \App\Models\CocheModeloModel();
		$generacionModel = new \App\Models\CocheGeneracionModel();

		$ficha = unserialize($_SESSION['configuracion_productos']);
		$posicionActual = $this->input->getPostGet("posicionActual");
		$cantidad = $this->input->getPostGet("cantidad");
		if (isset($_SESSION['uploaded_csv'])) {
			$csvAsArray = unserialize($_SESSION['uploaded_csv']);
			$maximo = ($posicionActual + $cantidad);
			echo "Existe uploaded_csv for i = $posicionActual; i < $maximo;  i++<br>";
			for ($i = $posicionActual; $i < $maximo; $i++) {
				$row = $csvAsArray[$i];
				//Marca
				echo "marca<br>";
				$marcaPos = array_search('marca', $ficha);
				if ($marcaPos !== false) {
					$marca = $marcaModel->findOrCreaByString($row[$marcaPos]);
					if ($marca === false) {
						continue;
					} else {
						//Modelo
						$modeloPos = array_search('modelo', $ficha);
						if ($modeloPos !== false) {
							$modelo = $modeloModel->findOrCreaByString($row[$modeloPos], $marca->_id());
							if ($modelo === false) {
								continue;
							} else {
								//Generacion
								$generacionPos = array_search('generacion', $ficha);
								if ($generacionPos !== false) {
									$generacion = $generacionModel->findOrCreaByString($row[$generacionPos], $modelo->_id());
									if ($generacion === false) {
										continue;
									}
								}
							}


						}
					}

				}
			}
		}
		echo "ok";
	}
	/********************compatibles*****************************************/

	public function importar_compatible(){
		$this->data["content"] = view("admin/importar/compatible", $this->data);
		return $this->printPage();
	}

	public function importar_config_compatible(){
		$ficha = $this->input->getPostGet("ficha");
		$_SESSION['configuracion_productos'] = serialize($ficha);
		return redirect()->to(base_url("admin/importar/compatible/proceso"));
	}

	public function importar_compatible_proceso(){
		$this->data["data"] = unserialize($_SESSION['uploaded_csv']);
		$this->data["ficha"] = unserialize($_SESSION['configuracion_productos']);
		$this->data["url"] = "admin/importar/compatible/proceso";
		$this->data["content"] = view("admin/importar/proceso", $this->data);
		return $this->printPage();
	}

	public function importar_compatible_post(){
		echo "Empieza proceso compatible<br>";
		$productoCompatibleModel = new \App\Models\ProductoCompatibleModel();

		$ficha = unserialize($_SESSION['configuracion_productos']);
		$posicionActual = $this->input->getPostGet("posicionActual");
		$cantidad = $this->input->getPostGet("cantidad");
		if (isset($_SESSION['uploaded_csv'])) {
			$csvAsArray = unserialize($_SESSION['uploaded_csv']);
			$maximo = ($posicionActual + $cantidad);
			echo "Existe uploaded_csv for i = $posicionActual; i < $maximo;  i++<br>";
			for ($i = $posicionActual; $i < $maximo; $i++) {
				$row = $csvAsArray[$i];
				//Compatible
				$marcaPos = array_search('marca', $ficha);
				$modeloPos = array_search('modelo', $ficha);
				$generacionPos = array_search('generacion', $ficha);
				$skuPos = array_search('sku', $ficha);
				if ($skuPos !== false) {
					echo "sku findOrCreaByString<br>";
					$productoCompatible = $productoCompatibleModel->findOrCreaByString($row[$marcaPos],$row[$modeloPos],$row[$generacionPos],$row[$skuPos]);
					if ($productoCompatible === false) {
						continue;
					}
				}
			}
		}
		echo "ok";
	}


	/*********************compatibles end*********************************/

	public function importar_productos(){
		$this->data["content"] = view("admin/importar/productos", $this->data);
		return $this->printPage();
	}

	public function importar_config(){
		$ficha = $this->input->getPostGet("ficha");
		$_SESSION['configuracion_productos'] = serialize($ficha);
		return redirect()->to(base_url("admin/importar/productos/proceso"));
	}

	public function importar_config_fa(){
		$ficha = $this->input->getPostGet("ficha");
		$_SESSION['configuracion_productos'] = serialize($ficha);
		return redirect()->to(base_url("admin/importar/formatos-atributos/proceso"));
	}

	public function importar_formato_atributo_proceso(){
		$this->data["data"] = unserialize($_SESSION['uploaded_csv']);
		$this->data["ficha"] = unserialize($_SESSION['configuracion_productos']);
		$this->data["url"] = "admin/importar/formatos-atributos/proceso";
		$this->data["content"] = view("admin/importar/proceso", $this->data);
		return $this->printPage();
	}

	public function importar_productos_proceso(){
		$this->data["data"] = unserialize($_SESSION['uploaded_csv']);
		$this->data["ficha"] = unserialize($_SESSION['configuracion_productos']);
		$this->data["url"] = "admin/importar/productos/proceso";
		$this->data["content"] = view("admin/importar/proceso", $this->data);
		return $this->printPage();
	}

	public function importar_productos_post(){
		$productoModel = new ProductoModel();
		$combinacionModel = new CombinacionModel();
		$familiaModel = new FamiliaModel();
		$marcaModel = new MarcaModel();
		$atributoModel = new AtributoModel();
		$productoFotoModel = new ProductoFotoModel();

		$ficha = unserialize($_SESSION['configuracion_productos']);
		$posicionActual = $this->input->getPostGet("posicionActual");
		$cantidad = $this->input->getPostGet("cantidad");
		if (isset($_SESSION['uploaded_csv'])) {
			$csvAsArray = unserialize($_SESSION['uploaded_csv']);
			$maximo = ($posicionActual + $cantidad);
			for ($i = $posicionActual; $i < $maximo; $i++) {
				$row = $csvAsArray[$i];
				//Familia
				$familiaPos = array_search('familia_id', $ficha);
				if ($familiaPos !== false) {
					$separador_familia = $ficha["separador_familia"][$familiaPos];
					$familia = $familiaModel->findOrCreaByString($row[$familiaPos], $separador_familia);
					if ($familia === false) {
						continue;
					}
				}
				//Marca
				$marcaPos = array_search('marca_id', $ficha);
				if ($marcaPos !== false) {
					$marca = $marcaModel->findOrCreaByString($row[$marcaPos]);
					if ($marca === false) {
						continue;
					}
				}
				//Producto
				$productoPos = array_search('nombreinterno', $ficha);
				$skuPos = array_search('sku', $ficha);
				if ($productoPos !== false) {
					$productoFicha = [
						"producto_nombreinterno" => $row[$productoPos],
						"producto_skubase" => $row[$skuPos],
						"producto_estado" => 1,
					];
					if (!empty($familia)) {
						$productoFicha["producto_subfamilia_id"] = $familia->_id();
					}
					if (!empty($marca)) {
						$productoFicha["producto_marca_id"] = $marca->_id();
					}
					$producto = $productoModel->findOrCreaByFicha($productoFicha);
					//Combinacion
					$precioPos = array_search('precio', $ficha);
					$combinacionFicha = [
						"combinacion_producto_id" => $producto->_id(),
						"combinacion_estado" => 1,
					];
					if ($precioPos !== false) {
						$combinacionFicha["combinacion_precio"] = $row[$precioPos];
					}
					if ($skuPos !== false) {
						$combinacionFicha["combinacion_sku"] = $row[$skuPos];

						//var_dump($combinacionFicha);
						$combinacion = $combinacionModel->findOrCreaByFicha($combinacionFicha);
						//Atributos
						$atributoPos = array_search('atributos', $ficha);
						$separador_atributos = $ficha["separador_atributo"][$atributoPos];
						$atributoModel->findOrCreaByString($row[$atributoPos], $separador_atributos, $combinacion);
					}
					//imagenes
					$imagenPos = array_search('imagen', $ficha);
					if ($imagenPos !== false) {
						$ubicacion = $ficha["imagen_ubicacion"][$imagenPos];
						$productoFotoModel->findOrCreaByString($row[$imagenPos], $ubicacion, $producto);
					}
				}
			}
		}
		echo "ok";
	}

	public function importar_formatos_atributos(){
		$this->data["content"] = view("admin/importar/formatos_atributos", $this->data);
		return $this->printPage();
	}

	public function importar_formato_atributo_proceso_post(){
		$formatoModel = new FormatoModel();
		$atributoModel = new AtributoModel();

		$ficha = unserialize($_SESSION['configuracion_productos']);
		$posicionActual = $this->input->getPostGet("posicionActual");
		$cantidad = $this->input->getPostGet("cantidad");
		if (isset($_SESSION['uploaded_csv'])) {
			$csvAsArray = unserialize($_SESSION['uploaded_csv']);
			$maximo = ($posicionActual + $cantidad);
			for ($i = $posicionActual; $i < $maximo; $i++) {
				$row = $csvAsArray[$i];
				//Formato
				$faPos = array_search('formato-atributo', $ficha);
				$separador_fa = $ficha["separador_formato_atributo"][$faPos];
				$formato = $formatoModel->findOrCreaByString($row[$faPos], $separador_fa);
				if ($formato === false) {
					continue;
				}
			}
		}
		echo "ok";
	}

}
