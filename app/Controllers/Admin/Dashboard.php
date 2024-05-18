<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JadwalAMIModel;
use App\Models\JadwalPeriodeEDModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    protected $jadwal_periode_ED_Model;
    protected $jadwal_AMI_Model;
    public function __construct()
    {
        $this->jadwal_periode_ED_Model = new JadwalPeriodeEDModel();
        $this->jadwal_AMI_Model = new JadwalAMIModel();
    }

    public function index()
    {
        // variabel data yang dapat dikirimkan dan membuat sesuatu menjadi dinamis
        // contoh nya title sesuai halaman yang ditampilkan , jadi kita bisa kirim lewat sini
        // dan dikirkan melalui parameter ke 2 pada function view(..., $data);

        $jadwalPeriodeED = $this->jadwal_periode_ED_Model->getJadwalPeriodeED();
        $jadwalAMI = $this->jadwal_AMI_Model->getJadwalAMI();
        $data = [
            'title' => 'Dashboard',
            'currentPage' => 'dashboard',
            'jadwalPeriodeED' => $jadwalPeriodeED,
            'jadwalAMI' => $jadwalAMI
        ];
        return view('admin/dashboard', $data);
    }
}
