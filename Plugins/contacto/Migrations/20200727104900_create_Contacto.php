<?php
namespace App\Database\Migrations;

class CreateContacto extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "contacto_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "contacto_fecha" => [
                "type" => "datetime",
            ],
            "contacto_data" => [
                "type" => "text",
            ],
            "contacto_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('contacto_id', TRUE);
        $this->forge->createTable('contacto');

        $fields = [
            "contactocrm_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "contactocrm_contacto_id" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "contactocrm_observaciones" => [
                "type" => "text",
            ],
            "contactocrm_fecha" => [
                "type" => "date",
            ],
            "contactocrm_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('contactocrm_id', TRUE);
        $this->forge->createTable('contactocrm');
    }

    public function down() {
        $this->forge->dropTable('contacto');
        $this->forge->dropTable('contactocrm');
    }

}
