<?php
namespace App\Database\Migrations;

class AddUser extends \CodeIgniter\Database\Migration {

    public function up() {
        $fields = [
            "usuario_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "usuario_tienda_id" => [ //deprecated
                "type" => "INT",
                'null' => TRUE,
            ],
            "usuario_alta" => [
                "type" => "TIMESTAMP",
                'null' => TRUE,
            ],
            "usuario_nombre" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
                "default" => "",
            ],
            "usuario_apellidos" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
                "default" => "",
            ],
            "usuario_email" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => FALSE,
            ],
            "usuario_telefono" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
                "default" => "",
            ],
            "usuario_dni" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
                "default" => "",
            ],
            "usuario_password" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
            ],
            "usuario_puntos" => [
                "type" => "FLOAT",
                'null' => TRUE,
                "default" => 0,
            ],
            "usuario_tipo" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "usuario_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "usuario_log" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "usuario_failed_log" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('usuario_id', TRUE);
        $this->forge->createTable('usuario');

        $db = \Config\Database::connect();
        $data = [
            'usuario_email' => 'davidroura@gmail.com',
            'usuario_password' => password_hash('123456', PASSWORD_DEFAULT),
            'usuario_nombre' => 'David',
            'usuario_apellidos' => 'Roura',
            'usuario_dni' => 'Y1621607Y',
            'usuario_telefono' => '690743734',
            'usuario_tienda_id' => 1,
            'usuario_estado' => 1,
        ];
        $db->table('usuario')->insert($data);

        $data = [
            'usuario_email' => 'empleado',
            'usuario_password' => password_hash('empleado', PASSWORD_DEFAULT),
            'usuario_nombre' => 'Empleado',
            'usuario_apellidos' => 'Empleado',
            'usuario_dni' => 'Empleado',
            'usuario_telefono' => '690743734',
            'usuario_tienda_id' => 1,
            'usuario_estado' => 1,
        ];
        $db->table('usuario')->insert($data);

        $data = [
            'usuario_email' => 'webmaster',
            'usuario_password' => password_hash('webmaster', PASSWORD_DEFAULT),
            'usuario_nombre' => 'webmaster',
            'usuario_apellidos' => 'webmaster',
            'usuario_dni' => 'webmaster',
            'usuario_telefono' => '690743734',
            'usuario_tienda_id' => 1,
            'usuario_estado' => 1,
        ];
        $db->table('usuario')->insert($data);

    }

    public function down() {
        $this->forge->dropTable('usuario');
    }
}
