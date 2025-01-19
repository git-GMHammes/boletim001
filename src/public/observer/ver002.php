<?php
function listarConteudoDiretorio($diretorio) {
    $arquivos = scandir($diretorio);
    $arquivos = array_diff($arquivos, array('.', '..'));
    $resultado = [];

    foreach ($arquivos as $arquivo) {
        $caminhoCompleto = $diretorio . '/' . $arquivo;
        $resultado[] = $caminhoCompleto;
        echo $caminhoCompleto . '<br>';
    }

    return $resultado;
}

$diretorio = '../';
$listagem = listarConteudoDiretorio($diretorio);

function listarConteudoRecursivo($diretorio) {
    $arquivos = scandir($diretorio);
    $arquivos = array_diff($arquivos, array('.', '..'));
    $resultado = [];

    foreach ($arquivos as $arquivo) {
        $caminhoCompleto = $diretorio . '/' . $arquivo;

        // Exibe o caminho do arquivo ou pasta
        echo $caminhoCompleto . '<br>';
        $resultado[] = $caminhoCompleto;

        // Se for um diretório, faz a chamada recursiva
        if (is_dir($caminhoCompleto)) {
            $resultado = array_merge($resultado, listarConteudoRecursivo($caminhoCompleto));
        }
    }

    return $resultado;
}

$diretorio = '../';
$listagemRecursiva = listarConteudoRecursivo($diretorio);

?>