<?php

namespace App\Controllers\Auditor;

use App\Controllers\BaseController;
use App\Models\AuditorModel;
use App\Models\KriteriaModel;
use App\Models\KriteriaProdiModel;
use CodeIgniter\HTTP\ResponseInterface;

class ViewEDAuditorController extends BaseController
{

    private $kriteriaProdi;
    private $auditor;

    public function __construct()
    {
        $this->kriteriaProdi = new KriteriaProdiModel();
        $this->auditor = new AuditorModel();
    }

    public function index()
    {
        $id_user = session()->get('id');
        $auditor = $this->auditor->where('id_user', $id_user)->first();

        $form_ed = $this->kriteriaProdi->select('standar, is_aktif, kriteria_prodi.uuid as uuid, id_kriteria, kriteria_prodi.id_prodi, capaian, akar_penyebab, tautan_bukti, nama, id_lembaga_akreditasi, kriteria, bobot')
                                        ->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
                                        ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
                                        ->join('kriteria_standar', 'kriteria_standar.id = kriteria.id_kriteria_standar')
                                        ->where('prodi.id', $auditor['id_prodi'])->findAll();

        if (count($form_ed) == 0) {
            return redirect()->to('auditor/dashboard')->with('gagal', 'Data form kriteria prodi belum ada');
        }
        // buat hitung progress pengisian ed
        $capaian = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria.id_kriteria_standar = kriteria_standar.id')
            ->where('capaian != 0')->where('akar_penyebab IS NOT null')
            ->where('tautan_bukti IS NOT null')
            ->where('kriteria_standar.is_aktif', 1)
            ->where('prodi.id', $auditor['id_prodi'])->findAll());
        $total = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria.id_kriteria_standar = kriteria_standar.id')
            ->where('kriteria_standar.is_aktif', 1)
            ->where('prodi.id', $auditor['id_prodi'])->findAll());

        // dd($total);

        $persentase_terisi = 0;

        if ($total != 0) {

            $persentase_terisi = ($capaian / $total) * 100;
        } else {
            $persentase_terisi = 100;
        }


        $data = [
            'title' => 'Isi Form ED',
            'currentPage' => 'lihat-kriteria-ed',
            'form_ed' => $form_ed,
            'persentase' => $persentase_terisi,
            'prodi' => $form_ed[0]['nama']

        ];
        return view('auditor/viewED/viewdetail', $data);
    }
}
