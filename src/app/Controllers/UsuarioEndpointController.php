<?php

namespace App\Controllers;

use App\Controllers\TokenCsrfController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class UsuarioEndpointController extends ResourceController
{
    use ResponseTrait;

    private $template = 'bw/templates/main';
    private $message = 'bw/message';
    private $footer = 'bw/footer';
    private $head = 'bw/head';
    private $menu = 'bw/menu';
    private $tokenCsrf;
    private $ModelResponse;
    private $uri;
    private $token;

    //
    public function __construct()
    {
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
        $this->tokenCsrf = new TokenCsrfController();
        $this->token = isset($_COOKIE['token']) ? $_COOKIE['token'] : '123';
    }

    //
    // route POST /www/sigla/rota
    // route GET /www/sigla/rota
    // Informação sobre o controller
    // retorno do controller [view]
    public function index($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }

    # Consumo de API
    # route GET /www/bw/usuario/endpoint/login/(:any)
    # route POST /www/bw/usuario/endpoint/login/(:any)
    # Informação sobre o controller
    # retorno do controller [VIEW]
    public function loginWeb($parameter = NULL)
    {
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
        #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,

            $this->footer,
        );
        try {
            $this->tokenCsrf->token_csrf();
            $requestJSONform = array();
            $apiRespond = [
                'status' => 'success',
                'message' => 'API loading data (dados para carregamento da API)',
                'date' => date('Y-m-d'),
                'api' => [
                    'version' => '1.0',
                    'method' => $getMethod,
                    'description' => 'API Description',
                    'content_type' => 'application/x-www-form-urlencoded'
                ],
                // 'method' => '__METHOD__',
                // 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'CADASTRAR ADOLESCENTE',
                    'getURI' => $this->uri->getSegments(),
                    // Você pode adicionar campos comentados anteriormente se forem relevantes
                    // 'method' => '__METHOD__',
                    // 'function' => '__FUNCTION__',
                ]
            ];
            if ($json == 1) {
                $response = $this->response->setJSON($apiRespond, 201);
            }
        } catch (\Exception $e) {
            $apiRespond = [
                'status' => 'error',
                'message' => $e->getMessage(),
                'date' => date('Y-m-d'),
                'api' => [
                    'version' => '1.0',
                    'method' => $getMethod,
                    'description' => 'API Criar Method',
                    'content_type' => 'application/x-www-form-urlencoded'
                ],
                'metadata' => [
                    'page_title' => 'ERRO - CRIAR ADOLESCENTE',
                    'getURI' => $this->uri->getSegments(),
                ]
            ];
            if ($json == 1) {
                $response = $this->response->setJSON($apiRespond, 500);
            }
        }
        if ($json == 1) {
            return $apiRespond;
        } else {
            // return $apiRespond;
            return view($this->template, $apiRespond);
        }
    }

}
