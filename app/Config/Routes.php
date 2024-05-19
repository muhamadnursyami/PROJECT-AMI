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
// jadwal periode admin
$routes->get('admin/jadwal-periode', 'Admin\JadwalED::index');
$routes->get('admin/jadwal-periode/create', 'Admin\JadwalED::create');
$routes->post('admin/jadwal-periode/save', 'Admin\JadwalED::save');
$routes->post('admin/jadwal-periode/update/(:num)', 'Admin\JadwalED::update/$1');
$routes->get('admin/jadwal-periode/edit/(:segment)', 'Admin\JadwalED::edit/$1');
$routes->delete('admin/jadwal-periode/(:num)', 'Admin\JadwalED::delete/$1');
// kelola kriteria ed admin
$routes->get('admin/kriteria-ed', 'Admin\KriteriaED::index');
$routes->get('admin/kriteria-ed/tambah', 'Admin\KriteriaED::create');
$routes->post('admin/kriteria-ed/tambah', 'Admin\KriteriaED::save');
$routes->get('admin/kriteria-ed/ubah/(:segment)', 'Admin\KriteriaED::update/$1');
$routes->post('admin/kriteria-ed/ubah/(:segment)', 'Admin\KriteriaED::updatePost/$1');
$routes->post('admin/kriteria-ed/hapus/(:segment)', 'Admin\KriteriaED::delete/$1');
// lihat ed admin
$routes->get('admin/kriteria-ed/view', 'Admin\ViewEDController::index');
$routes->get('admin/kriteria-ed/view/(:segment)', 'Admin\ViewEDController::view/$1');
// admin kelola standar
$routes->get('admin/kriteria-ed/tambah/standar', 'Admin\StandarController::index');
$routes->get('admin/kriteria-ed/tambah/standar/tambah', 'Admin\StandarController::create');
$routes->post('admin/kriteria-ed/tambah/standar/tambah', 'Admin\StandarController::createPost');
$routes->get('admin/kriteria-ed/tambah/standar/edit/(:segment)', 'Admin\StandarController::edit/$1');
$routes->post('admin/kriteria-ed/tambah/standar/edit/(:segment)', 'Admin\StandarController::editPost/$1');
$routes->post('admin/kriteria-ed/tambah/standar/hapus/(:segment)', 'Admin\StandarController::hapusPost/$1');

// FITUR ROLE AUDITI
// isi form ed
$routes->get('auditi/form-ed', 'Auditi\FormEDController::create');
$routes->post('auditi/form-ed', 'Auditi\FormEDController::save');
$routes->get('auditi/form-ed/ubah', 'Auditi\FormEDController::ubah');
$routes->post('auditi/form-ed/ubah', 'Auditi\FormEDController::ubahPost');


// FITUR ROLE AUDITOR
// lihat form ed
$routes->get('auditor/form-ed/view', 'Auditor\ViewEDAuditorController::index');
$routes->get('auditor/form-ed/view/(:segment)', 'Auditor\ViewEDAuditorController::view/$1');
