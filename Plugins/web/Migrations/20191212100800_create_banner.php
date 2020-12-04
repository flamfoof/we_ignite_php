<?php
namespace App\Database\Migrations;

class CreateBanner extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "banner_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "banner_lang_id" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "banner_ubicacion" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "banner_posicion" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "banner_ancho" => [
                "type" => "VARCHAR",
                "constraint" => 50,
                'null' => TRUE,
            ],
            "banner_alto" => [
                "type" => "VARCHAR",
                "constraint" => 50,
                'null' => TRUE,
            ],
            "banner_imagen" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "banner_video" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "banner_titulo" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "banner_descripcion" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "banner_link" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "banner_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('banner_id', TRUE);
        $this->forge->createTable('banner', true);
    }

    public function down() {
        $this->forge->dropTable('banner', true);
    }

}
