<?php
namespace App\Database\Migrations;

class AddConfiguracionCookies extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "configuracion_cookies" => [
                "type" => "TEXT",
                'null' => TRUE,
                "default" => "",
            ],
        ];
        $this->forge->addColumn('configuracion', $fields);

        echo "add configuracion fields <br>";

    }

    public function down() {
        $this->forge->dropColumn('configuracion', 'configuracion_data');
        echo "remove fields from configuracion <br>";
    }

}
