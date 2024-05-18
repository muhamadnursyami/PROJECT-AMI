<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JadwalAMIModel;
use CodeIgniter\HTTP\ResponseInterface;

class JadwalAMI extends BaseController
{
    protected $jadwal_AMI_Model;
    public function __construct()
    {
        $this->jadwal_AMI_Model = new JadwalAMIModel();
    }

    public function index()
    {

        $jadwalAMI = $this->jadwal_AMI_Model->getJadwalAMI();
        $data = [
            'title' => 'Jadwal AMI',
            'currentPage' => 'jadwalAMI',
            'jadwalAMI' => $jadwalAMI,
            'showAddButton' => count($jadwalAMI) == 0
        ];

        return view('admin/jadwalAMI/index', $data);
    }

    public function create()
    {

        $data = [
            'title' => 'Form Tambah Jadwal AMI',
            'currentPage' => 'jadwalAMI',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),

        ];
        return view("admin/jadwalAMI/create", $data);
    }

    public function save()
    {
        if (!$this->validate([
            'tanggal_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Mulai harus diisi !'
                ]
            ],
            'tanggal_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Selesai harus diisi !'
                ]
            ]
        ])) {

            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/jadwal-ami/create')->withInput();
        }

        // membuat uuid
        $uuid = service('uuid');
        $uuid4 = $uuid->uuid4();
        $uuid4String = $uuid4->toString();
        // dd($this->request->getVar());
        $this->jadwal_AMI_Model->save([
            'uuid' => $uuid4String,
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ]);


        session()->setFlashdata('pesan', 'Jadwal Berhasil ditambahkan');
        return redirect()->to('/admin/jadwal-ami');
    }

    public function delete($id)
    {
        $this->jadwal_AMI_Model->delete($id);
        session()->setFlashdata('pesan', "Jadwal Berhasil dihapus");
        return redirect()->to('/admin/jadwal-ami');
    }

    public function edit($uuid)
    {
        $jadwalAMI = $this->jadwal_AMI_Model->getJadwalAMI($uuid);
        $data = [
            'title' => 'Form Edit Jadwal',
            'validation' => session()->getFlashdata('validation') ?? \Config\Services::validation(),
            'currentPage' => 'jadwalAMI',
            'jadwalAMI' => $jadwalAMI
        ];

        return view('admin/jadwalAMI/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'tanggal_mulai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Mulai harus diisi !'
                ]
            ],
            'tanggal_selesai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal Selesai harus diisi !'
                ]
            ]
        ])) {

            session()->setFlashdata('validation', \Config\Services::validation());
            return redirect()->to('/admin/jadwal-ami/edit/' . $this->request->getVar('uuid'))->withInput();
        }

        $this->jadwal_AMI_Model->save([
            'id' => $id,
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ]);


        session()->setFlashdata('pesan', 'Jadwal Berhasil diubah');
        return redirect()->to('/admin/jadwal-ami');
    }
}
