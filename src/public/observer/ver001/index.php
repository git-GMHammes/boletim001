<?php
function listarArquivosDiretorios($pasta, $diretoriosExcluidos)
{
    // Abre o diretório
    if ($handle = opendir($pasta)) {
        while (false !== ($arquivo = readdir($handle))) {
            // Ignora os itens '.' e '..'
            if ($arquivo != '.' && $arquivo != '..') {
                $caminhoCompleto = $pasta . DIRECTORY_SEPARATOR . $arquivo;

                // Verifica se o diretório ou arquivo deve ser excluído
                if (in_array(realpath($caminhoCompleto), $diretoriosExcluidos)) {
                    continue; // Pula completamente este diretório ou arquivo
                }

                // Verifica se é um diretório
                if (is_dir($caminhoCompleto)) {
                    echo "Diretório: " . $caminhoCompleto . "<br>";
                    // Chamada recursiva para subdiretórios
                    listarArquivosDiretorios($caminhoCompleto, $diretoriosExcluidos);
                } else {
                    echo "Arquivo: " . $caminhoCompleto . "<br>";
                }
            }
        }
        closedir($handle);
    } else {
        echo "Não foi possível abrir o diretório: $pasta<br>";
    }
}

// Define o diretório base
$diretorio = realpath(__DIR__ . '/../../../../../www/html');

// Define os diretórios a serem excluídos (caminhos completos)
$diretoriosExcluidos = [
    realpath($diretorio . '/public/observer'),
    realpath($diretorio . '/system'),
    realpath($diretorio . '/vendor'),
    realpath($diretorio . '/writable'),
    // Adicione outros diretórios a serem excluídos aqui
];

// Lista arquivos e diretórios, ignorando os excluídos
echo "<strong>Listando arquivos e diretórios:</strong><br>";
echo "<br><br><strong>" . $diretorio . "</strong><br><br>";
listarArquivosDiretorios($diretorio, $diretoriosExcluidos);
?>