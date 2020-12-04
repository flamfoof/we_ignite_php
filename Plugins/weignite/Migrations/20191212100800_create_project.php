<?php
namespace App\Database\Migrations;

class CreateProject extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "project_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "project_archivo_id" => [
                "type" => "INT",
            ],
            "project_name" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
            ],
            "project_url" => [
                "type" => "VARCHAR",
                "constraint" => 300,
                'null' => TRUE,
            ],
            "project_secretkey" => [
                "type" => "VARCHAR",
                "constraint" => 300,
                'null' => TRUE,
            ],
            "project_accesstoken" => [
                "type" => "VARCHAR",
                "constraint" => 300,
                'null' => TRUE,
            ],
            "project_windows" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "project_mac" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "project_playstore" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "project_appstore" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "project_expiration" => [
                "type" => "DATETIME",
                'null' => TRUE,
            ],
            "project_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('project_id', TRUE);
        $this->forge->createTable('project', true);


        $fields = [
            "projectclient_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "projectclient_usuario_id" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "projectclient_project_id" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "projectclient_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('projectclient_id', TRUE);
        $this->forge->createTable('projectclient', true);

        $fields = [
            "access_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "access_project_id" => [
                "type" => "INT",
                'null' => TRUE,
            ],
            "access_email" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
            ],
            "access_date" => [
                "type" => "DATE",
                'null' => TRUE,
            ],
            "access_horainicio" => [
                "type" => "TIME",
                'null' => TRUE,
            ],
            "access_horafin" => [
                "type" => "TIME",
                'null' => TRUE,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('access_id', TRUE);
        $this->forge->createTable('access', true);

        $fields = [
            "action_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "action_project_id" => [
                "type" => "INT",
                'null' => TRUE,
            ],
            "action_email" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
            ],
            "action_type" => [
                "type" => "VARCHAR",
                "constraint" => 20,
                'null' => TRUE,
            ],
            "action_data" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "action_date" => [
                "type" => "DATETIME",
                'null' => TRUE,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('action_id', TRUE);
        $this->forge->createTable('action', true);
    }

    public function down() {
        $this->forge->dropTable('project', true);
        $this->forge->dropTable('projectclient', true);
        $this->forge->dropTable('access', true);
        $this->forge->dropTable('action', true);
    }

}
