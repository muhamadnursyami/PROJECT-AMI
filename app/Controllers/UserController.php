<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // menampilkan view login
    public function login()
    {
        return view('login');
    }

    // menampilkan view register
    public function register()
    {

        return view('register');
    }


    // register controller
    public function saveRegister()
    {

        // membuat uuid
        $uuid = service('uuid');
        $uuid4 = $uuid->uuid4();
        $uuid4String = $uuid4->toString();

        // validasi register
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => 'format harus berupa email',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // hash password menggunakan bcrypt
        $password = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);

        // save password
        $isSave = $this->userModel->save([
            'id' => $uuid4String,
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $password,
            'role' => $this->request->getPost('role'),
        ]);

        // cek berhasil register
        if ($isSave) {
            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            return redirect()->to('/');
        } else {
            session()->setFlashdata('email', 'Data Gagal ditambahkan');
            return redirect()->to('/');
        }
    }


    // post login controller
    public function postLogin()
    {

        // validasi login
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'valid_email' => 'pada kolom "Email", format harus berupa email',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ],
            ]

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // jika email ditemukan, maka akan return usernya
        $user = $this->userModel->where(['email' => $this->request->getVar('email')])->first();

        // jika email tidak ditemukan
        if (!$user) {
            session()->setFlashdata('email', 'Email atau password salah!');
            return redirect()->to('/');
        }

        // jika password salah
        if (!password_verify($this->request->getVar('password'), $user['password'])) {
            session()->setFlashdata('email', 'Email atau password salah!');
            return redirect()->to('/');
        }

        // // jika login berhasil
        return "Login Berhasil nama anda " . $user['name'] . " sebagai " .  $user['role'];

    }
}
