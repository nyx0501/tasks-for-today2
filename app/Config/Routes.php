<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public pages
$routes->get('/', 'Home::index');
$routes->get('tasks', 'Tasks::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'About::index');

// Authentication
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->post('logout', 'Auth::logout');

// Protected: create / edit / delete require login
$routes->group('tasks', ['filter' => 'auth'], static function ($routes) {
    $routes->get('new', 'Tasks::new');
    $routes->post('create', 'Tasks::create');
    $routes->get('(:num)/edit', 'Tasks::edit/$1');
    $routes->post('(:num)/update', 'Tasks::update/$1');
    $routes->post('(:num)/delete', 'Tasks::delete/$1');
});