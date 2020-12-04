<?php
namespace App\Database\Migrations;

class CreateMenuPagina extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "menu_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "menu_menu_id" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "menu_pagina_id" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "menu_posicion" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "menu_name" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "menu_url" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "menu_enlace" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "menu_icon" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "menu_custom" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "menu_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('menu_id', TRUE);
        $this->forge->createTable('menu', true);
    }

    public function down() {
        $this->forge->dropTable('menu', true);
        $this->forge->dropTable('pagina', true);
    }

}
