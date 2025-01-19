<?php
$diretorio = '../';
$arquivos = scandir($diretorio);

// Remove os itens '.' e '..' do array
$arquivos = array_diff($arquivos, array('.', '..'));

foreach ($arquivos as $arquivo) {
    echo $arquivo . '<br>';
}

$diretorio = '../';
if ($handle = opendir($diretorio)) {
    while (false !== ($arquivo = readdir($handle))) {
        if ($arquivo != '.' && $arquivo != '..') {
            echo $arquivo . '<br>';
        }
    }
    closedir($handle);
}
?>