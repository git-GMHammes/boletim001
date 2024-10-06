<?php
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
    'base_api_pessoas' => 'https://fakerapi.it/api/v1/persons?_locale=pt_PT&_quantity=3',
);
?>

<div class="app_principal" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppPrincipal = () => {

        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_principal').getAttribute('data-result'));

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;

        // APIs para consumo
        const base_api_pessoas = parametros.base_api_pessoas;

        // Definindo o estado para controlar a aba ativa
        const [tabNav, setTabNav] = React.useState('list');

        console.log('parametros: ', parametros);
        
        return (
            <div>
                <div className="d-flex justify-content-center align-items-center min-vh-100">
                    <div className="container">
                        <ul className="nav nav-tabs border border-top-0 border-start-0 border-end-0 rounded-top">
                            <li className="nav-item">
                                <a
                                    className={`nav-link ${tabNav === 'list' ? 'active' : ''}`}
                                    href="#"
                                    onClick={() => handleTabClick('list')}
                                >
                                    Lista de Pessoas
                                </a>
                            </li>
                            <li className="nav-item">
                                <a
                                    className={`nav-link ${tabNav === 'form' ? 'active' : ''}`}
                                    href="#"
                                    onClick={() => handleTabClick('form')}
                                >
                                    Formulário
                                </a>
                            </li>
                        </ul>
                        {/* Carrega todas as funções acima */}
                        <div className="border border-top-0 rounded-bottom p-3">
                            {tabNav === 'list' && <AppPessoas setParametros={parametros} />}
                            {/*
                            {tabNav === 'form' && <AppTab parametros={parametros} />}
                            */}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
    const rootElement = document.querySelector('.app_principal');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppPrincipal />);
</script>