<?php
namespace App\Database\Migrations;

class CreateMenuGrupo extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "menugrupo_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "menugrupo_name" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "menugrupo_custom" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "menugrupo_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('menugrupo_id', TRUE);
        $this->forge->createTable('menugrupo', true);

    }

    public function down() {
        $this->forge->dropTable('menugrupo', true);
    }

}
