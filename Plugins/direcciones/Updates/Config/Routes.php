<?php
$routes->get('admin/paises', 'Paises::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/pais/nuevo', 'Paises::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/pais/nuevo', 'Paises::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/pais/(:num)/editar', 'Paises::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/pais/(:num)/editar', 'Paises::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/pais/(:num)/borrar', 'Paises::borrar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/paises/editar/todos', 'Paises::editar_todos', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/paises/editar/seleccionados', 'Paises::editar_grupo', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/paises/options/(:num)', 'Paises::options/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/provincias', 'Provincias::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/provincia/nueva', 'Provincias::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/provincia/nueva', 'Provincias::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/provincia/(:num)/editar', 'Provincias::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/provincia/(:num)/editar', 'Provincias::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/provincia/(:num)/borrar', 'Provincias::borrar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/provincia/editar/todos', 'Provincias::editar_todos', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/provincia/editar/seleccionados', 'Provincias::editar_grupo', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/provincia/options/(:num)/(:num)', 'Provincias::options/$1/$2', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/ciudades', 'Ciudades::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/ciudad/nueva', 'Ciudades::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/ciudad/nueva', 'Ciudades::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/ciudad/(:num)/editar', 'Ciudades::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/ciudad/(:num)/editar', 'Ciudades::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/ciudad/(:num)/borrar', 'Ciudades::borrar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/ciudad/editar/todos', 'Ciudades::editar_todos', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/ciudad/options/(:num)/(:num)', 'Ciudades::options/$1/$2', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/zonas', 'Zonas::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/zona/nueva', 'Zonas::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/zona/nueva', 'Zonas::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/zona/(:num)/editar', 'Zonas::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/zona/(:num)/editar', 'Zonas::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/zona/(:num)/borrar', 'Zonas::borrar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/zona/editar/todos', 'Zonas::editar_todos', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/zona/editar/seleccionados', 'Zonas::editar_grupo', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/zona/options/(:num)/(:num)', 'Zonas::options/$1/$2', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/direccion/(:num)/load', 'Direcciones::ver_direcciones/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/usuario/(:num)/direccion/nueva', 'Direcciones::direccion_ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/usuario/(:num)/direccion/nueva', 'Direcciones::direccion_guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/usuario/(:num)/direccion/(:num)/editar', 'Direcciones::direccion_ver/$1/$2', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/usuario/(:num)/direccion/(:num)/editar', 'Direcciones::direccion_guardar/$1/$2', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/usuario/(:num)/direccion/(:num)/borrar', 'Direcciones::direccion_borrar/$1/$2', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/direccion/(:num)/pais/(:num)/modal', 'Direcciones::pais_modal/$1/$2', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/direccion/(:num)/pais/(:num)/modal', 'Direcciones::pais_modal_post/$1/$2', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/direccion/(:num)/provincia/(:num)/modal', 'Direcciones::provincia_modal/$1/$2', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/direccion/(:num)/provincia/(:num)/modal', 'Direcciones::provincia_modal_post/$1/$2', ['namespace' => 'App\Controllers\Admin']);

$routes->get('direcciones/object', 'Direcciones::getDirecciones');
$routes->get('pais/options/(:num)', 'Direcciones::getPaises/$1');
$routes->get('provincias/options/(:num)/(:num)', 'Direcciones::getProvincias/$1/$2');
$routes->get('ciudades/options/(:num)/(:num)', 'Direcciones::getCiudades/$1/$2');
$routes->get('zonas/options/(:num)/(:num)', 'Direcciones::getZonas/$1/$2');
 ?>
