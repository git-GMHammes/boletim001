<?php
/*
cd C:\laragon\www\vraptor002\Doc\observer003.php
/vraptor002/Doc/observer003.php
*/
function listarConteudoDiretorio($diretorio) {
    $arquivos = scandir($diretorio);
    $arquivos = array_diff($arquivos, array('.', '..')); // Remove os itens '.' e '..'
    $resultado = [];

    foreach ($arquivos as $arquivo) {
        $caminhoCompleto = $diretorio . '/' . $arquivo;
        $resultado[] = $caminhoCompleto;
        echo $caminhoCompleto . '<br>'; // Exibe o caminho do arquivo ou pasta
    }

    return $resultado;
}

$diretorio = '../vraptor002';
$listagem = listarConteudoDiretorio($diretorio);

function listarHierarquiaDiretorio($diretorio, $nivel = 0, $prefixo = '') {
    $arquivos = scandir($diretorio);
    $arquivos = array_diff($arquivos, array('.', '..')); // Remove os itens '.' e '..'
    $total = count($arquivos);
    $contador = 0;

    foreach ($arquivos as $arquivo) {
        $contador++;
        $caminhoCompleto = $diretorio . '/' . $arquivo;
        $isLast = ($contador === $total);
        $novoPrefixo = $prefixo . ($isLast ? '&emsp;&emsp;' : '&emsp;│&emsp;');

        if (is_dir($caminhoCompleto)) {
            echo $prefixo . ($isLast ? '&emsp;└─ ' : '&emsp;├─ ') . $arquivo . " \\" . '<br>';
            listarHierarquiaDiretorio($caminhoCompleto, $nivel + 1, $novoPrefixo);
        } else {
            echo $prefixo . ($isLast ? '&emsp;└─ ' : '&emsp;├─ ') . $arquivo . '<br>';
        }
    }
}

$diretorio = '../vraptor002';
listarHierarquiaDiretorio($diretorio);

?>