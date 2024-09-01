<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\TokenCsrfController;
use App\Controllers\SystemMessageController;
use App\Controllers\ExempleDbController;
use App\Controllers\CadastrosDbController;
use App\Controllers\UnidadesDbController;
use App\Controllers\AdolescenteDbController;
// use App\Controllers\SystemUploadDbController;

use Exception;

class ExampleApiController extends ResourceController
{
    use ResponseTrait;
    private $ModelResponse;
    private $dbFields;
    private $uri;
    private $tokenCsrf;
    private $DbController;
    private $DbCadastro;
    private $DbUnidades;
    private $message;

    public function __construct()
    {
        $this->DbController = new AdolescenteDbController();
        $this->DbCadastro = new CadastrosDbController();
        $this->DbUnidades = new UnidadeDbController();
        $this->tokenCsrf = new TokenCsrfController();
        $this->message = new SystemMessageController();
        // $this->DbController = new SystemUploadDbController();
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
    }
    #
    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function index($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }

    # route POST /www/exemple/group/api/teste/(:any)
    # route GET /www/exemple/group/api/teste/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbRead($parameter = NULL)
    {
        # Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $getGet = $this->request->getGet('page');
        $page = (isset($getGet) && !empty($getGet)) ? ($getGet) : (1);
        $processRequest = (array)$request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        #
        // myPrint($getMethod, 'src\app\Controllers\AdolescenteApiController.php');
        try {
            #
            $id = isset($processRequest['id']) ? ($processRequest['id']) : ($parameter);
            $requestDb = $this->DbController->dbRead($id, $page);
            #
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
                'result' => $requestDb,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                    // Você pode adicionar campos comentados anteriormente se forem relevantes
                    // 'method' => '__METHOD__',
                    // 'function' => '__FUNCTION__',
                ]
            ];
            $response = $this->response->setJSON($apiRespond, 201);
        } catch (\Exception $e) {
            $apiRespond = array(
                'message' => array('danger' => $e->getMessage()),
                'page_title' => 'Application title',
                'getURI' => $this->uri->getSegments(),
            );
            $this->message->message($message = array(), 'danger', $parameter, 5);
            $response = $this->response->setJSON($apiRespond, 500);
        }
        if ($json == 1) {
            return $response;
            // return redirect()->back();
            // return redirect()->to('project/endpoint/parameter/parameter/' . $parameter);
        } else {
            return $response;
        }
    }
    # cod 1
    # cod 2

    # route POST /# www/fia/ptpa/adolescente/api/filtrar/(:any)
    # route GET /# www/fia/ptpa/adolescente/api/filtrar/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbFilter($parameter = NULL)
    {

        # Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $getGet = $this->request->getGet('page');
        $page = (isset($getGet) && !empty($getGet)) ? ($getGet) : (1);
        $processRequest = (array)$request->getVar();
        $processRequest = array_filter($processRequest);
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        #
        try {
            #
            // return $this->response->setJSON($processRequest, 200);
            // myPrint($processRequest, 'src\app\Controllers\AdolescenteApiController.php');
            $requestDb = $this->DbController->dbFilter($processRequest, $page);
            // myPrint($requestDb, 'src\app\Controllers\AdolescenteApiController.php', true);
            #
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
                'result' => $requestDb,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                    // Você pode adicionar campos comentados anteriormente se forem relevantes
                    // 'method' => '__METHOD__',
                    // 'function' => '__FUNCTION__',
                ]
            ];
            $response = $this->response->setJSON($apiRespond, 201);
        } catch (\Exception $e) {
            $apiRespond = array(
                'message' => array('danger' => $e->getMessage()),
                'page_title' => 'Application title',
                'getURI' => $this->uri->getSegments(),
            );
            $this->message->message($message = array(), 'danger', $parameter, 5);
            $response = $this->response->setJSON($apiRespond, 500);
        }
        if ($json == 1) {
            return $response;
            // return redirect()->back();
            // return redirect()->to('project/endpoint/parameter/parameter/' . $parameter);
        } else {
            return $response;
        }
    }

    # route POST /www/exemple/group/api/criar/(:any)
    # route GET /www/exemple/group/api/criar/(:any)
    # route POST /exemple/group/api/atualizar/(:any)
    # route GET /exemple/group/api/atualizar/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function create_update($parameter = NULL)
    {
        # Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array)$request->getVar();
        // $uploadedFiles = $request->getFiles();
        $token_csrf = (isset($processRequest['token_csrf']) ? $processRequest['token_csrf'] : NULL);
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $choice_update = (isset($processRequest['id'])) ? (true) : (false);
        #
        if ($choice_update === true) {
            if ($this->tokenCsrf->valid_token_csrf($token_csrf)) {
                $id = (isset($processRequest['id'])) ? ($processRequest['id']) : (array());
                $dbResponse = $this->DbController->dbUpdate($id, $processRequest);
                if (isset($dbResponse["affectedRows"]) && $dbResponse["affectedRows"] > 0) {
                    $processRequestSuccess = true;
                }
            }
        } elseif ($choice_update === false) {
            if ($this->tokenCsrf->valid_token_csrf($token_csrf)) {
                $dbResponse = $this->DbController->dbCreate($processRequest);
                if (isset($dbResponse["affectedRows"]) && $dbResponse["affectedRows"] > 0) {
                    $processRequestSuccess = true;
                }
            }
        } else {
            $this->message->message(['ERRO: Dados enviados inválidos'], 'danger');
        };

        if (session()->get('message')) {
            $apiSession = session()->get('message');
            myPrint($apiSession, '');
        }

        $varSession = (session()->get('session_name')) ? (session()->get('session_name')) : (array());
        $status = (!isset($processRequestSuccess) || $processRequestSuccess !== true) ? ('trouble') : ('success');
        $message = (!isset($processRequestSuccess) || $processRequestSuccess !== true) ? ('Erro - requisição que foi bem-formada mas não pôde ser seguida devido a erros semânticos.') : ('API loading data (dados para carregamento da API)');
        $cod_http = (!isset($processRequestSuccess) || $processRequestSuccess !== true) ? (422) : (201);
        $apiRespond = [
            'status' => $status,
            'message' => $message,
            'date' => date('Y-m-d'),
            'api' => [
                'version' => '1.0',
                'method' => $getMethod,
                'description' => 'API Description',
                'content_type' => 'application/x-www-form-urlencoded'
            ],
            // 'method' => '__METHOD__',
            // 'function' => '__FUNCTION__',
            'result' => $dbResponse,
            'metadata' => [
                'page_title' => 'Application title',
                'getURI' => $this->uri->getSegments(),
                // Você pode adicionar campos comentados anteriormente se forem relevantes
                // 'method' => '__METHOD__',
                // 'function' => '__FUNCTION__',
            ]
        ];

        try {
            $response = $this->response->setJSON($apiRespond, $cod_http);
        } catch (\Exception $e) {
            $apiRespond = [
                'status' => 'error',
                'message' => $e->getMessage(),
                'date' => date('Y-m-d'),
                'api' => [
                    'version' => '1.0',
                    'method' => isset($getMethod) ? $getMethod : 'unknown',
                    'description' => 'API Criar Method',
                    'content_type' => 'application/x-www-form-urlencoded'
                ],
                'metadata' => [
                    'page_title' => 'ERRO - API Method',
                    'getURI' => $this->uri->getSegments(),
                ]
            ];
            $response = $this->response->setJSON($apiRespond, 500);
        }

        if ($json) {
            return $response;
            // return redirect()->to('project/endpoint/parameter/parameter/' . $parameter);
        } else {
            return $response;
            // return redirect()->back();
        }
    }

    private function checkMedicalRecords($parameter1 = 'cadastros', $parameter2 = NULL)
    {
        $requestDb = array();
        if ($parameter1 == 'cadastros') {
            $requestDb = $this->dbCleaner($parameter2);
            $requestDb = $requestDb->getBody();
            $requestDb = json_decode($requestDb, true);
            // myPrint($requestDb['result']['dbResponse'], '');
        }
        if (
            isset($requestDb['result']['dbResponse'][0]['UnidadeId'])
            && $requestDb['result']['dbResponse'][0]['UnidadeId'] !== null
            || isset($requestDb['result']['dbResponse'][0]['ProntuarioId'])
            && $requestDb['result']['dbResponse'][0]['ProntuarioId'] !== null
        ) {
            return false;
        }else{
            return true;
        }
    }

    # route POST /www/fia/ptpa/adolescente/api/deletar/(:any)
    # route GET /www/fia/ptpa/adolescente/api/deletar/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbDelete($parameter1 = NULL, $parameter2 = NULL)
    {
        $request = service('request');
        $getMethod = $request->getMethod();
        $processRequest = (array)$request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        // myPrint($parameter1, $parameter2);
        try {
            $this->checkMedicalRecords('cadastros', $parameter1);
            if (
                $parameter1 !== NULL
                && $parameter2 == 'eliminar'
                && $this->checkMedicalRecords('cadastros', $parameter1)
            ) {
                myPrint($parameter1, 'src\app\Controllers\AdolescenteApiController.php, 302', true);
                $dbResponse = $this->DbController->dbDelete($parameter1);
                $this->message->message(['Adolescente Eliminado com sucesso com Sucesso.'], 'success', $dbUpdate = array(), 5);
            } elseif (
                $parameter1 !== NULL
                && $parameter2 == 'restaurar'
            ) {
                $dbUpdate = array(
                    'deleted_at' => null
                );
                $dbResponse = $this->DbController->dbUpdate($parameter1, $dbUpdate);
                $this->message->message(['Adolescente Restaurado com sucesso com Sucesso.'], 'success', $dbUpdate = array(), 5);
            } elseif (
                $parameter1 !== NULL
                && $this->checkMedicalRecords('cadastros', $parameter1)
            ) {
                $dbUpdate = array(
                    'deleted_at' => date('Y-m-d H:i:s')
                );
                $dbResponse = $this->DbController->dbUpdate($parameter1, $dbUpdate);
                $this->message->message(['Adolescente Excluído com Sucesso.'], 'success', $dbUpdate = array(), 5);
            } else {
                $this->message->message(['Erro ao Excluir o Adolescente.'], 'warning', $dbUpdate = array(), 5);
            }
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
                'result' => $dbResponse,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                    // Você pode adicionar campos comentados anteriormente se forem relevantes
                    // 'method' => '__METHOD__',
                    // 'function' => '__FUNCTION__',
                ]
            ];
            $response = $this->response->setJSON($apiRespond, 201);
        } catch (\Exception $e) {
            $apiRespond = array(
                'message' => array('danger' => $e->getMessage()),
                'page_title' => 'Application title',
                'getURI' => $this->uri->getSegments(),
            );
            // $this->returnFunction(array($e->getMessage()), 'danger',);
            $response = $this->response->setJSON($apiRespond, 500);
        }
        if ($json == 1) {
            return $response;
            // return redirect()->back();
            // return redirect()->to('project/endpoint/parameter1/parameter/' . $parameter);
        } else {
            // return $response;
            return redirect()->back();
        }
    }

    # route POST /www/exemple/group/api/limpar/(:any)
    # route GET /www/exemple/group/api/limpar/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbCleaner($parameter = NULL)
    {
        # Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $getGet = $this->request->getGet('page');
        $page = (isset($getGet) && !empty($getGet)) ? ($getGet) : (1);
        $processRequest = (array)$request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        #
        // myPrint($getMethod, 'src\app\Controllers\AdolescenteApiController.php');
        try {
            #
            $id = isset($processRequest['id']) ? ($processRequest['id']) : ($parameter);
            $requestDb = $this->DbController->dbCleaner($id, $page);
            // myPrint($requestDb, '');
            #
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
                'result' => $requestDb,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                    // Você pode adicionar campos comentados anteriormente se forem relevantes
                    // 'method' => '__METHOD__',
                    // 'function' => '__FUNCTION__',
                ]
            ];
            $response = $this->response->setJSON($apiRespond, 201);
        } catch (\Exception $e) {
            $apiRespond = array(
                'message' => array('danger' => $e->getMessage()),
                'page_title' => 'Application title',
                'getURI' => $this->uri->getSegments(),
            );
            $this->message->message($message = array(), 'danger', $parameter, 5);
            $response = $this->response->setJSON($apiRespond, 500);
        }
        if ($json == 1) {
            return $response;
            // return redirect()->back();
            // return redirect()->to('project/endpoint/parameter/parameter/' . $parameter);
        } else {
            return $response;
        }
    }
}
