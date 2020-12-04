<?php
    $config = [
        "name" => "google_recaptcha",
        "description" => "Recaptcha de google v3",
        "version" => "1",
        "precio" => "5",
        "menuadmin" => [
            [
                "menuadmin_parent" => "Avanzado",
                "menuadmin_type" => 0,
                "menuadmin_name" => "reCaptcha",
                "menuadmin_url" => "admin/recaptcha",
                "menuadmin_icon" => "details",
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
