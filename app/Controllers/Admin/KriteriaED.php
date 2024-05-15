<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FormEDModel;
use CodeIgniter\HTTP\ResponseInterface;

class KriteriaED extends BaseController
{

    private $formEd;
    public function __construct()
    {
        $this->formEd = new FormEDModel();
    }

    public function create()
    {
        $form = $this->formEd->select('indikator')->findAll();
 
        $form_filter = array_filter($form, function ($item) {
            return strlen($item['indikator']) > 12;
        });

        $indikator = [];
        foreach ($form_filter as $item) {
            $indikator[] = $item['indikator'];
        }

        $form_ed = array_unique($indikator);

        $data = [
            'title' => 'Tambah Kriteria ED',
            'currentPage' => 'kriteria-ed',
            'form_ed' => $form_ed,
        ];

        return view('admin/kriteriaED/create', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'indikator' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'standar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ],
            ],
            'kriteria' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'prodi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ],
            ],


        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        // uuid
        $uuid = service('uuid')->uuid4()->toString();

        $isSave = $this->formEd->save([
            'uuid' => $uuid,
            'indikator' => $this->request->getPost('indikator'),
            'standar' => $this->request->getPost('standar'),
            'kriteria' => $this->request->getPost('kriteria'),
            'program_studi' => $this->request->getPost('prodi'),

        ]);

        if ($isSave) {
            return redirect()->back()->with('sukses', 'Berhasil menambah ED');
        } else {
            return redirect()->back()->with('gagal', 'Gagal menambah ED');
        }
    }
}
