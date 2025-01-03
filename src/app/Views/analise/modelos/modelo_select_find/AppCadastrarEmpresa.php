<?php
$token_csrf = (session()->get('token_csrf')) ? (session()->get('token_csrf')) : ('erro');
$parametros_backend = array(
    'DEBUG_MY_PRINT' => true,
    'token_csrf' => $token_csrf,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
    'getVar_page' => isset($metadata['getVar_page']) ? ('?page=' . $metadata['getVar_page']) : ('?page=' . '1'),
    'api_empresa_exibir' => 'bw/empresa/api/exibir',
    'api_empresa_filtrar' => 'bw/empresa/api/filtrar'
);
// myPrint($parametros_backend, 'src\app\Views\bw\empresa\AppCadastrarEmpresa.php', true);
?>

<div class="app_cadastrar_empresa" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppCadastrarEmpresa = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_cadastrar_empresa').getAttribute('data-result'));
        parametros.origemForm = 'empresa'
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const base_url = parametros.base_url;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const token_csrf = parametros.token_csrf;

        return (
            <div>
                <div className="mt-1">
                    <div className="d-flex justify-content-center align-items-center min-vh-100">
                        <AppForm 
                        parametros={parametros} 
                        />
                    </div>
                </div>
            </div>
        );
    };

    const rootElement = document.querySelector('.app_cadastrar_empresa');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppCadastrarEmpresa />);

</script>
<?php
$parametros_backend = array();
?>