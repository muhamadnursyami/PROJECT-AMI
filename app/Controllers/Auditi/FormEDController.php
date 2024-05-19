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

            $form_ed = $this->kriteriaProdi->select('kriteria_prodi.uuid as uuid, standar, is_aktif, kriteria.id_kriteria_standar as id_standar, id_kriteria, prodi.id as id_prodi, capaian, akar_penyebab, tautan_bukti, nama, id_lembaga_akreditasi, kriteria, bobot')
                ->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
                ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
                ->join('kriteria_standar', 'kriteria_standar.id = kriteria.id_kriteria_standar')
                ->where('prodi.id', $user['id_prodi'])->findAll();


            if (count($form_ed) == 0) {
                return redirect()->to('auditi/dashboard')->with('gagal', 'Data form kriteria prodi belum ada');
            }
            // buat hitung progress pengisian ed
            $capaian = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
                ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
                ->join('kriteria_standar', 'kriteria.id_kriteria_standar = kriteria_standar.id')
                ->where('capaian != 0')->where('akar_penyebab IS NOT null')
                ->where('tautan_bukti IS NOT null')
                ->where('kriteria_standar.is_aktif', 1)
                ->where('prodi.id', $user['id_prodi'])->findAll());
            $total = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
                ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
                ->join('kriteria_standar', 'kriteria.id_kriteria_standar = kriteria_standar.id')
                ->where('kriteria_standar.is_aktif', 1)
                ->where('prodi.id', $user['id_prodi'])->findAll());

            $persentase_terisi = 0;

            if ($total != 0) {

                $persentase_terisi = ($capaian / $total) * 100;
            }else {
                $persentase_terisi = 100;
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
        // dd($this->request->getVar());

        $uuid = session()->get('uuid');
        $user = $this->users->where('uuid', $uuid)->first();

        // dd($this->request->getVar());
        foreach ($this->request->getVar() as $key => $value) {
            if ($key == "csrf_test_name" || $key == "datatable_length") {
                continue;
            }

            // jika capaian terisi
            if (strlen($key) == 36) {
                $uuid = $key;
                $this->kriteriaProdi->set('capaian', $value)->where('uuid', $uuid)->update();
                $kriteriaProdi = $this->kriteriaProdi->where('uuid', $uuid)->first();

                $this->perubahanKriteria->set('capaian_sebelum', $kriteriaProdi['capaian'])
                    ->where('id_kriteria_prodi', $kriteriaProdi['id'])
                    ->update();
            }

            // jika akar penyebab terisi
            if (strlen($key) == 48) {
                if ($value == "") {
                    echo "Data penyebab terisi kosong<br>";
                } else {
                    $uuid = substr($key, 12);
                    $this->kriteriaProdi->set('akar_penyebab', $value)->where('uuid', $uuid)->update();
                }
            }

            // jika tautan bukti terisi
            if (strlen($key) == 47) {
                if ($value == "") {
                    echo "Data penyebab terisi kosong<br>";
                } else {
                    $uuid = substr($key, 11);
                    $this->kriteriaProdi->set('tautan_bukti', $value)->where('uuid', $uuid)->update();
                }
            }
        }

        $capaian = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria.id_kriteria_standar = kriteria_standar.id')
            ->where('capaian != 0')->where('akar_penyebab IS NOT null')
            ->where('tautan_bukti IS NOT null')
            ->where('kriteria_standar.is_aktif', 1)
            ->where('prodi.id', $user['id_prodi'])->findAll());
        $total = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria.id_kriteria_standar = kriteria_standar.id')
            ->where('kriteria_standar.is_aktif', 1)
            ->where('prodi.id', $user['id_prodi'])->findAll());

        $persentase_terisi = 0;

        if ($total != 0) {

            $persentase_terisi = ($capaian / $total) * 100;
        }else {
            $persentase_terisi = 100;
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

            $form_ed = $this->kriteriaProdi->select('kriteria_prodi.uuid as uuid, standar, is_aktif, kriteria.id_kriteria_standar as id_standar, id_kriteria, prodi.id as id_prodi, capaian, akar_penyebab, tautan_bukti, nama, id_lembaga_akreditasi, kriteria, bobot')
                ->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
                ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
                ->join('kriteria_standar', 'kriteria_standar.id = kriteria.id_kriteria_standar')
                ->where('prodi.id', $user['id_prodi'])->findAll();

            if (count($form_ed) == 0) {
                return redirect()->to('auditi/dashboard')->with('gagal', 'Data form kriteria prodi belum ada');
            }
            // buat hitung progress pengisian ed
            $capaian = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
                ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
                ->join('kriteria_standar', 'kriteria.id_kriteria_standar = kriteria_standar.id')
                ->where('capaian != 0')->where('akar_penyebab IS NOT null')
                ->where('tautan_bukti IS NOT null')
                ->where('kriteria_standar.is_aktif', 1)
                ->where('prodi.id', $user['id_prodi'])->findAll());
            $total = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
                ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
                ->join('kriteria_standar', 'kriteria.id_kriteria_standar = kriteria_standar.id')
                ->where('kriteria_standar.is_aktif', 1)
                ->where('prodi.id', $user['id_prodi'])->findAll());

            $persentase_terisi = 0;

            if ($total != 0) {

                $persentase_terisi = ($capaian / $total) * 100;
            }else {
                $persentase_terisi = 100;
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
        $uuid = session()->get('uuid');
        $user = $this->users->where('uuid', $uuid)->first();

        foreach ($this->request->getVar() as $key => $value) {
            if ($key == "csrf_test_name" || $key == "datatable_length") {
                continue;
            }

            // jika capaian terisi
            if (strlen($key) == 36) {
                $uuid = $key;
                $kriteriaProdi = $this->kriteriaProdi->where('uuid', $uuid)->first();
                $this->kriteriaProdi->set('capaian', $value)->where('uuid', $uuid)->update();

                if (!($kriteriaProdi['capaian'] == $value)) {
                    $this->perubahanKriteria->set('capaian_setelah', $value)
                        ->where('id_kriteria_prodi', $kriteriaProdi['id'])
                        ->update();
                }
            }

            // jika akar penyebab terisi
            if (strlen($key) == 48) {
                if ($value == "") {
                    echo "Data penyebab terisi kosong<br>";
                } else {
                    $uuid = substr($key, 12);
                    $this->kriteriaProdi->set('akar_penyebab', $value)->where('uuid', $uuid)->update();
                }
            }

            // jika tautan bukti terisi
            if (strlen($key) == 47) {
                if ($value == "") {
                    echo "Data penyebab terisi kosong<br>";
                } else {
                    $uuid = substr($key, 11);
                    $this->kriteriaProdi->set('tautan_bukti', $value)->where('uuid', $uuid)->update();
                }
            }
        }

        $capaian = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria.id_kriteria_standar = kriteria_standar.id')
            ->where('capaian != 0')->where('akar_penyebab IS NOT null')
            ->where('tautan_bukti IS NOT null')
            ->where('kriteria_standar.is_aktif', 1)
            ->where('prodi.id', $user['id_prodi'])->findAll());
        $total = count($this->kriteriaProdi->join('prodi', 'prodi.id = kriteria_prodi.id_prodi')
            ->join('kriteria', 'kriteria.id = kriteria_prodi.id_kriteria')
            ->join('kriteria_standar', 'kriteria.id_kriteria_standar = kriteria_standar.id')
            ->where('kriteria_standar.is_aktif', 1)
            ->where('prodi.id', $user['id_prodi'])->findAll());

        $persentase_terisi = 0;

        if ($total != 0) {

            $persentase_terisi = ($capaian / $total) * 100;
        }else {
            $persentase_terisi = 100;
        }

        return redirect()->back()->with('sukses', 'Berhasil mengubah ED')->with('persentase', "$persentase_terisi");
    }
}
