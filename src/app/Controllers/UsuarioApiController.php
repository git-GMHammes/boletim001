<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\TokenCsrfController;
use App\Controllers\SystemMessageController;
use App\Controllers\UsuarioDbController;
use App\Controllers\SystemMailController;
// use App\Controllers\SystemUploadDbController;

use Exception;

class UsuarioApiController extends ResourceController
{
    use ResponseTrait;
    private $sendMail;
    private $ModelResponse;
    private $dbFields;
    private $uri;
    private $tokenCsrf;
    private $DbController;
    private $message;

    public function __construct()
    {
        $this->DbController = new UsuarioDbController();
        $this->tokenCsrf = new TokenCsrfController();
        $this->message = new SystemMessageController();
        $this->sendMail = new SystemMailController();
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
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        #
        // myPrint($getMethod, 'src\app\Controllers\ObjetoApiController.php');
        try {
            #
            $login = isset($processRequest['login']) ? ($processRequest['login']) : ('');
            $password = isset($processRequest['password']) ? ($processRequest['password']) : ('');
            $dbFilter = array(
                'login' => $login,
                'senha' => $password,
            );
            // myPrint($dbFilter, 'src\app\Controllers\UsuarioApiController.php', true);
            $requestDb1 = $this->DbController->dbFilter($dbFilter);
            // myPrint($requestDb1['dbResponse'], 'src\app\Controllers\UsuarioApiController.php', true);
            if ($requestDb1['dbResponse'] && count($requestDb1['dbResponse']) === 1) {
                // myPrint($requestDb1['dbResponse'][0], 'src\app\Controllers\UsuarioApiController.php');
                $id = isset($requestDb1['dbResponse'][0]['id']) ? $requestDb1['dbResponse'][0]['id'] : null;
            } else {
                $id = isset($processRequest['id']) ? ($processRequest['id']) : ($parameter);
            }
            $requestDb2 = $this->DbController->dbRead($id, $page);
            // myPrint($requestDb2, 'src\app\Controllers\UsuarioApiController.php');
            if (
                isset($requestDb2['dbResponse'][0]['email'])
                && isset($requestDb2['dbResponse'][0]['login'])
                && isset($requestDb2['dbResponse'][0]['nome'])
            ) {
                $email = isset($requestDb2['dbResponse'][0]['email']) ? $requestDb2['dbResponse'][0]['email'] : (null);
                $login = isset($requestDb2['dbResponse'][0]['login']) ? $requestDb2['dbResponse'][0]['login'] : (null);
                $nome = isset($requestDb2['dbResponse'][0]['nome']) ? $requestDb2['dbResponse'][0]['nome'] : (null);
                $sessionData = array(
                    'email' => $email,
                    'login' => $login,
                    'nome' => $nome,
                );
                $apiRespond = array(
                    'name_session' => 'login_bom',
                    'time_in_seconds' => 36000
                );
                #
                session()->set($apiRespond['name_session'], $sessionData);
                session()->markAsTempdata($apiRespond['name_session'], $apiRespond['time_in_seconds']);
            }
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
                'result' => $requestDb2,
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

    # route POST /# www/fia/ptpa/modelo/api/filtrar/(:any)
    # route GET /# www/fia/ptpa/modelo/api/filtrar/(:any)
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
        #
        try {
            #
            // return $this->response->setJSON($processRequest, 200);
            // myPrint($processRequest, 'src\app\Controllers\ObjetoApiController.php');
            $requestDb = $this->DbController->dbFilter($processRequest, $page);
            // myPrint($requestDb, 'src\app\Controllers\ObjetoApiController.php', true);
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
        $processRequest = (array) $request->getVar();
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
        }
        ;

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

    # route POST /www/fia/ptpa/modelo/api/deletar/(:any)
    # route GET /www/fia/ptpa/modelo/api/deletar/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbDelete($parameter1 = NULL, $parameter2 = NULL)
    {
        $request = service('request');
        $getMethod = $request->getMethod();
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        // myPrint($parameter1, $parameter2);
        try {
            $this->checkMedicalRecords('cadastros', $parameter1);
            if (
                $parameter1 !== NULL
                && $parameter2 == 'eliminar'
                && $this->checkMedicalRecords('cadastros', $parameter1)
            ) {
                myPrint($parameter1, 'src\app\Controllers\ObjetoApiController.php, 302', true);
                $dbResponse = $this->DbController->dbDelete($parameter1);
                $this->message->message(['Objeto Eliminado com sucesso com Sucesso.'], 'success', $dbUpdate = array(), 5);
            } elseif (
                $parameter1 !== NULL
                && $parameter2 == 'restaurar'
            ) {
                $dbUpdate = array(
                    'deleted_at' => null
                );
                $dbResponse = $this->DbController->dbUpdate($parameter1, $dbUpdate);
                $this->message->message(['Objeto Restaurado com sucesso com Sucesso.'], 'success', $dbUpdate = array(), 5);
            } elseif (
                $parameter1 !== NULL
                && $this->checkMedicalRecords('cadastros', $parameter1)
            ) {
                $dbUpdate = array(
                    'deleted_at' => date('Y-m-d H:i:s')
                );
                $dbResponse = $this->DbController->dbUpdate($parameter1, $dbUpdate);
                $this->message->message(['Objeto Excluído com Sucesso.'], 'success', $dbUpdate = array(), 5);
            } else {
                $this->message->message(['Erro ao Excluir o Objeto.'], 'warning', $dbUpdate = array(), 5);
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
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        #
        // myPrint($getMethod, 'src\app\Controllers\ObjetoApiController.php');
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

    #
    # route POST /www/bw/habilidade/usuario/api/loginEtapa1/(:any)
    # route GET /www/bw/habilidade/usuario/api/loginEtapa1/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function loginEtapa1($parameter = NULL)
    {
        # Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $getGet = $this->request->getGet('page');
        $page = (isset($getGet) && !empty($getGet)) ? ($getGet) : (1);
        $processRequest = (array) $request->getVar();
        // myPrint($processRequest, 'src\app\Controllers\UsuarioApiController.php', true);
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        #
        $id = isset($processRequest['id']) ? ($processRequest['id']) : ($parameter);
        $requestDb = $this->DbController->dbFilterAuth($processRequest);
        // myPrint($requestDb, 'src\app\Controllers\UsuarioApiController.php');
        if (isset($requestDb['dbResponse'][0])) {
            $status = 'success';
            $codigo = 201;
            $sendMail = $this->sendMail->sendLoginEtapa1($requestDb);
        } else {
            $status = 'Bad Request';
            $codigo = 400;
            $sendMail = array(
                'id' => '',
                'cpf' => '',
                'mail' => '',
                'access_key_01' => '',
                'access_key_02' => '',
                'access_key_03' => '',
                'created_at' => '',
                'updated_at' => '',
                'deleted_at' => ''
            );
        }
        #
        // myPrint($requestDb, 'C:\Users\Habilidade.Com\AppData\Roaming\Code\User\snippets\php.json');
        #
        $apiRespond = [
            'status' => $status,
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
            'result' => $sendMail,
            'metadata' => [
                'page_title' => 'Application title',
                'getURI' => $this->uri->getSegments(),
                // Você pode adicionar campos comentados anteriormente se forem relevantes
                // 'method' => '__METHOD__',
                // 'function' => '__FUNCTION__',
            ]
        ];
        $response = $this->response->setJSON($apiRespond, $codigo);
        try {
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

    #
    # route POST /www/bw/habilidade/usuario/api/loginEtapa2/(:any)
    # route GET /www/bw/habilidade/usuario/api/loginEtapa2/(:any)
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function loginEtapa2($parameter1 = NULL, $parameter2 = NULL, $parameter3 = NULL)
    {
        # Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $getGet = $this->request->getGet('page');
        $page = (isset($getGet) && !empty($getGet)) ? ($getGet) : (1);
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $dbResponse = array();
        #
        // myPrint($parameter1, 'C:\Users\Habilidade.Com\AppData\Roaming\Code\User\snippets\php.json', true);
        // myPrint($parameter2, 'C:\Users\Habilidade.Com\AppData\Roaming\Code\User\snippets\php.json', true);
        // myPrint($parameter3, 'C:\Users\Habilidade.Com\AppData\Roaming\Code\User\snippets\php.json');
        if (
            $parameter1 !== null &&
            $parameter2 !== null &&
            $parameter3 !== null
        ) {
            $dbFilter = array(
                'access_key_01' => $parameter1,
                'access_key_02' => $parameter2,
                'access_key_03' => $parameter3,
            );
            // myPrint($dbFilter, 'src\app\Controllers\UsuarioApiController.php', true);
            $requestDb = $this->DbController->dbFilterAuth($dbFilter);
            // myPrint($requestDb['dbResponse'][0], 'src\app\Controllers\UsuarioApiController.php', true);
        }
        if (isset($requestDb['dbResponse'][0])) {
            $apiRespond = array(
                'name_session' => 'filterDeploy',
                'time_in_seconds' => 36000
            );
            #
            session()->set($apiRespond['name_session'], $requestDb['dbResponse'][0]);
            session()->markAsTempdata($apiRespond['name_session'], $apiRespond['time_in_seconds']);
        }
        if (isset($requestDb['dbResponse'][0]['id'])) {
            $id = $requestDb['dbResponse'][0]['id'];
            $dbUpdate = array(
                'access_key_01' => strtoupper(md5($parameter1 . time())),
                'access_key_02' => strtoupper(md5($parameter2 . time())),
                'access_key_03' => strtoupper(md5($parameter3 . time())),
            );
            // myPrint($dbUpdate, 'src\app\Controllers\UsuarioApiController.php');
            $dbResponse = $this->DbController->dbUpdateAuth($id, $dbUpdate);
        }
        $varSession = (session()->get('filterDeploy')) ? (session()->get('filterDeploy')) : (array());
        // myPrint($varSession, 'src\app\Controllers\UsuarioApiController.php, LINHA 543');
        try {
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
            $this->message->message($message = array(), 'danger', $parameter = array(), 5);
            $response = $this->response->setJSON($apiRespond, 500);
        }
        if ($json == 1) {
            return $response;
            // return redirect()->back();
        } else {
            return redirect()->to('/bw/usuario/endpoint/login');
            // return $response;
        }
    }
    #
}
