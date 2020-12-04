<?php
namespace App\Database\Migrations;

class Transporte extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "transporte_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "transporte_grupotransporte_id" => [
                "type" => "INT",
                "default" => 0,
            ],
            "transporte_nombre" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
                "default" => "",
            ],
            "transporte_peso_maximo" => [
                "type" => "FLOAT",
                'null' => TRUE,
                "default" => 0,
            ],
            "transporte_volumen_maximo" => [
                "type" => "FLOAT",
                'null' => TRUE,
                "default" => 0,
            ],
            "transporte_precio" => [
                "type" => "FLOAT",
                'null' => TRUE,
                "default" => 0,
            ],
            "transporte_estado" => [
                "type" => "TINYINT",
                "default" => 0,
                "options" => "estados"
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('transporte_id', TRUE);
        $this->forge->createTable('transporte');

        $fields = [
            "grupotransporte_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "grupotransporte_nombre" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
                "default" => "",
            ],
            "grupotransporte_estado" => [
                "type" => "TINYINT",
                "default" => 0,
                "options" => "estados"
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('grupotransporte_id', TRUE);
        $this->forge->createTable('grupotransporte');

        echo "create transporte <br>";
    }

    public function down() {
        $this->forge->dropTable('transporte');
        $this->forge->dropTable('grupotransporte');

        echo "remove transporte <br>";
    }

}
