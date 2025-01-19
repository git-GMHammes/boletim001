<?php
/*
cd C:\laragon\www\vraptor002\Doc\observer003.php
/vraptor002/Doc/observer003.php
*/

function listarConteudoDiretorio($diretorio, $diretoriosExcluidos) {
    $arquivos = scandir($diretorio);
    $arquivos = array_diff($arquivos, array('.', '..')); // Remove os itens '.' e '..'
    $resultado = [];

    foreach ($arquivos as $arquivo) {
        $caminhoCompleto = $diretorio . '/' . $arquivo;

        // Verifica se o caminho está na lista de exclusão
        if (in_array(realpath($caminhoCompleto), $diretoriosExcluidos)) {
            continue;
        }

        $resultado[] = $caminhoCompleto;
        echo $caminhoCompleto . '<br>'; // Exibe o caminho do arquivo ou pasta
    }

    return $resultado;
}

$diretorio = realpath(__DIR__ . '/../../../../../www/html');

// Define os diretórios a serem excluídos (caminhos completos)
$diretoriosExcluidos = [
    realpath($diretorio . '/public/observer'),
    realpath($diretorio . '/system'),
    realpath($diretorio . '/vendor'),
    realpath($diretorio . '/writable'),
    // Adicione outros diretórios a serem excluídos aqui
];

$listagem = listarConteudoDiretorio($diretorio, $diretoriosExcluidos);

function listarHierarquiaDiretorio($diretorio, $nivel = 0, $prefixo = '', $diretoriosExcluidos = []) {
    $arquivos = scandir($diretorio);
    $arquivos = array_diff($arquivos, array('.', '..')); // Remove os itens '.' e '..'
    $total = count($arquivos);
    $contador = 0;

    foreach ($arquivos as $arquivo) {
        $contador++;
        $caminhoCompleto = $diretorio . '/' . $arquivo;

        // Verifica se o caminho está na lista de exclusão
        if (in_array(realpath($caminhoCompleto), $diretoriosExcluidos)) {
            continue;
        }

        $isLast = ($contador === $total);
        $novoPrefixo = $prefixo . ($isLast ? '&emsp;&emsp;' : '&emsp;│&emsp;');

        if (is_dir($caminhoCompleto)) {
            echo $prefixo . ($isLast ? '&emsp;└─ ' : '&emsp;├─ ') . $arquivo . " \\" . '<br>';
            listarHierarquiaDiretorio($caminhoCompleto, $nivel + 1, $novoPrefixo, $diretoriosExcluidos);
        } else {
            echo $prefixo . ($isLast ? '&emsp;└─ ' : '&emsp;├─ ') . $arquivo . '<br>';
        }
    }
}

// Listar a hierarquia dos diretórios, ignorando os excluídos
echo "<br><strong>Listando arquivos e diretórios:</strong><br>";
echo "<br><strong>" . $diretorio . "</strong><br><br>";
listarHierarquiaDiretorio($diretorio, 0, '', $diretoriosExcluidos);
?>
