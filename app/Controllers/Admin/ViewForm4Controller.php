<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RingkasanTemuanModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PeriodeModel;
use App\Models\KriteriaProdiModel;
use App\Models\ProdiModel;
use App\Models\KopKelengkapanDokumenModel;


class ViewForm4Controller extends BaseController
{
    private $ringkasanTemuanModel;
    private $kopkelengkapanDokumen;
    private $periode_Model;
    private $prodi;
    private $kriteriaProdi;
    private $ringkasanTemuan;

    public function __construct()
    {
        $this->ringkasanTemuanModel = new RingkasanTemuanModel();
        $this->kopkelengkapanDokumen = new KopKelengkapanDokumenModel();
        $this->kriteriaProdi = new KriteriaProdiModel();
        $this->periode_Model = new PeriodeModel();
        $this->prodi = new ProdiModel();
        $this->kopkelengkapanDokumen = new KopKelengkapanDokumenModel();
        $this->ringkasanTemuan = new RingkasanTemuanModel();
    }

    public function index()
    {
        $ringkasaTemuan = $this->ringkasanTemuanModel->select('ringkasan_temuan.*, prodi.nama as nama_prodi, prodi.uuid as uuid_prodi, auditor.nama as nama_auditor')
            ->join('penugasan_auditor', 'penugasan_auditor.id = ringkasan_temuan.id_penugasan_auditor')
            ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
            ->join('auditor', 'auditor.id = penugasan_auditor.id_auditor')
            ->findAll();

        $dataProdi = [];
        $dataAuditor = [];
        $uuidProdi = [];

        foreach ($ringkasaTemuan as $ringkasan) {
            $dataProdi[] = $ringkasan['nama_prodi'];
            $uuidProdi[] = $ringkasan['uuid_prodi'];
            $dataAuditor[] = $ringkasan['nama_auditor'];
        }

        $dataAuditor = array_unique($dataAuditor);
        $dataProdi = array_unique($dataProdi);
        $uuidProdi = array_unique($uuidProdi);

        // dd($dataProdi, $dataAuditor, $uuidProdi);

        $data = [
            "title" => "Lihat Form 4",
            "currentPage" => "lihat-form4",
            'nama_prodi' => $dataProdi,
            'nama_auditor' => $dataAuditor,
            'uuid_prodi' => $uuidProdi,
        ];

        return view('admin/viewForm4/index', $data);
    }

    public function view($uuid2)
    {
        $dataKopKelengkapanDokumen = $this->kopkelengkapanDokumen
            ->join('prodi', 'prodi.nama = lokasi')
            ->where('prodi.uuid', $uuid2)->first();

        $anggota = [];
        if (!is_null($dataKopKelengkapanDokumen)) {
            $anggota = $dataKopKelengkapanDokumen['auditor_anggota'];
            preg_match_all('/(?:[^,]+, [^,]+(?:, [^,]+)?)/', $anggota, $matches);
            $anggota = $matches[0];
        }

        $ringkasanTemuan = $this->ringkasanTemuan
            ->select('kode_kriteria, deskripsi, kategori, ringkasan_temuan.uuid as uuid, prodi.nama as nama_prodi')
            ->join('penugasan_auditor', 'penugasan_auditor.id = id_penugasan_auditor')
            ->join('kriteria', 'kriteria.id = id_kriteria')
            ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
            ->where('prodi.uuid', $uuid2)
            ->findAll();

        $prodi = $this->prodi->where('uuid', $uuid2)->first();

        $periode = $this->periode_Model->first();
        $form_ed = $this->kriteriaProdi->select('kriteria_prodi.uuid as uuid, standar, is_aktif, kriteria.kode_kriteria as kode_kriteria, kriteria.id_kriteria_standar as id_standar, id_kriteria, prodi.id as id_prodi, capaian, akar_penyebab, tautan_bukti, nama, id_lembaga_akreditasi, kriteria, bobot, catatan')
            ->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria_standar.id = kriteria.id_kriteria_standar')
            ->where('prodi.uuid', $uuid2)
            ->where('is_aktif', 1)
            ->findAll();

        $data = [
            'title' => 'Form 4',
            'currentPage' => 'lihat-form4',
            'uuid2' => $uuid2,
            'prodi' => $prodi,
            'dataKopKelengkapanDokumen' => $dataKopKelengkapanDokumen,
            'anggota' => $anggota,
            'ringkasanTemuan' => $ringkasanTemuan,
            'periode' => $periode,
            'form_ed' => $form_ed
        ];

        return view('admin/viewForm4/viewDetail.php', $data);
    }
}
