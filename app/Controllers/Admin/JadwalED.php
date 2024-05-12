<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JadwalPeriodeED;
use App\Models\JadwalPeriodeEDModel;
use CodeIgniter\HTTP\ResponseInterface;

class JadwalED extends BaseController
{
    protected $jadwal_periode_ED;
    public function __construct()
    {
        $this->jadwal_periode_ED = new JadwalPeriodeEDModel();
    }

    public function index()
    {
        $jadwalED = $this->jadwal_periode_ED->findAll();
        $data = [
            'title' => 'Jadwal Periode',
            'currentPage' => 'jadwalPeriode',
            'jadwalPeriodeED' => $jadwalED
        ];

        return view('admin/jadwalED/index', $data);
    }
}
