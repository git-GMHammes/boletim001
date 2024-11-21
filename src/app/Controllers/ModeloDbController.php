<?php

namespace App\Controllers;

// use App\Models\UploadModel;
use App\Controllers\SystemBaseController;
use App\Controllers\SystemMessageController;
use App\Models\CadastrosModels;
use App\Models\VCadastroObjetosModels;
use Exception;

class ModeloDbController extends BaseController
{
    // private $ModelUpload;
    private $ModelVCadastroObjetos;
    private $ModelCadastro;
    private $pagination;
    private $message;
    private $uri;

    // $this->pagination = new SystemBaseController();
    // $linksArray = $this->pagination->extractPaginationLinks($paginationLinks);

    public function __construct()
    {
        // $this->ModelUpload = new UploadModel();
        $this->ModelVCadastroObjetos = new VCadastroObjetosModels();
        $this->pagination = new SystemBaseController();
        $this->message = new SystemMessageController();
        $this->ModelCadastro = new CadastrosModels();
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
        $autoColumn = $this->ModelObjetos->getColumnsFromTable();
        if (isset($autoColumn['COLUMN'])) {
            foreach ($autoColumn['COLUMN'] as $key_autoColumn => $value_autoColumn) {
                // myPrint($value_autoColumn, '', true);
                (isset($processRequestFields[$value_autoColumn])) ? ($dbCreate[$value_autoColumn] = $processRequestFields[$value_autoColumn]) : (NULL);
            }
        }
        if ($dbCreate == array()) {
            (isset($processRequestFields['id'])) ? ($dbCreate['id'] = $processRequestFields['id']) : (NULL);
            (isset($processRequestFields['unidade_id'])) ? ($dbCreate['unidade_id'] = $processRequestFields['unidade_id']) : (NULL);
            (isset($processRequestFields['NMatriculaCertidao'])) ? ($dbCreate['NMatriculaCertidao'] = $processRequestFields['NMatriculaCertidao']) : (NULL);
            (isset($processRequestFields['CPFObjeto'])) ? ($dbCreate['CPFObjeto'] = $processRequestFields['CPFObjeto']) : (NULL);
            (isset($processRequestFields['DataNascimentoObjeto'])) ? ($dbCreate['DataNascimentoObjeto'] = $processRequestFields['DataNascimentoObjeto']) : (NULL);
            (isset($processRequestFields['NomeObjeto'])) ? ($dbCreate['NomeObjeto'] = $processRequestFields['NomeObjeto']) : (NULL);
            (isset($processRequestFields['Enderecodolescente'])) ? ($dbCreate['Enderecodolescente'] = $processRequestFields['Enderecodolescente']) : (NULL);
            (isset($processRequestFields['TelefoneObjeto'])) ? ($dbCreate['TelefoneObjeto'] = $processRequestFields['TelefoneObjeto']) : (NULL);
            (isset($processRequestFields['Certidao'])) ? ($dbCreate['Certidao'] = $processRequestFields['Certidao']) : (NULL);
            (isset($processRequestFields['NumRegistro'])) ? ($dbCreate['NumRegistro'] = $processRequestFields['NumRegistro']) : (NULL);
            (isset($processRequestFields['Folha'])) ? ($dbCreate['Folha'] = $processRequestFields['Folha']) : (NULL);
            (isset($processRequestFields['Livro'])) ? ($dbCreate['Livro'] = $processRequestFields['Livro']) : (NULL);
            (isset($processRequestFields['Circunscricao'])) ? ($dbCreate['Circunscricao'] = $processRequestFields['Circunscricao']) : (NULL);
            (isset($processRequestFields['Zona'])) ? ($dbCreate['Zona'] = $processRequestFields['Zona']) : (NULL);
            (isset($processRequestFields['UFRegistro'])) ? ($dbCreate['UFRegistro'] = $processRequestFields['UFRegistro']) : (NULL);
            (isset($processRequestFields['BairroAdokescente'])) ? ($dbCreate['BairroAdokescente'] = $processRequestFields['BairroAdokescente']) : (NULL);
            (isset($processRequestFields['SexoObjeto'])) ? ($dbCreate['SexoObjeto'] = $processRequestFields['SexoObjeto']) : (NULL);
            (isset($processRequestFields['IdentGeneroObjeto'])) ? ($dbCreate['IdentGeneroObjeto'] = $processRequestFields['IdentGeneroObjeto']) : (NULL);
            (isset($processRequestFields['CorRacaEtniaObjeto'])) ? ($dbCreate['CorRacaEtniaObjeto'] = $processRequestFields['CorRacaEtniaObjeto']) : (NULL);
            (isset($processRequestFields['NomeResponsavelObjeto'])) ? ($dbCreate['NomeResponsavelObjeto'] = $processRequestFields['NomeResponsavelObjeto']) : (NULL);
            (isset($processRequestFields['TelResponsavel'])) ? ($dbCreate['TelResponsavel'] = $processRequestFields['TelResponsavel']) : (NULL);
            (isset($processRequestFields['CPFResponsavel'])) ? ($dbCreate['CPFResponsavel'] = $processRequestFields['CPFResponsavel']) : (NULL);
            (isset($processRequestFields['TipoEscolaObjeto'])) ? ($dbCreate['TipoEscolaObjeto'] = $processRequestFields['TipoEscolaObjeto']) : (NULL);
            (isset($processRequestFields['EscolaridadeObjeto'])) ? ($dbCreate['EscolaridadeObjeto'] = $processRequestFields['EscolaridadeObjeto']) : (NULL);
            (isset($processRequestFields['TurnoEscolarAdolesc'])) ? ($dbCreate['TurnoEscolarAdolesc'] = $processRequestFields['TurnoEscolarAdolesc']) : (NULL);
            (isset($processRequestFields['NomeEscola'])) ? ($dbCreate['NomeEscola'] = $processRequestFields['NomeEscola']) : (NULL);
            (isset($processRequestFields['DataCadastramento'])) ? ($dbCreate['DataCadastramento'] = $processRequestFields['DataCadastramento']) : (NULL);
        }
        // myPrint($dbCreate, 'src\app\Controllers\ExempleDbController.php');
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
                    ->ModelVCadastroObjetos
                    ->where('id', $processRequest['id'])
                    ->where('deleted_at', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                //
            } elseif ($parameter !== NULL) {
                $dbResponse = $this
                    ->ModelVCadastroObjetos
                    ->where('id', $parameter)
                    ->where('deleted_at', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                //
            } else {
                $dbResponse = $this
                    ->ModelVCadastroObjetos
                    ->where('deleted_at', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate($limit, 'paginator', $page);
                //
            };
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
        return $response;
    }

    // route POST /www/sigla/rota
    // route GET /www/sigla/rota
    // Informação sobre o controller
    // retorno do controller [JSON]
    public function dbFilter($parameter = NULL, $page = 1)
    {
        // Parâmentros para receber um POST
        $request = service('request');
        $processRequest = (array) $request->getVar();
        //
        try {
            $query = $this
                ->ModelVCadastroObjetos
                ->where('PerfilId', 5)
                ->where('AcessoId', 2)
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
            // exit('src\app\Controllers\ObjetoDbController.php');
            if (isset($processRequest['id'])) {
                $dbResponse = $this
                    ->ModelVCadastroObjetos
                    ->where('id', $processRequest['id'])
                    ->where('deleted_at !=', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                //
            } elseif ($parameter !== NULL) {
                $dbResponse = $this
                    ->ModelVCadastroObjetos
                    ->where('id', $parameter)
                    ->where('deleted_at !=', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                //
            } else {
                $dbResponse = $this
                    ->ModelVCadastroObjetos
                    ->where('deleted_at !=', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate($limit, 'paginator', $page);
                //
            };
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
