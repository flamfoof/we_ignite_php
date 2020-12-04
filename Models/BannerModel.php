<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Banner;

class BannerModel extends Model {
    protected $table = 'banner';
    protected $primaryKey = 'banner_id';
    protected $returnType    = 'App\Entities\Banner';
    protected $allowedFields = [
        "banner_id",
        "banner_lang_id",
        "banner_ubicacion",
        "banner_posicion",
        "banner_ancho",
        "banner_alto",
        "banner_imagen",
        "banner_video",
        "banner_titulo",
        "banner_descripcion",
        "banner_link",
        "banner_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
