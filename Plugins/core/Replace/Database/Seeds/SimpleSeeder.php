<?php namespace App\Database\Seeds;

class SimpleSeeder extends \CodeIgniter\Database\Seeder{
        public function run(){
            $db = \Config\Database::connect();
            $data = [
                "formato_nombre" => 'Tallas (3XS-3XL)',
                "formato_titulo" => 'Tallas',
                "formato_tipo" => '0',
                "formato_estado" => 1,
            ];
            $db->table('formato')->insert($data);

            $tallas = ["3XS", "XXS", "XS", "S", "M", "L", "XL", "2XL", "3XL"];
            foreach ($tallas as $talla) {
                $data = [
                    "atributo_formato_id" => 1,
                    "atributo_nombre" => $talla,
                    "atributo_estado" => 1,
                ];
                $db->table('atributo')->insert($data);
            }
            /**********************************************/
            $data = [
                "formato_nombre" => 'Tallas (42-66)',
                "formato_titulo" => 'Tallas',
                "formato_tipo" => '0',
                "formato_estado" => 1,
            ];
            $db->table('formato')->insert($data);

            $tallas = ["42", "44", "46", "48", "50", "52", "54", "56", "58", "60", "62", "64", "66"];
            foreach ($tallas as $talla) {
                $data = [
                    "atributo_formato_id" => 2,
                    "atributo_nombre" => $talla,
                    "atributo_estado" => 1,
                ];
                $db->table('atributo')->insert($data);
            }
            /**********************************************/
            $data = [
                "formato_nombre" => 'Tallas (36-46)',
                "formato_titulo" => 'Tallas',
                "formato_tipo" => '0',
                "formato_estado" => 1,
            ];
            $db->table('formato')->insert($data);

            $tallas = ["36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46"];
            foreach ($tallas as $talla) {
                $data = [
                    "atributo_formato_id" => 3,
                    "atributo_nombre" => $talla,
                    "atributo_estado" => 1,
                ];
                $db->table('atributo')->insert($data);
            }
            /**********************************************/
            $data = [
                "formato_nombre" => 'Tallas Zapatos (5-13)',
                "formato_titulo" => 'Tallas',
                "formato_tipo" => '0',
                "formato_estado" => 1,
            ];
            $db->table('formato')->insert($data);

            $tallas = ["5", "5.5", "6", "6.5", "7", "7.5", "8", "8.5", "9", "9.5", "10", "10.5", "11", "11.5", "12", "12.5", "13"];
            foreach ($tallas as $talla) {
                $data = [
                    "atributo_formato_id" => 4,
                    "atributo_nombre" => $talla,
                    "atributo_estado" => 1,
                ];
                $db->table('atributo')->insert($data);
            }
            /**********************************************/
            $data = [
                "formato_nombre" => 'Tallas Zapatos (35-46)',
                "formato_titulo" => 'Tallas',
                "formato_tipo" => '0',
                "formato_estado" => 1,
            ];
            $db->table('formato')->insert($data);

            $tallas = ["35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49"];
            foreach ($tallas as $talla) {
                $data = [
                    "atributo_formato_id" => 5,
                    "atributo_nombre" => $talla,
                    "atributo_estado" => 1,
                ];
                $db->table('atributo')->insert($data);
            }
            /**********************************************/
            $data = [
                "formato_nombre" => 'Tallas Cinturones (75-125)',
                "formato_titulo" => 'Tallas',
                "formato_tipo" => '0',
                "formato_estado" => 1,
            ];
            $db->table('formato')->insert($data);

            $tallas = ["75", "80", "85", "90", "95", "100", "105", "110", "115", "120", "125"];
            foreach ($tallas as $talla) {
                $data = [
                    "atributo_formato_id" => 6,
                    "atributo_nombre" => $talla,
                    "atributo_estado" => 1,
                ];
                $db->table('atributo')->insert($data);
            }
            /**********************************************/
            $data = [
                "formato_nombre" => 'Talla única',
                "formato_titulo" => 'Tallas',
                "formato_tipo" => '0',
                "formato_estado" => 1,
            ];
            $db->table('formato')->insert($data);

            $tallas = ["unica"];
            foreach ($tallas as $talla) {
                $data = [
                    "atributo_formato_id" => 7,
                    "atributo_nombre" => $talla,
                    "atributo_estado" => 1,
                ];
                $db->table('atributo')->insert($data);
            }
        }
}
