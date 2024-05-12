<?php

namespace App\Controllers;

use App\Database\Migrations\User;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        // menjalankan validation 
        $data = [
            'validation' => \Config\Services::validation()
        ];

        // Logic pengecekan jika user sudah login berdasarkan role, maka user tidak bisa mengakses halaman login
        if (session()->get('logged_in')) {
            $role = session()->get('role_id');
            if (in_array($role, ['admin', 'pimpinan', 'auditor', 'audit'])) {
                return redirect()->to("/{$role}/dashboard");
            }
        }
        return view('login', $data);
    }

    public function login_action()
    {
        // membuat rules untuk validation
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required'
        ];

        // Memngecek rules apakah sudah mengikuti aturan
        if (!$this->validate($rules)) {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');


            // cek email atau password jika string kosong atau null
            if ($email == "" || $email == null || $password == "" || $password == null) {
                session()->setFlashdata('pesan', 'Email atau Password masih kosong');
                session()->setFlashdata('alert_type', 'danger');
                return redirect()->to('/')->withInput();
            }

            // ambil dari variable data diatas ambil keynya itu validator
            $data['validation'] = $this->validator;

            return view('login', $data);
        } else {
            // menginisialisasi session
            $session = session();
            // menginisalisasi model
            $userModel = new UserModel();

            // mengambil data email  dan password dari inputan user
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            // mengambil data email dari database 
            $cekEmail = $userModel->where('email', $email)->first();

            // Kemudian di cek, Ketika email nya tidak ada maka akan menampikan session berupa flashData
            // yang bernama pesan yang isi messagenya: Email atau password anda salah dan arahkan 
            // balik ke halaman login
            if ($cekEmail) {
                // jika email benar maka akan cek passwordnya
                // ambil password dari database yang kita paramter nya itu kita ambil dari email yang
                // sudah kita cek, dan kita ambil data passwordnya
                $password_db = $cekEmail['password'];
                // $hash = password_hash($password, PASSWORD_BCRYPT);
                // if (password_verify($password, $password_db)) {
                //     echo 'Password is valid!';
                // } else {
                //     echo 'Invalid password.';
                //     echo 'Hashed password: ' . $hash;
                //     echo 'Password from DB: ' . $password_db;
                // }
                // dd($password_db, $password);
                // kita cek menggunakan function password_verify yang parameter 1 itu adalah
                // password yang user inputkan dan parameter kedua itu password dari db
                $cekPassword = password_verify($password, $password_db);

                // dd($cekPassword);
                if ($cekPassword) {

                    //  variabel  $session_data, digunakan untuk menampung semua data yang ingin
                    // disimpan.
                    $session_data = [
                        'logged_in' => TRUE,
                        'role_id' => $cekEmail['role'],
                        'name' => $cekEmail['name'],
                    ];

                    // masukan/tambah data  $session_data kedalam session aslinya 
                    $session->set($session_data);
                    // pengecekan role, jika sesuai dengan ketentuan akan di arahakan/didrect kedalam 
                    // routing tertentu 
                    switch ($cekEmail['role']) {
                        case 'admin':
                            return redirect()->to('admin/dashboard');
                        case 'auditor':
                            return redirect()->to('auditor/dashboard');
                        case 'auditi':
                            return redirect()->to('auditi/dashboard');
                        case 'pimpinan':
                            return redirect()->to('pimpinan/dashboard');
                        default:
                            // menambahkan session dengan mengguakan function setFlashdata
                            // yang namanya itu adalah pesan dan isi pesanya itu adalah anda belum terdafatr
                            $session->setFlashdata('pesan', 'Anda belum terdaftar !!!');
                            // menambahkan session juga, dengan nama alert type dan isi nya itu danger
                            session()->setFlashdata('alert_type', 'danger');
                            return redirect()->to('/');
                    }
                } else {
                    $session->setFlashdata('pesan', 'Password anda salah');
                    session()->setFlashdata('alert_type', 'danger');
                    return redirect()->to('/')->withInput();
                }
            } else {
                $session->setFlashdata('pesan', ' Email anda salah');
                session()->setFlashdata('alert_type', 'danger');
                return redirect()->to('/')->withInput();
            }
        }
    }

    public function logout()
    {
        $session = session();
        // menghapus semua session yang telah di simpan 
        $session->destroy();
        return redirect()->to('/');
    }
}
