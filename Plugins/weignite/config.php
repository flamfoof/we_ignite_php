<?php
    $config = [
        "name" => "weignite",
        "description" => "Plugin a medida para WeIgnite",
        "version" => "1",
        "precio" => "75",
        "menuadmin" => [
            [
                "menuadmin_parent" => "",
                "menuadmin_menuadmin_id" => 0,
                "menuadmin_type" => 2,
                "menuadmin_name" => "Projects",
                "menuadmin_url" => "",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_posicion" => "97",
                "menuadmin_estado" => 1,
            ], [
                "menuadmin_parent" => "Projects",
                "menuadmin_type" => 0,
                "menuadmin_name" => "Dashboard",
                "menuadmin_url" => "admin/stats/dashboard",
                "menuadmin_icon" => "view_carousel",
                "menuadmin_custom" => "",
                "menuadmin_estado" => 1,
            ], [
                "menuadmin_parent" => "Projects",
                "menuadmin_type" => 0,
                "menuadmin_name" => "Projects List",
                "menuadmin_url" => "admin/projects",
                "menuadmin_icon" => "inbox",
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
