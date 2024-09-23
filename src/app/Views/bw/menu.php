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

<div class="App_menu_react" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppMenuReact = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.App_menu_react').getAttribute('data-result'));
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;

        // Style
        const navyBlueDark = {
            backgroundColor: "#000080",
        };

        return (
            <div>
                <nav className="navbar navbar-expand-lg" style={navyBlueDark}>
                    <div className="container-fluid">
                        <button
                            className="navbar-toggler"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarTogglerDemo01"
                            aria-controls="navbarTogglerDemo01"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <span className="navbar-toggler-icon" style={{ filter: "invert(1)" }}></span>
                        </button>
                        <div className="collapse navbar-collapse justify-content-center mt-1" id="navbarTogglerDemo01">
                            <div className="btn-group m-1">
                                <button
                                    className="btn btn-secondary btn-sm dropdown-toggle"
                                    style={navyBlueDark}
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Empresa
                                </button>
                                <ul className="dropdown-menu p-2">
                                    <li><a className="dropdown-item" href="#">Ação 1</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 2</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 3</a></li>
                                </ul>
                            </div>
                            <div className="btn-group m-1">
                                <button
                                    className="btn btn-secondary btn-sm dropdown-toggle"
                                    style={navyBlueDark}
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Linha
                                </button>
                                <ul className="dropdown-menu p-2">
                                    <li><a className="dropdown-item" href="#">Tipo de Linha</a></li>
                                    <li><a className="dropdown-item" href="#">Importar Linhas</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 3</a></li>
                                </ul>
                            </div>
                            <div className="btn-group m-1">
                                <button
                                    className="btn btn-secondary btn-sm dropdown-toggle"
                                    style={navyBlueDark}
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Tipo de Veículo
                                </button>
                                <ul className="dropdown-menu p-2">
                                    <li><a className="dropdown-item" href="#">Ação 1</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 2</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 3</a></li>
                                </ul>
                            </div>
                            <div className="btn-group m-1">
                                <button
                                    className="btn btn-secondary btn-sm dropdown-toggle"
                                    style={navyBlueDark}
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Tarifa
                                </button>
                                <ul className="dropdown-menu p-2">
                                    <li><a className="dropdown-item" href="#">Tarifa Retroativa</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 2</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 3</a></li>
                                </ul>
                            </div>
                            <div className="btn-group m-1">
                                <button
                                    className="btn btn-secondary btn-sm dropdown-toggle"
                                    style={navyBlueDark}
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Usuário
                                </button>
                                <ul className="dropdown-menu p-2">
                                    <li><a className="dropdown-item" href="#">Log</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 2</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 3</a></li>
                                </ul>
                            </div>
                            <div className="btn-group m-1">
                                <button
                                    className="btn btn-secondary btn-sm dropdown-toggle"
                                    style={navyBlueDark}
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    BOM
                                </button>
                                <ul className="dropdown-menu p-2">
                                    <li><a className="dropdown-item" href="#">Ação 1</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 2</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 3</a></li>
                                </ul>
                            </div>
                            <div className="btn-group m-1">
                                <button
                                    className="btn btn-secondary btn-sm dropdown-toggle"
                                    style={navyBlueDark}
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Relatório
                                </button>
                                <ul className="dropdown-menu p-2">
                                    <li><a className="dropdown-item" href="#">Ação 1</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 2</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 3</a></li>
                                </ul>
                            </div>
                            <div className="btn-group m-1">
                                <button
                                    className="btn btn-secondary btn-sm dropdown-toggle"
                                    style={navyBlueDark}
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Configurações
                                </button>
                                <ul className="dropdown-menu p-2">
                                    <li><a className="dropdown-item" href="#">Ação 1</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 2</a></li>
                                    <li><a className="dropdown-item" href="#">Ação 3</a></li>
                                </ul>
                            </div>
                        </div> &nbsp;
                    </div>
                </nav>
            </div>
        );
    };
    ReactDOM.render(<AppMenuReact />, document.querySelector('.App_menu_react'));
</script>

<?php
$parametros_backend = array();
?>