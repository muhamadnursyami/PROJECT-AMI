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

$routes->get('pimpinan/dashboard', 'Pimpinan\Dashboard::index');
$routes->get('auditor/dashboard', 'Auditor\Dashboard::index');
$routes->get('auditi/dashboard', 'Auditi\Dashboard::index');
$routes->get('admin/dashboard', 'Admin\Dashboard::index');

// FITUR ROLE ADMIN 
$routes->get('admin/jadwal-periode', 'Admin\JadwalED::index');
$routes->get('admin/jadwal-periode/create', 'Admin\JadwalED::create');
$routes->post('admin/jadwal-periode/save', 'Admin\JadwalED::save');
$routes->post('admin/jadwal-periode/update/(:num)', 'Admin\JadwalED::update/$1');
$routes->get('admin/jadwal-periode/edit/(:segment)', 'Admin\JadwalED::edit/$1');
$routes->delete('admin/jadwal-periode/(:num)', 'Admin\JadwalED::delete/$1');
// kelola kriteria admin
$routes->get('admin/kriteria-ed', 'Admin\KriteriaED::create');
$routes->post('admin/kriteria-ed', 'Admin\KriteriaED::save');
$routes->get('admin/kriteria-ed/indikator', 'Admin\KriteriaED::indikator');
$routes->get('admin/kriteria-ed/indikator/tambah', 'Admin\KriteriaED::indikatorCreate');
$routes->post('admin/kriteria-ed/indikator/tambah', 'Admin\KriteriaED::indikatorCreatePost');
$routes->get('admin/kriteria-ed/ubah/(:segment)', 'Admin\KriteriaED::indikatorUbah/$1');
$routes->post('admin/kriteria-ed/ubah/(:segment)', 'Admin\KriteriaED::indikatorUbahPost/$1');
$routes->post('admin/kriteria-ed/hapus/(:segment)', 'Admin\KriteriaED::indikatorDelete/$1');

// FITUR ROLE AUDITI
$routes->get('auditi/form-ed', 'Auditi\FormEDController::create');
$routes->post('auditi/form-ed', 'Auditi\FormEDController::save');