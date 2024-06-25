<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdiModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class KelolaAkunPengguna extends BaseController
{

    private $user;
    private $prodi;
    public function __construct()
    {
        $this->user = new UserModel();   
        $this->prodi = new ProdiModel();
    }

    public function index()
    {
        
        $user = $this->user->where('akses', 1)->findAll();
        // dd($user);
        $data = [
            'title' => "Kelola Data Akun",
            'currentPage' => 'kelola-akun-pengguna',
            'users' => $user,
        ];

        return view('admin/kelolaAkunPengguna/index', $data);

    }


    public function update($uuid){

        $user = $this->user->where('uuid', $uuid)->first();
        $prodi = $this->prodi->findAll();
        $role = ["auditor", "auditi", "admin", "pimpinan"];

        $data = [
            'title' => "Kelola Akun Pengguna",
            "currentPage" => 'kelola-akun-pengguna',
            'user' => $user,
            'uuid' => $uuid,
            'prodi' => $prodi,
            'role' => $role,
        ];

        return view('admin/kelolaAkunPengguna/kelola', $data);

    }

    public function updatePost($uuid){

        $data = [
            "id_prodi" => $this->request->getVar('prodi'),
            "role" => $this->request->getVar('role'),
        ];

        $this->user->set($data)->where('uuid', $uuid)->update();
        
        return redirect()->to("/admin/kelola-akun-pengguna")->withInput()->with('sukses', "Data berhasil disimpan");

    }


    public function hapus($uuid){
        $this->user->where('uuid', $uuid)->delete();
        return redirect()->to("/admin/kelola-akun-pengguna")->withInput()->with('sukses', "Berhasil menghapus data pengguna");
    }


}
