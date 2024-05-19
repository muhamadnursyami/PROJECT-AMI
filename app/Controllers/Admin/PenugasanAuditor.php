<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\ResponseInterface;

class PenugasanAuditor extends BaseController
{

    public function index()
    {

        $data = [
            'title' => 'Penentuan Auditor',
            'currentPage' => 'penugasanAuditor',

        ];
        return view('admin/penentuanAuditor/index', $data);
    }
}
