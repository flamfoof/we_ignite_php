<?php
namespace App\Database\Migrations;

class CreateDireccion extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "direccion_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "direccion_usuario_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "direccion_pais_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "direccion_provincia_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "direccion_provincia_texto" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE
            ],
            "direccion_ciudad_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "direccion_ciudad_texto" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE
            ],
            "direccion_zona_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "direccion_zona_texto" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE
            ],
            "direccion_via" => [
                "type" => "TINYINT",
                'null' => TRUE
            ],
            "direccion_direccion" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE
            ],
            "direccion_piso" => [
                "type" => "VARCHAR",
                "constraint" => 10,
                'null' => TRUE
            ],
            "direccion_numero" => [
                "type" => "VARCHAR",
                "constraint" => 10,
                'null' => TRUE
            ],
            "direccion_codigopostal" => [
                "type" => "VARCHAR",
                "constraint" => 20,
                'null' => TRUE
            ],
            "direccion_google" => [
                "type" => "TEXT",
                'null' => TRUE
            ],
            "direccion_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
                "options" => "estados",
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('direccion_id', TRUE);
        $this->forge->createTable('direccion', TRUE);

        $fields = [
            "pais_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "pais_nombre" => [
                "type" => "TEXT",
                "constraint" => 200,
                'null' => TRUE
            ],
            "pais_alpha2" => [
                "type" => "VARCHAR",
                "constraint" => 2,
                'null' => TRUE
            ],
            "pais_alpha3" => [
                "type" => "VARCHAR",
                "constraint" => 3,
                'null' => TRUE
            ],
            "pais_codigo" => [
                "type" => "VARCHAR",
                "constraint" => 10,
                'null' => TRUE
            ],
            "pais_iva" => [
                "type" => "FLOAT",
                'null' => TRUE
            ],
            "pais_grupopago_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "pais_grupoenvio_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "pais_metodoenvio" => [ // 0 - solo enviar, 1 - enviar o recoger, 2 - solo recoger
                "type" => "TINYINT",
                'null' => TRUE
            ],
            "pais_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
                "options" => "estados",
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('pais_id', TRUE);
        $this->forge->createTable('pais', TRUE);

        $fields = [
            "provincia_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "provincia_pais_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "provincia_nombre" => [
                "type" => "VARCHAR",
                "constraint" => "100",
                'null' => TRUE
            ],
            "provincia_codigo" => [
                "type" => "VARCHAR",
                "constraint" => "100",
                'null' => TRUE
            ],
            "provincia_cp" => [
                "type" => "VARCHAR",
                "constraint" => "100",
                'null' => TRUE
            ],
            "provincia_tel" => [
                "type" => "VARCHAR",
                "constraint" => "100",
                'null' => TRUE
            ],
            "provincia_iva" => [
                "type" => "FLOAT",
                'null' => TRUE
            ],
            "provincia_grupopago_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "provincia_grupoenvio_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "provincia_metodoenvio" => [
                "type" => "TINYINT",
                'null' => TRUE
            ],
            "provincia_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
                "options" => "estados",
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('provincia_id', TRUE);
        $this->forge->createTable('provincia', TRUE);


        $fields = [
            "ciudad_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "ciudad_nombre" => [
                "type" => "VARCHAR",
                "constraint" => "100",
                'null' => TRUE
            ],
            "ciudad_provincia_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "ciudad_iva" => [
                "type" => "FLOAT",
                'null' => TRUE
            ],
            "ciudad_grupopago_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "ciudad_grupoenvio_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "ciudad_metodoenvio" => [
                "type" => "TINYINT",
                'null' => TRUE
            ],
            "ciudad_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
                "options" => "estados",
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('ciudad_id', TRUE);
        $this->forge->createTable('ciudad', TRUE);

        $fields = [
            "zona_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "zona_ciudad_id" => [
                "type" => "INT",
                'null' => TRUE
            ],
            "zona_nombre" => [
                "type" => "VARCHAR",
                "constraint" => "100",
                'null' => TRUE
            ], "zona_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
                "options" => "estados",
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('zona_id', TRUE);
        $this->forge->createTable('zona', TRUE);
    }

    public function down() {
        $db = \Config\Database::connect();

        $this->forge->dropTable('direccion', TRUE);
        $this->forge->dropTable('pais', TRUE);
        $this->forge->dropTable('provincia', TRUE);
        $this->forge->dropTable('ciudad', TRUE);
        echo "remove direccion <br>";
    }

}
