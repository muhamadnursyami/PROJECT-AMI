<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AuditorModel;
use App\Models\DeskripsiTemuanModel;
use App\Models\KopKelengkapanDokumenModel;
use App\Models\KriteriaProdiModel;
use App\Models\PenugasanAuditorModel;
use App\Models\PeriodeModel;
use App\Models\ProdiModel;
use App\Models\RingkasanTemuanModel;
use App\Models\UserModel;

class ViewForm5Controller extends BaseController
{

    private $users;
    private $periodeModel;
    private $auditor;
    private $penugasanAuditor;
    private $kopkelengkapanDokumen;
    private $ringkasanTemuan;
    private $prodi;
    private $kriteriaProdi;
    private $deskripsiTemuan;

    public function __construct()
    {
        $this->users = new UserModel();
        $this->periodeModel = new PeriodeModel();
        $this->auditor = new AuditorModel();
        $this->penugasanAuditor = new PenugasanAuditorModel();
        $this->kopkelengkapanDokumen = new KopKelengkapanDokumenModel();
        $this->ringkasanTemuan = new RingkasanTemuanModel();
        $this->prodi = new ProdiModel();
        $this->kriteriaProdi = new KriteriaProdiModel();
        $this->deskripsiTemuan = new DeskripsiTemuanModel();
    }

    public function index()
    {
        $ringkasaTemuan = $this->ringkasanTemuan->select('ringkasan_temuan.*, prodi.nama as nama_prodi, prodi.uuid as uuid_prodi, auditor.nama as nama_auditor')
            ->join('penugasan_auditor', 'penugasan_auditor.id = ringkasan_temuan.id_penugasan_auditor')
            ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
            ->join('auditor', 'auditor.id = penugasan_auditor.id_auditor')
            ->findAll();

        $dataProdi = [];
        $dataAuditor = [];
        $uuidProdi = [];

        foreach ($ringkasaTemuan as $key => $ringkasan) {
            
            
            if($key == 0){
                $dataAuditor[$key] = $ringkasan['nama_auditor'];
                $dataProdi[$key] = $ringkasan['nama_prodi'];
                $uuidProdi[$key] = $ringkasan['uuid_prodi'];
                continue;
            }

            $cekAuditor = $ringkasaTemuan[$key - 1]["nama_auditor"];
            $cekProdi = $ringkasaTemuan[$key - 1]["nama_prodi"];
            
            if($cekAuditor != $ringkasan['nama_auditor'] && $cekProdi != $ringkasan['nama_prodi']){

                $dataAuditor[$key] = $ringkasan['nama_auditor'];
                $dataProdi[$key] = $ringkasan['nama_prodi'];
                $uuidProdi[$key] = $ringkasan['uuid_prodi'];

            }
            
        }
        // dd($dataProdi, $dataAuditor, $uuidProdi);

        $data = [
            "title" => "Lihat Form 5",
            "currentPage" => "lihat-form5",
            'nama_prodi' => $dataProdi,
            'nama_auditor' => $dataAuditor,
            'uuid_prodi' => $uuidProdi,
        ];

        return view('admin/viewForm5/index', $data);
    }

    public function view($uuid2)
    {

        $dataKopKelengkapanDokumen = $this->kopkelengkapanDokumen
            ->join('prodi', 'prodi.nama = lokasi')
            ->where('prodi.uuid', $uuid2)->first();

        $anggota = [];
        if (!is_null($dataKopKelengkapanDokumen)) {
            $anggota = $dataKopKelengkapanDokumen['auditor_anggota'];
            // Gunakan regex untuk memisahkan nama auditor
            preg_match_all('/(?:[^,]+, [^,]+(?:, [^,]+)?)/', $anggota, $matches);
            $anggota = $matches[0];
        }

        $ringkasanTemuan = $this->ringkasanTemuan
            ->select('kode_kriteria, ringkasan_temuan.id as id, deskripsi,kategori, kriteria, ringkasan_temuan.uuid as uuid, prodi.nama as nama_prodi')
            ->join('penugasan_auditor', 'penugasan_auditor.id = id_penugasan_auditor')
            ->join('kriteria', 'kriteria.id = id_kriteria')
            ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
            ->where('prodi.uuid', $uuid2)
            ->where('kategori', 'kts')
            ->findAll();

        $prodi = $this->prodi->where('uuid', $uuid2)->first();

        $periode = $this->periodeModel->first();
        $form_ed = $this->kriteriaProdi->select('kriteria_prodi.uuid as uuid, standar, is_aktif, kriteria.kode_kriteria as kode_kriteria, kriteria.id_kriteria_standar as id_standar, id_kriteria, prodi.id as id_prodi, capaian, akar_penyebab, tautan_bukti, nama, id_lembaga_akreditasi, kriteria, bobot, catatan')
            ->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria_standar.id = kriteria.id_kriteria_standar')
            ->where('prodi.uuid', $uuid2)
            ->where('is_aktif', 1)
            ->findAll();


        if (count($ringkasanTemuan) == 0) {

            if(!isset($uuid2['id'])){
                return redirect()->back()->withInput()->with('gagal', "Data kop kelengkapam dokumen belum diisi");
            }

            $penugasan_auditor = $this->penugasanAuditor->select('penugasan_auditor.id,penugasan_auditor.uuid, prodi.uuid as uuid_prodi, ketua, auditor.nama as nama_auditor, fakultas, kode_auditor, prodi.nama as nama_prodi')
                ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
                ->join('auditor', 'auditor.id = penugasan_auditor.id_auditor')
                ->where('prodi.uuid', $uuid2['id'])->findAll();

            $data = [
                "title" => "Form 5",
                "currentPage" => "form-5",
                'penugasan_auditor' => $penugasan_auditor,
                'error' => "Form 4 - Ringkasan Temuan Audit pada prodi " . $prodi['nama'] . " belum dibuat, silahkan buat terlebih dahulu atau pastikan data tersebut memiliki kategori KTS",
                'formTerkunci' => false
            ];

            return view('auditor/form5/beranda', $data);
        }

        $deskripsiTemuan = $this->deskripsiTemuan->select('kode_kriteria')
            ->join('ringkasan_temuan', 'ringkasan_temuan.id = deskripsi_temuan.id_ringkasan_temuan')
            ->join('penugasan_auditor', 'penugasan_auditor.id = ringkasan_temuan.id_penugasan_auditor')
            ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
            ->join('kriteria', 'kriteria.id = id_kriteria')
            ->where('prodi.uuid', $uuid2)
            ->findAll();
        // foreach ($deskripsiTemuan as $key => $value) {
        //     echo $value['kode_kriteria'] . "===";
        // }


        if ($dataKopKelengkapanDokumen == null) {
            $penugasan_auditor = $this->penugasanAuditor->select('penugasan_auditor.id,penugasan_auditor.uuid, prodi.uuid as uuid_prodi, ketua, auditor.nama as nama_auditor, fakultas, kode_auditor, prodi.nama as nama_prodi')
                ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
                ->join('auditor', 'auditor.id = penugasan_auditor.id_auditor')
                ->where('prodi.uuid', $uuid2)->findAll();

            $data = [
                "title" => "Form 5",
                "currentPage" => "form-5",
                'penugasan_auditor' => $penugasan_auditor,
                'error' => "Form 1 - Data kelengkapan dokumen pada prodi " . $prodi['nama'] . " belum dibuat, silahkan buat terlebih dahulu",
                'formTerkunci' => false
            ];

            return view('auditor/form5/beranda', $data);
        }

        // dd(count($deskripsiTemuan));

        $data = [
            'title' => 'Form 5',
            'currentPage' => 'lihat-form5',
            'uuid2' => $uuid2,
            'prodi' => $prodi,
            'dataKopKelengkapanDokumen' => $dataKopKelengkapanDokumen,
            'anggota' => $anggota,
            'ringkasanTemuan' => $ringkasanTemuan,
            'periode' => $periode,
            'form_ed' => $form_ed,
            'wakil_auditi' => $dataKopKelengkapanDokumen['wakil_auditi'],
            'penjaminMutuAudit' => $periode['penjaminan_mutu_audit'],
            'deskripsiTemuan' => $deskripsiTemuan
        ];

        return view('admin/viewForm5/beranda', $data);
    }


    public function kelola($uuid)
    {
        $deskripsiTemuan = $this->deskripsiTemuan->select('kode_kriteria, deskripsi_temuan.uuid as uuid, prodi.nama as nama_prodi')
            ->join('ringkasan_temuan', 'ringkasan_temuan.id = deskripsi_temuan.id_ringkasan_temuan')
            ->join('penugasan_auditor', 'penugasan_auditor.id = ringkasan_temuan.id_penugasan_auditor')
            ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
            ->join('kriteria', 'kriteria.id = id_kriteria')
            ->where('prodi.uuid', $uuid)
            ->findAll();

        // dd($deskripsiTemuan);
        if(count($deskripsiTemuan) == 0){

            return redirect()->back()->withInput()->with('gagal', "Data deskripsi temuan belum ada");
        }

        $data = [
            'title' => 'Form 5',
            'currentPage' => 'lihat-form5',
            'prodi' => $deskripsiTemuan[0]['nama_prodi'],
            'uuid' => $uuid,
            'deskripsiTemuan' => $deskripsiTemuan
        ];


        return view('admin/viewForm5/kelola', $data);
    }


    public function viewDetail($uuid, $uuid_deskripsi_temuan)
    {

        $deskripsiTemuan = $this->deskripsiTemuan->select('kode_kriteria, deskripsi_temuan.uuid as uuid, ringkasan_temuan.deskripsi as deskripsi_temuan, deskripsi_temuan.id as id, id_ringkasan_temuan, deskripsi_temuan.kriteria as kriteria, deskripsi_temuan.akibat as akibat, deskripsi_temuan.akar_penyebab as akar_penyebab, deskripsi_temuan.rekomendasi as rekomendasi, deskripsi_temuan.tanggapan_auditi as tanggapan_auditi, deskripsi_temuan.rencana_perbaikan as rencana_perbaikan, jadwal_perbaikan, penanggung_jawab_perbaikan, rencana_pencegahan, jadwal_pencegahan, penanggung_jawab_pencegahan, pimpinan_auditi, deskripsi_temuan.reviewer as reviewer')
            ->join('ringkasan_temuan', 'ringkasan_temuan.id = deskripsi_temuan.id_ringkasan_temuan')
            ->join('penugasan_auditor', 'penugasan_auditor.id = ringkasan_temuan.id_penugasan_auditor')
            ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
            ->join('kriteria', 'kriteria.id = id_kriteria')
            ->where('deskripsi_temuan.uuid', $uuid_deskripsi_temuan)
            ->first();

        $prodi = $this->prodi->select('nama')->where('uuid', $uuid)->first();

        // dd($deskripsiTemuan);


        $data = [
            "title" => 'Form 5',
            'currentPage' => 'lihat-form5',
            'uuid' => $uuid,
            'uuid_deskripsi_temuan' => $uuid_deskripsi_temuan,
            'deskripsiTemuan' => $deskripsiTemuan,
            'prodi' => $prodi['nama'],
        ];

        return view('admin/viewForm5/viewDetail', $data);
    }



}
