<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KriteriaModel;
use App\Models\KriteriaProdiModel;
use App\Models\LembagaAkreditasiModel;
use App\Models\PerubahanKriteriaModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class KriteriaED extends BaseController
{

    private $users;
    private $kriteria;
    private $kriteriaProdi;
    private $lembaga_akreditasi;
    private $perubahanKriteria;

    public function __construct()
    {

        $this->users = new UserModel();
        $this->kriteria = new KriteriaModel();
        $this->kriteriaProdi = new KriteriaProdiModel();
        $this->lembaga_akreditasi = new LembagaAkreditasiModel();
        $this->perubahanKriteria = new PerubahanKriteriaModel();

    }

    // kriteria
    // method crud (create (get & post), read, update(get & post), delete)

    // read criteria
    public function index(){

        $kriteria = $this->kriteria->select('kriteria.uuid as uuid ,lembaga_akreditasi.nama as lembaga_akreditasi, users.name, keterangan as kriteria, bobot, users.id_prodi')->join('lembaga_akreditasi', 'lembaga_akreditasi.id = kriteria.id_lembaga_akreditasi')->join('users', 'users.id = kriteria.id_user')->findAll();

        $data = [
            'title' => 'Kelola kriteria ED',
            'currentPage' => 'kriteria-ed',
            'kriteria' => $kriteria
        ];

        return view('admin/kriteriaED/kriteria', $data);

    }


    // create kriteria
    public function create()
    {

        $users = $this->users->select('id, email, name')->where('role', 'auditi')->findAll();
        $lembaga_akreditasi = $this->lembaga_akreditasi->findAll();
        

        $data = [
            'title' => 'Tambah Kriteria ED',
            'currentPage' => 'kriteria-ed',
            'lembaga_akreditasi' => $lembaga_akreditasi,
            'users' => $users,
        ];

        return view('admin/kriteriaED/create', $data);
    }

    // create kriteria post
    public function save()
    {

        if (!$this->validate([
            'lembaga_akreditasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'id_auditi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ],
            ],
            'bobot' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'numeric' => '{field} Harus berupa angka'
                ]
            ],

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            "uuid" => service('uuid')->uuid4()->toString(),
            'id_user' => $this->request->getPost('id_auditi'),
            'id_lembaga_akreditasi' => $this->request->getPost('lembaga_akreditasi'),
            "keterangan" => $this->request->getPost('keterangan'),
            'bobot' => $this->request->getPost('bobot'),
        ];
        

        $this->kriteria->insert($data);

        $dat = $this->kriteria->where("uuid", $data['uuid'])->first();
        $dat2 = $this->users->where("id", $data["id_user"])->first();

        // input ke kriteria prodi
        $data_kriteriaProdi = [
            'uuid' => service('uuid')->uuid4()->toString(),
            'id_kriteria' => $dat['id'],
            'id_prodi' => $dat2['id_prodi'],
        ];

        $this->kriteriaProdi->insert($data_kriteriaProdi);

        // input ke perubahan kriteria
        $data_perubahanKriteria = [
            'id_kriteria' => $dat['id'],
            'uuid' => service('uuid')->uuid4()->toString(),
        ];

        $this->perubahanKriteria->insert($data_perubahanKriteria);

        return redirect()->to('/admin/kriteria-ed')->with('sukses', 'Berhasil menambah ED');
    }

    // update kriteria
    public function update($uuid)
    {

        $kriteria = $this->kriteria->select('kriteria.uuid as uuid ,lembaga_akreditasi.nama as lembaga_akreditasi, lembaga_akreditasi.id as id_lembaga_akreditasi ,users.name, users.id as id_user, keterangan as kriteria, bobot, users.id_prodi')->join('lembaga_akreditasi', 'lembaga_akreditasi.id = kriteria.id_lembaga_akreditasi')->join('users', 'users.id = kriteria.id_user')->where('kriteria.uuid', $uuid)->first();
        $users = $this->users->select('id, email, name')->where('role', 'auditi')->findAll();
        $lembaga_akreditasi = $this->lembaga_akreditasi->findAll();

        $data = [
            'title' => 'Tambah Indikator ED',
            'currentPage' => 'kriteria-ed',
            'kriteria' => $kriteria,
            'users' => $users,
            'lembaga_akreditasi' => $lembaga_akreditasi,
            'uuid' => $uuid,
        ];

        return view('admin/kriteriaED/update', $data);
    }

    // update kriteria post
    public function updatePost($uuid)
    {   

        if (!$this->validate([
            'lembaga_akreditasi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'id_auditi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ],
            ],
            'bobot' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'numeric' => '{field} Harus berupa angka'
                ]
            ],

        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $data = [
            'id_user' => $this->request->getPost('id_auditi'),
            'id_lembaga_akreditasi' => $this->request->getPost('lembaga_akreditasi'),
            "keterangan" => $this->request->getPost('keterangan'),
            'bobot' => $this->request->getPost('bobot'),
        ];
        

        $this->kriteria->set($data)->where('uuid', $uuid)->update();
        
        $ambilKriteria = $this->kriteria->where('uuid', $uuid)->first();
        $ambilUser = $this->users->where('id', $data['id_user'])->first();

        // update juga data prodi di kriteria prodi semisalnya data di kriteria keubah auditinya, karna auditi beda prodi
        $dataKriteriaProdi = [
            'id_prodi' => $ambilUser['id_prodi'],
        ];

        $this->kriteriaProdi->set($dataKriteriaProdi)->where('id_kriteria', $ambilKriteria['id'])->update();

        return redirect()->to('/admin/kriteria-ed')->with('sukses', 'Berhasil mengubah ED');
    }

    // Delete kriteria
    public function delete($uuid)
    {

        $ambilKriteria = $this->kriteria->where('uuid', $uuid)->first();

        // hapus di kriteria dan kriteria prodi
        $this->kriteriaProdi->where('id_kriteria', $ambilKriteria['id'])->delete();
        $isDelete = $this->kriteria->where('uuid', $uuid)->delete();

        if ($isDelete) {
            return redirect()->to('/admin/kriteria-ed')->with('sukses', 'Berhasil menghapus ED');
        } else {
            return redirect()->back()->with('gagal', 'Gagal menambah indikator ED');
        }
    }
}
