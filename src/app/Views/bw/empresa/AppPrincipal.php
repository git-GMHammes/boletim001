<?php
$token_csrf = (session()->get('token_csrf')) ? (session()->get('token_csrf')) : ('erro');
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'token_csrf' => $token_csrf,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
    'api_post_cadastrar_atualizar' => 'bw/empresa/api/cadastrar',
    # pode ser que seja excluido ↓↓↓
    'api_empresa_cadastrar' => 'bw/empresa/api/cadastrar',
    'api_empresa_atualizar' => 'bw/empresa/api/atualizar',
    # pode ser que seja excluido ↑↑↑
    'api_empresa_listar' => 'bw/empresa/api/atualizar',
    'api_empresa_exibir' => 'bw/empresa/api/exibir',
    'api_empresa_filtrar' => 'bw/empresa/api/filtrar',
);
// myPrint($parametros_backend, 'src\app\Views\bw\empresa\AppPrincipal.php', true);
?>

<div class="app_Principal" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppPrincipal = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_Principal').getAttribute('data-result'));
        parametros.origemForm = 'empresa'
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
        const token_csrf = parametros.token_csrf;

        // Lista de APIs
        const api_empresa_cadastrar = parametros.api_empresa_cadastrar;
        const api_empresa_atualizar = parametros.api_empresa_atualizar;
        const api_empresa_exibir = parametros.api_empresa_exibir;

        // Definindo o estado para controlar a aba ativa
        const [tabNav, setTabNav] = React.useState('form');

        // Função para trocar de aba
        const handleTabClick = (tab) => {
            setTabNav(tab); // Atualiza a aba selecionada
        };

        // Função que retorna uma lista
        const renderList = () => {
            return (
                <div>
                    LISTA
                </div>
            );
        };

        // Função que retorna um Exluir
        const renderDel = () => {
            return (
                <div>
                    Lixeira
                </div>
            );
        };

        // Função que retorna Ajuda
        const renderHelp = () => {
            return (
                <div>
                    AJUDA
                </div>
            );
        };

        return (
            <div className="mt-1">
                <div>
                    <div id="top" className="d-flex justify-content-center align-items-center min-vh-100">
                        <div className="container">
                            <ul className="nav nav-tabs border border-top-0 border-start-0 border-end-0 rounded-top">
                                <li className="nav-item">
                                    <a
                                        className={`nav-link ${tabNav === 'form' ? 'active' : ''}`}
                                        href="#top"
                                        onClick={() => handleTabClick('form')}
                                    >
                                        Formulario
                                    </a>
                                </li>
                                <li className="nav-item">
                                    <a
                                        className={`nav-link ${tabNav === 'list' ? 'active' : ''}`}
                                        href="#top"
                                        onClick={() => handleTabClick('list')}
                                    >
                                        Listar
                                    </a>
                                </li>
                                <li className="nav-item">
                                    <a
                                        className={`nav-link ${tabNav === 'lix' ? 'active' : ''}`}
                                        href="#top"
                                        onClick={() => handleTabClick('lix')}
                                    >
                                        Lixeira
                                    </a>
                                </li>
                                <li className="nav-item">
                                    <a
                                        className={`nav-link ${tabNav === 'help' ? 'active' : ''}`}
                                        href="#top"
                                        onClick={() => handleTabClick('help')}
                                    >
                                        Ajuda
                                    </a>
                                </li>
                            </ul>

                            {/* Carrega todas as funções acima */}
                            <div className="border border-top-0 rounded-bottom p-3">
                                {tabNav === 'form' && <AppForm parametros={parametros} />}
                                {tabNav === 'list' && <AppList parametros={parametros} />}
                                {tabNav === 'lix' && <AppLimpar parametros={parametros} />}
                                {tabNav === 'help' && renderHelp()}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    };
    const rootElement = document.querySelector('.app_Principal');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppPrincipal />);

</script>
<?php
$parametros_backend = array();
?>