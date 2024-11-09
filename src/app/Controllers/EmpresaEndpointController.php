<?php

namespace App\Controllers;

use App\Controllers\TokenCsrfController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class EmpresaEndpointController extends ResourceController
{
    use ResponseTrait;

    private $template = 'bw/templates/main';
    private $message = 'bw/message';
    private $app_message = 'bw/AppMessage';
    private $footer = 'bw/AppFooter';
    private $head = 'bw/AppHead';
    private $menu = 'bw/AppMenu';
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
    # route GET /www/bw/empresa/endpoint/principal/(:any)
    # route POST /www/bw/empresa/endpoint/principal/(:any)
    # Informação sobre o controller
    # retorno do controller [VIEW]
    public function dbCreate($parameter = NULL)
    {
        // $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
        // $processRequest = eagarScagaire($processRequest);
        #
        // Caminho da pasta que deseja listar
        $folderPath = APPPATH . 'Views' . DIRECTORY_SEPARATOR . 'bw' . DIRECTORY_SEPARATOR . 'camposValidacao';

        if (is_dir($folderPath)) {
            $files = array_diff(scandir($folderPath), ['.', '..']);
        } else {
            $files = [];
        }
        // Caminho da pasta que deseja listar
        $folderPath = APPPATH . 'Views' . DIRECTORY_SEPARATOR . 'bw' . DIRECTORY_SEPARATOR . 'camposValidacao';

        if (is_dir($folderPath)) {
            $files = array_diff(scandir($folderPath), ['.', '..']);
        } else {
            $files = [];
        }

        // Remove a extensão .php dos arquivos e adiciona o caminho
        $files = array_map(function ($file) {
            return 'bw/camposValidacao/' . pathinfo($file, PATHINFO_FILENAME);
        }, $files);

        // Estrutura de views a serem carregadas
        $loadView1 = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->app_message,
        );
        $loadView2 = $files;
        $loadView3 = array(
            'bw/empresa/AppList',
            'bw/empresa/AppLimpar',
            'bw/empresa/AppForm',
            'bw/empresa/AppPrincipal',
            $this->footer,
        );
        $loadView = array_merge($loadView1, $loadView2, $loadView3);

        // Imprime o array final para depuração
        // myPrint($loadView, 'src\app\Controllers\EmpresaEndpointController.php');

        $this->tokenCsrf->token_csrf();
        try {
            # URI da API                                                                                                          
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
                    'page_title' => 'Título do Método',
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
                    'page_title' => 'ERRO - Mensagem',
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

    #
    # route POST /www/project/group/api/exibir/(:any))
    # route GET /www/project/group/api/exibir/(:any))
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbRead($parameter = NULL)
    {
        exit('READ');
    }
    #
}
