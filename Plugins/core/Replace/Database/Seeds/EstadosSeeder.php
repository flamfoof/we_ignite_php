<?php namespace App\Database\Seeds;

class EstadosSeeder extends \CodeIgniter\Database\Seeder{
        public function run(){
            $db = \Config\Database::connect();

            $estadospagos = [
                ["estado_nombre" => "Cancelado", "estado_descripcion" => "Pedido cancelado"],
                ["estado_nombre" => "Revisando", "estado_descripcion" => "Revisando el pedido"],
                ["estado_nombre" => "Pagado", "estado_descripcion" => "Pedido pagado"],
                ["estado_nombre" => "Preparando", "estado_descripcion" => "Preparando pedido"],
                ["estado_nombre" => "Enviando", "estado_descripcion" => "Enviando pedido"],
                ["estado_nombre" => "Entregado", "estado_descripcion" => "Pedido Entregado"],
                ["estado_nombre" => "Pendiente", "estado_descripcion" => "Pedido pendiente"],
                ["estado_nombre" => "Devuelto", "estado_descripcion" => "Pedido devuelto"],
            ];
            foreach ($estadospagos as $estado) {
                $data = [
                    "estado_nombre" => $estado["estado_nombre"],
                    "estado_descripcion" => $estado["estado_descripcion"],
                    "estado_estado" => 1,
                ];
                $db->table('estado')->insert($data);
            }
        }
}
