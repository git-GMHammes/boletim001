<?php
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'result' => isset($result) ? ($result) : (array()),
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
);
?>

<div class="app_deletar_adolescente" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppDeletarAdolescente = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_deletar_adolescente').getAttribute('data-result'));
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
        // 
        return (
            <div>
                Tela de Exclusão aqui
            </div>
        );
    };
    ReactDOM.render(<AppDeletarAdolescente />, document.querySelector('.app_deletar_adolescente'));
</script>
<?php
$parametros_backend = array();
?>