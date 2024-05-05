<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        // variabel data yang dapat dikirimkan dan membuat sesuatu menjadi dinamis
        // contoh nya title sesuai halaman yang ditampilkan , jadi kita bisa kirim lewat sini
        // dan dikirkan melalui parameter ke 2 pada function view(..., $data);
        $data = [
            'title' => 'Dashboard'
        ];
        return view('admin/dashboard', $data);
    }
}
