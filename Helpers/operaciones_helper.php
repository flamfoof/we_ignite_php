<?php


    function fecha($fecha){
        return date("d/m/Y H:i:s", strtotime($fecha));
    }

    function fechaSimple($fecha){
        return date("d/m/Y", strtotime($fecha));
    }

    function suma($value1, $value2){
        return $value1 + $value2;
    }

    function resta($value1, $value2){
        return $value1 - $value2;
    }

    function moneda($value, $formato = "€"){
        if ($formato == "$") {
            return "<span itemprop='priceCurrency' content='USD'>$</span>".number_format(floatval($value), 2, ".", ",");
        } else {
            return number_format(floatval($value), 2, ",", ".")."<span itemprop='priceCurrency' content='EUR'>€</span>";
        }
    }

    function recortar($string, $len){
        return substr($string,0, $len).((strlen($string) > $len) ? "...": "");
    }

    function getGET($name, $default = ""){
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        return $default;
    }

    function getURLGets($array = array(), $removes = array()){
        $urlGets = [];
        foreach ($_GET as $key => $value) {
            if (!isset($urlGets[$key])) {
                $value = str_replace(" ","+",$value);
                $urlGets[$key] = "$key=$value";
            }
        }
        foreach ($array as $key => $value) {
            $urlGets[$key] = "$key=$value";
        }
        foreach ($removes as $remove) {
            if (isset($urlGets[$remove])) {
                unset($urlGets[$remove]);
            }
        }
        return "?".implode("&", $urlGets);
    }

    function getCurrent($array = array(), $removes = array()){
        $currentUrl = current_url();
        $parts = explode("?", $currentUrl);
        $currentUrl = $parts[0];
        return $currentUrl.getURLGets($array, $removes);
    }

    function getMainUrl($value=''){
        $currentUrl = current_url();
        $parts = explode("?", $currentUrl);
        return $parts[0];
    }

    function sanear($string){
       $string = trim($string);

       $string = str_replace(
           array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
           array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
           $string
       );

       $string = str_replace(
           array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
           array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
           $string
       );

       $string = str_replace(
           array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
           array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
           $string
       );

       $string = str_replace(
           array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
           array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
           $string
       );

       $string = str_replace(
           array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
           array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
           $string
       );

       $string = str_replace(
           array('ñ', 'Ñ', 'ç', 'Ç', "'"),
           array('n', 'N', 'c', 'C', ""),
           $string
       );

       //Esta parte se encarga de eliminar cualquier caracter extraño
       $string = str_replace(
           array("\\", "¨", "º", "-", "~",
                "#", "@", "|", "!", "\"",
                "·", "$", "%", "&", "/",
                "(", ")", "?", "\'", "¡",
                "¿", "[", "^", "<code>", "]",
                "+", "}", "{", "¨", "´",
                ">", "< ", ";", ",", ":",
                "."),
           '',
           $string
       );


       return $string;
    }

    function slug($string){
        $string = sanear($string);
        $string = str_replace(" ", "-", strtolower($string));
        return $string;
    }

    function adaptarAEmail($string){
        $string = str_replace(
            array(
                "ñ", "Ñ",
                "á", "Á", "à", "À", "â", "À",
                "é", "É", "è", "È", "ê", "Ê",
                "í", "Í", "ì", "Ì", "î", "Î",
                "ó", "Ó", "ò", "Ò", "ô", "Ô",
                "ú", "Ú", "ù", "Ù", "û", "Û",
            ),
            array(
                "&ntilde;", "&Ntilde;",
                "&aacute;", "&Aacute;", "&agrave;", "&Agrave;", "&acirc;", "&Acirc;",
                "&eacute;", "&Eacute;", "&egrave;", "&Egrave;", "&ecirc;", "&Ecirc;",
                "&iacute;", "&Iacute;", "&igrave;", "&Igrave;", "&icirc;", "&Icirc;",
                "&oacute;", "&Oacute;", "&ograve;", "&Ograve;", "&Ocirc;", "&Ocirc;",
                "&uacute;", "&Uacute;", "&ugrave;", "&Ugrave;", "&ucirc;", "&Ucirc;",
            ),
            $string
        );
        return $string;
    }

    function encodeText($string){
        $string = str_replace(
            array(
                "ñ", "Ñ",
                "á", "Á", "à", "À", "â", "À",
                "é", "É", "è", "È", "ê", "Ê",
                "í", "Í", "ì", "Ì", "î", "Î",
                "ó", "Ó", "ò", "Ò", "ô", "Ô",
                "ú", "Ú", "ù", "Ù", "û", "Û",
                "'", "€", "º", "'", "¡"
            ),
            array(
                "&ntilde;", "&Ntilde;",
                "&aacute;", "&Aacute;", "&agrave;", "&Agrave;", "&acirc;", "&Acirc;",
                "&eacute;", "&Eacute;", "&egrave;", "&Egrave;", "&ecirc;", "&Ecirc;",
                "&iacute;", "&Iacute;", "&igrave;", "&Igrave;", "&icirc;", "&Icirc;",
                "&oacute;", "&Oacute;", "&ograve;", "&Ograve;", "&Ocirc;", "&Ocirc;",
                "&uacute;", "&Uacute;", "&ugrave;", "&Ugrave;", "&ucirc;", "&Ucirc;",
                "&apost;", "&euro;", "&deg;", "&apost;", "&iexcl;"
            ),
            $string
        );
        return $string;
    }

    function decodeText($string){
        $string = str_replace(
            array(
                "&ntilde;", "&Ntilde;",
                "&aacute;", "&Aacute;", "&agrave;", "&Agrave;", "&acirc;", "&Acirc;",
                "&eacute;", "&Eacute;", "&egrave;", "&Egrave;", "&ecirc;", "&Ecirc;",
                "&iacute;", "&Iacute;", "&igrave;", "&Igrave;", "&icirc;", "&Icirc;",
                "&oacute;", "&Oacute;", "&ograve;", "&Ograve;", "&Ocirc;", "&Ocirc;",
                "&uacute;", "&Uacute;", "&ugrave;", "&Ugrave;", "&ucirc;", "&Ucirc;",
                "&apost;", "&euro;"
            ),
            array(
                "ñ", "Ñ",
                "á", "Á", "à", "À", "â", "À",
                "é", "É", "è", "È", "ê", "Ê",
                "í", "Í", "ì", "Ì", "î", "Î",
                "ó", "Ó", "ò", "Ò", "ô", "Ô",
                "ú", "Ú", "ù", "Ù", "û", "Û",
                "'", "€"
            ),
            $string
        );
        return $string;
    }
?>
