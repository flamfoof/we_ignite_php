<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Entities\Pais;

class PaisModel extends Model {
    public $table = 'pais';
    protected $primaryKey = 'pais_id';
    protected $returnType    = 'App\Entities\Pais';
    protected $allowedFields = [
        "pais_id",
        "pais_nombre",
        "pais_alpha2",
        "pais_alpha3",
        "pais_iva", //solo para indicar si el pais cobra iva o no, solo puedes cobrar iva en un pais
        "pais_grupopago_id",
        "pais_grupoenvio_id",
        "pais_metodoenvio", // 0 - solo enviar, 1 - enviar o recoger, 2 - solo recoger
        "pais_estado",
    ];
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

}
