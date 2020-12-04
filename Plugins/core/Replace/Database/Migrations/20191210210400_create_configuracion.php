<?php
namespace App\Database\Migrations;

class CreateConfiguracion extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "configuracion_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            /******************basico*************************/
            "configuracion_enmantenimiento" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "configuracion_tipotienda" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "configuracion_publicarproducto" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "configuracion_verprecios" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "configuracion_linkinfluencer" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
            "configuracion_porcentajepuntos" => [
                "type" => "FLOAT",
                'null' => TRUE,
                "default" => 0,
            ],
            "configuracion_template" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "configuracion_suscripciones" => [
                "type" => "TINYINT",
                'null' => TRUE,
            ],
            "configuracion_nombretienda" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "configuracion_razonsocial" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "configuracion_slogan" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "configuracion_email" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "configuracion_telefono" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "configuracion_direccion" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            "configuracion_cif" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            /********************para ventas***************************/
            "configuracion_gastosenviodefecto" => [
                "type" => "FLOAT",
                'null' => TRUE,
                "default" => 0,
            ],
            "configuracion_iban" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
            ],
            "configuracion_ivageneral" => [
                "type" => "TINYINT",
                'null' => TRUE,
            ],
            "configuracion_iva" => [
                "type" => "FLOAT",
                'null' => TRUE,
            ],
            "configuracion_irpf" => [
                "type" => "TEXT",
                'null' => TRUE,
            ],
            /************EMAIL***************/
            "configuracion_emailhost" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
            ],
            "configuracion_emailport" => [
                "type" => "VARCHAR",
                "constraint" => 5,
                'null' => TRUE,
            ],
            "configuracion_emailuser" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
            ],
            "configuracion_emailpass" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
            ],
            "configuracion_emailusuariopedir" => [
                "type" => "TINYINT",
                'null' => TRUE,
            ],
            "configuracion_emailusuariopagar" => [
                "type" => "TINYINT",
                'null' => TRUE,
            ],
            "configuracion_emailusuarioenviar" => [
                "type" => "TINYINT",
                'null' => TRUE,
            ],
            "configuracion_emailtiendapedir" => [
                "type" => "TINYINT",
                'null' => TRUE,
            ],
            "configuracion_emailtiendapagar" => [
                "type" => "TINYINT",
                'null' => TRUE,
            ],
            "configuracion_emailtiendaenviar" => [
                "type" => "TINYINT",
                'null' => TRUE,
            ],
            /**************INTEGRACIONES*****************/
            "configuracion_googleanalytics" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
            ],
            "configuracion_facebookpixel" => [
                "type" => "VARCHAR",
                "constraint" => 200,
                'null' => TRUE,
            ],
            /*****************************/
            "configuracion_contenidoonline" => [
                "type" => "TINYINT",
                'null' => TRUE,
            ],
            "configuracion_estado" => [
                "type" => "INT",
                'null' => TRUE,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('configuracion_id', TRUE);
        $this->forge->createTable('configuracion');

        $db = \Config\Database::connect();
        $data = [
            'configuracion_template' => 2,
            'configuracion_estado' => 1,
        ];
        $db->table('configuracion')->insert($data);
    }

    public function down() {
        $this->forge->dropTable('configuracion');
    }

}
