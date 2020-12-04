<?php
namespace App\Controllers;

class Direcciones extends PublicController{

	public function __construct(){
	}

	public function getDirecciones(){
		$direccionModel = new \App\Models\CiudadModel();
		$direcciones = $direccionModel
			->join("zona", "zona_ciudad_id = ciudad_id", 'left')
			->join("provincia", "provincia_id = ciudad_provincia_id")
			->join("pais", "pais_id = provincia_pais_id")
			->findAll();
		//echo $direccionModel->getLastQuery();
		$paises = [];
		$provincias = [];
		$ciudades = [];
		$zonas = [];
		foreach ($direcciones as $direccion) {
			$paises[$direccion->pais_id]["nombre"] = $direccion->pais_nombre;
			$provincias[$direccion->provincia_id]["nombre"] = $direccion->provincia_nombre;
			$provincias[$direccion->provincia_id]["pais_id"] = $direccion->pais_id;
			$ciudades[$direccion->ciudad_id]["nombre"] = $direccion->ciudad_nombre;
			$ciudades[$direccion->ciudad_id]["provincia_id"] = $direccion->provincia_id;
			$zonas[$direccion->zona_id]["nombre"] = $direccion->zona_nombre;
			$zonas[$direccion->zona_id]["ciudad_id"] = $direccion->ciudad_id;
		}
		$direcciones = [
			"paises" => $paises,
			"provincias" => $provincias,
			"ciudades" => $ciudades,
			"zonas" => $zonas,
		];
		$_SESSION["direcciones"] = serialize($direcciones);
	}

	public function getPaises($default_id){
		if (isset($_SESSION["direcciones"])) {
			$direcciones = unserialize($_SESSION["direcciones"]);
		} else {
			$this->getDirecciones();
			$direcciones = unserialize($_SESSION["direcciones"]);
		}
		$html = "";
		foreach ($direcciones["paises"] as $pais_id => $pais) {
			$selected = ($default_id == $pais_id) ? "selected" : "";
			$html .= "<option value='$pais_id' $selected>{$pais["nombre"]}</option>";
		}
		echo $html;
	}

	public function getProvincias($pais_id, $default_id){
		if (isset($_SESSION["direcciones"])) {
			$direcciones = unserialize($_SESSION["direcciones"]);
		} else {
			$this->getDirecciones();
			$direcciones = unserialize($_SESSION["direcciones"]);
		}
		$html = "";
		foreach ($direcciones["provincias"] as $provincia_id => $provincia) {
			if ($pais_id == $provincia["pais_id"]) {
				$selected = ($default_id == $provincia_id) ? "selected" : "";
				$html .= "<option value='$provincia_id' $selected>{$provincia["nombre"]}</option>";
			}
		}
		echo $html;
	}

	public function getCiudades($provincia_id, $default_id){
		if (isset($_SESSION["direcciones"])) {
			$direcciones = unserialize($_SESSION["direcciones"]);
		} else {
			$this->getDirecciones();
			$direcciones = unserialize($_SESSION["direcciones"]);
		}
		$html = "";
		foreach ($direcciones["ciudades"] as $ciudad_id => $ciudad) {
			if ($provincia_id == $ciudad["provincia_id"]) {
				$selected = ($default_id == $ciudad_id) ? "selected" : "";
				$html .= "<option value='$ciudad_id' $selected>{$ciudad["nombre"]}</option>";
			}
		}
		echo $html;
	}

	public function getZonas($ciudad_id, $default_id){
		if (isset($_SESSION["direcciones"])) {
			$direcciones = unserialize($_SESSION["direcciones"]);
		} else {
			$this->getDirecciones();
			$direcciones = unserialize($_SESSION["direcciones"]);
		}
		$html = "";
		foreach ($direcciones["zonas"] as $zona_id => $zona) {
			if ($ciudad_id == $zona["ciudad_id"]) {
				$selected = ($default_id == $zona_id) ? "selected" : "";
				$html .= "<option value='$zona_id' $selected>{$zona["nombre"]}</option>";
			}
		}
		echo $html;
	}

}
