<?php
namespace App\Entities;
use CodeIgniter\Entity;
use App\Models\ConfiguracionModel;
use App\Models\ProductoModel;
use App\Models\TiempoEntregaModel;
use App\Models\MetodoPagoModel;
use App\Models\TiendaModel;
use App\Models\ColorModel;
use App\Entities\Tienda;

class Configuracion extends BaseEntity{
    protected $model;
    protected $color_model;

    protected $attributes = [
        "configuracion_id" => null,
        "configuracion_enmantenimiento" => null,
        "configuracion_tipotienda" => null,
        "configuracion_publicarproducto" => null,
        "configuracion_verprecios" => null,
        "configuracion_linkinfluencer" => null,
        "configuracion_porcentajepuntos" => null,
        "configuracion_template" => null,
        "configuracion_contenidoonline" => null,
        "configuracion_razonsocial" => null,
        "configuracion_nombretienda" => null,
        "configuracion_slogan" => null,
        "configuracion_email" => null,
        "configuracion_telefono" => null,
        "configuracion_direccion" => null,
        "configuracion_cif" => null,
        "configuracion_gastosenviodefecto" => null,
        "configuracion_ivageneral" => null,
        "configuracion_iva" => null,
        "configuracion_tienda_id_online" => null,
        "configuracion_irpf" => null,

        "configuracion_emailhost" => null,
        "configuracion_emailport" => null,
        "configuracion_emailuser" => null,
        "configuracion_emailpass" => null,
        "configuracion_emailusuariopedir" => null,
        "configuracion_emailusuariopagar" => null,
        "configuracion_emailusuarioenviar" => null,
        "configuracion_emailtiendapedir" => null,
        "configuracion_emailtiendapagar" => null,
        "configuracion_emailtiendaenviar" => null,
        "configuracion_emailtype" => null,

        "configuracion_googleanalytics" => null,
        "configuracion_facebookpixel" => null,
        "configuracion_tiempoentrega_id" => null,

        "configuracion_metodopago_id_efectivo" => null,
        "configuracion_metodopago_id_tarjeta" => null,
        "configuracion_metodopago_id_giftcard" => null,

        "configuracion_moneda" => null,
        "configuracion_alphamoneda" => null,
        "configuracion_ubicacion" => null,
        "configuracion_miles" => null,
        "configuracion_decimales" => null,

        "configuracion_data" => null,
        "configuracion_cookies" => null,
        "configuracion_estado" => null,
    ];

    public $fields = [
        "configuracion_enmantenimiento" => [
            "html" => [
                "type" => "switch",
                "label" => "¿Tienda en Mantenimiento?",
            ],
        ],
        "configuracion_tipotienda" => [
            "html" => [
                "type" => "select",
                "label" => "Tipo de tienda",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "tipostiendas"
        ],
        "configuracion_verprecios" => [
            "html" => [
                "type" => "select",
                "label" => "¿Quien puede ver los precios?",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "verprecios"
        ],
        "configuracion_linkinfluencer" => [
            "html" => [
                "type" => "switch",
                "label" => "¿Trabajaras con influencers?",
                "description" => "Si trabajas con influencers, inserta el % de ganancia para ellos en el siguiente input"
            ],
        ],
        "configuracion_porcentajepuntos" => [
            "html" => [
                "type" => "number",
                "step" => "0.1",
                "min" => 0,
                "label" => "Porcentaje por compra",
                "placeholder" => "numero entre (0-1)",
                "description" => "para influencers"
            ],
            "options" => "verprecios"
        ],
        "configuracion_template" => [
            "html" => [
                "type" => "select",
                "label" => "Template",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "templates"
        ],
        "configuracion_suscripciones" => [
            "html" => [
                "type" => "switch",
                "label" => "Acepta suscripciones",
                "description" => "tu tienda"
            ],
        ],
        "configuracion_contenidoonline" => [
            "html" => [
                "type" => "switch",
                "label" => "Tiene contenido online",
            ],
        ],
        "configuracion_razonsocial" => [
            "html" => [
                "type" => "text",
                "label" => "Razon de la tienda",
                "placeholder" => "Mi tienda SL"
            ],
        ],
        "configuracion_nombretienda" => [
            "html" => [
                "type" => "text",
                "label" => "Nombre de la tienda",
                "placeholder" => "Mi tienda"
            ],
        ],
        "configuracion_slogan" => [
            "html" => [
                "type" => "text",
                "label" => "Slogan de la tienda",
                "placeholder" => "Mi tienda es la mejor"
            ],
        ],
        "configuracion_email" => [
            "html" => [
                "type" => "email",
                "label" => "Email de contacto",
                "placeholder" => "info@mitienda.com"
            ],
        ],
        "configuracion_telefono" => [
            "html" => [
                "type" => "tel",
                "label" => "Teléfono de contacto",
                "placeholder" => "+346986587"
            ],
        ],
        "configuracion_direccion" => [
            "html" => [
                "type" => "text",
                "label" => "Dirección de contacto",
                "placeholder" => "Av de mi tienda, 6542 España"
            ],
        ],
        "configuracion_cif" => [
            "html" => [
                "type" => "text",
                "label" => "CIF",
                "placeholder" => "B-5269515J"
            ],
        ],
        "configuracion_gastosenviodefecto" => [
            "html" => [
                "type" => "number",
                "step" => "0.1",
                "min" => 0,
                "label" => "Gastos de envio por defecto",
                "placeholder" => "Gastos de envio"
            ],
        ],
        "configuracion_ivageneral" => [
            "html" => [
                "type" => "switch",
                "label" => "¿IVA General?",
                "description" => "Al activar el IVA General, se cambiará el iva de todos los productos de la web, adicionalmente no será posible editarlos individualmente"
            ],
        ],
        "configuracion_iva" => [
            "html" => [
                "type" => "number",
                "step" => "0.01",
                "min" => 0,
                "label" => "IVA por defecto",
                "placeholder" => "IVA",
                "description" => "Introduzca un numero entre 0 y 1. Ejemplo = 0.21",
            ],
        ],
        "configuracion_irpf" => [
            "html" => [
                "type" => "text",
                "label" => "IRPF",
                "description" => "Para autonomos en España",
            ],
        ],
        "configuracion_iban" => [
            "html" => [
                "type" => "text",
                "label" => "IBAN para transferencias",
                "placeholder" => "IBAN"
            ],
        ],
        "configuracion_merchantcode" => [
            "html" => [
                "type" => "text",
                "label" => "Merchant code",
                "placeholder" => "MerchantCode"
            ],
        ],
        "configuracion_merchanttermial" => [
            "html" => [
                "type" => "text",
                "label" => "Terminal",
                "placeholder" => "Terminal de redsys"
            ],
        ],
        "configuracion_merchantsignature" => [
            "html" => [
                "type" => "text",
                "label" => "Firma",
                "placeholder" => "Firma de redsys"
            ],
        ],
        "configuracion_merchantproduccion" => [
            "html" => [
                "type" => "switch",
                "label" => "¿Produccion o pruebas?",
            ],
        ],
        "configuracion_aplazameclientid" => [
            "html" => [
                "type" => "text",
                "label" => "Cliente ID",
                "placeholder" => "Cliente ID"
            ],
        ],
        "configuracion_aplazameclientsecret" => [
            "html" => [
                "type" => "text",
                "label" => "Secret ID",
                "placeholder" => "Secret ID"
            ],
        ],
        "configuracion_aplazameproduccion" => [
            "html" => [
                "type" => "switch",
                "label" => "¿Produccion o Pruebas?",
            ],
        ],
        "configuracion_emailhost" => [
            "html" => [
                "type" => "text",
                "label" => "Host",
                "placeholder" => "Host"
            ],
        ],
        "configuracion_emailport" => [
            "html" => [
                "type" => "text",
                "label" => "Puerto",
                "placeholder" => "Puerto"
            ],
        ],
        "configuracion_emailuser" => [
            "html" => [
                "type" => "text",
                "label" => "Usuario",
                "placeholder" => "Usuario"
            ],
        ],
        "configuracion_emailpass" => [
            "html" => [
                "type" => "text",
                "label" => "Password",
                "placeholder" => "password"
            ],
        ],
        "configuracion_googleanalytics" => [
            "html" => [
                "type" => "text",
                "label" => "Google Analitycs",
                "placeholder" => "Google Analitycs"
            ],
        ],
        "configuracion_facebookpixel" => [
            "html" => [
                "type" => "text",
                "label" => "Facebook pixel",
                "placeholder" => "Facebook pixel"
            ],
        ],
        "configuracion_moneda" => [
            "html" => [
                "type" => "text",
                "label" => "Simbolo moneda",
                "placeholder" => "€",
            ],
        ],
        "configuracion_alphamoneda" => [
            "html" => [
                "type" => "text",
                "label" => "Alpha moneda",
                "placeholder" => "EUR",
            ],
        ],
        "configuracion_ubicacion" => [
            "html" => [
                "type" => "select",
                "label" => "Ubicacion del simbolo",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "ubicaciones"
        ],
        "configuracion_emailtype" => [
            "html" => [
                "type" => "select",
                "label" => "Forma de envío de email",
                "placeholder" => "--SELECCIONA UNA OPCION--"
            ],
            "options" => "types"
        ],
        "configuracion_miles" => [
            "html" => [
                "type" => "text",
                "label" => "Separador de miles",
                "placeholder" => ".",
            ],
        ],
        "configuracion_decimales" => [
            "html" => [
                "type" => "text",
                "label" => "Separador de decimales",
                "placeholder" => ",",
            ],
        ],

    ];

    public static $ubicaciones = [
        "Izquierda",
        "Derecha",
    ];

    public static $tipostiendas = [
        "Minorista",
        "Mayorista",
    ];

    public static $verprecios = [
        "Todos",
        "Solo Usuarios Registrados",
        "Nadie"
    ];

    public static $templates = [
        "basico",
        "sexylady",
        "danielarnedo",
        "betheme",
        "staronline",
        "custom_staronline",
        "family_circus",
        "mechanic"
    ];

    public static $sinos = [
        "No",
        "Si",
    ];

    public static $types = [
        "PHP",
        "CodeIgniter",
    ];

    public function __construct(){
        $this->model = new ConfiguracionModel();
    }

    public function getCarpeta(){
        if (isset(self::$templates[$this->_get("template")])) {
            return self::$templates[$this->_get("template")];
        }
        return $this->_get("template");
    }

    public function moneda($valor, $microData = true){
        $moneda = ($this->_get("moneda") != "") ? $this->_get("moneda") : "€";
        $alphaMoneda = ($this->_get("alphamoneda") != "") ? $this->_get("alphamoneda") : "EUR";
        $ubicacion = ($this->_get("ubicacion") != "") ? $this->_get("ubicacion") : 0;
        $miles = ($this->_get("miles") != "") ? $this->_get("miles") : ".";
        $decimales = ($this->_get("decimales") != "") ? $this->_get("decimales") : ",";
        $valor = floatval($valor);
        $valor = number_format($valor, 2, $decimales, $miles);

        if ($microData) {
            $moneda = "<span itemprop='priceCurrency' content='$alphaMoneda'>$moneda</span>";
        }
        if ($ubicacion == 0) {
            return $moneda.$valor;
        } else {
            return $valor.$moneda;
        }
    }

    public function getValueFromString($string){
        if (empty($string)) {
            return 0;
        }
        if (strpos($string, "%") !== false) {
            $string = str_replace("%", "", $string);
            $string = floatval($string);
            $string = $string * 0.01;
        }
        return floatval($string);
    }

    public function TEMAPATH($subdir = ""){
        if ($subdir != "") {
            return  APPPATH."Views/$subdir";
        }
        return  APPPATH."Views";
    }

    public function getImageTema($tema){
        $file = $this->TEMAPATH("$tema/picture.jpg");
        if (!file_exists($file)) {
            return "";
        }
        $imagen = file_get_contents($file);
        if ($imagen === false) {
            return "";
        }
        return "data:".$this->_get("mime").";base64,".base64_encode($imagen);
    }

    public function getThemeMap(){
        $url = APPPATH."Views/".$this->getCarpeta();
        $map = directory_map($url);
        $result = [];
        $this->getFilesFrom($map, $url."/", $result);
        return $result;
    }

    public function getFilesFrom($map, $root, &$files){
        foreach ($map as $dir => $file) {
            if (is_array($file)) {
                $this->getFilesFrom($file, $root.$dir, $files);
            } else {
                $php = strpos($file, ".php");
                if ($php !== false) {
                    $file = str_replace(".php", "", $file);
                    $file = $root.$file;
                    $file = str_replace(APPPATH."Views/".$this->getCarpeta()."/", "", $file);
                    $files[] = $file;
                }
            }
        }
    }

    public function getTiendaOnline(){
        $tienda_model = new \App\Models\TiendaModel();
        if ($this->_get("tienda_id_online") > 0) {
            return $tienda_model->find($this->_get("tienda_id_online"));
        } else {
            return new \App\Entities\Tienda();
        }
    }

    public function loadCookies(){
        $cookies = $this->_get("cookies");
		if (empty($cookies) || ($cookies == "")) {
			$cookies = [
				"Ajustes del banner" => [
					"Activo" => 1,
					"Boton aceptar" => "Aceptar",
					"Boton configurar" => "Configurar",
					"Posicion" => "Centro",
					"Fondo" => "#000",
					"Boton flotante" => 1,
					"Caducidad de las cookies (dias)" => 365,
				],
				"Resumen" => [
					"Titulo" => "Resumen de privacidad",
					"Contenido" => "Utilizamos cookies para darte la mejor experiencia en nuestra web. Puedes informarte más sobre qué cookies estamos utilizando o desactivarlas",
				],
				"Cookies" => [
					[
						"Nombre" => "ci_session",
						"Titulo" => "Session CodeIgniter",
						"Contenido" => "Definir los parámetros de la sesión: idioma, configuración regional, etc…",
						"Entidad encargada" => "Propias",
						"Caducidad" => "Al finalizar la sesión",
						"Script" => "",
						"Activa" => 1,
                        "tipo" => 0,
					], [
						"Nombre" => "aceptarCookie",
						"Titulo" => "Aceptar Cookies",
						"Contenido" => "Conocer si acepta cookies para no volver a mostrar el mensaje",
						"Entidad encargada" => "Propias",
						"Caducidad" => "30 días",
						"Script" => "",
						"Activa" => 0,
                        "tipo" => 0,
					], [
						"Nombre" => "_ga, _gid, _gat_gtag_UA_36394386-11",
						"Titulo" => "Google Analytics",
						"Contenido" => "Generar un ID de usuario anónimo, que es el empleado para hacer recuento de cuántas veces un mismo usuario visita un Sitio de Internet",
						"Entidad encargada" => "Google Analytics",
						"Caducidad" => "2 años desde inicio de sesión",
						"Script" => '
                            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-36394386-11"></script>
                           <script>
                             window.dataLayer = window.dataLayer || [];
                             function gtag(){dataLayer.push(arguments);}
                             gtag("js", new Date());

                             gtag("config", "UA-36394386-11");
                           </script>
                        ',
						"Activa" => 0,
                        "tipo" => 1,
					], [
						"Nombre" => "_fbp",
						"Titulo" => "Facebook Pixel",
						"Contenido" => "Utilizada por Facebook para proporcionar una serie de productos publicitarios como pujas en tiempo real de terceros anunciantes.",
						"Entidad encargada" => "Facebook Pixel",
						"Caducidad" => "3 meses",
						"Script" => "",
						"Activa" => 1,
                        "tipo" => 1,
					],
				],
			];
			$this->_set("cookies", json_encode($cookies));
			$this->update();
		} else {
			$cookies = json_decode($cookies, true);
		}
        return $cookies;
    }

    public function getCookiesHeader(){
        $cookies = $this->loadCookies();
        if ($cookies["Ajustes del banner"]["Activo"] != 1) {
            return "";
        }
        if (!isset($_COOKIE["aceptarCookie"])) {
            return "";
        }
        $cookiesMarcadas = json_decode($_COOKIE["aceptarCookie"], true);
        $script = "";
        foreach ($cookiesMarcadas as $cookie => $value) {
            if ($value == "checked") {
                foreach ($cookies["Cookies"] as $dbcookie) {
                    if ($dbcookie["Activa"] == 1) {
                        $nombrecompleto = $this->getCookieNombre($dbcookie["Nombre"]);
                        if ($nombrecompleto == $cookie) {
                            $script .= $dbcookie["Script"];
                        }
                    }
                }
            }

        }
        return $script;
    }
    public function getCookiesFooter(){
        $cookies = $this->loadCookies();
        return view("admin/cookies/footer.php", ["configuracion" => $this, "cookies" => $cookies]);
    }

    public function getDomain(){
        $url = base_url();
        $domain = str_replace("http://www", "", $url);
        $domain = str_replace("http://", "", $domain);
        $domain = str_replace("https://www", "", $domain);
        $domain = str_replace("https://", "", $domain);
        $domain = str_replace("/", "", $domain);
        return $domain;
    }

    public function getCookieNombre($nombrecompleto){
        $nombrecompleto = str_replace(" ", "", $nombrecompleto);
        $nombres = explode(",", $nombrecompleto);
        return $nombres[0];
    }

    public function getCookieArray($nombrecompleto){
        $nombrecompleto = str_replace(" ", "", $nombrecompleto);
        $nombres = explode(",", $nombrecompleto);
        return implode(",", $nombres);
    }

    public function getCookieChecked($nombrecompleto){
        $nombrecompleto = str_replace(" ", "", $nombrecompleto);
        $nombres = explode(",", $nombrecompleto);
        foreach ($nombres as $nombre) {
            if (isset($_COOKIE[$nombre])) {
                return "checked";
            }
        }
        return "";
    }

    public function getreCaptcha(){
        if (file_exists(APPPATH."/Views/admin/recaptcha")) {
            $predata = $this->_get("data");
    		$data = json_decode($predata, true);
            if (!isset($data["reCaptcha"])) {
                return "";
            }
            return view("admin/recaptcha/script", ["data" => $data["reCaptcha"]]);
        }
    }

    public function evaluateRecaptcha(){
        $predata = $this->_get("data");
		$data = json_decode($predata, true);
        if (!isset($data["reCaptcha"])) {
            return true;
        }

        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = $data["reCaptcha"]['CLAVE_SECRETA'];
        $recaptcha_response = $_POST['recaptcha_response'];
        $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $recaptcha = json_decode($recaptcha);

        if($recaptcha->score >= $data["reCaptcha"]['SECURITY_LEVEL']){
            return true;
        } else {
            return false;
        }
    }

    public function sendEmail($de, $nombreTienda, $para, $titulo, $mensaje){
        if ($this->_get("emailtype") == 1) {
            $email = \Config\Services::email();
            $email->initialize([
                "mailType"      => "html",
                "protocol"      => "mail",//mail, sendmail, or smtp
            ]);
            $email->setFrom($de, $nombreTienda);
            $email->setTo($para);

            $email->setSubject($titulo);
            $email->setMessage($mensaje);

            return $email->send();
        } else {
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $cabeceras .= 'From: '. $de ."\r\n" .
                'Reply-To: '. $para ."\r\n" .
                'X-Mailer: PHP/' . phpversion();

            return mail($para, $titulo, $mensaje, $cabeceras);
        }
    }
}
