<?php
namespace App\Database\Migrations;

class CreatePlugin extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "menuadmin_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "menuadmin_menuadmin_id" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "menuadmin_posicion" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
            "menuadmin_type" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "menuadmin_name" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "menuadmin_url" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "menuadmin_icon" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "menuadmin_plugin" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "menuadmin_custom" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "menuadmin_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('menuadmin_id', TRUE);
        $this->forge->createTable('menuadmin');

        $menuadmins = [
            [ //1
                "menuadmin_menuadmin_id" => 0,
                "menuadmin_type" => 2,
                "menuadmin_name" => "Avanzado",
                "menuadmin_url" => "",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_posicion" => "99",
                "menuadmin_estado" => 1,
            ], [ //2
                "menuadmin_menuadmin_id" => 1,
                "menuadmin_type" => 0,
                "menuadmin_name" => "Plugins",
                "menuadmin_url" => "admin/plugins",
                "menuadmin_icon" => "dashboard",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ],[ //3
                "menuadmin_menuadmin_id" => 1,
                "menuadmin_type" => 0,
                "menuadmin_name" => "Gestion de usuarios",
                "menuadmin_url" => "",
                "menuadmin_icon" => "people",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ], [ //4
                "menuadmin_menuadmin_id" => 3,
                "menuadmin_type" => 1,
                "menuadmin_name" => "Usuarios",
                "menuadmin_url" => "admin/usuarios",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ], [// 5
                "menuadmin_menuadmin_id" => 3,
                "menuadmin_type" => 1,
                "menuadmin_name" => "Roles",
                "menuadmin_url" => "admin/roles",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ], [// 6
                "menuadmin_menuadmin_id" => 3,
                "menuadmin_type" => 1,
                "menuadmin_name" => "Permisos",
                "menuadmin_url" => "admin/permisos",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ], [// 7
                "menuadmin_menuadmin_id" => 1,
                "menuadmin_type" => 0,
                "menuadmin_name" => "Configuracion",
                "menuadmin_url" => "",
                "menuadmin_icon" => "build",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ], [ //8
                "menuadmin_menuadmin_id" => 7,
                "menuadmin_type" => 0,
                "menuadmin_name" => "Configuración general",
                "menuadmin_url" => "admin/configuracion",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ], [ //9
                "menuadmin_menuadmin_id" => 7,
                "menuadmin_type" => 0,
                "menuadmin_name" => "Seleccionar tema",
                "menuadmin_url" => "admin/configuracion/temas",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ],[ //10
                "menuadmin_menuadmin_id" => 1,
                "menuadmin_type" => 0,
                "menuadmin_name" => "Configuracion tienda",
                "menuadmin_url" => "",
                "menuadmin_icon" => "build",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ], [ //11
                "menuadmin_menuadmin_id" => 7,
                "menuadmin_type" => 0,
                "menuadmin_name" => "Configuración Menu Admin",
                "menuadmin_url" => "admin/menusadmin",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ],
        ];
        foreach ($menuadmins as $menuadmin) {
            $db->table('menuadmin')->insert($menuadmin);
        }

        echo "menus listos<br>";

        $fields = [
            "plugin_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "plugin_name" => [
                "type" => "VARCHAR",
                "constraint" => "200",
            ],
            "plugin_filename" => [
                "type" => "VARCHAR",
                "constraint" => "200",
            ],
            "plugin_custom" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "plugin_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('plugin_id', TRUE);
        $this->forge->createTable('plugin');
    }

    public function down() {
        $this->forge->dropTable('menuadmin');
        $this->forge->dropTable('plugin');
    }

}
