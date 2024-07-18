<?php

namespace App\Policies;

use App\Models\AuditorModel;
use App\Models\PenugasanAuditorModel;
use App\Models\ProdiModel;
use App\Models\UserModel;

class AuditorPolicy
{

    public function create($prodi, $penugasanAuditor)
    {

        foreach ($penugasanAuditor as $key2 => $value2) {
            if(!isset($prodi['id'])){
                return true;
            }

            if ($value2['id_prodi'] === $prodi['id']) {
                return true;
            }
        }


        // dd($penugasanAuditor);
        return false;

        // return $penugasanAuditor->id_prodi === $this->prodiModel->id;
    }

}
