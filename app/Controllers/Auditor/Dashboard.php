<?php

namespace App\Controllers\Auditor;

use App\Controllers\BaseController;
use App\Models\AuditorModel;
use App\Models\ProdiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{

    private $auditor;
    private $prodi;
    public function __construct()
    {
        $this->auditor = new AuditorModel();
        $this->prodi = new ProdiModel();
    }

    public function index()
    {
        // variabel data yang dapat dikirimkan dan membuat sesuatu menjadi dinamis
        // contoh nya title sesuai halaman yang ditampilkan , jadi kita bisa kirim lewat sini
        // dan dikirkan melalui parameter ke 2 pada function view(..., $data);
        $id_user = session()->get('id');
        $auditor = $this->auditor->where('id_user', $id_user)->first();
        $prodi = $this->prodi->where('id', $auditor['id_prodi'])->first();
        
        
        $data = [
            'title' => 'Dashboard',
            'currentPage' => 'dashboard',
            'prodi' => $prodi,

        ];
        return view('auditor/dashboard', $data);
    }
}
