<?php
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
);
?>

<div class="App_menu" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppMenu = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.App_menu').getAttribute('data-result'));
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;

        return (
            <div>
                <div className="container mt-5">
                    <div className="row">
                        <div className="col-12 col-sm-3">
                            <div className="dropdown">
                                <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>Exemplos Órfãos</span>
                                </button>
                                <ul className="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a className="dropdown-item" href={`${base_url}analise/modelo/endpoint/AppPrincipal`}>AppPrincipal (Tab/Form)</a></li>
                                    <li><a className="dropdown-item" href={`${base_url}analise/modelo/endpoint/AppExecLoading`}>AppExecLoading (Teste de Loading)</a></li>
                                    <li><a className="dropdown-item disabled" href={`${base_url}`}>disabled</a></li>
                                </ul>
                            </div>
                        </div>
                        <div className="col-12 col-sm-3">
                            <div className="dropdown">
                                <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span>Link Principal</span>
                                </button>
                                <ul className="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a className="dropdown-item" href={`${base_url}analise/modelo/endpoint/AppExecApi`}>AppExecApi (Exemplo de consumo API)</a></li>
                                    <li><a className="dropdown-item disabled" href={`${base_url}`}>disabled</a></li>
                                </ul>
                            </div>
                        </div>
                        <div className="col-12 col-sm-3">

                        </div>
                        <div className="col-12 col-sm-3">

                        </div>
                    </div>
                </div>
            </div>
        );
    };
    const rootElement = document.querySelector('.App_menu');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppMenu />);

</script>

<?php
$parametros_backend = array();
?>