<?php 

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\Exceptions\HTTPException;

class CheckPolicyForm implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $user = session()->get('id');
        $policy = new \App\Policies\AuditorPolicy();
        $penugasanAuditor = new \App\Models\PenugasanAuditorModel();
        $auditor = new \App\Models\AuditorModel();
        $prodi = new \App\Models\ProdiModel();

        if (isset($arguments[0]) && method_exists($policy, $arguments[0])) {
            $action = $arguments[0];
            $auditor = $auditor->where('id_user', $user)->first();

            $actualLink = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $uri = new \CodeIgniter\HTTP\URI($actualLink);
            try{
                $uuidProdi = $uri->getSegment(3);
                $prodi = $prodi->where('uuid', $uuidProdi)->first();
                $penugasanAuditor = $penugasanAuditor->where('id_auditor', $auditor['id'])->findAll();
            }catch(HTTPException $e){
                return true;
            }

            if (!$policy->$action($prodi, $penugasanAuditor)) {
                return redirect()->to('/unauthorized');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

