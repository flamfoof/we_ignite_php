<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Blog;

class BlogModel extends Model {
    protected $table = 'blog';
    protected $primaryKey = 'blog_id';
    protected $returnType    = 'App\Entities\Blog';
    protected $allowedFields = [
        "blog_id",
        "blog_tema",
        "blog_url",
        "blog_fecha",
        "blog_titulo",
        "blog_descripcion",
        "blog_contenido",
        "blog_imagen",
        "blog_video",
        "blog_meta_titulo",
        "blog_meta_description",
        "blog_meta_keywords",
        "blog_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/
}
