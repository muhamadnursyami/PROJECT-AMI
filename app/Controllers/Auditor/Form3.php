<?php

namespace App\Controllers\Auditor;

use App\Models\PenugasanAuditorModel;
use App\Models\PeriodeModel;
use App\Models\AuditorModel;
use App\Models\UserModel;

use App\Models\KriteriaProdiModel;
use App\Controllers\BaseController;
use App\Models\CatatanAuditModel;
use App\Models\DokumenModel;
use App\Models\KelengkapanDokumenModel;
use App\Models\KopKelengkapanDokumenModel;
use App\Models\KriteriaModel;
use App\Models\ProdiModel;
use CodeIgniter\HTTP\ResponseInterface;

class Form3 extends BaseController
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
    protected $catatanAudit;
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
        $this->catatanAudit = new CatatanAuditModel();
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

        $dataCatatanAuditPositifBerdasakanProdi = [];
        $dataCatatanAuditNegatifBerdasakanProdi = [];
        foreach ($penugasan_auditor as $penugasan) {
            $catatanAudit = $this->catatanAudit->where('id_penugasan_auditor', $penugasan['id'])->findAll();
            foreach ($catatanAudit as $catatan) {
                if ($catatan['label'] === '+') {
                    $dataCatatanAuditPositifBerdasakanProdi[] = $catatan;
                } else if ($catatan['label'] === '-') {
                    $dataCatatanAuditNegatifBerdasakanProdi[] = $catatan;
                }
            }
        }

        $data = [
            'title' => 'Form 3',
            'currentPage' => 'form-3',
            'uuidProdi' => $uuidProdi,
            'dataCatatanAuditPositifBerdasakanProdi' => $dataCatatanAuditPositifBerdasakanProdi,
            'dataCatatanAuditNegatifBerdasakanProdi' => $dataCatatanAuditNegatifBerdasakanProdi,
            'isKetua' => $isKetua
        ];

        return view('auditor/form3/index', $data);
    }
    public function createCatatanPositif($uuid2)
    {
        $uuid = session()->get('uuid');
        $user = $this->users->where('uuid', $uuid)->first();
        $auditor = $this->auditor->where('id_user', $user['id'])->first();
        $penugasan_auditor = $this->penugasanAuditor->where('id_auditor', $auditor['id'])->first();
        $form_ed = $this->kriteriaProdi->select('kriteria_prodi.id as id, ,standar, is_aktif, kriteria.kode_kriteria as kode_kriteria, kriteria.id_kriteria_standar as id_standar, id_kriteria, prodi.id as id_prodi, capaian, akar_penyebab, tautan_bukti, nama, id_lembaga_akreditasi, kriteria, bobot, catatan')
            ->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria_standar.id = kriteria.id_kriteria_standar')
            ->where('prodi.uuid', $uuid2)
            ->where('is_aktif', 1)
            ->first();


        $data = [
            'title' => 'Tambah Catatan Audit Positif',
            'currentPage' => 'form-3',
            'uuid' => $uuid2,
            'penugasan_auditor' => $penugasan_auditor,
            'form_ed' => $form_ed
        ];
        return view('auditor/form3/createCatatanAuditPositif', $data);
    }

    public function createCatatanPositifPost()
    {

        $data = [
            "uuid" => service('uuid')->uuid4()->toString(),
            'id_kriteria' => $this->request->getPost('id_kriteria'),
            'id_penugasan_auditor' => $this->request->getPost('id_penugasan_auditor'),
            'label' => $this->request->getPost('label'),
            'catatan_audit' => $this->request->getPost('catatan_audit')
        ];
        // dd($data);
        $this->catatanAudit->insert($data);
        return redirect()->to("/auditor/form-3")->with('sukses', 'Berhasil menambahkan catatan Audit Positif');
    }

    public function createCatatanNegatif($uuid2)
    {
        $uuid = session()->get('uuid');
        $user = $this->users->where('uuid', $uuid)->first();
        $auditor = $this->auditor->where('id_user', $user['id'])->first();
        $penugasan_auditor = $this->penugasanAuditor->where('id_auditor', $auditor['id'])->first();
        $form_ed = $this->kriteriaProdi->select('kriteria_prodi.id as id, ,standar, is_aktif, kriteria.kode_kriteria as kode_kriteria, kriteria.id_kriteria_standar as id_standar, id_kriteria, prodi.id as id_prodi, capaian, akar_penyebab, tautan_bukti, nama, id_lembaga_akreditasi, kriteria, bobot, catatan')
            ->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria_standar.id = kriteria.id_kriteria_standar')
            ->where('prodi.uuid', $uuid2)
            ->where('is_aktif', 1)
            ->first();


        $data = [
            'title' => 'Tambah Catatan Audit Negatif',
            'currentPage' => 'form-3',
            'uuid' => $uuid2,
            'penugasan_auditor' => $penugasan_auditor,
            'form_ed' => $form_ed
        ];
        return view('auditor/form3/createCatatanAuditNegatif', $data);
    }

    public function createCatatanNegatifPost()
    {

        $data = [
            "uuid" => service('uuid')->uuid4()->toString(),
            'id_kriteria' => $this->request->getPost('id_kriteria'),
            'id_penugasan_auditor' => $this->request->getPost('id_penugasan_auditor'),
            'label' => $this->request->getPost('label'),
            'catatan_audit' => $this->request->getPost('catatan_audit')
        ];
        // dd($data);
        $this->catatanAudit->insert($data);
        return redirect()->to("/auditor/form-3")->with('sukses', 'Berhasil menambahkan catatan Audit Negatif');
    }


    public function updateCatatanPositif($uuid)
    {
        $catatanPositif = $this->catatanAudit->where('uuid', $uuid)->first();

        $data = [
            'title' => 'Ubah Catatan Audit Positif',
            'currentPage' => 'form-3',
            'catatanPositif' => $catatanPositif,
            'uuid' => $uuid

        ];
        return view('auditor/form3/updateCatatanAuditPositif', $data);
    }
    public function updateCatatanPositifPost($uuid)
    {
        $data = [
            'catatan_audit' => $this->request->getPost('catatan_audit'),
        ];

        $this->catatanAudit->set($data)->where('uuid', $uuid)->update();
        return redirect()->to("/auditor/form-3")->with('sukses', 'Berhasil mengedit Catatan Audit Positif');
    }
    public function updateCatatanNegatif($uuid)
    {
        $catatanNegatif = $this->catatanAudit->where('uuid', $uuid)->first();

        $data = [
            'title' => 'Ubah Catatan Audit Positif',
            'currentPage' => 'form-3',
            'catatanNegatif' => $catatanNegatif,
            'uuid' => $uuid

        ];
        return view('auditor/form3/updateCatatanAuditNegatif', $data);
    }
    public function updateCatatanNegatifPost($uuid)
    {
        $data = [
            'catatan_audit' => $this->request->getPost('catatan_audit'),
        ];

        $this->catatanAudit->set($data)->where('uuid', $uuid)->update();
        return redirect()->to("/auditor/form-3")->with('sukses', 'Berhasil mengedit Catatan Audit Negatif');
    }
    public function catatanPositifDelete($uuid)
    {
        $this->catatanAudit->where('uuid', $uuid)->delete();
        return redirect()->to("/auditor/form-3")->with('sukses', 'Berhasil menghapus Catatan Audit Positif');
    }
    public function catatanNegatifDelete($uuid)
    {
        $this->catatanAudit->where('uuid', $uuid)->delete();
        return redirect()->to("/auditor/form-3")->with('sukses', 'Berhasil menghapus Catatan Audit Negatif');
    }
}
