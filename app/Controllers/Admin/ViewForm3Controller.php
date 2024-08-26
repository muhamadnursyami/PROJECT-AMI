<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CatatanAuditModel;
use App\Models\PenugasanAuditorModel;
use CodeIgniter\HTTP\ResponseInterface;



class ViewForm3Controller extends BaseController
{
    private $catatanAuditModel;
    private $penugasanAuditorModel;

    public function __construct()
    {
        $this->catatanAuditModel = new CatatanAuditModel();
        $this->penugasanAuditorModel = new PenugasanAuditorModel();
    }

    public function index()
    {
        $catatanAudit = $this->catatanAuditModel->select('catatan_audit.*, prodi.nama as nama_prodi, prodi.uuid as uuid_prodi, auditor.nama as nama_auditor')
            ->join('penugasan_auditor', 'penugasan_auditor.id = catatan_audit.id_penugasan_auditor')
            ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
            ->join('auditor', 'auditor.id = penugasan_auditor.id_auditor')
            ->findAll();

        $dataProdi = [];
        $dataAuditi = [];
        $uuidProdi = [];

        foreach ($catatanAudit as $key => $audit) {

            if($key == 0){
                $dataAuditi[$key] = $audit['nama_auditor'];
                $dataProdi[$key] = $audit['nama_prodi'];
                $uuidProdi[$key] = $audit['uuid_prodi'];
                continue;
            }

            $cekAuditor = $catatanAudit[$key - 1]["nama_auditor"];
            $cekProdi = $catatanAudit[$key - 1]["nama_prodi"];
            
            if($cekAuditor != $audit['nama_auditor'] && $cekProdi != $audit['nama_prodi']){

                $dataAuditi[$key] = $audit['nama_auditor'];
                $dataProdi[$key] = $audit['nama_prodi'];
                $uuidProdi[$key] = $audit['uuid_prodi'];

            }
        }


        $data = [
            "title" => "Lihat Form 3",
            "currentPage" => "lihat-form3",
            'nama_prodi' => $dataProdi,
            'nama_auditi' => $dataAuditi,
            'uuid_prodi' => $uuidProdi,
        ];

        return view('admin/viewForm3/index', $data);
    }

    public function view($uuid)
    {
        $catatanAuditDetail = $this->catatanAuditModel->select('catatan_audit.*, prodi.nama as nama_prodi')
            ->join('penugasan_auditor', 'penugasan_auditor.id = catatan_audit.id_penugasan_auditor')
            ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
            ->where('prodi.uuid', $uuid)
            ->findAll();

        $positifNotes = [];
        $negatifNotes = [];

        foreach ($catatanAuditDetail as $item) {
            if ($item['label'] == '+') {
                $positifNotes[] = $item;
            } elseif ($item['label'] == '-') {
                $negatifNotes[] = $item;
            }
        }
        // dd($catatanAuditDetail[0]['id_penugasan_auditor']);
        $data = [
            'title' => 'Lihat Detail Form 3',
            'currentPage' => 'lihat-form3',
            'positifNotes' => $positifNotes,
            'negatifNotes' => $negatifNotes,
            'catatanAuditDetail' => $catatanAuditDetail,
            'prodi_uuid' => $uuid
        ];

        return view('admin/viewForm3/viewDetail', $data);
    }


    public function delete()
    {
        // Ambil id_penugasan_auditor dari request
        $id_penugasan_auditor = $this->request->getPost('id_penugasan_auditor');

        // Cari id_prodi terkait dengan id_penugasan_auditor
        $penugasanAuditor = $this->penugasanAuditorModel->where('id', $id_penugasan_auditor)->first();

        // Jika tidak ditemukan, kembalikan dengan pesan error
        if (!$penugasanAuditor) {
            return redirect()->to('/admin/form3/view')->with('error', 'Penugasan auditor tidak ditemukan.');
        }

        // Ambil id_prodi dari penugasan auditor
        $id_prodi = $penugasanAuditor['id_prodi'];

        // Cari semua id_penugasan_auditor yang terkait dengan id_prodi
        $penugasanAuditorList = $this->penugasanAuditorModel->where('id_prodi', $id_prodi)->findAll();
        $idPenugasanAuditorList = array_column($penugasanAuditorList, 'id');

        // Hapus semua catatan audit yang terkait dengan id_penugasan_auditor dalam daftar id_penugasan_auditor
        $this->catatanAuditModel->whereIn('id_penugasan_auditor', $idPenugasanAuditorList)->delete();

        // Redirect ke halaman '/admin/form3/view' dengan pesan sukses
        return redirect()->to('/admin/form3/view')->with('success', 'Catatan audit Form 3 berhasil dihapus.');
    }
}
