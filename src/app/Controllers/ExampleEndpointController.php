<?php

namespace App\Controllers;

use App\Controllers\TokenCsrfController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class ExampleEndpointController extends ResourceController
{
    use ResponseTrait;

    private $template = 'boletim_operacao_mensal/templates/main';
    private $message = 'boletim_operacao_mensal/message';
    private $footer = 'boletim_operacao_mensal/footer';
    private $head = 'boletim_operacao_mensal/head';
    private $menu = 'boletim_operacao_mensal/menu';
    private $tokenCsrf;
    private $ModelResponse;
    private $uri;
    private $token;

#
    public function __construct()
    {
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
        $this->tokenCsrf = new TokenCsrfController();
        $this->token = isset($_COOKIE['token']) ? $_COOKIE['token'] : '123';
    }

# route POST /www/sigla/rota
# route GET /www/sigla/rota
# Informação sobre o controller
# retorno do controller [view]
    public function index($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_login/(:any)
# route POST /www/exemple/group/endpoint/bom_login/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomLogin($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/000_login/main', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_main/(:any)
# route POST /www/exemple/group/endpoint/bom_main/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomMain($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/001_main/main', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_empresa_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_empresa_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomEmpresaFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/002_empresa/001_filtrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_Empresa/(:any)
# route POST /www/exemple/group/endpoint/bom_Empresa/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomEmpresaCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/002_empresa/002_cadastrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_linha_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_linha_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomLinhaFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/003_linha/001_filtrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_linha/(:any)
# route POST /www/exemple/group/endpoint/bom_linha/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomLinhaCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/003_linha/002_cadastrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomVeiculoFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/004_veiculo/001_filtrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomVeiculoCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/004_veiculo/002_cadastrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomLinhaTipoFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/005_linha_tipo/001_filtrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomLinhaTipoCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/005_linha_tipo/002_cadastrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomTarifaFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/006_tarifa/001_filtrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomTarifaCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/006_tarifa/002_cadastrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomUsuarioFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/007_usuario/001_filtrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomUsuarioCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/007_usuario/002_cadastrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/008_bom/001_filtrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/008_bom/002_cadastrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomConfiguracoesHome($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/010_configuracoes/001_home', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomConfiguracoesBom($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/010_configuracoes/002_bom', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomConfiguracoesPermissoes($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/010_configuracoes/003_permissoes', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomRelatorioFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/011_relatorio/001_relario', $apiRespond);
        }
    }
# Consumo de API
# route GET /www/exemple/group/endpoint/bom_relatorio_pendente/(:any)
# route POST /www/exemple/group/endpoint/bom_relatorio_pendente/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomRelatorioPendente($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/008_bom/003_pendentes', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomRelatorioCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/011_relatorio/001_relario', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomLogFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/009_log/001_filtrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomLogCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/009_log/002_cadastrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomImportarLinhasFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/012_importar_linhas/001_importar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomImportarLinhasCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/012_importar_linhas/002_cadastrar', $apiRespond);
        }
    }


# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomTarifaRetroativaFiltrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/013_tarifa_retroativa/001_filtrar', $apiRespond);
        }
    }

# Consumo de API
# route GET /www/exemple/group/endpoint/bom_veiculo/(:any)
# route POST /www/exemple/group/endpoint/bom_veiculo/(:any)
# Informação sobre o controller
# retorno do controller [VIEW]
    public function bomTarifaRetroativaCadastrar($parameter = NULL)
    {
    # $this->token_csrf();
        $request = service('request');
        $getMethod = $request->getMethod();
        $getVar_page = $request->getVar('page');
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $id = (isset($processRequest['id'])) ? ('/' . $processRequest['id']) : ('/' . $parameter);
    # myPrint('TESTE', 'src\app\Controllers\ExampleEndpointController.php');
    #
        $loadView = array(
            $this->head,
            $this->menu,
            $this->message,
            $this->footer
        );
        try {
        # URI da API
            $endPoint['objeto'] = myEndPoint('index.php/projeto/endereco/api/verbo', '123');
            $requestJSONform['objeto'] = isset($endPoint['objeto']['result']) ? $endPoint['objeto']['result'] : array();
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
            # 'method' => '__METHOD__',
            # 'function' => '__FUNCTION__',
                'result' => $processRequest,
                'loadView' => $loadView,
                'metadata' => [
                    'page_title' => 'Application title',
                    'getURI' => $this->uri->getSegments(),
                # Você pode adicionar campos comentados anteriormente se forem relevantes
                # 'method' => '__METHOD__',
                # 'function' => '__FUNCTION__',
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
                    'page_title' => 'ERRO - API Method',
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
        # return $apiRespond;
        # return view($this->template, $apiRespond);
            return view('Exemplo/bom_clone/013_tarifa_retroativa/002_cadastrar', $apiRespond);
        }
    }
}
