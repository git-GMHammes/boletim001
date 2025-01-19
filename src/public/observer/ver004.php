<?php
/*
cd C:\laragon\www\vraptor002\Doc\observer003.php
/vraptor002/Doc/observer003.php
*/

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
            echo $prefixo . ($isLast ? '&emsp;└─ ' : '&emsp;├─ ') . $arquivo . ' \\' . '<br>';
            listarHierarquiaDiretorio($caminhoCompleto, $nivel + 1, $novoPrefixo);
        } else {
            echo $prefixo . ($isLast ? '&emsp;└─ ' : '&emsp;├─ ') . $arquivo . '<br>';
        }
    }
}

// Define o diretório base e exibe apenas uma vez
$diretorioBase = '../vraptor002';
echo $diretorioBase . '<br>';

// Chama a função para listar a hierarquia a partir do diretório base
listarHierarquiaDiretorio($diretorioBase);

?>
