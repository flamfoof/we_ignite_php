<?php
namespace App\Controllers;
use App\Models\UsuarioModel;

class Migrate extends \CodeIgniter\Controller {

    public function index() {
        $migrate = \Config\Services::migrations();

        try {
            $migrate->latest();
        } catch (\Exception $e) {
            echo "ERROR<br>";
            var_dump($e);
        }
        echo "Migrate done!<br>";
    }

    public function back() {
        $migrate = \Config\Services::migrations();

        try {
            $migrate->regress(-1);
        } catch (\Exception $e) {
            echo "ERROR<br>";
            var_dump($e);
        }
        echo "Migrate done!<br>";
    }

    public function seed_tallas(){
        $seeder = \Config\Database::seeder();
        $seeder->call('SimpleSeeder');
        echo "Seed ok<br>";
    }

    public function seed_paises(){
        $seeder = \Config\Database::seeder();
        $seeder->call('PaisSeeder');
        echo "Seed ok<br>";
    }

    public function seed_states(){
        $seeder = \Config\Database::seeder();
        $seeder->call('StatesSeeder');
        echo "Seed ok<br>";
    }

    public function seed_temp(){
        $seeder = \Config\Database::seeder();
        $seeder->call('TempSeeder');
        echo "Seed ok<br>";
    }

    public function seed_envios(){
        $seeder = \Config\Database::seeder();
        $seeder->call('EnviosSeeder');
        echo "Seed ok<br>";
    }

    public function reset_user(){
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find(1);
        $usuario->_set("password", password_hash("123456", PASSWORD_DEFAULT));
        $usuario->_set("log", "");
        $usuario->update();
        echo $usuarioModel->getLastQuery();
    }

    public function danielarnedo(){
        $combinacionModel = new \App\Models\CombinacionModel();
        $productoModel = new \App\Models\ProductoModel();
        $combinacionTiendaModel = new \App\Models\CombinacionTiendaModel();
        $db = \Config\Database::connect();
        $sql = "
        SELECT
            *
        FROM
            base_combinacion
        JOIN base_producto ON producto_id = combinacion_producto_id
        WHERE
        	producto_estado = 1 AND
            combinacion_estado = 1
        ORDER BY producto_id
        ";
        $query = $db->query($sql);
        foreach ($query->getResult() as $key => $dbcombinacion) {
            $combinacion = new \App\Entities\Combinacion();
            $producto = new \App\Entities\Producto();

            //--temporada
            $sqlTemporada = "
            SELECT coleccion_nombre
            FROM base_coleccion
            JOIN base_productocoleccion ON productocoleccion_coleccion_id = coleccion_id
            WHERE productocoleccion_producto_id = '{$dbcombinacion->producto_id}' AND
                productocoleccion_estado = 1 AND
                coleccion_padre = 'Temporada'
            LIMIT 1
            ";
            $queryTemporada = $db->query($sqlTemporada);
            $dbtemporada = $queryTemporada->getResult();
            $temporada = 0;
            if (isset($dbtemporada[0])) {
                $dbtemporada = $dbtemporada[0];
                $temporada = array_search($dbtemporada->coleccion_nombre, $producto::$temporadas);
            }

            //--genero
            $sqlGenero = "
            SELECT coleccion_nombre
            FROM base_coleccion
            JOIN base_productocoleccion ON productocoleccion_coleccion_id = coleccion_id
            WHERE productocoleccion_producto_id = '{$dbcombinacion->producto_id}' AND
                productocoleccion_estado = 1 AND
                coleccion_padre = 'Genero'
            LIMIT 1
            ";
            $queryGenero = $db->query($sqlGenero);
            $dbGenero = $queryGenero->getResult();
            $genero = 0;
            if (!empty($dbGenero[0])) {
                $dbGenero = $dbGenero[0];
                if (isset($dbGenero)) {
                    $genero = array_search(mb_strtoupper($dbGenero->coleccion_nombre), $producto::$generos);
                }
            }
            $generoN = "HOMBRE";
            if (!empty($dbGenero)) {
                $generoN = mb_strtoupper($dbGenero->coleccion_nombre);
            }

            //--familia
            $sqlFamilia = "
            SELECT familialang_nombre
            FROM base_familialang
            JOIN base_familia ON familia_id = familialang_familia_id
            WHERE familia_id = '{$dbcombinacion->producto_subfamilia_id}'
            LIMIT 1
            ";
            echo "--$sqlFamilia<br>";
            $queryFamilia = $db->query($sqlFamilia);
            $dbFamilia = $queryFamilia->getResult();
            $familias = $producto::$familias;
            $familiaUnique = "";
            if (!empty($dbFamilia[0])) {
                echo "familias[$generoN] <br>";
                foreach ($familias[$generoN] as $key => $familiaArray) {
                    echo "familias[$generoN][$key] find {$dbFamilia[0]->familialang_nombre} <br>";
                    $familiaID = array_search($dbFamilia[0]->familialang_nombre, $familiaArray);
                    if ($familiaID !== false) {
                        $familiaUnique = "$generoN||$key||$familiaID";
                    }
                }
            }
            echo "familiaUnique = $familiaUnique<br>";

            //--marca
            $sqlMarca = "
            SELECT marca_nombre
            FROM base_marca
            WHERE marca_id = '{$dbcombinacion->producto_marca_id}'
            LIMIT 1
            ";
            $queryMarca = $db->query($sqlMarca);
            $dbMarca = $queryMarca->getResult();
            $marca = 0;
            if (!empty($dbMarca[0])) {
                $dbMarca = $dbMarca[0];
                if (isset($dbMarca)) {
                    $marca = array_search(mb_strtoupper($dbMarca->marca_nombre), $producto::$marcas);
                }
            }

            //--crear producto
            $ficha = [
                "producto_sku" => $dbcombinacion->producto_skubase,
                "producto_temporada_id" => $temporada,
                "producto_genero_id" => $genero,
                "producto_subfamilia_id" => $familiaUnique,
                "producto_marca_id" => $marca,
            ];
            $producto = $productoModel->findByFicha($ficha);
    		if (empty($producto)) {
    			$producto = new \App\Entities\Producto();
    			$ficha["producto_fecha"] = date("Y-m-d H:i:s");
    			$ficha["producto_usuario_id"] = 1;
    		}
            $ficha["producto_nombreinterno"] = $dbcombinacion->producto_nombreinterno;
            $ficha["producto_precio"] = $dbcombinacion->combinacion_precio;
            $ficha["producto_costo"] = $dbcombinacion->combinacion_costo;
            $ficha["producto_iva"] = 0.21;
            $ficha["producto_estado"] = 1;
            $ficha["producto_modificado"] = date("Y-m-d H:i:s");
            $ficha["producto_usuario_id_modificado"] = 1;
            $ficha["producto_trama_id"] = 0;
            $producto->save($ficha);


            //--talla
            $sqlTalla = "
            SELECT atributo_nombre, formato_nombre
            FROM base_atributo
            JOIN base_combinacionatributo ON combinacionatributo_atributo_id = atributo_id
            JOIN base_formato ON formato_id = atributo_formato_id
            WHERE combinacionatributo_combinacion_id = '{$dbcombinacion->combinacion_id}'
            LIMIT 1
            ";
            $queryTalla = $db->query($sqlTalla);
            $dbTalla = $queryTalla->getResult();
            $tallas = $combinacion::$tallas;
            $formato = "";
            if (!empty($dbTalla)) {
                $formato = $dbTalla[0]->formato_nombre;
            }
            $talla = "not found";
            if (isset($tallas[$generoN])) {
                if (isset($tallas[$generoN][$formato])) {
                    $haystack = $tallas[$generoN][$formato];
                    $needle = $dbTalla[0]->atributo_nombre;
                    $talla = array_search($needle, $haystack);
                    $talla = "$generoN||$formato||$talla";
                }
            }

            //--color
            $sqlcolor = "
            SELECT color_nombre
            FROM base_color
            JOIN base_producto ON producto_color_id = color_id
            WHERE producto_color_id = '{$dbcombinacion->producto_color_id}'
            LIMIT 1
            ";
            echo "<br>COLOR: $sqlcolor<br>";
            $queryColor = $db->query($sqlcolor);
            $dbColor = $queryColor->getResult();
            if (isset($dbColor[0])) {
                $dbColor = $dbColor[0];
                $color = $dbColor->color_nombre;
            } else {
                $color = "VACIO";
            }

            //--crear combinacion
            $fichaux = [
                "producto_sku" => $dbcombinacion->producto_skubase,
                "producto_temporada_id" => $temporada,
                "producto_genero_id" => $genero,
                "combinacion_skucolor" => $dbcombinacion->producto_skudetalle,
                "combinacion_talla" => $talla,
                "combinacion_ean" => $dbcombinacion->combinacion_ean,
            ];
            $combinacion = $combinacionModel->findByFichaIncludeEan($fichaux);
    		if (empty($combinacion)) {
    			$combinacion = new \App\Entities\Combinacion();
    		}
            $combinacion->_set("ean", $dbcombinacion->combinacion_ean);
            $combinacion->_set("producto_id", $producto->_id());
            $combinacion->_set("skucolor", $dbcombinacion->producto_skudetalle);
            $combinacion->_set("talla", $talla);
            $combinacion->_set("color", $color);
            $combinacion->_set("estado", 1);
            $combinacion->update();

            //-- cantidades
            $sqlCantidades = "
                SELECT *
                FROM base_combinaciontienda
                WHERE combinaciontienda_combinacion_id = '{$dbcombinacion->combinacion_id}' AND
                    combinaciontienda_estado = 1 AND combinaciontienda_tienda_id < 4
            ";
            echo "$sqlCantidades <br>";
            $queryCantidades = $db->query($sqlCantidades);
            foreach ($queryCantidades->getResult() as $key => $dbCantidad) {
                $combinacionTienda = $combinacionTiendaModel
                    ->where("combinaciontienda_tienda_id", $dbCantidad->combinaciontienda_tienda_id)
                    ->where("combinaciontienda_combinacion_id", $dbcombinacion->combinacion_id)
                    ->first();
                echo "--".$combinacionTiendaModel->getLastQuery()."<br>";
                if (empty($combinacionTienda)) {
                    $combinacionTienda = new \App\Entities\CombinacionTienda();
                }
                $combinacionTienda->_set("combinacion_id", $dbCantidad->combinaciontienda_combinacion_id);
                $combinacionTienda->_set("tienda_id", $dbCantidad->combinaciontienda_tienda_id);
                $combinacionTienda->_set("cantidad", $dbCantidad->combinaciontienda_cantidad);
                $combinacionTienda->_set("estado", 1);
                $combinacionTienda->update();
            }
            echo "<hr>";
        }
    }

    public function danielarnedo_albaranes(){
        $inventarioModel = new \App\Models\InventarioModel();
        $inventarioProductoModel = new \App\Models\InventarioProductoModel();
        $productoModel = new \App\Models\ProductoModel();
        $db = \Config\Database::connect();
        $sql = "
        SELECT
            *
        FROM
            base_albaran
        ";
        $query = $db->query($sql);
        foreach ($query->getResult() as $key => $dbalbaran) {
            $inventario = $inventarioModel
                ->where("inventario_referencia", $dbalbaran->albaran_referencia)
                ->where("inventario_observacion", $dbalbaran->albaran_observaciones)
                ->where("inventario_tienda_id_from", $dbalbaran->albaran_tienda_id)
                ->where("inventario_fecha", $dbalbaran->albaran_fecha)
                ->first();
            if (empty($inventario)) {
                $inventario = new \App\Entities\Inventario();
            }
            $tipo = $dbalbaran->albaran_tipo;
            if (empty($tipo) || ($tipo == 0)) {//recibo
                if ($dbalbaran->albaran_usuario_id_cliente > 0) {// recibo ramiro / farfetch
                    $tipo = 0;
                } else {// recibo empresa
                    $tipo = 4;
                }
                $tipo = 4;
            } elseif ($tipo == 1) {
                if ($dbalbaran->albaran_usuario_id_cliente > 0) {// envio ramiro / farfetch
                    $tipo = 3;
                } else {// envio empresa
                    $tipo = 0;
                }
            }
            $estado = $dbalbaran->albaran_estado;
            if ($dbalbaran->albaran_estado == 3) {
                $estado = 2;
            } elseif ($dbalbaran->albaran_estado == 6) {
                $estado = 3;
            } else {
                $estado = 1;
            }
            $inventario->_set("referencia", $dbalbaran->albaran_referencia);
            $inventario->_set("tipo", $tipo);
            $inventario->_set("usuario_id", 1);
            $inventario->_set("usuario_id_cliente", $dbalbaran->albaran_usuario_id_cliente);
            $inventario->_set("tienda_id_from", $dbalbaran->albaran_tienda_id);
            $inventario->_set("tienda_id_to", 0);
            $inventario->_set("subtotal", $dbalbaran->albaran_subtotal);
            $inventario->_set("iva", ($dbalbaran->albaran_total * 0.21));
            $inventario->_set("total", $dbalbaran->albaran_total);
            $inventario->_set("marca", "");
            $inventario->_set("temporada", "");
            $inventario->_set("fecha", $dbalbaran->albaran_fecha);
            $inventario->_set("observacion", $dbalbaran->albaran_observaciones);
            $inventario->_set("estado", $estado);
            $inventario->update();

            //-- productos
            $sqlProductos = "
            SELECT
                *
            FROM
                base_albaranproducto
            JOIN base_producto ON producto_id = albaranproducto_producto_id
            JOIN base_combinacion ON combinacion_id = albaranproducto_combinacion_id
            WHERE
            	albaranproducto_albaran_id = '{$dbalbaran->albaran_id}' AND
                albaranproducto_estado = 1

            ";
            $queryProductos = $db->query($sqlProductos);
            foreach ($queryProductos->getResult() as $key => $dbproductos) {
                $inventarioproducto = $inventarioProductoModel
                    ->where("inventarioproducto_producto_id", $dbproductos->albaranproducto_producto_id)
                    ->where("inventarioproducto_combinacion_id", $dbproductos->albaranproducto_combinacion_id)
                    ->where("inventarioproducto_estado", 1)
                    ->first();
                if (empty($inventarioproducto)) {
                    $inventarioproducto = new \App\Entities\InventarioProducto();
                }
                $producto = $productoModel
                    ->join("combinacion", "combinacion_producto_id = producto_id")
                    ->where("combinacion_ean", $dbproductos->combinacion_ean)
                    ->first();
                if (empty($producto)) {
                    $producto = new \App\Entities\Producto();
                }
                $inventarioproducto->_set("inventario_id", $inventario->_id());
                $inventarioproducto->_set("usuario_id", 1);
                $inventarioproducto->_set("producto_id", $producto->producto_id);
                $inventarioproducto->_set("combinacion_id", $producto->combinacion_id);
                $inventarioproducto->_set("producto_sku", $producto->producto_sku);
                $inventarioproducto->_set("producto_nombreinterno", $producto->producto_nombreinterno);
                $inventarioproducto->_set("combinacion_skucolor", $producto->combinacion_skucolor);
                $inventarioproducto->_set("combinacion_ean", $producto->combinacion_ean);
                $inventarioproducto->_set("costo", $producto->combinacion_costo);
                $inventarioproducto->_set("precio", $producto->combinacion_precio);
                $inventarioproducto->_set("cantidad", $dbproductos->albaranproducto_cantidad);
                $inventarioproducto->_set("iva", 0.21);
                $inventarioproducto->_set("cantidad_recibida", 0);
                $inventarioproducto->_set("observacion", "");
                $inventarioproducto->_set("observacion_recibida", "");
                $inventarioproducto->_set("estado", 1);
                $inventarioproducto->update();
            }
        }
    }

    public function kasas10_proveedores(){
        $usuario_model = new \App\Models\UsuarioModel();
        $usuariorole_model = new \App\Models\UsuarioRoleModel();
        $role_model = new \App\Models\RoleModel();
        $role = $role_model->where("role_nombre", "Proveedor")->first();
        $usuarios = $usuario_model->findAll();
        foreach ($usuarios as $usuario) {
            $usuariorole = $usuariorole_model
                ->where("usuariorole_usuario_id", $usuario->_id())
                ->where("usuariorole_role_id", $role->_id())
                ->first();
            if (empty($usuariorole)) {
                $usuariorole = new \App\Entities\UsuarioRole();
                $usuariorole->_set("usuario_id", $usuario->_id());
                $usuariorole->_set("role_id", $role->_id());
                $usuariorole->_set("estado", 1);
                $usuariorole->update();
                echo $usuariorole_model->getLastQuery()."<br>";
            } else {
                $usuariorole->_set("estado", 1);
                $usuariorole->update();
                echo $usuariorole_model->getLastQuery()."<br>";
            }
        }
        echo "FIN";
    }

    public function kasas10_inmuebles(){
        helper('operaciones_helper');
        $propiedadModel = new \App\Models\PropiedadModel();
        $usuarioModel = new \App\Models\UsuarioModel();
        $ciudadModel = new \App\Models\CiudadModel();
        $zonaModel = new \App\Models\ZonaModel();
        $inmocrmModel = new \App\Models\InmoCRMModel();
        $propiedadFotoModel = new \App\Models\PropiedadFotoModel();
        $db = \Config\Database::connect();
        $sql = "
        SELECT
            *
        FROM
            inmobiliaria_piso
        WHERE estado = 3
        ";//hasta 765 -
        $query = $db->query($sql);
        foreach ($query->getResult() as $key => $dbinmueble) {
            $propiedad = $propiedadModel
                ->where("propiedad_referencia", $dbinmueble->referencia)
                ->where("propiedad_nombre", $dbinmueble->titulo)
                ->first();
            echo "START -> ".$propiedadModel->getLastQuery()."<br>";
            if (empty($propiedad)) {
                echo "Producto no encontrado <br>";
                $direccion = new \App\Entities\Direccion();
                $propiedad = new \App\Entities\Propiedad();
            } else {
                echo "Producto found <br>";
                $direccion = $propiedad->getDireccion();
            }

            // -- Ciudad
            $sqlCiudad = "
            SELECT
                *
            FROM
                inmobiliaria_localidad
            WHERE
                LOWER(localidad_id) = {$dbinmueble->localidad}
            LIMIT 1
            ";
            echo "Query Ciudad: $sqlCiudad<br>";
            $queryCiudad = $db->query($sqlCiudad);
            $dbciudades = $queryCiudad->getResult();
            $dbciudad = $dbciudades[0];

            $ciudad = $ciudadModel->where("LOWER(ciudad_nombre)", mb_strtolower($dbciudad->nombre))->first();
            if (empty($ciudad)) {
                $ciudad = new \App\Entities\Ciudad();
                $ciudad->_set("nombre", mb_strtolower($dbciudad->nombre));
                $ciudad->_set("provincia_id", 1);
                $ciudad->_set("estado", 1);
                $ciudad->update();
            }

            if ($dbinmueble->zona > 0) {
                // -- zona
                $sqlZona = "
                SELECT
                    *
                FROM
                    inmobiliaria_zona
                WHERE
                    LOWER(zona_id) = {$dbinmueble->zona}
                LIMIT 1
                ";
                echo "query ZONA: $sqlZona <br>";
                $queryZona = $db->query($sqlZona);
                $dbzonas = $queryZona->getResult();
                $dbzona = $dbzonas[0];

                $zona = $zonaModel->where("LOWER(zona_nombre)", mb_strtolower($dbzona->nombre))->first();
                if (empty($zona)) {
                    $zona = new \App\Entities\Zona();
                    $zona->_set("nombre", mb_strtolower($dbzona->nombre));
                    $zona->_set("ciudad_id", $ciudad->_id());
                    $zona->_set("estado", 1);
                    $zona->update();
                }
            } else {
                $zona = new \App\Entities\Zona();
            }


            // -- direccion
            $direccion->_set("usuario_id", 0);
            $direccion->_set("pais_id", 1);
            $direccion->_set("provincia_id", 1);
            $direccion->_set("ciudad_id", $ciudad->_id());
            $direccion->_set("zona_id", $zona->_id());
            $direccion->_set("via", 0);
            $direccion->_set("direccion", $dbinmueble->calle);
            $direccion->_set("piso", $dbinmueble->piso);
            $direccion->_set("numero", $dbinmueble->numero);
            $direccion->_set("codigopostal", 0);
            $direccion->_set("estado", 1);
            $direccion->update();

            if ($dbinmueble->proveedor_id_id > 0) {
                // -- usuario
                $sqlProveedor = "
                SELECT
                    *
                FROM
                    inmobiliaria_proveedor
                WHERE
                    proveedor_id = {$dbinmueble->proveedor_id_id}
                LIMIT 1
                ";
                echo "Query Proveedor $sqlProveedor <br>";
                $queryProveedor = $db->query($sqlProveedor);
                $dbproveedores = $queryProveedor->getResult();
                $dbproveedor = $dbproveedores[0];
                var_dump($dbproveedor);
                $proveedor = $usuarioModel
                    ->where("usuario_nombre", $dbproveedor->nombres)
                    ->where("usuario_apellidos", $dbproveedor->apellidos)
                    ->where("usuario_email", $dbproveedor->email)
                    ->first();
                if (empty($proveedor)) {
                    $proveedor = new \App\Entities\Usuario();
                }
                $proveedor->_set("nombre", $dbproveedor->nombres);
                $proveedor->_set("apellidos", $dbproveedor->apellidos);
                $proveedor->_set("dni", $dbproveedor->dni);
                $proveedor->_set("telefono", $dbproveedor->telefono);
                $proveedor->_set("email", $dbproveedor->email);
                $proveedor->_set("estado", 1);
                $proveedor->update();
            } else {
                $proveedor = new \App\Entities\Usuario();
            }

            // -- propiedad
            $estado = 1;
            if ($dbinmueble->estado == 0) { //activo en viejo
                $estado = 1;
            } elseif ($dbinmueble->estado == 3) { //desactivado en viejo
                $estado = 4;
            } elseif ($dbinmueble->estado == 1) { //vendido
                $estado = 2;
            } else { //alquilado
                $estado = 3;
            }

            switch ($dbinmueble->tipo_contrato) {
                case '1':
                    $tipocontrato = "venta";
                    break;
                case '2':
                    $tipocontrato = "alquiler";
                    break;
                case '3':
                    $tipocontrato = "traspaso";
                    break;
                default:
                    $tipocontrato = "venta";
                    break;
            }

            switch ($dbinmueble->tipo_inmueble) {
                case '1':
                    $tipoinmueble = "apartamento";
                    break;
                case '2':
                    $tipoinmueble = "atico";
                    break;
                case '3':
                    $tipoinmueble = "buhardilla";
                    break;
                case '4':
                    $tipoinmueble = "casa";
                    break;
                case '5':
                    $tipoinmueble = "chalet-adosado";
                    break;
                case '6':
                    $tipoinmueble = "chalet-individual";
                    break;
                case '7':
                    $tipoinmueble = "duplex";
                    break;
                case '8':
                    $tipoinmueble = "edificio";
                    break;
                case '9':
                    $tipoinmueble = "estudio";
                    break;
                case '10':
                    $tipoinmueble = "finca-rustica";
                    break;
                case '11':
                    $tipoinmueble = "garaje";
                    break;
                case '12':
                    $tipoinmueble = "entreplanta";
                    break;
                case '13':
                    $tipoinmueble = "hotel";
                    break;
                case '14':
                    $tipoinmueble = "local";
                    break;
                case '15':
                    $tipoinmueble = "merendero";
                    break;
                case '16':
                    $tipoinmueble = "oficina";
                    break;
                case '17':
                    $tipoinmueble = "pabellon";
                    break;
                case '18':
                    $tipoinmueble = "piso";
                    break;
                case '19':
                    $tipoinmueble = "restaurante";
                    break;
                case '20':
                    $tipoinmueble = "trastero";
                    break;
                case '21':
                    $tipoinmueble = "terreno";
                    break;
                case '22':
                    $tipoinmueble = "bodega";
                    break;
                case '23':
                    $tipoinmueble = "bar";
                    break;
                case '24':
                    $tipoinmueble = "casa-de-pueblo";
                    break;
                case '25':
                    $tipoinmueble = "nave-industrial";
                    break;
                case '26':
                    $tipoinmueble = "peluqueria";
                    break;
                default:
                    $tipoinmueble = "";
                    break;
            }

            switch ($dbinmueble->estado_inmueble) {
                case '1':
                    $estadoinmueble = "segundamano";
                    break;
                case '2':
                    $estadoinmueble = "obra-nueva";
                    break;
                default:
                    $estadoinmueble = "obra-nueva";
                    break;
            }

            if ($propiedad->_get("url") == "") {
                $url = slug($dbinmueble->titulo);
                $sqlURL = "
                SELECT
                    propiedad_url
                FROM
                    v4_propiedad
                WHERE
                    propiedad_url LIKE '$url%'
                ";
                echo "Query URL $sqlURL <br>";
                $queryURL = $db->query($sqlURL);
                $dburl = $queryURL->getResult();
                if (!empty($dburl)) {
                    $url .= "-".count($dburl);
                }
            } else {
                $url = $propiedad->_get("url");
            }
            echo "<br>";
            $propiedad->_set("nombre", $dbinmueble->titulo);
            $propiedad->_set("url", $url);
            $propiedad->_set("referencia", $dbinmueble->referencia);
            $propiedad->_set("fechaventa", $dbinmueble->vendido_fecha);
            $propiedad->_set("referenciacatastral", $dbinmueble->referencia_catastral);
            $propiedad->_set("usuario_id", 1);
            $propiedad->_set("usuario_id_proveedor", $proveedor->_id());
            $propiedad->_set("destacado", 0);
            $propiedad->_set("preciocompra", $dbinmueble->precio_original);
            $propiedad->_set("precioventa", $dbinmueble->precio);
            $propiedad->_set("preciooferta", 0);
            $propiedad->_set("comision", $dbinmueble->comision);
            $propiedad->_set("mtscontruccion", $dbinmueble->construccion);
            $propiedad->_set("mtsutiles", $dbinmueble->mts_utiles);
            $propiedad->_set("aniocontruccion", $dbinmueble->ano_contruccion);
            $propiedad->_set("habitaciones", $dbinmueble->habitaciones);
            $propiedad->_set("banios", $dbinmueble->banos);
            $propiedad->_set("descripcion", $dbinmueble->descripcion);
            $propiedad->_set("letraenergetica", $dbinmueble->ce_letra_clasificacion);
            $propiedad->_set("valorenergetica", $dbinmueble->ce_valor_clasificacion);
            $propiedad->_set("letraemisiones", $dbinmueble->ce_letra_emisiones);
            $propiedad->_set("valoremisiones", $dbinmueble->ce_valor_emisiones);
            $propiedad->_set("online", 1);
            $propiedad->_set("llaves", $dbinmueble->llave);
            $propiedad->_set("garaje", $dbinmueble->garaje);
            $propiedad->_set("ascensor", $dbinmueble->ascensor);
            $propiedad->_set("piscina", $dbinmueble->piscina);
            $propiedad->_set("terraza", $dbinmueble->terraza);
            $propiedad->_set("trastero", $dbinmueble->trastero);
            $propiedad->_set("direccion_id", $direccion->_id());
            $propiedad->_set("tipocontrato", $tipocontrato);
            $propiedad->_set("tipoinmueble", $tipoinmueble);
            $propiedad->_set("estadoinmueble", $estadoinmueble);
            $propiedad->_set("referenciacatastral", $dbinmueble->referencia_catastral);
            $propiedad->_set("estado", $estado);
            $propiedad->update(true);

            echo "<br>PROPIEDAD  ".$propiedad->_id()."<br>";

            // -- CRM
            $inmoCRM = $inmocrmModel->where("inmocrm_propiedad_id", $propiedad->_id())->first();
            if (empty($inmoCRM)) {
                $nota = $dbinmueble->nota;
                $inmoCRM = new \App\Entities\InmoCRM();
                $inmoCRM->_set("propiedad_id", $propiedad->_id());
                $inmoCRM->_set("creacion", date("Y-m-d H:i:S"));
                $inmoCRM->_set("fecha", date("Y-m-d H:i:S"));
                $inmoCRM->_set("observacion", $nota);
                $inmoCRM->_set("estado", 1);
                $inmoCRM->update();
            }

            // -- fotos
            /*$sqlFotos = "
            SELECT
                *
            FROM
                inmobiliaria_imagen
            JOIN inmobiliaria_archivo ON archivo_id = imagen
            WHERE
                piso_id_id = {$dbinmueble->piso_id}
            ";
            echo "Query Fotos $sqlFotos <br>";
            $queryFotos = $db->query($sqlFotos);
            $dbfotos = $queryFotos->getResult();

            foreach ($dbfotos as $dbfoto) {
                $foto = $propiedadFotoModel
                    ->where("propiedadfoto_propiedad_id", $propiedad->_id())
                    ->where("propiedadfoto_posicion", $dbfoto->numero)
                    ->first();
                if (empty($foto)) {
                    $archivo = $dbfoto->object;
                    $archivo = json_decode($archivo, true);
                    $file = $archivo["file_name"];
                    $base_root = "http://kasas10.com/assets/images/pisos/";
                    $url = "{$base_root}{$file}";
                    $content = file_get_contents($url);
                    $myfile = fopen(FCPATH."assets/images/inmuebles/$file", "w+") or die("Unable to open file!");
                    fwrite($myfile, $content);
                    fclose($myfile);

                    $ext = explode(".", $file);
                    $archivo = new \App\Entities\Archivo();
                    $archivo->_set("nombre", $file);
                    $archivo->_set("nombreoriginal", $file);
                    $archivo->_set("ext", end($ext));
                    $archivo->_set("mime", "image/jpg");
                    $archivo->_set("path", "assets/images/inmuebles/");
                    $archivo->_set("alt", "vacio");
                    $archivo->_set("raw", "vacio");
                    $archivo->_set("tipo", 0);
                    $archivo->update();

                    $foto = new \App\Entities\PropiedadFoto();
                    $foto->_set("propiedad_id", $propiedad->_id());
                    $foto->_set("archivo_id", $archivo->_id());
                    $foto->_set("posicion", $dbfoto->numero);
                    $foto->_set("estado", 1);
                    $foto->update();

                    echo "Guardar foto de la propiedad {$propiedad->_id()} <br>";
                } else {
                    echo "Esta foto ya existe {$propiedad->_id()} {$dbfoto->numero} <br>";
                }
            }/**/
            echo "<hr>";/**/
        }
    }


}
