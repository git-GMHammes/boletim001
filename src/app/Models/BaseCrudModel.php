<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;
use App\Controllers\SystemMessageController;

class BaseCrudModel extends Model
{

    protected $DBGroup = GRUPO_DB_CONFIG;

    protected $table = '';
    protected $primaryKey = '';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = [];
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $dbInsert;
    protected $dbRead;
    protected $message;
    protected $affectedRows;

    // App\Models\BaseCrudModel;
    // $ModelBaseCrud = new BaseCrudModel;
    // $ModelBaseCrud->getColumnsFromTable($dbTable, $primaryKey, $parameter1 = 'column', $parameter2 = 'value_type', $parameter3 = 'value_key');
    // $dbTable, $primaryKey;
    public function getColumnsFromTable($dbTable, $primaryKey, $parameter1 = 'column', $parameter2 = 'value_type', $parameter3 = 'value_key')
    {
        $getTable = array();
        // myPrint($dbTable, '', true);
        // myPrint($primaryKey, '');
        $this->primaryKey = (string)$primaryKey;
        $this->table = $dbTable;
        # input: getColumnsFromTable('tab_link', 'column', 'type', 'key')
        if ($parameter1 == 'column' && $parameter2 == 'value_type' && $parameter3 == 'value_key') {
            // exit('if 1');
            $query = $this->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$this->table';");
            foreach ($query->getResultArray() as $key => $value_columns) {
                $getTable['COLUMN'][] = $value_columns['COLUMN_NAME'];
                // myPrint($getTable['COLUMN'], '', true);
            }
        } elseif ($parameter1 == 'column' && $parameter2 == 'type' && $parameter3 == 'value_key') {
            // exit('else if 2');
            $query = $this->query("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$this->table';");
            foreach ($query->getResultArray() as $key => $value_columns) {
                $getTable['COLUMN'][] = $value_columns['COLUMN_NAME'] . ', ' . $value_columns['DATA_TYPE'];
            }
        } elseif ($parameter1 == 'column' && $parameter2 == 'type' && $parameter3 == 'key') {
            // exit('else if 3');
            $query = $this->query("SELECT COLUMN_NAME, DATA_TYPE, COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$this->table';");
            foreach ($query->getResultArray() as $key => $value_columns) {
                $getTable['COLUMN'][] = $value_columns['COLUMN_NAME'] . ', ' . $value_columns['DATA_TYPE'] . ', ' . $value_columns['COLUMN_KEY'];
            }
        }
        // myPrint($query, 'src\app\Models\BaseCrudModel.php');
        return $getTable;
    }

    public function dbCreate($dbTable, $primaryKey, $dbCreate)
    {
        $this->message = new SystemMessageController();
        $this->table = $dbTable;
        $this->primaryKey = $primaryKey;
        $this->allowedFields = array_keys($dbCreate);
        try {
            $this->dbInsert = $this->insert($dbCreate);
            // myPrint($this, 'src\app\Models\AdolescentesModels.php');
            $this->affectedRows = $this->db->affectedRows();
            if ($this->affectedRows > 0) {
                $this->message->message(['Cadastrado realizado com Sucesso'], 'success', $dbCreate, 5);
            }
        } catch (\Throwable $th) {
            if (DEBUG_MY_PRINT) {
                myPrint($th->getMessage(), 'src/app/Models/.php');
            }
            $message = $th->getMessage();
            $this->message->message([$message], 'danger', $dataValue = array(), 5);
        }
        return $this;
    }

    public function dbRead($dbTable, $primaryKey, $keyVariable = NULL, $keyValue = NULL)
    {
        $this->message = new SystemMessageController();
        // $getColumnsFromTable = array();
        $this->table = $dbTable;
        $this->primaryKey = $primaryKey;
        // myPrint($this->table, '', true);
        // myPrint($this->primaryKey, '');
        $getColumnsFromTable = $this->getColumnsFromTable($this->table, $this->primaryKey)['COLUMN'];
        // myPrint($getColumnsFromTable, 'src/app/Models/ComCategoriaModel.php');
        $this->allowedFields = $getColumnsFromTable;
        #
        try {
            if ($keyVariable !== NULL && $keyValue !== NULL) {
                $this->dbRead = $this->where($keyVariable, $keyValue);
            } elseif ($keyVariable !== NULL && $keyValue == NULL) {
                $this->dbRead = $this->select($this->allowedFields);
            } else {
                $this->dbRead = $this->select($this->allowedFields);
            }
            // myPrint($this->dbRead->findAll(), 'src\app\Models\AdolescentesModels.php');
            $this->affectedRows = $this->db->affectedRows();
        } catch (\Throwable $th) {
            if (DEBUG_MY_PRINT) {
                myPrint($th->getMessage(), 'src/app/Models/.php');
            }
            $message = $th->getMessage();
            $this->message->message([$message], 'danger', $getColumnsFromTable = array(), 5);
        }
        return $this;
    }

    public function dbUpdate($dbTable, $primaryKey, $key, $dbUpdate)
    {
        // myPrint($key, $dbUpdate);
        $this->table = $dbTable;
        $this->primaryKey = $primaryKey;
        $this->message = new SystemMessageController();
        try {
            if (
                isset($dbUpdate)
            ) {
                $this->allowedFields = array_keys($dbUpdate);
                // myPrint($this->allowedFields, true);
            }
            if (
                isset($key)
                && is_array($key)
                && isset($dbUpdate)
            ) {
                // Configura a atualização
                $this->set($dbUpdate);
                $this->where($key);
                $this->update();
            } else {
                $this->update($key, $dbUpdate);
            }
            $this->affectedRows = $this->db->affectedRows();
            if ($this->affectedRows > 0) {
                $this->message->message(['Cadastro Atualizado com Sucesso.'], 'success', $dbUpdate = array(), 5);
            } else {
                $this->message->message(['Erro ao Atualizar o Adolescente'], 'danger', $dbUpdate = array(), 5);
            }
        } catch (\Throwable $th) {
            if (DEBUG_MY_PRINT) {
                myPrint($th->getMessage(), 'src/app/Models/.php');
            }
            $message = $th->getMessage();
            $this->message->message([$message], 'danger', $dbUpdate = array(), 5);
        }
        return $this;
    }

    public function dBdelete($dbTable, $primaryKey, $parameter, $key = NULL)
    {
        $this->message = new SystemMessageController();
        $this->table = $dbTable;
        $this->primaryKey = $primaryKey;
        try {
            if ($key === NULL) {
                $this->where('deleted_at !=', NULL);
                $this->delete();
            } else {
                $this->where($parameter, $key);
                $this->delete();
            }
        } catch (\Throwable $th) {
            if (DEBUG_MY_PRINT) {
                myPrint($th->getMessage(), 'src/app/Models/.php');
            }
            $message = $th->getMessage();
            $this->message->message([$message], 'danger', array(), 5);
        }
        return $this;
    }
}
