<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\ArchivoModel;

class Archivo extends BaseEntity{
    protected $model;
    protected $archivo_model;
    public $myroles;

    protected $attributes = [
        "archivo_id" => null,
        "archivo_alt" => null,
        "archivo_nombre" => null,
        "archivo_nombreoriginal" => null,
        "archivo_raw" => null,
        "archivo_path" => null,
        "archivo_ext" => null,
        "archivo_mime" => null,
        "archivo_tipo" => null,
    ];

    public $fields = [];

    public static $estados = [
        0 => "Borrar",
        1 => "Activo",
    ];

    public static $tipos = [
        0 => "Imagenes",
        1 => "Documentos",
        2 => "Video",
    ];

    public function __construct(){
        $this->model = new ArchivoModel();
    }

    public function insertFile($fileName, $_root, $thumb = false){
        $root = "";
        $roots = explode("/", $_root);
        foreach ($roots as $value) {
            $root .= "$value/";
            if (!is_dir($root)) {
                mkdir($root, 0755, true);
            }
        }
        $base_root = str_replace(FCPATH, "", $root);
        $request = \Config\Services::request();
        $file = $request->getFile($fileName);
        if ($file == null) {
            return false;
        }
        if ($file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            if ($file->move($root, $newName)) {
                $this->_set("nombre", $newName);
                $this->_set("nombreoriginal", $file->getClientName());
                $this->_set("ext", $file->getClientExtension());
                $this->_set("mime", $file->getClientMimeType());
                $this->_set("path", $base_root);
                $this->_set("alt", "vacio");
                $this->_set("raw", "vacio");
                $this->_set("tipo", 0);
                $this->update();
                return true;
            }
        }
        return false;
    }

    public function editFile($fileName, $_root, $thumb = false){
        $root = "";
        $roots = explode("/", $_root);
        foreach ($roots as $value) {
            $root .= "$value/";
            if (!is_dir($root)) {
                mkdir($root, 0755, true);
            }
        }
        $base_root = str_replace(FCPATH, "", $root);
        $request = \Config\Services::request();
        $file = $request->getFile($fileName);
        if ($file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            if ($file->move($root, $newName)) {
                //borrar imagen vieja
                $oldfile = FCPATH.$this->_get("path").$this->_get("nombre");
                if (file_exists($oldfile)) {
                    unlink($oldfile);
                }
                //actualizar nueva imagen
                $this->_set("nombre", $newName);
                $this->_set("nombreoriginal", $file->getClientName());
                $this->_set("ext", $file->getClientExtension());
                $this->_set("mime", $file->getClientMimeType());
                $this->_set("path", $base_root);
                $this->_set("alt", "vacio");
                $this->_set("raw", "vacio");
                $this->_set("tipo", 0);
                $this->update();
                return true;
            }
        }
        return false;
    }

    public function getAsBase64(){
        $imagen = base_url("assets/images/launch.svg");
        $file = FCPATH.$this->_get("path").$this->_get("nombre");
        //echo "$file -- ";
        if (file_exists($file)) {
            $imagen = file_get_contents($file);
            if ($imagen !== false) {
                $imagen = "data:".$this->_get("mime").";base64,".base64_encode($imagen);
            }
        }
        return $imagen;
    }

    public function delete(){
        $file = FCPATH.$this->_get("path").$this->_get("nombre");
        if (file_exists($file)) {
            unlink($file);
        }
    }

    public function getPath(){
        return FCPATH.$this->_get("path").$this->_get("nombre");
    }

    public function getHRef(){
        return base_url($this->_get("path").$this->_get("nombre"));
    }

}
