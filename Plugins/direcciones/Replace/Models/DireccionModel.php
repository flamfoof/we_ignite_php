<?php
namespace App\Models;
use CodeIgniter\Model;

class DireccionModel extends Model {
    protected $table = 'direccion';
    protected $primaryKey = 'direccion_id';
    protected $returnType    = 'App\Entities\Direccion';
    protected $allowedFields = [
        "direccion_id",
        "direccion_usuario_id",
        "direccion_pais_id",
        "direccion_provincia_id",
        "direccion_provincia_texto",
        "direccion_ciudad_id",
        "direccion_ciudad_texto",
        "direccion_zona_id",
        "direccion_zona_texto",
        "direccion_via",
        "direccion_direccion",
        "direccion_piso",
        "direccion_numero",
        "direccion_codigopostal",
        "direccion_google",
        "direccion_estado",
    ];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

}
