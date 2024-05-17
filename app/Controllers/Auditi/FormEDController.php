<?php

namespace App\Controllers\Auditi;

use App\Controllers\BaseController;
use App\Models\FormEDModel;
use CodeIgniter\HTTP\ResponseInterface;

class FormEDController extends BaseController
{

    private $formED;
    public function __construct()
    {
        $this->formED = new FormEDModel();   
    }

    public function create()
    {

        $prodi = session()->get('prodi');
        // dd($prodi);

        $form_ed = $this->formED->select('form_ed.uuid as uuid, indikator, standar, kriteria, capaian, program_studi, prodi.nama')->join('indikator_ed', 'indikator_ed.id = form_ed.id_indikator')->join('prodi', 'prodi.id = form_ed.id_prodi')->where('prodi.nama', $prodi)->findAll();
        
        $count_form = count($form_ed);

        // jika form ed ada isinya
        if($count_form != 0){
            // $capaian = count($this->formED->where('capaian !=', 0)->findAll());
            // $total = count($this->formED->where('kriteria !=', "")->findAll());
            $capaian = count($this->formED->select('form_ed.uuid as uuid, indikator, standar, kriteria, capaian, program_studi, prodi.nama')
                                                     ->join('indikator_ed', 'indikator_ed.id = form_ed.id_indikator')
                                                     ->join('prodi', 'prodi.id = form_ed.id_prodi')
                                                     ->where('prodi.nama', $prodi)
                                                     ->where('capaian !=', 0)
                                                     ->findAll());
            $total = count($this->formED->select('form_ed.uuid as uuid, indikator, standar, kriteria, capaian, program_studi, prodi.nama')
                                    ->join('indikator_ed', 'indikator_ed.id = form_ed.id_indikator')
                                    ->join('prodi', 'prodi.id = form_ed.id_prodi')
                                    ->where('prodi.nama', $prodi)->findAll());                           

            $persentase_terisi = 0;

            if($total != 0){

                $persentase_terisi = ($capaian/$total) * 100;
            }

    
            $data = [
                'title' => 'Isi Form ED',
                'currentPage' => 'form-ed',
                'form_ed' => $form_ed,
                'persentase' => $persentase_terisi,
                'prodi' => $prodi
    
            ];
            return view('auditi/formed/create', $data);
        }

        // jika form ed tidak ada isinya
        $prodi = "";

        $persentase_terisi = 0;
        $data = [
                'title' => 'Isi Form ED',
                'currentPage' => 'form-ed',
                'form_ed' => $form_ed,
                'persentase' => $persentase_terisi,
                'prodi' => $prodi,
    
            ];
        return view('auditi/formed/create', $data);

    }

    public function save(){

        // dd($this->request->getPost());
        $prodi = session()->get('prodi');
        
        foreach ($this->request->getPost() as $key => $value) {
            $this->formED->set('capaian', $value)->where('uuid', $key)->update();
        }
        
        $capaian = count($this->formED->select('form_ed.uuid as uuid, indikator, standar, kriteria, capaian, program_studi, prodi.nama')
                                                     ->join('indikator_ed', 'indikator_ed.id = form_ed.id_indikator')
                                                     ->join('prodi', 'prodi.id = form_ed.id_prodi')
                                                     ->where('prodi.nama', $prodi)
                                                     ->where('capaian !=', 0)
                                                     ->findAll());
            $total = count($this->formED->select('form_ed.uuid as uuid, indikator, standar, kriteria, capaian, program_studi, prodi.nama')
                                    ->join('indikator_ed', 'indikator_ed.id = form_ed.id_indikator')
                                    ->join('prodi', 'prodi.id = form_ed.id_prodi')
                                    ->where('prodi.nama', $prodi)->findAll());                           

            $persentase_terisi = 0;

            if($total != 0){

                $persentase_terisi = ($capaian/$total) * 100;
            }

        return redirect()->back()->with('sukses', 'Berhasil menambah ED')->with('persentase', "$persentase_terisi");
    }

}
