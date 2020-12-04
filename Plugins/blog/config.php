<?php
    $config = [
        "name" => "blog",
        "description" => "Plugin para gestionar tu blog",
        "version" => "1",
        "precio" => "5",
        "menuadmin" => [
            [
                "menuadmin_parent" => "",
                "menuadmin_menuadmin_id" => 0,
                "menuadmin_type" => 2,
                "menuadmin_name" => "Web",
                "menuadmin_url" => "",
                "menuadmin_icon" => "",
                "menuadmin_custom" => "",
                "menuadmin_posicion" => "97",
                "menuadmin_estado" => 1,
            ], [
                "menuadmin_parent" => "Web",
                "menuadmin_type" => 0,
                "menuadmin_name" => "Blogs",
                "menuadmin_url" => "admin/blogs",
                "menuadmin_icon" => "content_paste",
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
