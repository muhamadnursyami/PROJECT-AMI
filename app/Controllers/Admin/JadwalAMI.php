<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JadwalPeriodeED;
use App\Models\JadwalPeriodeEDModel;
use CodeIgniter\HTTP\ResponseInterface;

class JadwalAMI extends BaseController
{


    public function index()
    {


        $data =  [
            'title' => 'Jadwal AMI',
            'currentPage' => 'jadwalAMI'
        ];

        return view('admin/jadwalAMI/index', $data);
    }
}
