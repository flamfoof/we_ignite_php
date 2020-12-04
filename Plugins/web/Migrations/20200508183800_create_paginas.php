<?php
namespace App\Database\Migrations;

class CreatePaginas extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "pagina_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "pagina_name" => [
                "type" => "VARCHAR",
                "constraint" => "200",
            ],
            "pagina_slug" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "pagina_custom" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "pagina_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "pagina_meta_index" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "pagina_meta_title" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
            ],
            "pagina_meta_description" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "pagina_meta_keywords" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "pagina_facebook_url" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "pagina_facebook_type" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "pagina_facebook_title" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "pagina_facebook_description" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "pagina_facebook_image" => [
                "type" => "INT",
                'null' => TRUE,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('pagina_id', TRUE);
        $this->forge->createTable('pagina', true);

        echo "create paginas <br>";
    }

    public function down() {
        $db = \Config\Database::connect();
        $this->forge->dropTable('pagina', true);
        echo "remove paginas <br>";
    }

}
