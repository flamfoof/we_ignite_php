<?php
$routes->get('admin/menus', 'Menus::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/menu/nuevo', 'Menus::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/menu/nuevo', 'Menus::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/menu/(:num)/editar', 'Menus::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/menu/(:num)/editar', 'Menus::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/menu/(:num)/borrar', 'Menus::borrar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/menu/(:num)/borrar', 'Menus::borrar_post/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/menu/(:num)/load', 'Menus::ver/$1/1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/menu/(:num)/sort', 'Menus::sort/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/grupomenus', 'GrupoMenus::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/grupomenu/nuevo', 'GrupoMenus::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/grupomenu/nuevo', 'GrupoMenus::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/grupomenu/(:num)/editar', 'GrupoMenus::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/grupomenu/(:num)/editar', 'GrupoMenus::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/grupomenu/(:num)/borrar', 'GrupoMenus::borrar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/grupomenu/(:num)/borrar', 'GrupoMenus::borrar_post/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/grupomenu/(:num)/load', 'GrupoMenus::ver/$1/1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/paginas', 'Paginas::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/pagina/nueva', 'Paginas::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/pagina/nueva', 'Paginas::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/pagina/(:num)/editar', 'Paginas::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/pagina/(:num)/editar', 'Paginas::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/pagina/(:num)/load', 'Paginas::ver/$1/1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/pagina/(:num)/borrar', 'Paginas::borrar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/pagina/(:num)/load', 'Paginas::ver/$1/1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/pagina/(:num)/editar-pagina', 'Home::editar_content/$1');
$routes->post('admin/pagina/(:num)/guardar/content', 'Paginas::guardar_content/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/banners', 'Banners::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/banner/nuevo', 'Banners::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/banner/nuevo', 'Banners::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/banner/(:num)/editar', 'Banners::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/banner/(:num)/editar', 'Banners::guardar/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->post('llamame', 'Webs::contacto_post/$1');
$routes->get('page/(:any)', 'Webs::pagina/$1');
$routes->get('/', 'Webs::pagina');
?>
