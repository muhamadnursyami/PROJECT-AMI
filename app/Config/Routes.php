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

// jadwal AMI
$routes->get('admin/jadwal-ami', 'Admin\Periode::index');
$routes->get('admin/jadwal-ami/create', 'Admin\Periode::create');
$routes->post('admin/jadwal-ami/save', 'Admin\Periode::save');
$routes->post('admin/jadwal-ami/update/(:num)', 'Admin\Periode::update/$1');
$routes->get('admin/jadwal-ami/edit/(:segment)', 'Admin\Periode::edit/$1');
$routes->delete('admin/jadwal-ami/(:num)', 'Admin\Periode::delete/$1');

// Kelola Auditor
$routes->get('admin/kelola-auditor', 'Admin\KelolaAuditor::index');
$routes->get('admin/kelola-auditor/tambah', 'Admin\KelolaAuditor::create');
$routes->post('admin/kelola-auditor/tambah', 'Admin\KelolaAuditor::save');
$routes->get('admin/kelola-auditor/ubah/(:segment)', 'Admin\KelolaAuditor::update/$1');
$routes->post('admin/kelola-auditor/ubah/(:segment)', 'Admin\KelolaAuditor::updatePost/$1');
$routes->post('admin/kelola-auditor/hapus/(:segment)', 'Admin\KelolaAuditor::delete/$1');

// Penugasan Auditor
$routes->get('admin/penugasan-auditor', 'Admin\PenugasanAuditor::index');
$routes->get('admin/penugasan-auditor/tambah', 'Admin\PenugasanAuditor::create');
$routes->get('/admin/penugasan-auditor/getProdiNameByAuditor/(:num)', 'Admin\PenugasanAuditor::getProdiNameByAuditor/$1');
$routes->post('admin/penugasan-auditor/tambah', 'Admin\PenugasanAuditor::save');
$routes->get('admin/penugasan-auditor/ubah/(:segment)', 'Admin\PenugasanAuditor::update/$1');
$routes->post('admin/penugasan-auditor/ubah/(:segment)', 'Admin\PenugasanAuditor::updatePost/$1');
$routes->post('admin/penugasan-auditor/hapus/(:segment)', 'Admin\PenugasanAuditor::delete/$1');

// Kelola Auditi
$routes->get('admin/kelola-auditi', 'Admin\KelolaAuditi::index');
// $routes->get('admin/kelola-auditi/tambah', 'Admin\KelolaAuditi::create');
// $routes->post('admin/kelola-auditi/tambah', 'Admin\KelolaAuditi::save');
$routes->get('admin/kelola-auditi/kelola/(:segment)', 'Admin\KelolaAuditi::kelola/$1');
$routes->post('admin/kelola-auditi/kelola/(:segment)', 'Admin\KelolaAuditi::kelolaPost/$1');
$routes->post('admin/kelola-auditi/hapus/(:segment)', 'Admin\KelolaAuditi::delete/$1');
// FITUR ROLE AUDITI
// isi form ed
$routes->get('auditi/form-ed', 'Auditi\FormEDController::create');
$routes->post('auditi/form-ed', 'Auditi\FormEDController::save');
$routes->get('auditi/form-ed/ubah', 'Auditi\FormEDController::ubah');
$routes->post('auditi/form-ed/ubah', 'Auditi\FormEDController::ubahPost');


// lihat berkas AUDIII
$routes->get('auditi/lihat-berkas', 'Auditi\LihatBerkas::index');



// FITUR ROLE AUDITOR
// lihat form ed
$routes->get('auditor/form-ed/view', 'Auditor\ViewEDAuditorController::index');
$routes->get('auditor/form-ed/view/(:segment)', 'Auditor\ViewEDAuditorController::create/$1');
$routes->post('auditor/form-ed/view/(:segment)', 'Auditor\ViewEDAuditorController::createPost/$1');

// FORM 1
// kop kelengkapan dokumen
$routes->get('auditor/form-1', 'Auditor\Form1::beranda');
$routes->get('auditor/form-1/(:segment)', 'Auditor\Form1::index/$1');
$routes->get('auditor/form-1/kop-kelengkapan-dokumen/(:segment)', 'Auditor\Form1::kopKelengkapanDokumen/$1');
$routes->post('auditor/form-1/kop-kelengkapan-dokumen/tambah/(:segment)', 'Auditor\Form1::kopKelengkapanDokumenPost/$1');
$routes->get('auditor/form-1/kop-kelengkapan-dokumen/ubah/(:segment)', 'Auditor\Form1::kopkelengkapanDokumenUpdate/$1');
$routes->post('auditor/form-1/kop-kelengkapan-dokumen/ubah/(:segment)', 'Auditor\Form1::kopkelengkapanDokumenUpdatePost/$1');
$routes->post('auditor/form-1/kop-kelengkapan-dokumen/hapus/(:segment)', 'Auditor\Form1::kopkelengkapanDokumenDelete/$1');
// kelengkapan dokumen
$routes->get('auditor/form-1/kelengkapan-dokumen/(:segment)', 'Auditor\Form1::kelengkapanDokumen/$1');
$routes->post('auditor/form-1/kelengkapan-dokumen/tambah/(:segment)', 'Auditor\Form1::kelengkapanDokumenPost/$1');

$routes->get('auditor/form-1/kelengkapan-dokumen/ubah/(:segment)', 'Auditor\Form1::kelengkapanDokumenUpdate/$1');
$routes->post('auditor/form-1/kelengkapan-dokumen/ubah/(:segment)', 'Auditor\Form1::kelengkapanDokumenUpdatePost/$1');
$routes->post('auditor/form-1/kelengkapan-dokumen/hapus/(:segment)', 'Auditor\Form1::kelengkapanDokumenDelete/$1');

// FORM 3 - catatan audit
$routes->get('auditor/form-3', 'Auditor\Form3::beranda');
$routes->get('auditor/form-3/(:segment)', 'Auditor\Form3::index/$1');
$routes->get('auditor/form-3/catatan-audit/tambah/positif/(:segment)', 'Auditor\Form3::createCatatanPositif/$1');
$routes->get('auditor/form-3/catatan-audit/tambah/negatif/(:segment)', 'Auditor\Form3::createCatatanNegatif/$1');
$routes->post('auditor/form-3/catatan-audit/tambah/positif/(:segment)', 'Auditor\Form3::createCatatanPositifPost/$1');
$routes->post('auditor/form-3/catatan-audit/tambah/negatif/(:segment)', 'Auditor\Form3::createCatatanNegatifPost/$1');
$routes->get('auditor/form-3/catatan-audit/ubah/positif/(:segment)', 'Auditor\Form3::updateCatatanPositif/$1');
$routes->get('auditor/form-3/catatan-audit/ubah/negatif/(:segment)', 'Auditor\Form3::updateCatatanNegatif/$1');
$routes->post('auditor/form-3/catatan-audit/ubah/positif/(:segment)', 'Auditor\Form3::updateCatatanPositifPost/$1');
$routes->post('auditor/form-3/catatan-audit/ubah/negatif/(:segment)', 'Auditor\Form3::updateCatatanNegatifPost/$1');
$routes->post('auditor/form-3/catatan-audit/positif/hapus/(:segment)', 'Auditor\Form3::catatanPositifDelete/$1');
$routes->post('auditor/form-3/catatan-audit/negatif/hapus/(:segment)', 'Auditor\Form3::catatanNegatifDelete/$1');

// FORM 4 ringkasan temuan
$routes->get('auditor/form-4', 'Auditor\Form4::beranda');
$routes->get('auditor/form-4/(:segment)', 'Auditor\Form4::index/$1');
$routes->get('auditor/form-4/ringkasan-temuan/(:segment)', 'Auditor\Form4::ringkasanTemuan/$1');
$routes->post('auditor/form-4/ringkasan-temuan/tambah/(:segment)', 'Auditor\Form4::ringkasanTemuanPost/$1');
$routes->get('auditor/form-4/ringkasan-temuan/ubah/(:segment)/(:segment)', 'Auditor\Form4::ringkasanTemuanUpdate/$1/$2');
$routes->post('auditor/form-4/ringkasan-temuan/ubah/(:segment)', 'Auditor\Form4::ringkasanTemuanUpdatePost/$1');
$routes->post('auditor/form-4/ringkasan-temuan/hapus/(:segment)/(:segment)', 'Auditor\Form4::ringkasanTemuanDelete/$1/$2');
$routes->get('auditor/form-4/ringkasan-temuan/pdf/(:segment)', 'Auditor\Form4::PDFRingkasanTemuan/$1');


// FORM 5 Deskripsi Temuan Audit
$routes->get('auditor/form-5', 'Auditor\Form5::beranda');
$routes->get('auditor/form-5/(:segment)', 'Auditor\Form5::index/$1');
$routes->post('auditor/form-5/(:segment)', 'Auditor\Form5::create/$1');
$routes->get('auditor/form-5/kelola/(:segment)', 'Auditor\Form5::kelola/$1');
$routes->get('auditor/form-5/kelola/(:segment)/(:segment)', 'Auditor\Form5::kelolaUbah/$1/$2');
$routes->post('auditor/form-5/kelola/(:segment)/(:segment)', 'Auditor\Form5::kelolaUbahPost/$1/$2');
$routes->post('auditor/form-5/kelola/(:segment)/(:segment)/hapus', 'Auditor\Form5::kelolaDeletePost/$1/$2');
$routes->get('auditor/form-5/deskripsi-temuan/pdf/(:segment)', 'Auditor\Form5::PDFDeskripsiTemuan/$1');

// UPLOAD BERKAS
$routes->get('auditor/upload-berkas', 'Auditor\UploadBerkas::beranda');
$routes->get('auditor/upload-berkas/(:segment)', 'Auditor\UploadBerkas::index/$1');
$routes->get('auditor/upload-berkas/form-upload/(:segment)', 'Auditor\UploadBerkas::formUpload/$1');
$routes->post('auditor/upload-berkas/form-upload/tambah/(:segment)', 'Auditor\UploadBerkas::formUploadPost/$1');

$routes->get('auditor/upload-berkas/form-upload/(:segment)/ubah/(:segment)', 'Auditor\UploadBerkas::formUploadUpdate/$1/$2');
$routes->post('auditor/upload-berkas/form-upload/(:segment)/ubah/(:segment)', 'Auditor\UploadBerkas::formUploadUpdatePost/$1/$2');
$routes->post('auditor/upload-berkas/(:segment)/delete/(:segment)', 'Auditor\UploadBerkas::formUploadDelete/$1/$2');


// PIMPINAN
$routes->get('pimpinan/lihat-berkas', 'Pimpinan\LihatBerkas::index');
