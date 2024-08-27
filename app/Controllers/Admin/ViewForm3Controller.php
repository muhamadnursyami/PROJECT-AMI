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

        $penugasanAuditor = $this->penugasanAuditorModel->select('penugasan_auditor.id as id, prodi.uuid as uuid_prodi, auditor.nama as nama_auditor, prodi.nama as nama_prodi')
            ->join('auditor', 'auditor.id = penugasan_auditor.id_auditor')
            ->join('prodi', 'prodi.id = penugasan_auditor.id_prodi')
            ->where('penugasan_auditor.ketua', "1")
            ->findAll();


        $data = [
            "title" => "Lihat Form 3",
            "currentPage" => "lihat-form3",
            'penugasan_auditor' => $penugasanAuditor,
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
        
        if(count($catatanAuditDetail) == 0){
            return redirect()->back()->withInput()->with('gagal', "Data form 3 belum diisi auditor");
        }

        $positifNotes = [];
        $negatifNotes = [];

        foreach ($catatanAuditDetail as $item) {
            if ($item['label'] == '+') {
                $positifNotes[] = $item;
            } elseif ($item['label'] == '-') {
                $negatifNotes[] = $item;
            }
        }
        
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
