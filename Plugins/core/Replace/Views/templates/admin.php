<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <link rel="icon" href="<?= base_url("assets_admin/images/logo_square.png") ?>" type="image/gif" sizes="16x16">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"><!--, shrink-to-fit=no-->
    <title><?= isset($title) ? $title : "Vega"  ?></title>

    <!-- Prevent the demo from appearing in search engines (REMOVE THIS) -->
    <meta name="robots" content="noindex">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?= base_url("assets_admin/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url("assets_admin/assets/css/plugins.css") ?>" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link href="<?= base_url("assets_admin/assets/css/scrollspyNav.css") ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets_admin/assets/css/forms/theme-checkbox-radio.css") ?>">
    <link href="<?= base_url("assets_admin/assets/css/tables/table-basic.css") ?>" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL CUSTOM STYLES -->

    <!-- Material Design Icons -->
    <link type="text/css" href="<?= base_url("assets_admin/assets/css/material-icons.css") ?>" rel="stylesheet">
    <link type="text/css" href="<?= base_url("assets_admin/assets/css/material-icons.rtl.css") ?>" rel="stylesheet">
    <link type="text/css" href="<?= base_url("assets_admin/assets/css/dashboard/dash_2.css") ?>" rel="stylesheet">
    <link href="<?= base_url("assets_admin/assets/css/style.css") ?>" rel="stylesheet" type="text/css" />

    <script src="<?= base_url("assets_admin/assets/js/libs/jquery-3.1.1.min.js") ?>"></script>
</head>

<body class="alt-menu sidebar-noneoverflow" data-spy="scroll" data-target="#navSection" data-offset="140">

    <?= isset($header) ? $header : "" ?>

    <?= isset($mensaje) ? $mensaje : "" ?>

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">

        <div class="overlay"></div>
        <div class="cs-overlay"></div>
        <div class="search-overlay"></div>

        <?= view("templates/menu_top",[
            "usuario" => $usuario
        ]) ?>

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <?= isset($content) ? $content : "" ?>

            <div class="d-print-none">
                Copyright &copy; <?= date("Y") ?> - StarOnline
            </div>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    <div class="print-area d-print-block">

    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?= base_url("assets_admin/bootstrap/js/popper.min.js") ?>"></script>
    <script src="<?= base_url("assets_admin/bootstrap/js/bootstrap.min.js") ?>"></script>
    <script src="<?= base_url("assets_admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js") ?>"></script>
    <script src="<?= base_url("assets_admin/assets/js/app.js") ?>"></script>

    <script src="<?= base_url("assets_admin/assets/js/dom-factory.js") ?>"></script>
    <script src="<?= base_url("assets_admin/assets/js/material-design-kit.js") ?>"></script>

    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?= base_url("assets_admin/plugins/highlight/highlight.pack.js") ?>"></script>
    <script src="<?= base_url("assets_admin/assets/js/custom.js") ?>"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="<?= base_url("assets_admin/assets/js/scrollspyNav.js") ?>"></script>
    <script>
        checkall('todoAll', 'todochkbox');
        $('[data-toggle="tooltip"]').tooltip()
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->

    <?= view("templates/custom_modal") ?>
    <?= view("templates/archivos_modal") ?>
    <script src="<?= base_url("assets_admin/assets/js/staronline.js") ?>"></script>
</body>

</html>
