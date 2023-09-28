<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('auth', static function ($routes) {
	$routes->get('login', 'Auth\LoginController::index');
	$routes->post('login', 'Auth\LoginController::login');

	$routes->get('register', 'Auth\RegisterController::index');
	$routes->post('register', 'Auth\RegisterController::register');

	$routes->get('account', 'Auth\AccountController::index');
	$routes->post('account', 'Auth\AccountController::update');
	$routes->post('account/delete', 'Auth\AccountController::delete');
	$routes->post('account/logout', 'Auth\AccountController::logout');
});

$routes->group('tags', static function ($routes) {
	$routes->get('', 'TagsController::index');
	$routes->get('(:num)', 'TagsController::show/$1');

	$routes->get('new', 'TagsController::new');
	$routes->post('create', 'TagsController::create');
	$routes->post('delete/(:num)', 'TagsController::delete/$1');

	$routes->get('edit/(:num)', 'TagsController::edit/$1');
	$routes->post('update/(:num)', 'TagsController::update/$1');
});

$routes->group('content_types', static function ($routes) {
	$routes->get('', 'ContentTypesController::index');
	$routes->get('(:num)', 'ContentTypesController::show/$1');

	$routes->get('new', 'ContentTypesController::new');
	$routes->post('create', 'ContentTypesController::create');
	$routes->post('delete/(:num)', 'ContentTypesController::delete/$1');

	$routes->get('edit/(:num)', 'ContentTypesController::edit/$1');
	$routes->post('update/(:num)', 'ContentTypesController::update/$1');
});

$routes->group('content', static function ($routes) {
	$routes->get('', 'ContentController::index', ['filter' => ['auth_filter','localhost_filter','request_log_filter']]);
	$routes->get('(:num)', 'ContentController::show/$1');

	$routes->get('new', 'ContentController::new', ['filter' => ['auth_filter','localhost_filter','request_log_filter']]);
	$routes->post('create', 'ContentController::create', ['filter' => ['auth_filter','localhost_filter','request_log_filter']]);
	$routes->post('delete/(:num)', 'ContentController::delete/$1', ['filter' => ['auth_filter','localhost_filter','request_log_filter']]);

	$routes->get('edit/(:num)', 'ContentController::edit/$1', ['filter' => ['auth_filter','localhost_filter','request_log_filter']]);
	$routes->post('update/(:num)', 'ContentController::update/$1', ['filter' => ['auth_filter','localhost_filter','request_log_filter']]);
});

$routes->group('file_upload', static function ($routes) {
	$routes->get('', 'FileUploadController::index');
	$routes->post('upload', 'FileUploadController::upload');
});
