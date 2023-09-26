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
});