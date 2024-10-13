<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Controllers\SystemBaseController;

class FilterDeploy implements FilterInterface
{
    private $uri;
    public function before(RequestInterface $request, $arguments = null)
    {
        $uriObject = new \CodeIgniter\HTTP\URI(current_url());
        $uri = $uriObject->getSegments();
        #
        if (session()->get('filterDeploy')) {
            $filterDeploy = session()->get('filterDeploy');
            // myPrint($filterDeploy, '');
        } elseif (
            $this->definePublico($uri)
        ) {
            // return redirect()->to('bw/habilidade/usuario/endpoint/auth');
        }
        #
    }

    private function definePublico($uri)
    {
        if (
            in_array('auth', $uri)
            || in_array('analise', $uri)
            || in_array('modelo', $uri)
            || in_array('api', $uri)
            || in_array('AppPrincipal', $uri)
            || in_array('AppExecApi', $uri)
            || in_array('AppExecLoading', $uri)
            || in_array('AppExecForm', $uri)
        ) {
            // exit('src\app\Filters\FilterDeploy.php');
            return false;
        } else {
            return true;
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Você pode fazer algo aqui depois que a solicitação é processada.
    }
}
