<?php

namespace App\Controllers;

// use App\Models\UploadModel;
use App\Controllers\SystemBaseController;
use App\Controllers\SystemMessageController;
use App\Models\UsuarioModels;
use App\Models\AuthModels;
use Exception;

class UsuarioDbController extends BaseController
{
    // private $ModelUpload;
    private $ModelUsuario;
    private $ModelAuth;
    private $pagination;
    private $message;
    private $uri;

    // $this->pagination = new SystemBaseController();
    // $linksArray = $this->pagination->extractPaginationLinks($paginationLinks);

    public function __construct()
    {
        // $this->ModelUpload = new UploadModel();
        $this->ModelUsuario = new UsuarioModels();
        $this->ModelAuth = new AuthModels();
        $this->pagination = new SystemBaseController();
        $this->message = new SystemMessageController();
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
        $this->message = new SystemMessageController();
    }

    // route POST /www/sigla/rota
    // route GET /www/sigla/rota
    // Informação sobre o controller
    // retorno do controller [JSON]
    public function index($parameter = NULL)
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }

    // use App\Controllers\SystemUploadDbController;
    // private $DbController;
    // $this->DbController = new SystemUploadDbController();
    // $this->DbController->dbFields($fileds = array();
    public function dbFields($processRequestFields = array())
    {
        // myPrint($processRequestFields, 'src\app\Controllers\SystemUploadDbController.php', true);
        $dbCreate = array();
        $autoColumn = $this->ModelUsuario->getColumnsFromTable();
        if (isset($autoColumn['COLUMN'])) {
            foreach ($autoColumn['COLUMN'] as $key_autoColumn => $value_autoColumn) {
                // myPrint($value_autoColumn, '', true);
                (isset($processRequestFields[$value_autoColumn])) ? ($dbCreate[$value_autoColumn] = $processRequestFields[$value_autoColumn]) : (NULL);
            }
        }
        (isset($processRequestFields['modelo'])) ? ($dbCreate['modeloDb'] = $processRequestFields['modelo']) : (NULL);
        // myPrint($dbCreate, 'src\app\Controllers\ExempleDbController.php');
        return ($dbCreate);
    }

    // use App\Controllers\SystemUploadDbController;
    // private $DbController;
    // $this->DbController = new SystemUploadDbController();
    // $this->DbController->dbFields($fileds = array();
    public function dbFieldsAuth($processRequestFields = array())
    {
        // myPrint($processRequestFields, 'src\app\Controllers\SystemUploadDbController.php', true);
        $dbCreate = array();
        $autoColumn = $this->ModelAuth->getColumnsFromTable();
        if (isset($autoColumn['COLUMN'])) {
            foreach ($autoColumn['COLUMN'] as $key_autoColumn => $value_autoColumn) {
                // myPrint($value_autoColumn, '', true);
                (isset($processRequestFields[$value_autoColumn])) ? ($dbCreate[$value_autoColumn] = $processRequestFields[$value_autoColumn]) : (NULL);
            }
        }
        (isset($processRequestFields['modelo'])) ? ($dbCreate['modeloDb'] = $processRequestFields['modelo']) : (NULL);
        // myPrint($dbCreate, 'src\app\Controllers\ExempleDbController.php 80');
        return ($dbCreate);
    }

    // use App\Controllers\TokenCsrfController;
    // $this->DbController = new ExempleDbController();
    // $this->DbController->dbCreate($parameter);
    public function dbCreate($parameter = NULL)
    {
        try {
            $this->ModelCadastro->dbCreate($this->dbFields($parameter));
            $affectedRows = $this->ModelCadastro->affectedRows();
            if ($affectedRows > 0) {
                $dbCreate['insertID'] = $this->ModelCadastro->insertID();
                $dbCreate['affectedRows'] = $affectedRows;
                $dbCreate['dbCreate'] = $parameter;
            } else {
                $dbCreate['insertID'] = NULL;
                $dbCreate['affectedRows'] = $affectedRows;
                $dbCreate['dbCreate'] = $parameter;
            }
            $response = $dbCreate;
        } catch (\Exception $e) {
            if (DEBUG_MY_PRINT) {
                myPrint($e->getMessage(), 'src\app\Controllers\ExempleDbController.php');
            }
            $message = $e->getMessage();
            $this->message->message([$message], 'danger', $parameter, 5);
            $response = array();
        }
        return $response;
    }

    // route POST /www/sigla/rota
    // route GET /www/sigla/rota
    // Informação sobre o controller
    // retorno do controller [JSON]
    public function dbRead($parameter = NULL, $page = 1)
    {
        // Parâmentros para receber um POST
        $request = service('request');
        $processRequest = (array) $request->getVar();
        $limit = 10;
        $getURI = $this->uri->getSegments();
        if (in_array('select', $getURI)) {
            $limit = 200;
        }
        // $processRequest = eagarScagaire($processRequest);
        //
        try {
            if (isset($processRequest['id'])) {
                $dbResponse = $this
                    ->ModelUsuario
                    ->where('id', $processRequest['id'])
                    ->where('deleted_at', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                //
            } elseif ($parameter !== NULL) {
                $dbResponse = $this
                    ->ModelUsuario
                    ->where('id', $parameter)
                    ->where('deleted_at', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                //
            } else {
                $dbResponse = $this
                    ->ModelUsuario
                    ->where('deleted_at', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate($limit, 'paginator', $page);
                //
            }
            ;
            // Paginação
            $pager = \Config\Services::pager();
            $paginationLinks = $pager->makeLinks($page, $limit, $pager->getTotal('paginator'), 'default_full');
            $linksArray = $this->pagination->extractPaginationLinks($paginationLinks);
            //
            $response = array(
                'dbResponse' => $dbResponse,
                'linksArray' => $linksArray
            );
        } catch (\Exception $e) {
            if (DEBUG_MY_PRINT) {
                myPrint($e->getMessage(), 'src\app\Controllers\ExempleDbController.php');
            }
            $message = $e->getMessage();
            $this->message->message([$message], 'danger', $parameter, 5);
            $response = array();
        }
        // exit('src\app\Controllers\UsuarioDbController.php');
        return $response;
    }

    // route POST /www/sigla/rota
    // route GET /www/sigla/rota
    // Informação sobre o controller
    // retorno do controller [JSON]
    public function dbFilter($parameter = NULL, $page = 1)
    {
        $uri = $this->uri->getSegments();
        $limit = (in_array('filtrar', $uri)) ? (200) : (10);
        // Parâmentros para receber um POST
        $request = service('request');
        $processRequest = (array) $request->getVar();
        //
        try {
            $query = $this
                ->ModelUsuario
                ->where('deleted_at', NULL);
            foreach ($parameter as $key => $value) {
                $query = $query->like($key, $value);
            }

            $dbResponse = $query
                ->orderBy('id', 'DESC')
                ->paginate($limit, 'paginator', $page);

            // Paginação
            $pager = \Config\Services::pager();
            $paginationLinks = $pager->makeLinks($page, $limit, $pager->getTotal('paginator'), 'default_full');
            $linksArray = $this->pagination->extractPaginationLinks($paginationLinks);
            //
            $response = array(
                'dbResponse' => $dbResponse,
                'linksArray' => $linksArray
            );
            //
        } catch (\Exception $e) {
            if (DEBUG_MY_PRINT) {
                myPrint($e->getMessage(), 'src\app\Controllers\ExempleDbController.php');
            }
            $message = $e->getMessage();
            $this->message->message([$message], 'danger', $parameter, 5);
            $response = array();
        }
        return $response;
    }

    // route POST /www/sigla/rota
    // route GET /www/sigla/rota
    // Informação sobre o controller
    // retorno do controller [JSON]
    public function dbFilterAuth($parameter = NULL, $page = 1)
    {
        // myPrint($parameter, 'src\app\Controllers\UsuarioDbController.php, Linha 229', true);
        $uri = $this->uri->getSegments();
        $limit = (in_array('filtrar', $uri)) ? (200) : (10);
        $parameter = $this->dbFieldsAuth($parameter);
        // myPrint($parameter, 'src\app\Controllers\UsuarioDbController.php, Linha 233', true);
        //
        try {
            $query = $this
                ->ModelAuth
                ->where('deleted_at', NULL);
            foreach ($parameter as $key => $value) {
                // myPrint($key,'', true);
                // myPrint($value, '', true);
                $query = $query->like($key, $value);
            }

            $dbResponse = $query
                ->orderBy('id', 'DESC')
                ->paginate($limit, 'paginator', $page);

            // Paginação
            $pager = \Config\Services::pager();
            $paginationLinks = $pager->makeLinks($page, $limit, $pager->getTotal('paginator'), 'default_full');
            $linksArray = $this->pagination->extractPaginationLinks($paginationLinks);
            //
            $response = array(
                'dbResponse' => $dbResponse,
                'linksArray' => $linksArray
            );
            //
        } catch (\Exception $e) {
            if (DEBUG_MY_PRINT) {
                // myPrint($e->getMessage(), 'src\app\Controllers\ExempleDbController.php');
            }
            $message = $e->getMessage();
            $this->message->message([$message], 'danger', $parameter, 5);
            $response = array();
        }
        // myPrint($response, 'src\app\Controllers\UsuarioDbController.php, Linha 266');
        return $response;
    }

    // route POST /www/sigla/rota
    // route GET /www/sigla/rota
    // Informação sobre o controller
    // retorno do controller [JSON]
    public function dbUpdate($key, $parameter = NULL)
    {
        try {
            if (
                $parameter['deleted_at'] == null
                && count($parameter) == 1
            ) {
                $this->ModelCadastro->dbUpdate($key, $parameter);
            } else {
                $this->ModelCadastro->dbUpdate($key, $this->dbFields($parameter));
            }
            $affectedRows = $this->ModelCadastro->affectedRows();
            if ($affectedRows > 0) {
                $dbUpdate['updateID'] = $key;
                $dbUpdate['affectedRows'] = $affectedRows;
                $dbUpdate['dbUpdate'] = $parameter;
            } else {
                $dbUpdate['updateID'] = $key;
                $dbUpdate['affectedRows'] = $affectedRows;
                $dbUpdate['dbUpdate'] = $parameter;
            }
            $response = $dbUpdate;
        } catch (\Exception $e) {
            if (DEBUG_MY_PRINT) {
                myPrint($e->getMessage(), 'src\app\Controllers\ExempleDbController.php');
            }
            $message = $e->getMessage();
            $this->message->message([$message], 'danger', $parameter, 5);
            $response = array();
        }
        return $response;
    }

    // route POST /www/sigla/rota
    // route GET /www/sigla/rota
    // Informação sobre o controller
    // retorno do controller [JSON]
    public function dbUpdateAuth($key, $parameter = NULL)
    {
        try {
            if (
                isset($parameter['deleted_at'])
                && $parameter['deleted_at'] == null
                && count($parameter) == 1
            ) {
                $this->ModelAuth->dbUpdate($key, $parameter);
            } else {
                $teste = $this->dbFieldsAuth($parameter);
                // myPrint($teste, 'src\app\Controllers\UsuarioDbController.php 322');
                $this->ModelAuth->dbUpdate($key, $this->dbFieldsAuth($parameter));
            }
            $affectedRows = $this->ModelAuth->affectedRows();
            if ($affectedRows > 0) {
                $dbUpdate['updateID'] = $key;
                $dbUpdate['affectedRows'] = $affectedRows;
                $dbUpdate['dbUpdate'] = $parameter;
            } else {
                $dbUpdate['updateID'] = $key;
                $dbUpdate['affectedRows'] = $affectedRows;
                $dbUpdate['dbUpdate'] = $parameter;
            }
            $response = $dbUpdate;
        } catch (\Exception $e) {
            if (DEBUG_MY_PRINT) {
                myPrint($e->getMessage(), 'src\app\Controllers\ExempleDbController.php');
            }
            $message = $e->getMessage();
            $this->message->message([$message], 'danger', $parameter, 5);
            $response = array();
        }
        return $response;
    }

    // route POST /www/sigla/rota
    // route GET /www/sigla/rota
    // Informação sobre o controller
    // retorno do controller [JSON]
    public function dbDelete($parameter = NULL)
    {
        try {
            $this->ModelCadastro->dbDelete('id', $parameter);
            $affectedRows = $this->ModelCadastro->affectedRows();
            if ($affectedRows > 0) {
                $dbUpdate['updateID'] = $parameter;
                $dbUpdate['affectedRows'] = $affectedRows;
            } else {
                $dbUpdate['updateID'] = $parameter;
                $dbUpdate['affectedRows'] = $affectedRows;
            }
            $response = $dbUpdate;
        } catch (\Exception $e) {
            if (DEBUG_MY_PRINT) {
                myPrint($e->getMessage(), 'src\app\Controllers\ExempleDbController.php');
            }
            $message = $e->getMessage();
            $this->message->message([$message], 'danger', $parameter, 5);
            $response = array();
        }
        return $response;
    }

    // route POST /www/sigla/rota
    // route GET /www/sigla/rota
    // Informação sobre o controller
    // retorno do controller [JSON]
    public function dbCleaner($parameter = NULL, $page = 1)
    {
        // Parâmentros para receber um POST
        $request = service('request');
        $getMethod = $request->getMethod();
        $processRequest = (array) $request->getVar();
        $json = isset($processRequest['json']) && $processRequest['json'] == 1 ? 1 : 0;
        $limit = 10;
        try {
            if (isset($processRequest['id'])) {
                $dbResponse = $this
                    ->ModelUsuario
                    ->where('id', $processRequest['id'])
                    ->where('deleted_at !=', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                //
            } elseif ($parameter !== NULL) {
                $dbResponse = $this
                    ->ModelUsuario
                    ->where('id', $parameter)
                    ->where('deleted_at !=', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                //
            } else {
                $dbResponse = $this
                    ->ModelUsuario
                    ->where('deleted_at !=', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate($limit, 'paginator', $page);
                //
            }
            ;
            // Paginação
            $pager = \Config\Services::pager();
            $paginationLinks = $pager->makeLinks($page, $limit, $pager->getTotal('paginator'), 'default_full');
            $linksArray = $this->pagination->extractPaginationLinks($paginationLinks);
            //
            $response = array(
                'dbResponse' => $dbResponse,
                'linksArray' => $linksArray
            );
            //
        } catch (\Exception $e) {
            if (DEBUG_MY_PRINT) {
                myPrint($e->getMessage(), 'src\app\Controllers\ExempleDbController.php');
            }
            $message = $e->getMessage();
            $this->message->message([$message], 'danger', $parameter, 5);
            $response = array();
        }
        return $response;
    }
}
