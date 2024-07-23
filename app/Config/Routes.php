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
// kelola kriteria ed admin untuk prodi
$routes->get('admin/kriteria-ed', 'Admin\KriteriaED::index');
$routes->get('admin/kriteria-ed/tambah', 'Admin\KriteriaED::create');
$routes->post('admin/kriteria-ed/tambah', 'Admin\KriteriaED::save');
$routes->get('admin/kriteria-ed/ubah/(:segment)', 'Admin\KriteriaED::update/$1');
$routes->post('admin/kriteria-ed/ubah/(:segment)', 'Admin\KriteriaED::updatePost/$1');
$routes->post('admin/kriteria-ed/hapus/(:segment)', 'Admin\KriteriaED::delete/$1');
// kelola kriteria ed admin untuk semua prodi
$routes->get('admin/kriteria-ed/universitas/tambah', 'Admin\KriteriaED::createUniv');
$routes->post('admin/kriteria-ed/universitas/tambah', 'Admin\KriteriaED::saveUniv');
// admin hapus kriteria ed multiple
$routes->post('admin/kriteria-ed/hapus-multiple', 'Admin\KriteriaED::deleteMultiple');


// lihat ed admin
$routes->get('admin/kriteria-ed/view', 'Admin\ViewEDController::index');
$routes->get('admin/kriteria-ed/view/(:segment)', 'Admin\ViewEDController::view/$1');
// admin delete kriteria ed
$routes->post('admin/kriteria-ed/view/delete', 'Admin\ViewEDController::delete');

// lihat FORM 3 admin
$routes->get('admin/form3/view', 'Admin\ViewForm3Controller::index');
$routes->get('admin/form3/view/(:segment)', 'Admin\ViewForm3Controller::view/$1');
// admin delete FORM 3
$routes->post('admin/form3/view/delete', 'Admin\ViewForm3Controller::delete');


// lihat FORM 4 admin
$routes->get('admin/form4/view', 'Admin\ViewForm4Controller::index');
$routes->get('admin/form4/view/(:segment)', 'Admin\ViewForm4Controller::view/$1');


// Lihat form 5 admin
$routes->get('admin/form5/view', 'Admin\ViewForm5Controller::index');
$routes->get('admin/form5/view/(:segment)', 'Admin\ViewForm5Controller::view/$1');
$routes->get('admin/form5/view/deskripsi-temuan/(:segment)', 'Admin\ViewForm5Controller::kelola/$1');
$routes->get('admin/form5/view/deskripsi-temuan/(:segment)/(:segment)', 'Admin\ViewForm5Controller::viewDetail/$1/$2');

// admin kelola standar
$routes->get('admin/kriteria-ed/tambah/standar', 'Admin\StandarController::index');
$routes->get('admin/kriteria-ed/tambah/standar/tambah', 'Admin\StandarController::create');
$routes->post('admin/kriteria-ed/tambah/standar/tambah', 'Admin\StandarController::createPost');
$routes->get('admin/kriteria-ed/tambah/standar/edit/(:segment)', 'Admin\StandarController::edit/$1');
$routes->post('admin/kriteria-ed/tambah/standar/edit/(:segment)', 'Admin\StandarController::editPost/$1');
$routes->post('admin/kriteria-ed/tambah/standar/hapus/(:segment)', 'Admin\StandarController::hapusPost/$1');

// admin kelola data pengguna
$routes->get('admin/kelola-data', 'Admin\KelolaUserController::index');
$routes->get('admin/kelola-data/(:segment)', 'Admin\KelolaUserController::detail/$1');
$routes->post('admin/kelola-data/(:segment)', 'Admin\KelolaUserController::savePassword/$1');

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

// admin kelola prodi
$routes->get('admin/kelola-prodi', 'Admin\KelolaProdi::index');
$routes->get('admin/kelola-prodi/tambah', 'Admin\KelolaProdi::tambah');
$routes->post('admin/kelola-prodi/tambah', 'Admin\KelolaProdi::tambahPost');
$routes->get('admin/kelola-prodi/edit/(:segment)', 'Admin\KelolaProdi::edit/$1');
$routes->post('admin/kelola-prodi/edit/(:segment)', 'Admin\KelolaProdi::editPost/$1');
$routes->post('admin/kelola-prodi/hapus/(:segment)', 'Admin\KelolaProdi::hapus/$1');

// admin kelola lembaga akreditasi
$routes->get('admin/kelola-lembaga-akreditasi', 'Admin\KelolaLembagaAkreditasi::index');
$routes->get('admin/kelola-lembaga-akreditasi/tambah', 'Admin\KelolaLembagaAkreditasi::tambah');
$routes->post('admin/kelola-lembaga-akreditasi/tambah', 'Admin\KelolaLembagaAkreditasi::tambahPost');
$routes->get('admin/kelola-lembaga-akreditasi/edit/(:segment)', 'Admin\KelolaLembagaAkreditasi::edit/$1');
$routes->post('admin/kelola-lembaga-akreditasi/edit/(:segment)', 'Admin\KelolaLembagaAkreditasi::editPost/$1');
$routes->post('admin/kelola-lembaga-akreditasi/hapus/(:segment)', 'Admin\KelolaLembagaAkreditasi::hapus/$1');

// admin kelola akses akun pengguna
$routes->get('admin/kelola-akses', 'Admin\KelolaAkunController::index');
$routes->post('admin/kelola-akses/terima/(:segment)', 'Admin\KelolaAkunController::terima/$1');
$routes->post('admin/kelola-akses/tolak/(:segment)', 'Admin\KelolaAkunController::tolak/$1');

// admin kelola akun pengguna (role dan prodi)
$routes->get('admin/kelola-akun-pengguna', 'Admin\KelolaAkunPengguna::index');
$routes->get('admin/kelola-akun-pengguna/kelola/(:segment)', 'Admin\KelolaAkunPengguna::update/$1');
$routes->post('admin/kelola-akun-pengguna/kelola/(:segment)', 'Admin\KelolaAkunPengguna::updatePost/$1');
$routes->post('admin/kelola-akun-pengguna/hapus/(:segment)', 'Admin\KelolaAkunPengguna::hapus/$1');

// FITUR ROLE AUDITI
// isi form ed
$routes->get('auditi/form-ed', 'Auditi\FormEDController::create');
$routes->post('auditi/form-ed', 'Auditi\FormEDController::save');
$routes->get('auditi/form-ed/ubah', 'Auditi\FormEDController::ubah');
$routes->post('auditi/form-ed/ubah', 'Auditi\FormEDController::ubahPost');


// lihat berkas AUDIII
$routes->get('auditi/lihat-berkas', 'Auditi\LihatBerkas::index');

// Kelola data auditi
$routes->get('auditi/kelola-data', 'Auditi\KelolaAuditiController::index');
$routes->post('auditi/kelola-data', 'Auditi\KelolaAuditiController::savePassword');


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

// FORM 2
$routes->get('auditor/form-2', 'Auditor\Form2::index');
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
$routes->get('auditor/form-3/catatan-audit/pdf/(:segment)', 'Auditor\Form3::PDFCatatanAudit/$1');


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

// ubah data auditor
$routes->get('auditor/kelola-data', 'Auditor\KelolaAuditorController::index');
$routes->post('auditor/kelola-data', 'Auditor\KelolaAuditorController::savePassword');


// PIMPINAN
$routes->get('pimpinan/lihat-berkas', 'Pimpinan\LihatBerkas::index');
// ubah data pimpinan
$routes->get('pimpinan/kelola-data', 'Pimpinan\KelolaPimpinanController::index');
$routes->post('pimpinan/kelola-data', 'Pimpinan\KelolaPimpinanController::savePassword');
