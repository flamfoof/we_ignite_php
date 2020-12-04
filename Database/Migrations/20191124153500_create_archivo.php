<?php
namespace App\Database\Migrations;

class CreateArchivo extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();

        //crear familia
        $fields = [
            "archivo_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "archivo_alt" => [
                "type" => "TEXT",
                'null' => TRUE,
                "default" => "",
            ],
            "archivo_nombre" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
                "default" => "",
            ],
            "archivo_nombreoriginal" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
                "default" => "",
            ],
            "archivo_raw" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
                "default" => "",
            ],
            "archivo_path" => [
                "type" => "TEXT",
                'null' => TRUE,
                "default" => "",
            ],
            "archivo_ext" => [
                "type" => "VARCHAR",
                "constraint" => 5,
                'null' => TRUE,
                "default" => "",
            ],
            "archivo_mime" => [
                "type" => "VARCHAR",
                "constraint" => 100,
                'null' => TRUE,
                "default" => "",
            ],
            "archivo_tipo" => [
                "type" => "TINYINT",
                "options" => "tipos",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('archivo_id', TRUE);
        $this->forge->createTable('archivo');

    }

    public function down() {
        $this->forge->dropTable('familia');
    }

}
