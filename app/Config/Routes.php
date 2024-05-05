<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Login::index');
$routes->post('/', 'Login::login_action');
$routes->get('/register', 'UserController::register');
$routes->post('register/save', 'UserController::saveRegister');
$routes->get('logout', 'Login::logout');
// Tambakan ['filter' => 'pimpinanFilter'] untuk memberikan filter routing / url hanya bisa diakses
// oleh role yang sama sesuai ketentuan yang telah di buat Folder Filters/xxxxFilter

$routes->get('pimpinan/dashboard', 'Pimpinan\Dashboard::index', ['filter' => 'pimpinanFilter']);
$routes->get('auditor/dashboard', 'Auditor\Dashboard::index', ['filter' => 'auditorFilter']);
$routes->get('auditi/dashboard', 'Auditi\Dashboard::index', ['filter' => 'auditiFilter']);
$routes->get('admin/dashboard', 'Admin\Dashboard::index', ['filter' => 'adminFilter']);
