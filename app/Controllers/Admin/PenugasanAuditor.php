<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AuditorModel;
use App\Models\PenugasanAuditorModel;
use App\Models\ProdiModel;
use App\Models\PeriodeModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpParser\Node\Stmt\Return_;

class PenugasanAuditor extends BaseController
{
    protected $auditor;
    protected $prodi;
    protected $penugasanAuditor;
    protected $periode_Model;
    public function __construct()
    {
        $this->auditor = new AuditorModel();
        $this->prodi = new ProdiModel();
        $this->penugasanAuditor = new PenugasanAuditorModel();
        $this->periode_Model = new PeriodeModel();
    }
    public function index()
    {
        $penugasanAuditor = $this->penugasanAuditor->select('penugasan_auditor.uuid as uuid, auditor.nama as nama, prodi.nama as prodi, periode.tanggal_mulai, periode.tanggal_selesai')->join('auditor', 'auditor.id = penugasan_auditor.id_auditor')->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')->join('periode', 'periode.id = penugasan_auditor.id_periode')->findAll();
        // dd($penugasanAuditor);
        $data = [
            'title' => 'Penugasan Auditor',
            'currentPage' => 'penugasanAuditor',
            'penugasanAuditor' => $penugasanAuditor
        ];
        return view('admin/penugasanAuditor/index', $data);
    }

    public function create()
    {
        $prodi = $this->prodi->findAll();
        $auditor = $this->auditor->findAll();

        $data = [
            'title' => 'Tambah Penugasan Auditor',
            'currentPage' => 'penugasanAuditor',
            'auditor' => $auditor,
            'prodi' => $prodi
        ];

        return view('admin/penugasanAuditor/create', $data);
    }


    public function save()
    {
        if (!$this->validate([
            'auditor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'prodi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $periode = $this->periode_Model->select('id')->first();

        $data = [
            "uuid" => service('uuid')->uuid4()->toString(),
            'id_auditor' => $this->request->getPost('auditor'),
            'id_prodi' => $this->request->getPost('prodi'),
            'id_periode' => $periode
        ];

        $this->penugasanAuditor->insert($data);

        return redirect()->to('admin/penugasan-auditor')->with('sukses', 'Berhasil menambah Penugasan Auditor');
    }


    public function update($uuid)
    {
        $penugasanAuditor = $this->penugasanAuditor->select('penugasan_auditor.uuid as uuid, auditor.id as id_auditor,prodi.id as id_prodi , auditor.nama as nama, prodi.nama as prodi, periode.tanggal_mulai, periode.tanggal_selesai')->join('auditor', 'auditor.id = penugasan_auditor.id_auditor')->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')->join('periode', 'periode.id = penugasan_auditor.id_periode')->where('penugasan_auditor.uuid', $uuid)->first();
        $prodi = $this->prodi->findAll();
        $auditor = $this->auditor->findAll();
        $data = [
            'title' => "Ubah Penugasan Auditor",
            'currentPage' => 'penugasanAuditor',
            'penugasanAuditor' => $penugasanAuditor,
            'prodi' => $prodi,
            'auditor' => $auditor,
            'uuid' => $uuid
        ];


        return view('admin/penugasanAuditor/update', $data);
    }


    public function updatePost($uuid)
    {
        if (!$this->validate([
            'auditor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'prodi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id_auditor' => $this->request->getPost('auditor'),
            'id_prodi' => $this->request->getPost('prodi'),
        ];

        $this->penugasanAuditor->set($data)->where('uuid', $uuid)->update();
        return redirect()->to('/admin/penugasan-auditor')->with('sukses', 'Berhasil mengubah Penugasan Auditor');
    }
    public  function delete($uuid)
    {
        $this->penugasanAuditor->where('uuid', $uuid)->delete();

        return redirect()->to('/admin/penugasan-auditor')->with('sukses', 'Berhasil menghapus Penugasan auditor');
    }
}
