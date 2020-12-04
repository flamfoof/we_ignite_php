<?php
namespace App\Models;
use CodeIgniter\Model;
use  CodeIgniter\Database;
use App\Entities\Configuracion;

class ConfiguracionModel extends Model {
    protected $table = 'configuracion';
    protected $primaryKey = 'configuracion_id';
    protected $returnType    = 'App\Entities\Configuracion';
    protected $allowedFields = [
        "configuracion_id",
        "configuracion_enmantenimiento",
        "configuracion_tipotienda",
        "configuracion_publicarproducto",
        "configuracion_verprecios",
        "configuracion_linkinfluencer",
        "configuracion_porcentajepuntos",
        "configuracion_template",
        "configuracion_suscripciones",
        "configuracion_contenidoonline",
        "configuracion_razonsocial",
        "configuracion_nombretienda",
        "configuracion_slogan",
        "configuracion_email",
        "configuracion_telefono",
        "configuracion_direccion",
        "configuracion_cif",
        "configuracion_gastosenviodefecto",
        "configuracion_iban",
        "configuracion_ivageneral",
        "configuracion_iva",
        "configuracion_tienda_id_online",
        "configuracion_irpf",

        "configuracion_emailhost",
        "configuracion_emailport",
        "configuracion_emailuser",
        "configuracion_emailpass",
        "configuracion_emailusuariopedir",
        "configuracion_emailusuariopagar",
        "configuracion_emailusuarioenviar",
        "configuracion_emailtiendapedir",
        "configuracion_emailtiendapagar",
        "configuracion_emailtiendaenviar",
        "configuracion_emailtype",

        "configuracion_googleanalytics",
        "configuracion_facebookpixel",
        "configuracion_tiempoentrega_id",

        "configuracion_metodopago_id_efectivo",
        "configuracion_metodopago_id_tarjeta",
        "configuracion_metodopago_id_giftcard",

        "configuracion_moneda",
        "configuracion_alphamoneda",
        "configuracion_ubicacion",
        "configuracion_miles",
        "configuracion_decimales",

        "configuracion_data",
        "configuracion_cookies",
        "configuracion_estado",
    ];
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    /***************************************/

    public function getDataConfig(&$data){
        $configuracion = $this->first();
        return $configuracion;
    }

}
