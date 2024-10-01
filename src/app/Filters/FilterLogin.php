<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Controllers\SystemBaseController;
use App\Controllers\SystemMessageController;

class FilterLogin implements FilterInterface
{
    private $uri;
    public function before(RequestInterface $request, $arguments = null)
    {
        $uriObject = new \CodeIgniter\HTTP\URI(current_url());
        $message = new SystemMessageController();
        $uri = $uriObject->getSegments();
        #
        if (session()->get('login_bom')) {
            $login_bom = session()->get('login_bom');
            // myPrint($login_bom, '', true);
        } elseif (
            $this->definePublico($uri)
        ) {
            // return redirect()->to('bw/usuario/endpoint/login');
            $message->message(['Acesso restrito. '], 'danger', $parameter, 5);
        }
        #
    }

    private function definePublico($uri)
    {
        if (
            in_array('login', $uri) ||
            in_array('auth', $uri) ||
            in_array('api', $uri)
        ) {
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
