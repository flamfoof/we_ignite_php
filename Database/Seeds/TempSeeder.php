<?php namespace App\Database\Seeds;

class TempSeeder extends \CodeIgniter\Database\Seeder{
        public function run(){
            $forge = \Config\Database::forge();
            $db = \Config\Database::connect();
            $fields = [
                "direccion_usuario_id" => [
                    "type" => "INT",
                    'null' => TRUE
                ],
            ];
            $forge->addColumn('direccion', $fields);
        }
}
