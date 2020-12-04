<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8">
    <title><?= (isset($info)) ? $info["pagina_meta_titulo"] : "WeIgniteIt | Landing" ?></title>
    <?= (isset($head)) ? $head : "" ?>
    <!-- Google Follow -->
	<?php if (isset($google_index_follow)): ?>
		<meta name="robots" content="<?= $google_index_follow ?>">
	<?php endif; ?>
	<!-- END Google Follow -->

	<!-- Google Canonical -->
	<?php if (isset($canonical)): ?>
		<link rel="canonical" href="<?= site_url($canonical) ?>" />
	<?php endif; ?>
    <!-- END Google Canonical -->

    <!-- Google Lang -->
    <?php if (isset($lang)): ?>
		<link rel="alternate" hreflang="<?= $lang ?>" href="<?= $lang_url ?>" />
	<?php endif; ?>
    <!-- END Google Lang -->

    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
    <?= isset($mensaje) ? $mensaje : "" ?>

    <?= isset($header) ? $header : "" ?>

    <?= isset($content) ? $content : "" ?>

    <?= isset($footer) ? $footer : "" ?>
</body>
</html>
