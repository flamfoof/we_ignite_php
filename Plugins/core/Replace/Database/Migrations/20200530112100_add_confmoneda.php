<?php
namespace App\Database\Migrations;

class AddInventrioDefecto extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "configuracion_moneda" => [
                "type" => "VARCHAR",
                "constraint" => "20",
                'null' => TRUE,
                "default" => "",
            ],
            "configuracion_alphamoneda" => [
                "type" => "VARCHAR",
                "constraint" => "3",
                'null' => TRUE,
                "default" => "",
            ],
            "configuracion_ubicacion" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => "0",
            ],
            "configuracion_miles" => [
                "type" => "VARCHAR",
                "constraint" => "1",
                'null' => TRUE,
                "default" => "",
            ],
            "configuracion_decimales" => [
                "type" => "VARCHAR",
                "constraint" => "1",
                'null' => TRUE,
                "default" => "",
            ],
        ];
        $this->forge->addColumn('configuracion', $fields);

        echo "add configuracion fields <br>";

    }

    public function down() {
        $this->forge->dropColumn('configuracion', 'configuracion_moneda');
        $this->forge->dropColumn('configuracion', 'configuracion_ubicacion');
        $this->forge->dropColumn('configuracion', 'configuracion_miles');
        $this->forge->dropColumn('configuracion', 'configuracion_decimales');
        //$this->forge->dropColumn('inventario', 'configuracion_alphamoneda');

        echo "remove fields from configuracion <br>";
    }

}
