<?php
namespace App\Database\Migrations;

class AddConfigEmailType extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "configuracion_emailtype" => [ //deprecated
                "type" => "TINYINT",
                'null' => TRUE,
            ],
        ];
        $this->forge->addColumn('configuracion', $fields);
        echo "add configuracion fields <br>";

    }

    public function down() {
        $this->forge->dropColumn('configuracion', 'configuracion_emailtype');
        echo "remove fields from configuracion <br>";
    }

}
