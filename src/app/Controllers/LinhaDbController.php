<?php

namespace App\Controllers;

# use App\Models\UploadModel;
use App\Controllers\SystemBaseController;
use App\Controllers\SystemMessageController;
use App\Models\EmporesaModels;
# use App\Models\VEmporesaModelsModels;
use Exception;

class LinhaDbController extends BaseController
{
    # private $ModelUpload;
    private $ModelLinha;
    # private $ModelLinha;
    private $message;
    private $uri;
    private $pagination;

    public function __construct()
    {
        $this->uri = new \CodeIgniter\HTTP\URI(current_url());
        $this->pagination = new SystemBaseController();
        $this->message = new SystemMessageController();
        $this->ModelLinha = new EmporesaModels();
        # $this->ModelUpload = new UploadModel();
        # $this->ModelLinha = new VEmporesaModelsModels();
    }

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function index()
    {
        exit('403 Forbidden - Directory access is forbidden.');
    }

    # use App\Controllers\SystemUploadDbController;
    # private $DbController;
    # $this->DbController = new SystemUploadDbController();
    # $this->DbController->dbFields($fileds = array();
    public function dbFields($processRequestFields = array())
    {
        # myPrint($processRequestFields, 'src\app\Controllers\SystemUploadDbController.php', true);
        $dbCreate = array();
        $autoColumn = $this->ModelLinha->getColumnsFromTable();
        if (isset($autoColumn['COLUMN'])) {
            foreach ($autoColumn['COLUMN'] as $key_autoColumn => $value_autoColumn) {
                # myPrint($value_autoColumn, '', true);
                (isset($processRequestFields[$value_autoColumn])) ? ($dbCreate[$value_autoColumn] = $processRequestFields[$value_autoColumn]) : (NULL);
            }
        }
        (isset($processRequestFields['modelo'])) ? ($dbCreate['modelo'] = $processRequestFields['modelo']) : (NULL);
        # myPrint($dbCreate, 'src\app\Controllers\ExempleDbController.php');
        return ($dbCreate);
    }

    # use App\Controllers\SystemUploadDbController;
    # private $DbController;
    # $this->DbController = new SystemUploadDbController();
    # $this->DbController->dbFields($fileds = array();
    public function dbFieldsFilter($processRequestFields = array())
    {
        # myPrint($processRequestFields, 'src\app\Controllers\SystemUploadDbController.php', true);
        $dbCreate = array();
        $autoColumn = $this->ModelLinha->getColumnsFromTable();
        // myPrint($autoColumn, '', true);
        if (isset($autoColumn['COLUMN'])) {
            foreach ($autoColumn['COLUMN'] as $key_autoColumn => $value_autoColumn) {
                # myPrint($value_autoColumn, '', true);
                (isset($processRequestFields[$value_autoColumn])) ? ($dbCreate[$value_autoColumn] = $processRequestFields[$value_autoColumn]) : (NULL);
            }
        }

        // myPrint($dbCreate, 'src\app\Controllers\ExempleDbController.php');
        return ($dbCreate);
    }

    # use App\Controllers\TokenCsrfController;
    # $this->DbController = new ExempleDbController();
    # $this->DbController->dbCreate($parameter);
    public function dbCreate($parameter = NULL)
    {

        try {
            $this->ModelLinha->dbCreate($this->dbFields($parameter));
            $affectedRows = $this->ModelLinha->affectedRows();
            if ($affectedRows > 0) {
                $dbCreate['insertID'] = $this->ModelLinha->insertID();
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

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbRead($parameter = NULL, $page = 1)
    {
        $limit = 10;
        try {
            if ($parameter !== NULL) {
                $dbResponse = $this
                    ->ModelLinha
                    ->where('id', $parameter)
                    ->where('deleted_at', NULL)
                    ->orderBy('updated_at', 'asc')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                #
            } else {
                $dbResponse = $this
                    ->ModelLinha
                    ->where('deleted_at', NULL)
                    ->orderBy('updated_at', 'asc')
                    ->dBread()
                    ->paginate($limit, 'paginator', $page);
                #
            }
            # Paginação
            $pager = \Config\Services::pager();
            $paginationLinks = $pager->makeLinks($page, $limit, $pager->getTotal('paginator'), 'default_full');
            $linksArray = $this->pagination->extractPaginationLinks($paginationLinks);
            #
            $response = array(
                'dbResponse' => $dbResponse,
                'linksArray' => $linksArray
            );
            # myPrint($response, 'src\app\Controllers\LinhaDbController.php');
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

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbFilter($parameter = NULL, $page = 1, $limit = 10)
    {
        $parameter = $this->dbFieldsFilter($parameter);
        $getURI = $this->uri->getSegments();
        if (in_array('filtrar', $getURI)) {
            $limit = 200;
        }
        #
        try {
            $query = $this
                ->ModelLinha
                ->where('deleted_at', NULL);
            foreach ($parameter as $key => $value) {
                $query = $query->like($key, $value);
                // myPrint($key, $value, true);
            }

            $dbResponse = $query
                ->orderBy('id', 'DESC')
                ->paginate($limit, 'paginator', $page);

            # Paginação
            $pager = \Config\Services::pager();
            $paginationLinks = $pager->makeLinks($page, $limit, $pager->getTotal('paginator'), 'default_full');
            $linksArray = $this->pagination->extractPaginationLinks($paginationLinks);
            #
            $response = array(
                'dbResponse' => $dbResponse,
                'linksArray' => $linksArray
            );
            #
        } catch (\Exception $e) {
            if (DEBUG_MY_PRINT) {
                myPrint($e->getMessage(), 'src\app\Controllers\ExempleDbController.php');
            }
            $message = $e->getMessage();
            $this->message->message([$message], 'danger', $parameter, 5);
            $response = array();
        }
        #
        // myPrint($response, 'src\app\Controllers\LinhaDbController.php');
        return $response;
    }

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbUpdate($key, $parameter = NULL)
    {
        if (
            !isset($parameter['deleted_at'])
            && empty($parameter['deleted_at'])
            && count($parameter) == 1
        ) {
            $this->ModelLinha->dbUpdate($key, $parameter);
        } else {
            $this->ModelLinha->dbUpdate($key, $this->dbFields($parameter));
        }
        try {
            $affectedRows = $this->ModelLinha->affectedRows();
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

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbDelete($parameter = NULL)
    {
        try {
            $this->ModelLinha->dbDelete('id', $parameter);
            $affectedRows = $this->ModelLinha->affectedRows();
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

    # route POST /www/sigla/rota
    # route GET /www/sigla/rota
    # Informação sobre o controller
    # retorno do controller [JSON]
    public function dbCleaner($parameter = NULL, $page = 1)
    {
        $limit = 10;
        try {
            # exit('src\app\Controllers\AdolescenteDbController.php');
            if (isset($processRequest['id'])) {
                $dbResponse = $this
                    ->ModelLinha
                    ->where('id', $processRequest['id'])
                    ->where('deleted_at !=', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                #
            } elseif ($parameter !== NULL) {
                $dbResponse = $this
                    ->ModelLinha
                    ->where('id', $parameter)
                    ->where('deleted_at !=', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate(1, 'paginator', $page);
                #
            } else {
                $dbResponse = $this
                    ->ModelLinha
                    ->where('deleted_at !=', NULL)
                    ->orderBy('id', 'DESC')
                    ->dBread()
                    ->paginate($limit, 'paginator', $page);
                #
            }
            ;
            # Paginação
            $pager = \Config\Services::pager();
            $paginationLinks = $pager->makeLinks($page, $limit, $pager->getTotal('paginator'), 'default_full');
            $linksArray = $this->pagination->extractPaginationLinks($paginationLinks);
            #
            $response = array(
                'dbResponse' => $dbResponse,
                'linksArray' => $linksArray
            );
            #
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

?>