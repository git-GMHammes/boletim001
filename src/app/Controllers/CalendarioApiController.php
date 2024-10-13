<?php
#
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
# 
use App\Controllers\SystemCalendarController;
use App\Controllers\SystemMessageController;
// use App\Controllers\TokenCsrfController;
// use App\Controllers\ObjetoDbController;
// use App\Controllers\SystemUploadDbController;
# 
use Exception;

class CalendarioApiController extends ResourceController
{
    use ResponseTrait;
    private $ModelResponse;
    private $uri;
    private $tokenCsrf;
    private $DbController;
    private $message;
    private $calendario;

    public function __construct()
    {
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
        $this->calendario = new SystemCalendarController();
        $this->message = new SystemMessageController();
        // $this->DbController = new ObjetoDbController();
        // $this->tokenCsrf = new TokenCsrfController();
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

    #
    # route POST /www/exemple/group/api/exibir/(:any))
    # route GET /www/exemple/group/api/exibir/(:any))
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function getDiasMes($parameter1 = NULL, $parameter2 = NULL)
    {
        # Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $getGet = $this->request->getGet('page');
        $page = (isset($getGet) && !empty($getGet)) ? ($getGet) : (1);
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        #
        $getDiasMes = $this->calendario->getDiasMes($parameter1, $parameter2);
        // myPrint($getDiasMes, 'C:\Users\Habilidade.Com\AppData\Roaming\Code\User\snippets\php.json');
        if (
            isset($getDiasMes['dias']) &&
            $getDiasMes['dias'] === array() &&
            isset($getDiasMes['error'])
        ) {
            $status = 'error';
        } else {
            $status = 'success';
            // myPrint($getDiasMes, '', true);
        }
        // exit('src\app\Controllers\CalendarioApiController.php');
        try {
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
                'result' => $getDiasMes,
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
            $this->message->message($message = array(), 'danger', $parameter1 . ' ' . $parameter2, 5);
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
    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function create_update($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }
    #
    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbRead($parameter = NULL)
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