<?php
$routes->get('admin/contactos', 'Contactos::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/contacto/(:num)/editar', 'Contactos::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/contacto/(:num)/editar', 'Contactos::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/contacto/(:num)/borrar', 'Contactos::borrar/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->post('contactar', 'Contactar::contacto_post/$1');
$routes->get('contacto/ok', 'Mensajes::contacto_ok');
?>
