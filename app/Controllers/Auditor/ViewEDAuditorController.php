<?php

namespace App\Controllers\Auditor;

use App\Controllers\BaseController;
use App\Models\AuditorModel;
use App\Models\KriteriaModel;
use App\Models\KriteriaProdiModel;
use CodeIgniter\HTTP\ResponseInterface;

class ViewEDAuditorController extends BaseController
{

    private $kriteria;
    private $kriteriaProdi;
    private $auditor;

    public function __construct()
    {
        $this->kriteria = new KriteriaModel();
        $this->kriteriaProdi = new KriteriaProdiModel();
        $this->auditor = new AuditorModel();
    }

    public function index()
    {
        $id_user = session()->get('id');
        $user = $this->auditor->where('id_user', $id_user)->first();
        // dd($user);

        if (is_null($user['id_prodi'])) {
            return redirect()->to('auditi/dashboard')->with('gagal', 'Akun anda belum memiliki prodi, silahkan hubungi admin');
        } else {

            $form_ed = $this->kriteriaProdi->select('kriteria_prodi.uuid as uuid, id_kriteria, id_prodi, score, catatan, aktif, nama, id_user, id_lembaga_akreditasi, keterangan, bobot')->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')->where('prodi.id', $user['id_prodi'])->findAll();

            if (count($form_ed) == 0) {
                return redirect()->to('auditor/dashboard')->with('gagal', 'Data form kriteria prodi belum ada');
            }
            // buat hitung progress pengisian ed
            $capaian = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')->where('score != 0')->where('prodi.id', $user['id_prodi'])->findAll());
            $total = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')->where('prodi.id', $user['id_prodi'])->findAll());

            $persentase_terisi = 0;

            if ($total != 0) {

                $persentase_terisi = ($capaian / $total) * 100;
            }


            $data = [
                'title' => 'Isi Form ED',
                'currentPage' => 'lihat-form-ed',
                'form_ed' => $form_ed,
                'persentase' => $persentase_terisi,
                'prodi' => $form_ed[0]['nama']

            ];
            return view('auditor/viewED/viewdetail', $data);
        }
    }
}
