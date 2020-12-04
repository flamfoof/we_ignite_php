<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\ProjectModel;
use App\Models\ArchivoModel;

class Project extends BaseEntity{
    protected $model;
    protected $archivo_model;

    public $attributes = [
        "project_id" => null,
        "project_name" => null,
        "project_url" => null,
        "project_secretkey" => null,
        "project_accesstoken" => null,
        "project_expiration" => null,
        "project_archivo_id" => null,
        "project_windows" => null,
        "project_mac" => null,
        "project_playstore" => null,
        "project_appstore" => null,
        "project_estado" => null,
    ];

    public $fields = [
        "project_name" => [
            "html" => [
                "type" => "text",
                "label" => "Name",
            ]
        ],
        "project_url" => [
            "html" => [
                "type" => "text",
                "label" => "URL",
                "readonly" => true,
            ]
        ],
        "project_secretkey" => [
            "html" => [
                "type" => "text",
                "label" => "Secre Key",
                "readonly" => true,
            ]
        ],
        "project_expiration" => [
            "html" => [
                "type" => "text",
                "label" => "Expiration date",
                "readonly" => true,
            ]
        ],
        "project_windows" => [
            "html" => [
                "type" => "text",
                "label" => "Windows",
            ]
        ],
        "project_mac" => [
            "html" => [
                "type" => "text",
                "label" => "Mac",
            ]
        ],
        "project_playstore" => [
            "html" => [
                "type" => "text",
                "label" => "PlayStore",
            ]
        ],
        "project_appstore" => [
            "html" => [
                "type" => "text",
                "label" => "AppStore",
            ]
        ],
        "project_estado" => [
            "html" => [
                "type" => "select",
                "label" => "Project State",
                "placeholder" => "--STATE--"
            ],
            "options" => "estados"
        ],
    ];

    protected $_imagen;

    public static $estados = [
        0 => "Deleted",
        1 => "Active",
    ];

    public function __construct(){
        $this->model = new ProjectModel();
    }

    public function getUsuarios(){
        $projectClientModel = new \App\Models\ProjectClientModel();
        $usuarios = $projectClientModel
            ->join("usuario", "usuario_id = projectclient_usuario_id")
            ->where("projectclient_project_id", $this->_id())
            ->where("usuario_estado", 1)
            ->where("projectclient_estado", 1)
            ->findAll();
        return $usuarios;
    }

    public function getAccesosGruped(){
        $accessModel = new \App\Models\AccessModel();
        $accesos = $accessModel
            ->select("*")
            ->where("access_project_id", $this->_id())
            ->orderBy("access_date", "ASC")
            ->findAll();
        return $accesos;
    }

    public function getGraph(){
        $accesos = $this->getAccesosGruped();
        $graph = [];
        foreach ($accesos as $acces) {
            $month = date("F-d", strtotime($acces->_get("date")));
            if (isset($graph[$month])) {
                $graph[$month]["cantidad"] ++;
                $graph[$month]["time"][] = $acces->_get("horainicio")."|".$acces->_get("horafin");
            } else {
                $graph[$month]["cantidad"] = 1;
                $graph[$month]["time"][] = $acces->_get("horainicio")."|".$acces->_get("horafin");
            }
        }
        return $graph;
    }

    public function getAccessGraph($graphs){
        $accessGraph = [];
        foreach ($graphs as $key => $graph) {
            $accessGraph[$key] = $graph["cantidad"];
        }
        return $accessGraph;
    }

    public function getTotalGraph($graphs){
        $total = 0;
        foreach ($graphs as $graph) {
            $total += $graph["cantidad"];
        }
        return $total;
    }

    public function getGrpahTime($graphs){
        $timeGraph = [];
        for ($i=0; $i < 24; $i++) {
            $time = ($i < 10) ? "0$i" : $i;
            $timestr = "$time:00:00";
            $time = strtotime($timestr);
            foreach ($graphs as $graph) {
                foreach ($graph["time"] as $key => $gtime) {
                    $times = explode("|", $gtime);
                    $start = $times[0];
                    $end = end($times);
                    $timeStar = strtotime($start);
                    $timeEnd = strtotime($end);
                    if (!isset($timeGraph[$timestr])) {
                        $timeGraph[$timestr] = 0;
                    }
                    if (
                        ($time >= $timeStar) && ($time < $timeEnd)
                    ) {
                        $timeGraph[$timestr] ++;
                    }
                }
            }
        }
        return $timeGraph;
    }

    public function getMostLinked(){
        $actionModel = new \App\Models\ActionModel();
        $actions = $actionModel
            ->select("*, count(action_type) as cantidad")
            ->where("action_project_id", $this->_id())
            ->groupStart()
                ->where("action_type", "video_click")
                ->orWhere("action_type", "link_click")
            ->groupEnd()
            ->groupBy("action_type, action_data")
            ->orderBy("cantidad", "DESC")
            ->findAll();
        return $actions;
    }

    public function getMostEmojis(){
        $actionModel = new \App\Models\ActionModel();
        $actions = $actionModel
            ->select("*, count(action_type) as cantidad")
            ->where("action_project_id", $this->_id())
            ->where("action_type", "emoji")
            ->groupBy("action_type, action_data")
            ->orderBy("cantidad", "DESC")
            ->findAll();
        return $actions;
    }

    public function getImagen(){
        $archivo_model = new \App\Models\ArchivoModel();
        $this->_imagen = base_url("assets/images/launch.svg");
        if($this->_id()>0){
            if(($this->_id() > 0)&&($this->_get("archivo_id") > 0)){
                $archivo = $archivo_model->find($this->_get("archivo_id"));
                $this->_imagen = $archivo->getAsBase64();
            }
        }
        return $this->_imagen;
    }

    public function subirImagen($fileName){
        $archivo_model = new \App\Models\ArchivoModel();
        $root = FCPATH."assets/images/banners";
        if($this->_get("archivo_id") > 0){
            $archivo = $archivo_model->find($this->_get("archivo_id"));
            $archivo->_set("alt", ($this->_get("imagen_alt") != "") ? $this->_get("imagen_alt") : "vacio");
            $archivo->editFile($fileName, $root);
        } else {
            $archivo = new \App\Entities\Archivo();
            $archivo->_set("alt", ($this->_get("imagen_alt") != "") ? $this->_get("imagen_alt") : "vacio");
            $archivo->insertFile($fileName, $root);
        }
        $this->_set("imagen", $archivo->_id());
        $this->update();
    }
}
