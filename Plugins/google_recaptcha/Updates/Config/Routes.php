<?php
$routes->get('admin/recaptcha', 'ReCaptcha::config', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/recaptcha', 'ReCaptcha::config_post', ['namespace' => 'App\Controllers\Admin']);
?>
