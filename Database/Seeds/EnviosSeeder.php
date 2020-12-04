<?php namespace App\Database\Seeds;

class EnviosSeeder extends \CodeIgniter\Database\Seeder{
        public function run(){
            $db = \Config\Database::connect();
            $array = [
                ["metodopago_nombre" => "Efectivo", "metodopago_modulo" => 0],       //1
                ["metodopago_nombre" => "Cheque", "metodopago_modulo" => 0],         //2
                ["metodopago_nombre" => "Transferencia", "metodopago_modulo" => 0],  //3
                ["metodopago_nombre" => "GriftCard", "metodopago_modulo" => 0],      //4
                ["metodopago_nombre" => "Tarjeta de crédito", "metodopago_modulo" => 1],         //5
                ["metodopago_nombre" => "Bizum", "metodopago_modulo" => 0],          //6
                ["metodopago_nombre" => "Paypal", "metodopago_modulo" => 0],         //7
                ["metodopago_nombre" => "Prestamo", "metodopago_modulo" => 0],       //8
                ["metodopago_nombre" => "Aplazame", "metodopago_modulo" => 0],       //9
                ["metodopago_nombre" => "Stripe", "metodopago_modulo" => 0],         //10
                ["metodopago_nombre" => "Contrareembolso", "metodopago_modulo" => 0],//11
            ];
            foreach ($array as $row) {
                $data = [
                    "metodopago_nombre" => $row["metodopago_nombre"],
                    "metodopago_modulo" => $row["metodopago_modulo"],
                    "metodopago_estado" => 1,
                ];
                $db->table('metodopago')->insert($data);
            }

            $array = [
                ["map_relation" => "mp_5", "map_clave" => "redsys_merchant_terminal", "map_valor" => "001", "map_descripcion" => "Terminal de Redsys"],
                ["map_relation" => "mp_5", "map_clave" => "redsys_merchant_code", "map_valor" => "124333790", "map_descripcion" => "Codigo de Redsys"],
                ["map_relation" => "mp_5", "map_clave" => "redsys_merchant_currenci", "map_valor" => "978", "map_descripcion" => "Moneda euro"],
                ["map_relation" => "mp_5", "map_clave" => "redsys_merchant_transactiontype", "map_valor" => "0", "map_descripcion" => "transaction type"],
                ["map_relation" => "mp_5", "map_clave" => "redsys_merchant_signature", "map_valor" => "UwTRWXtrj66WEAGufcC7/K3HhucAOfUy", "map_descripcion" => "Merchant signature de redsys real"],
                ["map_relation" => "mp_5", "map_clave" => "redsys_merchant_signature_test", "map_valor" => "sq7HjrUOBfKmC576ILgskD5srU870gJ7", "map_descripcion" => "Merchant signature de prueba redsys"],
                ["map_relation" => "mp_5", "map_clave" => "redsys_merchant_production", "map_valor" => "0", "map_descripcion" => "Estado de redsys 0 = prueba | 1 = real"],

                ["map_relation" => "mp_7", "map_clave" => "paypal_production", "map_valor" => "live", "map_descripcion" => "Estado de paypal live = prueba | sandbox = real"],
                ["map_relation" => "mp_7", "map_clave" => "paypal_client_id", "map_valor" => "AbyW1f6bG4at5UUcGb8vT8GAI84ZD_AQtkoH4DzLAYL0CMEbCC42nW-ebEdLxSxXWCRdV9pQp1RAUpj9", "map_descripcion" => "Client ID"],
                ["map_relation" => "mp_7", "map_clave" => "paypal_client_secret", "map_valor" => "EHDTOudlV-lwBnf3ZDBBHTqklYNSuZ8WBJ20WRVzsNcHEZu4uWJrqFbDyf6A8ieOCSHT2sBhl3nHbE2M-ebEdLxSxXWCRdV9pQp1RAUpj9", "map_descripcion" => "Client Secret"],
                ["map_relation" => "mp_7", "map_clave" => "paypal_currency", "map_valor" => "EUR", "map_descripcion" => "Moneda"],
                ["map_relation" => "mp_7", "map_clave" => "paypal_currency", "map_valor" => "EUR", "map_descripcion" => "Moneda"],

                ["map_relation" => "mp_9", "map_clave" => "aplazame_production", "map_valor" => "0", "map_descripcion" => "Estado de aplazame 0 = prueba | 1 = real"],
                ["map_relation" => "mp_9", "map_clave" => "aplazame_public_key", "map_valor" => "0", "map_descripcion" => "Clave publica"],
                ["map_relation" => "mp_9", "map_clave" => "aplazame_private_key", "map_valor" => "0", "map_descripcion" => "Clave privada"],
            ];

            foreach ($array as $key => $row) {
                $data = [
                    "map_relation" => $row["map_relation"],
                    "map_clave" => $row["map_clave"],
                    "map_valor" => $row["map_valor"],
                    "map_descripcion" => $row["map_descripcion"],
                    "map_estado" => 1,
                ];
                $db->table('map')->insert($data);
            }


            $array = [
                ["grupopago_descripcion" => "Pagos en Logroño"],
                ["grupopago_descripcion" => "Pagos en la Rioja"],
                ["grupopago_descripcion" => "Pagos en la Península"],
                ["grupopago_descripcion" => "Pagos en Islas Baleares y Canarias"],
                ["grupopago_descripcion" => "Pagos en el Extranjero"],
            ];

            foreach ($array as $key => $row) {
                $data = [
                    "grupopago_descripcion" => $row["grupopago_descripcion"],
                    "grupopago_estado" => 1,
                ];
                $db->table('grupopago')->insert($data);
            }

            $array = [
                ["combinacionpago_grupopago_id" => 1, "combinacionpago_metodopago_id" => "3", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 1, "combinacionpago_metodopago_id" => "4", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 1, "combinacionpago_metodopago_id" => "5", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 1, "combinacionpago_metodopago_id" => "6", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 1, "combinacionpago_metodopago_id" => "11", "combinacionpago_comision" => "0"],

                ["combinacionpago_grupopago_id" => 2, "combinacionpago_metodopago_id" => "3", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 2, "combinacionpago_metodopago_id" => "4", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 2, "combinacionpago_metodopago_id" => "5", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 2, "combinacionpago_metodopago_id" => "6", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 2, "combinacionpago_metodopago_id" => "11", "combinacionpago_comision" => "0"],

                ["combinacionpago_grupopago_id" => 3, "combinacionpago_metodopago_id" => "3", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 3, "combinacionpago_metodopago_id" => "4", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 3, "combinacionpago_metodopago_id" => "5", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 3, "combinacionpago_metodopago_id" => "6", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 3, "combinacionpago_metodopago_id" => "11", "combinacionpago_comision" => "0"],

                ["combinacionpago_grupopago_id" => 4, "combinacionpago_metodopago_id" => "3", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 4, "combinacionpago_metodopago_id" => "4", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 4, "combinacionpago_metodopago_id" => "5", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 4, "combinacionpago_metodopago_id" => "6", "combinacionpago_comision" => "0"],

                ["combinacionpago_grupopago_id" => 5, "combinacionpago_metodopago_id" => "3", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 5, "combinacionpago_metodopago_id" => "4", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 5, "combinacionpago_metodopago_id" => "5", "combinacionpago_comision" => "0"],
                ["combinacionpago_grupopago_id" => 5, "combinacionpago_metodopago_id" => "6", "combinacionpago_comision" => "0"],
            ];

            foreach ($array as $key => $row) {
                $data = [
                    "combinacionpago_grupopago_id" => $row["combinacionpago_grupopago_id"],
                    "combinacionpago_metodopago_id" => $row["combinacionpago_metodopago_id"],
                    "combinacionpago_comision" => $row["combinacionpago_comision"],
                    "combinacionpago_estado" => 1,
                ];
                $db->table('combinacionpago')->insert($data);
            }


            $array = [
                ["grupoenvio_descripcion" => "Envíos en Logroño"],
                ["grupoenvio_descripcion" => "Envíos en la Rioja"],
                ["grupoenvio_descripcion" => "Envíos en la Península"],
                ["grupoenvio_descripcion" => "Envíos en Islas Baleares y Canarias"],
                ["grupoenvio_descripcion" => "Envíos en el Extranjero"],
            ];

            foreach ($array as $key => $row) {
                $data = [
                    "grupoenvio_descripcion" => $row["grupoenvio_descripcion"],
                    "grupoenvio_estado" => 1,
                ];
                $db->table('grupoenvio')->insert($data);
            }/**/

            $array = [
                ["grupotransporte_nombre" => "Envíos en Logroño"],
                ["grupotransporte_nombre" => "Envíos en la Rioja"],
                ["grupotransporte_nombre" => "Envíos en la Península"],
                ["grupotransporte_nombre" => "Envíos en Islas Baleares y Canarias"],
                ["grupotransporte_nombre" => "Envíos en el Extranjero"],
            ];

            foreach ($array as $key => $row) {
                $data = [
                    "grupotransporte_nombre" => $row["grupotransporte_nombre"],
                    "grupotransporte_estado" => 1,
                ];
                $db->table('grupotransporte')->insert($data);
            }

            $array = [
                ["transporte_grupotransporte_id" => 1, "transporte_nombre" => "2k Logroño", "transporte_peso_maximo" => "2000", "transporte_volumen_maximo" => "2000", "transporte_precio" => "3.95"],
                ["transporte_grupotransporte_id" => 2, "transporte_nombre" => "2k", "transporte_peso_maximo" => "2000", "transporte_volumen_maximo" => "2000", "transporte_precio" => "3.95"],
            ];

            foreach ($array as $key => $row) {
                $data = [
                    "transporte_grupotransporte_id" => $row["transporte_grupotransporte_id"],
                    "transporte_nombre" => $row["transporte_nombre"],
                    "transporte_peso_maximo" => $row["transporte_peso_maximo"],
                    "transporte_volumen_maximo" => $row["transporte_volumen_maximo"],
                    "transporte_precio" => $row["transporte_precio"],
                    "transporte_estado" => 1,
                ];
                $db->table('transporte')->insert($data);
            }
        }
}
