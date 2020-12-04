<?php
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

?>
