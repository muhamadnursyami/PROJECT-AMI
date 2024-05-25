<?php

namespace App\Controllers\Auditor;

use App\Controllers\BaseController;
use App\Models\AuditorModel;
use App\Models\ProdiModel;
use App\Models\PeriodeModel;
use App\Models\JadwalPeriodeEDModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    protected $jadwal_periode_ED_Model;
    protected $jadwal_AMI_Model;
    private $auditor;
    private $prodi;
    protected $periode_Model;
    public function __construct()
    {
        $this->auditor = new AuditorModel();
        $this->prodi = new ProdiModel();
        $this->jadwal_periode_ED_Model = new JadwalPeriodeEDModel();
        $this->periode_Model = new PeriodeModel();
    }

    public function index()
    {
        $id_user = session()->get('id');
        $auditor = $this->auditor->where('id_user', $id_user)->first();
        $prodi = $this->prodi->where('id', $auditor['id_prodi'])->first();
        $jadwalPeriodeED = $this->jadwal_periode_ED_Model->getJadwalPeriodeED();
        
        // buat warning jika dekat masa waktu
        // tanggal selesai
        $tanggal_string = $this->periode_Model->getPeriode();
        
        $sekarang = time();
        $tanggal_selesai = strtotime($tanggal_string[0]['tanggal_selesai']);
        
        $selisih_detik = $tanggal_selesai - $sekarang;
        $selisih_hari = floor($selisih_detik / (60 * 60 * 24)) + 1;


        $periode = $this->periode_Model->getPeriode();
        $data = [
            'title' => 'Dashboard',
            'currentPage' => 'dashboard',
            'prodi' => $prodi,
            'jadwalPeriodeED' => $jadwalPeriodeED,
            'jadwalAMI' => $periode,
            'waktu' => $selisih_hari,

        ];
        return view('auditor/dashboard', $data);
    }
}
