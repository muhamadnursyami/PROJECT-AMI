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

        // $form_ed = $this->formED->orderBy('indikator', 'ASC')->findAll();
        $form_ed = $this->formED->select('form_ed.uuid as uuid, indikator, standar, kriteria, capaian, program_studi')->join('indikator_ed', 'indikator_ed.id = form_ed.id_indikator')->findAll();

        $capaian = count($this->formED->where('capaian !=', 0)->findAll());
        $total = count($this->formED->where('kriteria !=', "")->findAll());

        $persentase_terisi = ($capaian/$total) * 100;

        $data = [
            'title' => 'Isi Form ED',
            'currentPage' => 'form-ed',
            'form_ed' => $form_ed,
            'persentase' => $persentase_terisi,

        ];
        return view('auditi/formed/create', $data);
    }

    public function save(){

        // dd($this->request->getPost());
        
        foreach ($this->request->getPost() as $key => $value) {
            $this->formED->set('capaian', $value)->where('uuid', $key)->update();
        }
        
        
        $capaian = count($this->formED->where('capaian !=', 0)->findAll());
        $total = count($this->formED->where('kriteria !=', "")->findAll());

        $persentase_terisi = ($capaian/$total) * 100;

        return redirect()->back()->with('sukses', 'Berhasil menambah ED')->with('persentase', "$persentase_terisi");
    }

}
