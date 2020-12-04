<?php
namespace App\Database\Migrations;

class AddUsuarioImagen extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            "usuario_archivo_id" => [ //deprecated
                "type" => "INT",
                'null' => TRUE,
            ],
        ];
        $this->forge->addColumn('usuario', $fields);
        echo "add configuracion fields <br>";

    }

    public function down() {
        $this->forge->dropColumn('usuario', 'usuario_archivo_id');
        echo "remove fields from configuracion <br>";
    }

}
