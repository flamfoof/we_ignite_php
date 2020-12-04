<?php namespace App\Database\Seeds;

class StatesSeeder extends \CodeIgniter\Database\Seeder{
        public function run(){
            $db = \Config\Database::connect();
            $states = [
                ["codigo"=>"AK","cp"=>"52","nombre"=>"Alaska","tel"=>"95"],
                ["codigo"=>"AL","cp"=>"52","nombre"=>"Alabama","tel"=>"95"],
                ["codigo"=>"AZ","cp"=>"52","nombre"=>"Arizona","tel"=>"95"],
                ["codigo"=>"AR","cp"=>"52","nombre"=>"Arkansas","tel"=>"95"],
                ["codigo"=>"CA","cp"=>"52","nombre"=>"California","tel"=>"95"],
                ["codigo"=>"CO","cp"=>"52","nombre"=>"Colorado","tel"=>"95"],
                ["codigo"=>"CT","cp"=>"52","nombre"=>"Connecticut","tel"=>"95"],
                ["codigo"=>"DE","cp"=>"52","nombre"=>"Delaware","tel"=>"95"],
                ["codigo"=>"DC","cp"=>"52","nombre"=>"DistrictofColumbia","tel"=>"95"],
                ["codigo"=>"FL","cp"=>"52","nombre"=>"Florida","tel"=>"95"],
                ["codigo"=>"GA","cp"=>"52","nombre"=>"Georgia","tel"=>"95"],
                ["codigo"=>"HI","cp"=>"52","nombre"=>"Hawaii","tel"=>"95"],
                ["codigo"=>"ID","cp"=>"52","nombre"=>"Idaho","tel"=>"95"],
                ["codigo"=>"IL","cp"=>"52","nombre"=>"Illinois","tel"=>"95"],
                ["codigo"=>"IN","cp"=>"52","nombre"=>"Indiana","tel"=>"95"],
                ["codigo"=>"IA","cp"=>"52","nombre"=>"Iowa","tel"=>"95"],
                ["codigo"=>"KS","cp"=>"52","nombre"=>"Kansas","tel"=>"95"],
                ["codigo"=>"KY","cp"=>"52","nombre"=>"Kentucky","tel"=>"95"],
                ["codigo"=>"LA","cp"=>"52","nombre"=>"Louisiana","tel"=>"95"],
                ["codigo"=>"ME","cp"=>"52","nombre"=>"Maine","tel"=>"95"],
                ["codigo"=>"MD","cp"=>"52","nombre"=>"Maryland","tel"=>"95"],
                ["codigo"=>"MA","cp"=>"52","nombre"=>"Massachusetts","tel"=>"95"],
                ["codigo"=>"MI","cp"=>"52","nombre"=>"Michigan","tel"=>"95"],
                ["codigo"=>"MN","cp"=>"52","nombre"=>"Minnesota","tel"=>"95"],
                ["codigo"=>"MS","cp"=>"52","nombre"=>"Mississippi","tel"=>"95"],
                ["codigo"=>"MO","cp"=>"52","nombre"=>"Missouri","tel"=>"95"],
                ["codigo"=>"MT","cp"=>"52","nombre"=>"Montana","tel"=>"95"],
                ["codigo"=>"NE","cp"=>"52","nombre"=>"Nebraska","tel"=>"95"],
                ["codigo"=>"NV","cp"=>"52","nombre"=>"Nevada","tel"=>"95"],
                ["codigo"=>"NH","cp"=>"52","nombre"=>"NewHampshire","tel"=>"95"],
                ["codigo"=>"NJ","cp"=>"52","nombre"=>"NewJersey","tel"=>"95"],
                ["codigo"=>"NM","cp"=>"52","nombre"=>"NewMexico","tel"=>"95"],
                ["codigo"=>"NY","cp"=>"52","nombre"=>"NewYork","tel"=>"95"],
                ["codigo"=>"NC","cp"=>"52","nombre"=>"NorthCarolina","tel"=>"95"],
                ["codigo"=>"ND","cp"=>"52","nombre"=>"NorthDakota","tel"=>"95"],
                ["codigo"=>"OH","cp"=>"52","nombre"=>"Ohio","tel"=>"95"],
                ["codigo"=>"OK","cp"=>"52","nombre"=>"Oklahoma","tel"=>"95"],
                ["codigo"=>"OR","cp"=>"52","nombre"=>"Oregon","tel"=>"95"],
                ["codigo"=>"PA","cp"=>"52","nombre"=>"Pennsylvania","tel"=>"95"],
                ["codigo"=>"PR","cp"=>"52","nombre"=>"PuertoRico","tel"=>"95"],
                ["codigo"=>"RI","cp"=>"52","nombre"=>"RhodeIsland","tel"=>"95"],
                ["codigo"=>"SC","cp"=>"52","nombre"=>"SouthCarolina","tel"=>"95"],
                ["codigo"=>"SD","cp"=>"52","nombre"=>"SouthDakota","tel"=>"95"],
                ["codigo"=>"TN","cp"=>"52","nombre"=>"Tennessee","tel"=>"95"],
                ["codigo"=>"TX","cp"=>"52","nombre"=>"Texas","tel"=>"95"],
                ["codigo"=>"UT","cp"=>"52","nombre"=>"Utah","tel"=>"95"],
                ["codigo"=>"VT","cp"=>"52","nombre"=>"Vermont","tel"=>"95"],
                ["codigo"=>"VA","cp"=>"52","nombre"=>"Virginia","tel"=>"95"],
                ["codigo"=>"WA","cp"=>"52","nombre"=>"Washington","tel"=>"95"],
                ["codigo"=>"WV","cp"=>"52","nombre"=>"WestVirginia","tel"=>"95"],
                ["codigo"=>"WI","cp"=>"52","nombre"=>"Wisconsin","tel"=>"95"],
                ["codigo"=>"WY","cp"=>"52","nombre"=>"Wyoming","tel"=>"95"],
            ];

            foreach ($states as $state) {
                $data = [
                    "provincia_nombre" => $state["nombre"],
                    "provincia_codigo" => $state["codigo"],
                    "provincia_cp" => $state["cp"],
                    "provincia_tel" => $state["tel"],
                    "provincia_pais_id" => 65,
                    "provincia_estado" => 1,
                ];
                $db->table('provincia')->insert($data);
            }
        }
}
