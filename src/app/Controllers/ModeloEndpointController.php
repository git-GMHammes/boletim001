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
}
