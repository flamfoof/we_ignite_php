<?php
$routes->get('admin/blogs', 'Blogs::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/blog/nuevo', 'Blogs::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/blog/nuevo', 'Blogs::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/blog/(:num)/editar', 'Blogs::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/blog/(:num)/editar', 'Blogs::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/blog/(:num)/borrar', 'Blogs::borrar/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('blogs', 'Blogs::blogs');
$routes->get('blog/(:any)', 'Blogs::blog/$1');
?>
