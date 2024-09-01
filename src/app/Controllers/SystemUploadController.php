<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UploadModel;
use Exception;

class SystemUploadController extends Controller
{
    private $message;
    private $ModelUpload;
    public function __construct()
    {
        $this->ModelUpload = new UploadModel();
        $this->message = array();
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

    # use App\Controllers\SystemUploadController;
    # private $fileUpload;
    # $this->fileUpload = new SystemUploadController();
    # $this->fileUpload->determinePath($fileType, $id);
    public function determinePath($fileType, $id, $app = 'anexo_app')
    {
        // Obter o nome do servidor
        $serverName = $_SERVER['SERVER_NAME'];
        $port = $_SERVER['SERVER_PORT'];
        $directoryName = str_replace('.', '_', $serverName);

        // Log do tipo de arquivo
        // myPrint('debug', 'Tipo de Arquivo: ' . $fileType, true);
        // Definir tipos MIME suportados para documentos
        $docTypes = [
            'application/pdf', // PDF
            'application/msword', // DOC
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // DOCX
            'application/vnd.ms-excel', // XLS
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // XLSX
            'text/csv', // CSV
            'text/plain', // TXT
            'application/zip' // ZIP
        ];

        // Verificação de tipos de arquivos e definição do caminho de upload
        if (in_array($fileType, $docTypes)) {
            return "writable/uploads/{$directoryName}{$port}/{$app}/" . $id . '/' . 'files';
        } elseif (strpos($fileType, 'image') !== false) {
            return "writable/uploads/{$directoryName}{$port}/{$app}/" . $id . '/' . 'images';
        } elseif (strpos($fileType, 'video') !== false) {
            return "writable/uploads/{$directoryName}{$port}/{$app}/" . $id . '/' . 'videos';
        } elseif (strpos($fileType, 'audio') !== false) {
            return "writable/uploads/{$directoryName}{$port}/{$app}/" . $id . '/' . 'audios';
        }

        return null;
    }

    # use App\Controllers\SystemUploadController;
    # private $fileUpload;
    # $this->fileUpload = new SystemUploadController();
    # $this->fileUpload->saveFilePath($id, $filePath);
    public function saveFilePath($id, $filePath)
    {
        $dbUpload['aplication'] = $_SERVER['SERVER_NAME'];
        $dbUpload['aplication_id'] = $id;
        $dbUpload['filePath'] = $filePath;
        // myPrint($dbUpload, 'saveFilePath', true);
        $this->ModelUpload->dbCreate($dbUpload);
    }
}
