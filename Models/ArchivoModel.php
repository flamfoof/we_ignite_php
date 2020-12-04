<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Archivo;

class ArchivoModel extends Model {
    protected $table = 'archivo';
    protected $primaryKey = 'archivo_id';
    protected $returnType    = 'App\Entities\Archivo';
    protected $allowedFields = [
        "archivo_id",
        "archivo_alt",
        "archivo_nombre",
        "archivo_nombreoriginal",
        "archivo_raw",
        "archivo_path",
        "archivo_ext",
        "archivo_mime",
        "archivo_tipo",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
