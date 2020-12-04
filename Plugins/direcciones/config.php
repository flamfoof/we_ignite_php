<?php
    $config = [
        "name" => "direcciones",
        "description" => "Plugin de direcciones",
        "version" => "1",
        "precio" => "5",
        "menuadmin" => [
            [
                "menuadmin_parent" => "Avanzado",
                "menuadmin_type" => 0,
                "menuadmin_name" => "Lugares",
                "menuadmin_url" => "",
                "menuadmin_icon" => "work",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ], [
                "menuadmin_parent" => "Lugares",
                "menuadmin_type" => 1,
                "menuadmin_name" => "Direcciones",
                "menuadmin_url" => "admin/direcciones",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ], [
                "menuadmin_parent" => "Lugares",
                "menuadmin_type" => 1,
                "menuadmin_name" => "Paises",
                "menuadmin_url" => "admin/paises",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ],  [
                "menuadmin_parent" => "Lugares",
                "menuadmin_type" => 1,
                "menuadmin_name" => "Provincias",
                "menuadmin_url" => "admin/provincias",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ],  [
                "menuadmin_parent" => "Lugares",
                "menuadmin_type" => 1,
                "menuadmin_name" => "Ciudades",
                "menuadmin_url" => "admin/ciudades",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ],  [
                "menuadmin_parent" => "Lugares",
                "menuadmin_type" => 1,
                "menuadmin_name" => "Zonas",
                "menuadmin_url" => "admin/zonas",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ],
        ],
        "updates" => [
            [
                "from" => "Updates/Config/Routes.php",
                "to" => "Config/Routes.php",
                "Type" => "update",
            ],
        ],
    ];
?>
