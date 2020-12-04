<?php
namespace App\Database\Migrations;

class Blogs extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "blog_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "blog_tema" => [
                "type" => "VARCHAR",
                "constraint" => 300,
                'null' => TRUE,
                "default" => "",
            ],
            "blog_url" => [
                "type" => "VARCHAR",
                "constraint" => 300,
                'null' => TRUE,
                "default" => "",
            ],
            "blog_fecha" => [
                "type" => "DATETIME",
                'null' => TRUE,
            ],
            "blog_titulo" => [
                "type" => "VARCHAR",
                "constraint" => 300,
                'null' => TRUE,
                "default" => "",
            ],
            "blog_descripcion" => [
                "type" => "TEXT",
                'null' => TRUE,
                "default" => "",
            ],
            "blog_contenido" => [
                "type" => "TEXT",
                'null' => TRUE,
                "default" => "",
            ],
            "blog_imagen" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "blog_video" => [
                "type" => "TEXT",
                'null' => TRUE,
                "default" => "",
            ],
            /******************************/
            "blog_meta_titulo" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
                "default" => "",
            ],
            "blog_meta_description" => [
                "type" => "TEXT",
                'null' => TRUE,
                "default" => "",
            ],
            "blog_meta_keywords" => [
                "type" => "TEXT",
                'null' => TRUE,
                "default" => "",
            ],
            "blog_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
                "options" => "estados"
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('blog_id', TRUE);
        $this->forge->createTable('blog');
    }

    public function down() {
        $db = \Config\Database::connect();
        $this->forge->dropTable('blog');
    }

}
