<?php
#
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
# 
use App\Controllers\TokenCsrfController;
use App\Controllers\SystemMessageController;
use App\Controllers\LinhaDbController;
// use App\Controllers\SystemUploadDbController;
# 
use Exception;

class LinhaApiController extends ResourceController
{
    use ResponseTrait;
    private $ModelResponse;
    private $uri;
    private $tokenCsrf;
    private $DbController;
    private $message;

    public function __construct()
    {
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
        $this->DbController = new LinhaDbController();
        $this->tokenCsrf = new TokenCsrfController();
        $this->message = new SystemMessageController();
        #
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

    # route POST /www/bw/Linha/api/cadastrar/(:any)
    # route GET /www/bw/Linha/api/cadastrar/(:any)
    # route POST /www/bw/Linha/api/atualizar/(:any)
    # route GET /www/bw/Linha/api/atualizar/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function create_update($parameter = NULL)
    {
        # Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        #
        // myPrint($processRequest, 'src\app\Controllers\LinhaApiController.phpn');
        #
        $token_csrf = (isset($processRequest['token_csrf']) ? $processRequest['token_csrf'] : NULL);
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $choice_update = (isset($processRequest['id']) && !empty($processRequest['id'])) ? (true) : (false);
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
                // return $this->response->setJSON($processRequest, 200);
                $dbResponse = $this->DbController->dbCreate($processRequest);
                if (isset($dbResponse["affectedRows"]) && $dbResponse["affectedRows"] > 0) {
                    $processRequestSuccess = true;
                }
            }
        } else {
            $this->message->message(['ERRO: Dados enviados inválidos'], 'danger');
        }
        ;
        if (session()->get('message')) {
            $apiSession = session()->get('message');
            // myPrint($apiSession, '');
        }
        $status = (!isset($processRequestSuccess) || $processRequestSuccess !== true) ? ('trouble') : ('success');
        $message = (!isset($processRequestSuccess) || $processRequestSuccess !== true) ? ('Erro - requisição que foi bem-formada mas não pôde ser seguida devido a erros semânticos.') : ('API loading data (dados para carregamento da API)');
        $cod_http = (!isset($processRequestSuccess) || $processRequestSuccess !== true) ? (422) : (201);
        try {
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
            // return redirect()->back();
            return $response;
        }
    }

    #
    # route POST /bw/Linha/api/exibir/(:any)
    # route GET /bw/Linha/api/exibir/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbRead($parameter = NULL)
    {
        # Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $getGet = $this->request->getGet('page');
        $page = (isset($getGet) && !empty($getGet)) ? ($getGet) : (1);
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        #
        // myPrint($getMethod, 'C:\Users\Habilidade.Com\AppData\Roaming\Code\User\snippets\php.json');
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

    # route POST /# www/project/group/api/filtrar/(:any)
    # route GET /# www/project/group/api/filtrar/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbFilter($parameter = NULL)
    {
        # Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $getGet = $this->request->getGet('page');
        $page = (isset($getGet) && !empty($getGet)) ? ($getGet) : (1);
        $processRequest = (array) $request->getVar();
        $processRequest = array_filter($processRequest);
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        // myPrint($processRequest, 'C:\Users\Habilidade.Com\AppData\Roaming\Code\User\snippets\php.json', true);
        #
        try {
            #
            // return $this->response->setJSON($processRequest, 200);
            $requestDb = $this->DbController->dbFilter($processRequest, $page);
            // myPrint($requestDb, 'C:\Users\Habilidade.Com\AppData\Roaming\Code\User\snippets\php.json', true);
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



    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbRead1($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }
    #
    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbDelete($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }
    #
    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbClear($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }
}
#
?>