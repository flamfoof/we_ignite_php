<?php
namespace App\Database\Migrations;

class CreatePermisos extends \CodeIgniter\Database\Migration {

    public function up() {
        $db = \Config\Database::connect();

        //crear roles
        $fields = [
            "role_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "role_nombre" => [
                "type" => "VARCHAR",
                "constraint" => "200",
                'null' => TRUE,
                "default" => "",
            ],
            "role_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('role_id', TRUE);
        $this->forge->createTable('role');

        //crear permisos
        $fields = [
            "permission_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "permission_nombre" => [
                "type" => "VARCHAR",
                "constraint" => "100",
                'null' => TRUE,
                "default" => "",
            ],
            "permission_description" => [
                "type" => "TEXT",
                'null' => TRUE,
                "default" => "",
            ],
            "permission_estado" => [
                "type" => "TINYINT",
                'null' => TRUE,
                "default" => 0,
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('permission_id', TRUE);
        $this->forge->createTable('permission');

        //crear role permiso
        $fields = [
            "rolepermission_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
                "is_id" => true,
            ],
            "rolepermission_role_id" => [
                "type" => "INT",
            ],
            "rolepermission_permission_id" => [
                "type" => "INT",
            ],
            "rolepermission_estado" => [
                "type" => "TINYINT",
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('rolepermission_id', TRUE);
        $this->forge->createTable('rolepermission');
        //$db->query("ALTER TABLE ma_rolepermission ADD FOREIGN KEY (rolepermission_role_id) REFERENCES ma_role(role_id) ON DELETE CASCADE ON UPDATE CASCADE;");
        //$db->query("ALTER TABLE ma_rolepermission ADD FOREIGN KEY (rolepermission_permission_id) REFERENCES ma_permission(permission_id) ON DELETE CASCADE ON UPDATE CASCADE;");

        //crear usuario role
        $fields = [
            "usuariorole_id" => [
                "type" => "INT",
                "unsigned" => TRUE,
                "auto_increment" => TRUE,
            ],
            "usuariorole_usuario_id" => [
                "type" => "INT",
            ],
            "usuariorole_role_id" => [
                "type" => "INT",
            ],
            "usuariorole_estado" => [
                "type" => "TINYINT",
            ],
        ];
        $this->forge->addField($fields);
        $this->forge->addKey('usuariorole_id', TRUE);
        $this->forge->createTable('usuariorole');
        //$db->query("ALTER TABLE ma_usuariorole ADD FOREIGN KEY (usuariorole_usuario_id) REFERENCES ma_usuario(usuario_id) ON DELETE CASCADE ON UPDATE CASCADE;");
        //$db->query("ALTER TABLE ma_usuariorole ADD FOREIGN KEY (usuariorole_role_id) REFERENCES ma_role(role_id) ON DELETE CASCADE ON UPDATE CASCADE;");

        /******ROLES*****/
        $roles = ["Admin", "Empleado", "Webmaster"];
        foreach ($roles as $role) {
            $db->table('role')->insert([
                'role_nombre' => $role,
                'role_estado' => 1,
            ]);
        }
        /******PERMISOS*****/
        $permisos = [
            "roles" => ["ver", "crear", "editar", "borrar"],
            "permisos" => ["ver", "crear", "editar", "borrar"],
            "usuarios" => [
                "ver", "crear", "editar", "borrar", "asignar_role_admin",
                "asignar_role_empresa", "asignar_role_empleado",
                "asignar_role_webmaster", "ver_role_admin", "ver_role_empresa",
                "ver_role_empleado", "ver_role_webmaster"
            ],
            "giftcards" => ["ver", "crear", "editar", "borrar"],
            "familias" => ["ver", "crear", "editar", "borrar"],
            "idiomas" => ["ver", "crear", "editar", "borrar"],
            "marcas" => ["ver", "crear", "editar", "borrar"],
            "productos" => ["ver", "crear", "editar", "borrar"],
            "atributos" => ["ver", "crear", "editar", "borrar"],
            "formatos" => ["ver", "crear", "editar", "borrar"],
            "pedidos" => ["ver", "crear", "editar", "borrar"],
            "carritos" => ["ver", "crear", "editar", "borrar"],
            "tiendas" => ["ver", "crear", "editar", "borrar"],
            "empresas" => ["ver", "crear", "editar", "borrar"],
            "banners" => ["ver", "crear", "editar", "borrar"],
            "inventarios" => ["ver", "crear", "editar", "borrar"],
            "arqueos" => ["ver", "crear", "editar", "borrar"],
            "importar" => ["ver", "importar", "borrar"]
        ];
        foreach ($permisos as $permiso => $acciones) {
            foreach ($acciones as $accion) {
                $db->table('permission')->insert([
                    'permission_nombre' => "{$permiso}_{$accion}",
                    'permission_description' => "{$accion} $permiso",
                    'permission_estado' => 1,
                ]);
            }
        }
        /****ROLEPERMISSION***/
        $rolepermisos = [
            "Admin" => "all",
            "Empleado" => [
                "usuarios" => [
                    "ver", "crear", "editar"
                ],
                "giftcards" => "all",
                "productos" => ["ver"],
                "pedidos" => "all",
                "carritos" => "all",
                "inventarios" => "all",
                "arqueos" => "all",
            ],
            "Webmaster" => [
                "usuarios" => [
                    "ver", "crear", "editar"
                ],
                "giftcards" => "all",
                "familias" => "all",
                "idiomas" => "all",
                "marcas" => "all",
                "productos" => "all",
                "atributos" => "all",
                "formatos" => "all",
                "pedidos" => "all",
                "carritos" => "all",
                "banners" => "all",
            ],
        ];
        foreach ($rolepermisos as $rolepermiso_key => $rolepermiso_value) {
            //["Admin" => "all", "Empresa" => []]
            $role_id = array_search($rolepermiso_key, $roles);
            $array_permisos = [];
            if ($rolepermiso_value == "all") {
                //"Admin" => "all"
                $array_permisos[$role_id] = $permisos;
            } elseif (is_array($rolepermiso_value)) {
                /*"Empresa" => [
                    "giftcards" => "all",
                    "usuarios" => []
                ]*/
                foreach ($rolepermiso_value as $rolepermiso_value_key => $rolepermiso_value_value) {
                    //["giftcards" => "all", "usuarios" => []]
                    if ($rolepermiso_value_value == "all") {
                        //"giftcards" => "all"
                        $array_permisos[$role_id][$rolepermiso_value_key] = $permisos[$rolepermiso_value_key];
                    } elseif (is_array($rolepermiso_value_value)) {
                        foreach ($rolepermiso_value_value as $rolepermiso_value_value_key => $rolepermiso_value_value_value) {
                            $array_permisos[$rolepermiso_value_value_key][] = $rolepermiso_value_value_value;
                        }
                    }
                }
            }
            foreach ($array_permisos as $array_permiso) {
                foreach ($array_permiso as $key => $value) {
                    $db->table('rolepermission')->insert([
                        'rolepermission_role_id' => $role_id,
                        'rolepermission_permission_id' => $key,
                        'rolepermission_estado' => 1,
                    ]);
                }
            }


        }

        /********USUARIOROLE**********/
        $db->table('usuariorole')->insert([
            'usuariorole_usuario_id' => 1,
            'usuariorole_role_id' => 1,
            'usuariorole_estado' => 1,
        ]);// 1

        $db->table('usuariorole')->insert([
            'usuariorole_usuario_id' => 2,
            'usuariorole_role_id' => 2,
            'usuariorole_estado' => 1,
        ]);// 2

        $db->table('usuariorole')->insert([
            'usuariorole_usuario_id' => 3,
            'usuariorole_role_id' => 3,
            'usuariorole_estado' => 1,
        ]);// 3

    }

    public function down() {
        $this->forge->dropTable('role');
        $this->forge->dropTable('permission');
        $this->forge->dropTable('rolepermission');
        $this->forge->dropTable('usuariorole');
    }

}
