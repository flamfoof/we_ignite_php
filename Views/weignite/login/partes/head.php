<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Login StarOnline |v3 </title>
    <link rel="icon" type="image/x-icon" href="<?= base_url("assets_admin/assets/img/favicon.ico") ?>"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?= base_url("assets_admin/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url("assets_admin/assets/css/plugins.css") ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url("assets_admin/assets/css/authentication/form-1.css") ?>" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets_admin/assets/css/forms/theme-checkbox-radio.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets_admin/assets/css/forms/switches.css") ?>">
    <style media="screen">
        body{
            background: #ffffff;
        }
        h1{
            color: #009688 !important;
        }
        .form-form .form-form-wrap form .field-wrapper svg{
            color: #009688;
            fill: #0096886e !important;
        }
        .switch .slider{
            background-color: #a88888;
        }
        .switch .slider:before{
            box-shadow: 0 1px 15px 1px rgb(104 40 40 / 34%) !important;
        }
        .btn-primary, .switch.s-primary .slider:before{
            background-color: #009688 !important;
            border-color: #009688;
        }
        .form-image .l-image{
            background-color: white !important;
            background-image: url(<?= $logo ?>) !important;
        }
    </style>
</head>
<body class="form">
    <?= isset($mensaje) ? $mensaje : "" ?>
