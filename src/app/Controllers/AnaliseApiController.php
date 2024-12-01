<?php
#
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
# 
use App\Controllers\EmpresaDbController;
// use App\Controllers\TokenCsrfController;
// use App\Controllers\SystemMessageController;
// use App\Controllers\ObjetoDbController;
// use App\Controllers\SystemUploadDbController;
# 
use Exception;

class AnaliseApiController extends ResourceController
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
        $this->DbController = new EmpresaDbController();
        // $this->DbController = new ObjetoDbController();
        // $this->tokenCsrf = new TokenCsrfController();
        // $this->message = new SystemMessageController();
        #
    }

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function index($parameter = NULL)
    {
        $request = service('request');
        $apiRespond['getMethod'] = $request->getMethod();
        $apiRespond['method'] = __METHOD__;
        $apiRespond['function'] = __FUNCTION__;
        $apiRespond['message'] = '403 Forbidden - Directory access is forbidden.';
        return $this->response->setStatusCode(403)->setJSON($apiRespond);
    }

    /**
     * Função auxiliar para gerar valores únicos
     */
    private function uniqueValue($prefix)
    {
        return $prefix . '_' . bin2hex(random_bytes(6)); // Gera um identificador único com prefixo
    }

    /**
     * Função para gerar um registro único
     */
    public function generateUniqueRecord()
    {
        return [
            "id" => random_int(1, 1000000), // ID único aleatório
            "codigo" => $this->uniqueValue("COD"), // Código único com prefixo COD
            "nome" => $this->uniqueValue("Empresa"), // Nome fictício único da empresa
            "responsavel" => $this->uniqueValue("Responsavel"), // Nome fictício único do responsável
            "email_contato" => $this->uniqueValue("email") . "@example.com", // Email único
            "inicio_vigencia_bom" => date("Y-m-d", strtotime("+30 days")), // Data única fixa
            "active" => random_int(0, 1), // Ativo/Inativo: 0 ou 1 aleatório
            "data_criacao" => date("Y-m-d H:i:s", strtotime("-1 year")), // Data fictícia, 1 ano atrás
            "created_at" => date("Y-m-d H:i:s"), // Timestamp atual
            "updated_at" => date("Y-m-d H:i:s"), // Timestamp atual
            "deleted_at" => null, // Sempre NULL para não excluído
        ];
    }

    /**
     * Gera registros fictícios e insere no banco de dados
     */
    public function dbFakeEmpresa($id = null)
    {
        for ($i = 0; $i < 1000; $i++) {
            $record = $this->generateUniqueRecord();
            $this->DbController->dbCreate($record); // Insere no banco de dados
        }

        // Exibe o último registro gerado
        myPrint($record, 'src\app\Controllers\AnaliseApiController.php');
    }

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function create_update($parameter = NULL)
    {
        $request = service('request');
        $apiRespond['getMethod'] = $request->getMethod();
        $apiRespond['method'] = __METHOD__;
        $apiRespond['function'] = __FUNCTION__;
        $apiRespond['message'] = '403 Forbidden - Directory access is forbidden.';
        return $this->response->setStatusCode(403)->setJSON($apiRespond);
    }

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbRead($parameter = NULL)
    {
        $request = service('request');
        $apiRespond['getMethod'] = $request->getMethod();
        $apiRespond['method'] = __METHOD__;
        $apiRespond['function'] = __FUNCTION__;
        $apiRespond['message'] = '403 Forbidden - Directory access is forbidden.';
        return $this->response->setStatusCode(403)->setJSON($apiRespond);
    }

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbDelete($parameter = NULL)
    {
        $request = service('request');
        $apiRespond['getMethod'] = $request->getMethod();
        $apiRespond['method'] = __METHOD__;
        $apiRespond['function'] = __FUNCTION__;
        $apiRespond['message'] = '403 Forbidden - Directory access is forbidden.';
        return $this->response->setStatusCode(403)->setJSON($apiRespond);
    }

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbClear($parameter = NULL)
    {
        $request = service('request');
        $apiRespond['getMethod'] = $request->getMethod();
        $apiRespond['method'] = __METHOD__;
        $apiRespond['function'] = __FUNCTION__;
        $apiRespond['message'] = '403 Forbidden - Directory access is forbidden.';
        return $this->response->setStatusCode(403)->setJSON($apiRespond);
    }
}
#
?>