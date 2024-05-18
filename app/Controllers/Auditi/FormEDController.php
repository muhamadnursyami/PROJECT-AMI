<?php

namespace App\Controllers\Auditi;

use App\Controllers\BaseController;
use App\Models\KriteriaProdiModel;
use App\Models\PerubahanKriteriaModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class FormEDController extends BaseController
{

    private $kriteriaProdi;
    private $users;
    private $perubahanKriteria;
    public function __construct()
    {
        $this->kriteriaProdi = new KriteriaProdiModel();
        $this->users = new UserModel();
        $this->perubahanKriteria = new PerubahanKriteriaModel();
    }

    public function create()
    {

        $uuid = session()->get('uuid');
        $user = $this->users->where('uuid', $uuid)->first();

        if (is_null($user['id_prodi'])) {
            return redirect()->to('auditi/dashboard')->with('gagal', 'Akun anda belum memiliki prodi, silahkan hubungi admin');
        } else {

            $form_ed = $this->kriteriaProdi->select('kriteria_prodi.uuid as uuid, id_kriteria, id_prodi, score, catatan, aktif, nama, id_user, id_lembaga_akreditasi, keterangan, bobot')->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')->where('prodi.id', $user['id_prodi'])->findAll();

            if (count($form_ed) == 0) {
                return redirect()->to('auditi/dashboard')->with('gagal', 'Data form kriteria prodi belum ada');
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
                'currentPage' => 'form-ed',
                'form_ed' => $form_ed,
                'persentase' => $persentase_terisi,
                'prodi' => $form_ed[0]['nama']

            ];
            return view('auditi/formed/create', $data);
        }
    }

    public function save()
    {

        $uuid = session()->get('uuid');
        $user = $this->users->where('uuid', $uuid)->first();
        $data = [
            'score',
            'catatan',
            'aktif',
        ];
        // d($this->request->getVar());

        $i = 0;
        foreach ($this->request->getVar() as $key => $value) {
            if ($key == "csrf_test_name" || $value == "" || $key == "datatable_length") {
                continue;
            }
            if (strlen($key) == 36) {
                $uuid = $key;
            }
            if ($i == 3) {
                $i = 0;
            }
            // echo $data[$i] . " => " . $value . "<br>";
            $this->kriteriaProdi->set($data[$i], $value)->where('uuid', $uuid)->update();
            $i++;
        }

        $capaian = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')->where('score != 0')->where('prodi.id', $user['id_prodi'])->findAll());
        $total = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')->where('prodi.id', $user['id_prodi'])->findAll());

        $persentase_terisi = 0;

        if ($total != 0) {

            $persentase_terisi = ($capaian / $total) * 100;
        }

        return redirect()->back()->with('sukses', 'Berhasil menambah ED')->with('persentase', "$persentase_terisi");
    }

    public function ubah()
    {

        $uuid = session()->get('uuid');
        $user = $this->users->where('uuid', $uuid)->first();


        if (is_null($user['id_prodi'])) {
            return redirect()->to('auditi/dashboard')->with('gagal', 'Akun anda belum memiliki prodi, silahkan hubungi admin');
        } else {

            $form_ed = $this->kriteriaProdi->select('kriteria_prodi.uuid as uuid, id_kriteria, id_prodi, score, catatan, aktif, nama, id_user, id_lembaga_akreditasi, keterangan, bobot')->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')->where('prodi.id', $user['id_prodi'])->findAll();

            if (count($form_ed) == 0) {
                return redirect()->to('auditi/dashboard')->with('gagal', 'Data form kriteria prodi belum ada');
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
                'currentPage' => 'form-ed',
                'form_ed' => $form_ed,
                'persentase' => $persentase_terisi,
                'prodi' => $form_ed[0]['nama']

            ];
            return view('auditi/formed/ubah', $data);
        }
    }

    public function ubahPost()
    {

        // dd($this->request->getVar());

        $uuid = session()->get('uuid');
        $user = $this->users->where('uuid', $uuid)->first();
        $data = [
            'score',
            'catatan',
            'aktif',
        ];
        $data_perubahanKriteria = [
            'score_setelah',
            'catatan_setelah'
        ];
        // d($this->request->getVar());

        $i = 0;
        foreach ($this->request->getVar() as $key => $value) {
            if ($key == "csrf_test_name" || $value == "" || $key == "datatable_length") {
                continue;
            }
            if (strlen($key) == 36) {
                $uuid = $key;
                $data_lama = $this->kriteriaProdi->where('uuid', $uuid)->first();
                
                $this->perubahanKriteria->set('score_sebelum', $data_lama['score'])
                                        ->set('catatan_sebelum', $data_lama['catatan'])
                                        ->where('id_kriteria', $data_lama['id_kriteria'])
                                        ->update();
            }
            if($i == 3) $i = 0;
            // echo $data[$i] . " => " . $value . "<br>";

            // masukkan data ke kriteria prodi
            $this->kriteriaProdi->set($data[$i], $value)->where('uuid', $uuid)->update();
            
            // update data baru ke perubahan_kriteria
            if($i < 2){
                if($value == $data_lama['score'] || $value == $data_lama['catatan']){

                }else {
                    $this->perubahanKriteria->set($data_perubahanKriteria[$i], $value)->where('id_kriteria', $data_lama['id_kriteria'])->update();
                }
            }
            $i++;
        }

        $capaian = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')->where('score != 0')->where('prodi.id', $user['id_prodi'])->findAll());
        $total = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')->where('prodi.id', $user['id_prodi'])->findAll());

        $persentase_terisi = 0;

        if ($total != 0) {

            $persentase_terisi = ($capaian / $total) * 100;
        }

        return redirect()->back()->with('sukses', 'Berhasil mengubah ED')->with('persentase', "$persentase_terisi");
    }
}
