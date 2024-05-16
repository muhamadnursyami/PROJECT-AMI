<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FormEDModel;
use App\Models\IndikatorED;
use CodeIgniter\Database\Seeder;
use CodeIgniter\HTTP\ResponseInterface;

class KriteriaED extends BaseController
{

    private $formEd;
    private $indikatorEd;

    public function __construct()
    {
        $this->formEd = new FormEDModel();
        $this->indikatorEd = new IndikatorED();
    }

    public function create()
    {
        // $form = $this->formEd->select('indikator')->findAll();

        $form_ed = $this->indikatorEd->orderBy('indikator', 'ASC')->findAll();

        // $form_filter = array_filter($form, function ($item) {
        //     return strlen($item['indikator']) > 12;
        // });

        // $indikator = [];
        // foreach ($form_filter as $item) {
        //     $indikator[] = $item['indikator'];
        // }

        // $form_ed = array_unique($indikator);

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

        $data = [
            "uuid" => service('uuid')->uuid4()->toString(),
            "id_indikator" => $this->request->getVar('indikator'),
            "standar" => $this->request->getVar('standar'),
            "kriteria" => $this->request->getVar('kriteria'),
        ];
        

        $this->formEd->insert($data);

        return redirect()->back()->with('sukses', 'Berhasil menambah ED');
    }


    // indikator
    public function indikator()
    {

        $data = [
            'title' => 'Kelola Indikator ED',
            'currentPage' => 'kriteria-ed',
            'indikator' => $this->indikatorEd->orderBy('indikator', 'ASC')->findAll(),
        ];

        return view('admin/kriteriaED/createindikator', $data);
    }

    // indikator tambah
    public function indikatorCreate()
    {

        $data = [
            'title' => 'Tambah Indikator ED',
            'currentPage' => 'kriteria-ed',
        ];

        return view('admin/kriteriaED/indikatortambah', $data);
    }

    // indikator tambah post
    public function indikatorCreatePost()
    {


        $uuid = service('uuid')->uuid4()->toString();
        $isSave = $this->indikatorEd->save([
            'uuid' => $uuid,
            'indikator' => $this->request->getPost('indikator'),
        ]);

        if ($isSave) {
            return redirect()->to('/admin/kriteria-ed/indikator')->with('sukses', 'Berhasil menambah indikator ED');
        } else {
            return redirect()->back()->with('gagal', 'Gagal menambah indikator ED');
        }
    }

    // indikator ubah
    public function indikatorUbah($uuid)
    {

        $indikator = $this->indikatorEd->select('indikator')->where('uuid', $uuid)->first();

        $data = [
            'title' => 'Tambah Indikator ED',
            'currentPage' => 'kriteria-ed',
            'indikator' => $indikator,
            'uuid' => $uuid,
        ];

        return view('admin/kriteriaED/indikatorubah', $data);
    }

    // indikator ubah post
    public function indikatorUbahPost($uuid)
    {

        // coba update datanya
        $isSave = $this->indikatorEd->set('indikator', $this->request->getPost('indikator'))->where('uuid', $uuid)->update();

        if ($isSave) {
            return redirect()->to('/admin/kriteria-ed/indikator')->with('sukses', 'Berhasil mengubah indikator ED');
        } else {
            return redirect()->back()->with('gagal', 'Gagal menambah indikator ED');
        }
    }

    // indikator post hapus
    public function indikatorDelete($uuid)
    {
        $isDelete = $this->indikatorEd->where('uuid', $uuid)->delete();

        if ($isDelete) {
            return redirect()->to('/admin/kriteria-ed/indikator')->with('sukses', 'Berhasil menghapus indikator ED');
        } else {
            return redirect()->back()->with('gagal', 'Gagal menambah indikator ED');
        }
    }
}
