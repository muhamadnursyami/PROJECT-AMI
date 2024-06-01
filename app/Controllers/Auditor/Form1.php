<?php

namespace App\Controllers\Auditor;

use App\Models\PenugasanAuditorModel;
use App\Models\PeriodeModel;
use App\Models\AuditorModel;
use App\Models\UserModel;

use App\Models\KriteriaProdiModel;
use App\Controllers\BaseController;
use App\Models\DokumenModel;
use App\Models\KelengkapanDokumenModel;
use App\Models\KopKelengkapanDokumenModel;
use App\Models\KriteriaModel;
use App\Models\ProdiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Form1 extends BaseController
{
    protected $auditor;
    protected $penugasanAuditor;
    protected $periode_Model;
    protected $users;
    protected $prodi;
    protected $kriteriaProdi;
    protected $kelengkapanDokumen;
    protected $kopkelengkapanDokumen;
    protected $kriteria;

    public function __construct()
    {
        $this->kriteriaProdi = new KriteriaProdiModel();
        $this->auditor = new AuditorModel();
        $this->penugasanAuditor = new PenugasanAuditorModel();
        $this->periode_Model = new PeriodeModel();
        $this->users = new UserModel();
        $this->prodi = new ProdiModel();
        $this->kriteria = new KriteriaModel();
        $this->kopkelengkapanDokumen = new KopKelengkapanDokumenModel();
        $this->kelengkapanDokumen = new KelengkapanDokumenModel();
    }

    public function index()
    {
        $id_user = session()->get('id');
        $auditor = $this->auditor->where('id_user', $id_user)->first();
        if (!$auditor) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Auditor not found");
        }

        // Get all prodi ids associated with the current auditor
        $prodiIds = $this->penugasanAuditor->select('id_prodi')
            ->where('id_auditor', $auditor['id'])
            ->findColumn('id_prodi');

        if (empty($prodiIds)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("No prodi found for the auditor");
        }

        // Get all assignments for the prodi ids
        $penugasan_auditor = $this->penugasanAuditor->whereIn('id_prodi', $prodiIds)->findAll();

        $isKetua = $this->penugasanAuditor->where('id_auditor', $auditor['id'])->first();

        $kriteriaProdi = [];
        foreach ($penugasan_auditor as $value) {
            $kriteriaProdi[] = $this->kriteriaProdi->select('capaian, akar_penyebab, tautan_bukti, kriteria, bobot, prodi.nama as nama, prodi.uuid as uuid_prodi, fakultas, users.name as nama_user, users.id_prodi as id_prodi')
                ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
                ->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
                ->join('users', 'users.id_prodi = prodi.id')
                ->where('users.id_prodi', $value['id_prodi'])
                ->findAll();
        }

        $dataProdi = [];
        $dataAuditi = [];
        $uuidProdi = [];

        foreach ($kriteriaProdi as $value) {
            foreach ($value as $item) {
                array_push($dataProdi, $item['nama']);
                array_push($dataAuditi, $item['nama_user']);
                array_push($uuidProdi, $item['uuid_prodi']);
            }
        }

        $dataAuditi = array_unique($dataAuditi);
        $dataProdi = array_unique($dataProdi);
        $uuidProdi = array_unique($uuidProdi);

        $dataKopKelengkapanDokumen = [];
        $dataKelengkapanDokumen = [];

        foreach ($penugasan_auditor as $penugasan) {
            $kopDokumen = $this->kopkelengkapanDokumen->where('id_penugasan_auditor', $penugasan['id'])->first();
            if ($kopDokumen) {
                $dataKopKelengkapanDokumen[] = $kopDokumen;
            }
        }

        foreach ($penugasan_auditor as $penugasan) {
            $kelengkapanDokumen = $this->kelengkapanDokumen->where('id_penugasan_auditor', $penugasan['id'])->findAll();
            if ($kelengkapanDokumen) {
                foreach ($kelengkapanDokumen as &$dokumen) {
                    $kriteria = $this->kriteria->select('kode_kriteria')->where('id', $dokumen['id_kriteria'])->first();
                    if ($kriteria) {
                        $dokumen['kode_kriteria'] = $kriteria['kode_kriteria'];
                    }
                }
                $dataKelengkapanDokumen[] = $kelengkapanDokumen;
            }
        }

        $data = [
            'title' => 'Form 1',
            'currentPage' => 'form-1',
            'uuid_prodi' => $uuidProdi,
            'dataKopKelengkapanDokumen' => $dataKopKelengkapanDokumen,
            'dataKelengkapanDokumen' => $dataKelengkapanDokumen,
            'isKetua' => $isKetua
        ];

        return view('auditor/form1/index', $data);
    }



    public function kopKelengkapanDokumen($uuid2)
    {
        $uuid = session()->get('uuid');
        $user = $this->users->where('uuid', $uuid)->first();
        $auditor = $this->auditor->where('id_user', $user['id'])->first();
        $penugasan_auditor = $this->penugasanAuditor->where('id_auditor', $auditor['id'])->first();


        // Mendapatkan nama prodi dari id_prodi yang didapat dari tabel penugasan auditor
        $prodiId = $penugasan_auditor['id_prodi'];
        $prodiName = $this->prodi->getProdiNameById($prodiId);

        // Mendapatkan semua data dari tabel penugasan auditor yang memiliki id prodinya sama dengan id dari auditor yang sedang aktif
        $penugasan_auditor_with_same_prodi = $this->penugasanAuditor->where('id_prodi', $prodiId)->findAll();

        // Mendapatkan informasi tambahan dari hasil penugasan auditor
        $auditor_ketua = [];
        $auditor_anggota = [];

        foreach ($penugasan_auditor_with_same_prodi as $pa) {
            $auditor_name = $this->auditor->getAuditorNameById($pa['id_auditor']);
            if ($pa['ketua'] == 1) {
                $auditor_ketua[] = $auditor_name;
            } else {
                $auditor_anggota[] = $auditor_name;
            }
        }
        $periode_Model = $this->periode_Model->first();

        $data = [
            'title' => 'Kop Kelengkapan Dokumen',
            'currentPage' => 'form-1',
            'lokasi' => $prodiName,
            'auditor_ketua' => $auditor_ketua,
            'auditor_anggota' => $auditor_anggota,
            'periode' => $periode_Model,
            'id_penugasanAuditor' => $penugasan_auditor,
            'uuid2' => $uuid2

        ];
        return view("auditor/form1/kopkelengkapandokumen/createKopKelengkapanDokumen", $data);
    }

    public function kopKelengkapanDokumenPost()
    {

        $data = [
            "uuid" => service('uuid')->uuid4()->toString(),
            'lokasi' => $this->request->getPost('lokasi'),
            'ruang_lingkup' => $this->request->getPost('ruang_lingkup'),
            'tanggal_audit' => $this->request->getPost('tanggal_audit'),
            'wakil_auditi' => $this->request->getPost('wakil_auditi'),
            'auditor_ketua' => $this->request->getPost('auditor_ketua'),
            'auditor_anggota' => $this->request->getPost('auditor_anggota'),
            'id_penugasan_auditor' => $this->request->getPost('id_penugasanAuditor')
        ];

        $this->kopkelengkapanDokumen->insert($data);
        return redirect()->to("/auditor/form-1")->with('sukses', 'Berhasil menyimpan data kop kelengkapan dokumen');
    }


    public function kopkelengkapanDokumenUpdate($uuid)
    {
        $kopkelengkapanDokumen = $this->kopkelengkapanDokumen->where('uuid', $uuid)->first();

        $data = [
            'title' => 'Ubah Kop Kelengkapan Dokumen',
            'currentPage' => 'form-1',
            'kopkelengkapanDokumen' => $kopkelengkapanDokumen,
            'uuid' => $uuid
        ];

        return view("auditor/form1/kopkelengkapandokumen/updateKopKelengkapanDokumen", $data);
    }

    public function kopkelengkapanDokumenUpdatePost($uuid)
    {
        $data = [
            'wakil_auditi' => $this->request->getPost('wakil_auditi'),
        ];

        $this->kopkelengkapanDokumen->set($data)->where('uuid', $uuid)->update();
        return redirect()->to("/auditor/form-1")->with('sukses', 'Berhasil mengedit data kop kelengkapan dokumen');
    }

    public function kopkelengkapanDokumenDelete($uuid)
    {
        $this->kopkelengkapanDokumen->where('uuid', $uuid)->delete();
        return redirect()->to("/auditor/form-1")->with('sukses', 'Berhasil menghapus data kop kelengkapan dokumen');
    }
    public function kelengkapanDokumen($uuid2)
    {
        $uuid = session()->get('uuid');
        $user = $this->users->where('uuid', $uuid)->first();
        $auditor = $this->auditor->where('id_user', $user['id'])->first();
        $penugasan_auditor = $this->penugasanAuditor->where('id_auditor', $auditor['id'])->first();
        $form_ed = $this->kriteriaProdi->select('kriteria_prodi.uuid as uuid, standar, is_aktif, kriteria.kode_kriteria as kode_kriteria, kriteria.id_kriteria_standar as id_standar, id_kriteria, prodi.id as id_prodi, capaian, akar_penyebab, tautan_bukti, nama, id_lembaga_akreditasi, kriteria, bobot, catatan')
            ->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria_standar.id = kriteria.id_kriteria_standar')
            ->where('prodi.uuid', $uuid2)
            ->where('is_aktif', 1)
            ->findAll();


        $data = [
            'title' => 'Form 1',
            'currentPage' => 'form-1',
            'form_ed' => $form_ed,
            'id_penugasanAuditor' => $penugasan_auditor,
            'uuid2' => $uuid2
        ];
        return view("auditor/form1/kelengkapandokumen/createKelengkapanDokumen", $data);
    }

    public function kelengkapanDokumenPost()
    {

        $data = [
            "uuid" => service('uuid')->uuid4()->toString(),
            'id_penugasan_auditor' => $this->request->getPost('id_penugasanAuditor'),
            'id_kriteria' => $this->request->getPost('id_kriteria'),
            'status_dokumen' => $this->request->getPost('status_dokumen'),
            'nama_dokumen' => $this->request->getPost('nama_dokumen'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];
        // dd($data);
        $this->kelengkapanDokumen->insert($data);
        return redirect()->to("/auditor/form-1")->with('sukses', 'Berhasil menyimpan data kelengkapan dokumen');
    }

    public function kelengkapanDokumenUpdate($uuid)
    {
        // Fetch the current document data to be updated
        $kelengkapanDokumen = $this->kelengkapanDokumen->where('uuid', $uuid)->first();

        if (!$kelengkapanDokumen) {
            // Handle case when the document is not found
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Kelengkapan Dokumen not found");
        }

        // Fetch the penugasan auditor using id_penugasan_auditor from kelengkapanDokumen
        $penugasan_auditor = $this->penugasanAuditor->where('id', $kelengkapanDokumen['id_penugasan_auditor'])->first();

        if (!$penugasan_auditor) {
            // Handle case when the penugasan auditor is not found
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Penugasan Auditor not found");
        }

        // Get id_prodi from penugasan_auditor
        $id_prodi = $penugasan_auditor['id_prodi'];

        // Fetch form_ed data using id_prodi
        $form_ed = $this->kriteriaProdi->select('kriteria.id as id_kriteria, kriteria.kode_kriteria')
            ->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->where('prodi.id', $id_prodi)
            ->findAll();

        // Prepare data for the view
        $data = [
            'title' => 'Ubah Kelengkapan Dokumen',
            'currentPage' => 'form-1',
            'kelengkapanDokumen' => $kelengkapanDokumen,
            'form_ed' => $form_ed,
            'uuid' => $uuid
        ];

        return view("auditor/form1/kelengkapandokumen/updateKelengkapanDokumen", $data);
    }



    public function kelengkapanDokumenUpdatePost($uuid)
    {
        $data = [
            'id_kriteria' => $this->request->getPost('id_kriteria'),
            'status_dokumen' => $this->request->getPost('status_dokumen'),
            'nama_dokumen' => $this->request->getPost('nama_dokumen'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];


        $this->kelengkapanDokumen->set($data)->where('uuid', $uuid)->update();
        return redirect()->to("/auditor/form-1")->with('sukses', 'Berhasil mengedit data kelengkapan dokumen');
    }

    public function kelengkapanDokumenDelete($uuid)
    {
        $this->kelengkapanDokumen->where('uuid', $uuid)->delete();
        return redirect()->to("/auditor/form-1")->with('sukses', 'Berhasil menghapus data kelengkapan dokumen');
    }
}
