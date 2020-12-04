<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
* --------------------------------------------------------------------
* Router Setup
* --------------------------------------------------------------------
*/
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Core');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);
$routes->set404Override('Core::notFound');

/**
* --------------------------------------------------------------------
* Route Definitions
* --------------------------------------------------------------------
*/

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
/***********ADMIN**************************************************************/
$routes->get('login', 'Login::index', ['namespace' => 'App\Controllers\Admin']);
$routes->post('login', 'Login::session', ['namespace' => 'App\Controllers\Admin']);
$routes->get('logout', 'Login::logout', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin', 'Dashboard::index', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/inicio', 'Dashboard::index', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/easy-menu', 'Dashboard::easy_menu', ['namespace' => 'App\Controllers\Admin']);

$routes->post('admin/menuadmin/favorito', 'Admin::menuadmin_favorito', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/menusadmin', 'Admin::menuadmin_list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/menuadmin/(:num)/editar', 'Admin::menuadmin_ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/menuadmin/(:num)/editar', 'Admin::menuadmin_guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/menuadmin/(:num)/borrar', 'Admin::menuadmin_borrar/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/roles', 'Roles::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/role/nuevo', 'Roles::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/role/nuevo', 'Roles::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/role/(:num)/editar', 'Roles::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/role/(:num)/editar', 'Roles::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/role/(:num)/borrar', 'Roles::borrar/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/permisos', 'Permisos::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/permiso/nuevo', 'Permisos::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/permiso/nuevo', 'Permisos::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/permiso/(:num)/editar', 'Permisos::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/permiso/(:num)/editar', 'Permisos::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/permiso/(:num)/borrar', 'Permisos::borrar/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/usuarios', 'Usuarios::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/usuario/nuevo', 'Usuarios::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/usuario/nuevo', 'Usuarios::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/usuario/(:num)/editar', 'Usuarios::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/usuario/(:num)/editar', 'Usuarios::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/usuario/(:num)/borrar', 'Usuarios::borrar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/usuario/(:num)/recuperar', 'Usuarios::recuperar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/usuarios/filter', 'Usuarios::filter', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/plugins', 'Plugins::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugins/install', 'Plugins::list_install', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/nuevo', 'Plugins::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/plugin/nuevo', 'Plugins::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/(:num)/editar', 'Plugins::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/plugin/(:num)/editar', 'Plugins::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/(:num)/borrar', 'Plugins::borrar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/(:segment)/install', 'Plugins::install/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/(:num)/uninstall', 'Plugins::uninstall/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/(:num)/deactivate', 'Plugins::uninstall/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/(:num)/update', 'Plugins::update/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/configuracion', 'Configuracion::configuracion', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/configuracion', 'Configuracion::configuracion_post', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/configuracion/wizard', 'Configuracion::wizard', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/configuracion/temas', 'Configuracion::temas', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/configuracion/(:segment)/activar', 'Configuracion::tema_activar::temas/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/archivos', 'Galeria::archivos', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/archivos/mas', 'Galeria::archivos_mas', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/archivo/subir', 'Galeria::subir_archivos', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/archivo/subir', 'Galeria::subir_archivos_test', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/galeria/imagenes', 'Galeria::imagen_list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/galeria/imagen/nueva', 'Galeria::iamgen_ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/galeria/imagen/nueva', 'Galeria::imagen_guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/galeria/imagen/(:num)/editar', 'Galeria::iamgen_ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/galeria/imagen/(:num)/editar', 'Galeria::imagen_guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/galeria/imagenes/sincronizar', 'Galeria::imagen_sincronizar', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/galeria/documentos', 'Galeria::documento_list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/galeria/documento/nuevo', 'Galeria::documento_ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/galeria/documento/nuevo', 'Galeria::documento_guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/galeria/documento/(:num)/editar', 'Galeria::documento_ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/galeria/documento/(:num)/editar', 'Galeria::documento_guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/galeria/documentos/sincronizar', 'Galeria::documento_sincronizar/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/galeria/videos', 'Galeria::video_list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/galeria/video/nuevo', 'Galeria::video_ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/galeria/video/nuevo', 'Galeria::video_guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/galeria/video/(:num)/editar', 'Galeria::video_ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/galeria/video/(:num)/editar', 'Galeria::video_guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/galeria/video/(:num)/subir', 'Galeria::video_subir/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/galeria/videos/sincronizar', 'Galeria::video_sincronizar/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/galeria/load/boton_html', 'Galeria::boton_html', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/configuracion', 'Configuracion::configuracion', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/configuracion', 'Configuracion::configuracion_post', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/configuracion/wizard', 'Configuracion::wizard', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/configuracion/temas', 'Configuracion::temas', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/configuracion/(:segment)/activar', 'Configuracion::tema_activar::temas/$1', ['namespace' => 'App\Controllers\Admin']);
/********************************************************************************/
$routes->get('migrate', 'Migrate::index');
$routes->get('migrate/back', 'Migrate::back');
$routes->get('migrate/from/v3', 'Migrate::danielarnedo');
$routes->get('migrate/from/v3/albaranes', 'Migrate::danielarnedo_albaranes');
$routes->get('migrate/from/v1/inmuebles', 'Migrate::kasas10_inmuebles');
$routes->get('migrate/from/v1/proveedores', 'Migrate::kasas10_proveedores');

$routes->get('admin/importar', 'Importar::menu', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/importar', 'Importar::menu_post', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/importar/productos', 'Importar::importar_productos', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/importar/productos', 'Importar::importar_config', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/importar/productos/proceso', 'Importar::importar_productos_proceso', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/importar/productos/proceso', 'Importar::importar_productos_post', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/importar/productos/proceso/get', 'Importar::importar_productos_post', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/importar/coches', 'Importar::importar_coches', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/importar/coches', 'Importar::importar_config_coches', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/importar/coches/proceso', 'Importar::importar_coches_proceso', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/importar/coches/proceso', 'Importar::importar_coches_post', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/importar/coches/proceso/get', 'Importar::importar_coches_post', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/importar/compatible', 'Importar::importar_compatible', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/importar/compatible', 'Importar::importar_config_compatible', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/importar/compatible/proceso', 'Importar::importar_compatible_proceso', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/importar/compatible/proceso', 'Importar::importar_compatible_post', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/importar/compatible/proceso/get', 'Importar::importar_compatible_post', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/importar/formatos-atributos', 'Importar::importar_formatos_atributos', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/importar/formatos-atributos', 'Importar::importar_config_fa', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/importar/productos/proceso/get', 'Importar::importar_productos_post', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/importar/formatos-atributos/proceso', 'Importar::importar_formato_atributo_proceso', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/importar/formatos-atributos/proceso', 'Importar::importar_formato_atributo_proceso_post', ['namespace' => 'App\Controllers\Admin']);

//----------------PLUGIN SYSTEM START------------------------------------------//
//PLUGINS START

//PLUGINS ENDS
/***********************************FRONT*****************************************/
$routes->get('ver/archivo/(:num)', 'Core::mostrar_archivo/$1');
$routes->get('404', 'Core::notFound');
$routes->get('/', 'Core::index');

/**
* --------------------------------------------------------------------
* Additional Routing
* --------------------------------------------------------------------
*
* There will often be times that you need additional routing and you
* need to it be able to override any defaults in this file. Environment
* based routes is one such time. require() additional route files here
* to make that happen.
*
* You will have access to the $routes object within that file without
* needing to reload it.
*/
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
