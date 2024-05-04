<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 
$routes->get('/', 'UserController::login');

$routes->get('/register', 'UserController::register');

$routes->post('/register/save', 'UserController::saveRegister');

$routes->post('/login', 'UserController::postLogin');