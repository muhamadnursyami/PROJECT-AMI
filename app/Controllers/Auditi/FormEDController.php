<?php

namespace App\Controllers\Auditi;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class FormEDController extends BaseController
{
    public function create()
    {

        $data = [
            'title' => 'Isi Form ED',
            'currentPage' => 'form-ed',
        ];
        return view('auditi/create', $data);
    }
}
