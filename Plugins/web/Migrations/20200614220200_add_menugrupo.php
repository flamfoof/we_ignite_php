<?php
namespace App\Database\Migrations;

class AddMenuGrupo extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();
        $fields = [
            //-----------producto nuevo------------
            "menu_menugrupo_id" => [
                "type" => "INT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addColumn('menu', $fields);

    }

    public function down() {
    }

}
