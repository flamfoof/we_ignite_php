<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Pagina;

class PaginaModel extends Model {
    protected $table = 'pagina';
    protected $primaryKey = 'pagina_id';
    protected $returnType    = 'App\Entities\Pagina';
    protected $allowedFields = [
        "pagina_id",
        "pagina_name",
        "pagina_slug",
        "pagina_custom",
        "pagina_estado",

        "pagina_meta_index",
        "pagina_meta_title",
        "pagina_meta_description",
        "pagina_meta_keywords",
        "pagina_facebook_url",
        "pagina_facebook_type",
        "pagina_facebook_title",
        "pagina_facebook_description",
        "pagina_facebook_image",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
