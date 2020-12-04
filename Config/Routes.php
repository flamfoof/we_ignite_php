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
$routes->setDefaultController('Webs');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);
$routes->set404Override('Webs::notFound');

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

$routes->get('admin/usuario/(:num)/direccion/nueva', 'Usuarios::direccion_ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/usuario/(:num)/direccion/nueva', 'Usuarios::direccion_guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/usuario/(:num)/direccion/(:num)/editar', 'Usuarios::direccion_ver/$1/$2', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/usuario/(:num)/direccion/(:num)/editar', 'Usuarios::direccion_guardar/$1/$2', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/usuario/(:num)/direccion/(:num)/borrar', 'Usuarios::direccion_borrar/$1/$2', ['namespace' => 'App\Controllers\Admin']);

$routes->get('admin/plugins', 'Plugins::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugins/install', 'Plugins::list_install', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/nuevo', 'Plugins::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/plugin/nuevo', 'Plugins::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/(:num)/editar', 'Plugins::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/plugin/(:num)/editar', 'Plugins::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/(:num)/borrar', 'Plugins::borrar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/(:segment)/install', 'Plugins::install/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/plugin/(:num)/uninstall', 'Plugins::uninstall/$1', ['namespace' => 'App\Controllers\Admin']);
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

/* PLUGIN | BLOG */
$routes->get('admin/blogs', 'Blogs::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/blog/nuevo', 'Blogs::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/blog/nuevo', 'Blogs::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/blog/(:num)/editar', 'Blogs::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/blog/(:num)/editar', 'Blogs::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/blog/(:num)/borrar', 'Blogs::borrar/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->get('blogs', 'Blogs::blogs');
$routes->get('blog/(:any)', 'Blogs::blog/$1');

/* PUGLIN | BLOG | END */
/* PLUGIN | CONTACTO */
$routes->get('admin/contactos', 'Contactos::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/contacto/(:num)/editar', 'Contactos::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/contacto/(:num)/editar', 'Contactos::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/contacto/(:num)/borrar', 'Contactos::borrar/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->post('contactar', 'Contactar::contacto_post/$1');
$routes->get('contacto/ok', 'Mensajes::contacto_ok');

/* PUGLIN | CONTACTO | END */
/* PLUGIN | DIRECCIONES */
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
 
/* PUGLIN | DIRECCIONES | END */
/* PLUGIN | WEB */
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

/* PUGLIN | WEB | END */
/* PLUGIN | WEIGNITE */
/**********************TEST API ******************************************************/
$routes->get('admin/api/login', 'TestAPI::login', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/api/access', 'TestAPI::access', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/api/action', 'TestAPI::action', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/api/(:num)/loginuser', 'TestAPI::login_user/$1', ['namespace' => 'App\Controllers\Admin']);
/**********************API ******************************************************/
//--sets
$routes->post('api/project/(:num)/login', 'API::getAccessToken/$1'); //header[secret key] -> returns public key
$routes->post('api/project/(:num)/access', 'API::setAccess/$1'); //header[secret key] post [email, date, starts, ends ] OATHv2
$routes->post('api/project/(:num)/action', 'API::setAction/$1'); //header[secret key] post [email, type, data, date] data=link or video name
//--gets
$routes->post('api/project/(:num)/login/user', 'API::login/$1'); //header[secret key] post [email, password] -> user array

/**********************Projects******************************************************/
$routes->get('admin/projects', 'Projects::list', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/project/new', 'Projects::ver', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/project/new', 'Projects::guardar', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/project/(:num)/edit', 'Projects::ver/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/project/(:num)/edit', 'Projects::guardar/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/project/(:num)/delete', 'Projects::ver/$1', ['namespace' => 'App\Controllers\Admin']);

$routes->post('admin/project/(:num)/user', 'Projects::users/$1', ['namespace' => 'App\Controllers\Admin']);
$routes->get('admin/project/(:num)/user/(:num)/delete', 'Projects::users_delete/$1/$2', ['namespace' => 'App\Controllers\Admin']);

/**********************Client******************************************************/
//$routes->get('project/login', 'ProjectLogin::login');
//$routes->post('project/login', 'ProjectLogin::login_post');
$routes->get('(:segment)/admin', 'ProjectLogin::login/$1');
$routes->post('(:segment)/admin', 'ProjectLogin::login_post/$1');

$routes->get('(:segment)/register', 'ProjectLogin::register/$1');
$routes->post('(:segment)/register', 'ProjectLogin::register_post/$1');
$routes->get('(:segment)/user/(:num)/verify', 'ProjectLogin::verify/$1/$2');
$routes->get('(:segment)/recover', 'ProjectLogin::recover/$1');
$routes->post('(:segment)/recover', 'ProjectLogin::recover_post/$1');
$routes->get('(:segment)/account/activation/(:segment)', 'ProjectLogin::activation/$1/$2');
$routes->post('(:segment)/account/activation/(:segment)', 'ProjectLogin::activation_post/$1/$2');


$routes->get('project/dashboard', 'ProjectClients::dashboard');
$routes->get('project/list', 'ProjectClients::list');
$routes->get('project/(:num)/view', 'ProjectClients::view/$1');
$routes->post('project/(:num)/user', 'ProjectClients::add_user/$1');
$routes->get('project/(:num)/user/(:num)/delete', 'ProjectClients::users_delete/$1/$2');

$routes->get('(:segment)/login', 'ProjectLogin::login_client/$1');
$routes->post('(:segment)/login', 'ProjectLogin::login_client_post/$1');
$routes->get('(:segment)/user/(:num)', 'ProjectUsers::download/$1/$2');


/* PUGLIN | WEIGNITE | END */
/* PLUGIN | GOOGLE_RECAPTCHA */
$routes->get('admin/recaptcha', 'ReCaptcha::config', ['namespace' => 'App\Controllers\Admin']);
$routes->post('admin/recaptcha', 'ReCaptcha::config_post', ['namespace' => 'App\Controllers\Admin']);

/* PUGLIN | GOOGLE_RECAPTCHA | END */
/* PLUGIN | CORE */
//nothing yet

/* PUGLIN | CORE | END */
//PLUGINS ENDS
/***********************************FRONT*****************************************/
$routes->get('ver/archivo/(:num)', 'Webs::mostrar_archivo/$1');
$routes->get('404', 'Webs::notFound');
$routes->get('/', 'Webs::pagina');
$routes->get('(:segment)', 'Webs::pagina/$1');
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
