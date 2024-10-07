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
                            {/* Menu Lateral */}
                            <button className="btn btn-outline-primary btn-sm m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                <i className="bi bi-gear-wide-connected"></i>
                            </button>
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
                                    <li><a className="dropdown-item" href={`${base_url}bw/empresa/endpoint/principal`}>Principal</a></li>
                                    <li><a className="dropdown-item" href={`${base_url}bw/empresa/endpoint/cadastrar`}>Cadastrar</a></li>
                                    <li><a className="dropdown-item disabled" href={`${base_url}bw/empresa/endpoint/filtrar`}>Filtrar</a></li>
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
                            {/* Menu Lateral */}
                            <button className="btn btn-outline-warning btn-sm m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i className="bi bi-gear-wide-connected"></i>
                            </button>
                        </div>
                    </div>
                </nav>

                {/* Menu Lateral */}
                <div className="offcanvas offcanvas-start" tabIndex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div className="offcanvas-header">
                        <h5 className="offcanvas-title" id="offcanvasExampleLabel">Menu Secundário</h5>
                        <button type="button" className="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div className="offcanvas-body">
                        <div className="mb-5">
                            Navegação no Sistema antigo
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Login</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_login`} target="_blank">Acesso</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Principal</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_main`} target="_blank">Acesso</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Empresa</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_empresa_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_empresa_cadasrtar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Linhas</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_linha_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_linha_cadastrar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Veículo</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_veiculo_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_veiculo_cadastrar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Tipo de Linha</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_linha_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_linha_cadastrar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Tarifa</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_tarifa_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_tarifa_cadastrar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Usuário</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_usuario_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_usuario_cadastrar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>BOM</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_cadastrar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Relatório</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_relatorio_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_relatorio_pendente`} target="_blank">Pendente</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_relatorio_cadastrar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Log</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_log_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_log_cadastrar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Configurações</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_log_bom`} target="_blank">BOM</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/bom_log_permissoes`} target="_blank">Permissões</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Tarifa Retroativa</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/tarifa_retroaativa_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/tarifa_retroaativa_cadastrar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Importar Linhas</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/tarifa_importar_linhas_filtrar`} target="_blank">Filtrar</a></li>
                                <li><a className="dropdown-item" href={`${base_url}exemple/group/endpoint/tarifa_importar_linhas_cadastrar`} target="_blank">Cadastrar</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                {/* Menu Lateral */}
                <div className="offcanvas offcanvas-end" tabIndex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div className="offcanvas-header">
                        <h5 className="offcanvas-title" id="offcanvasRightLabel">Menu Secundário</h5>
                        <button type="button" className="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div className="offcanvas-body">
                        <div className="mb-5">
                            Navegação de Modelos
                        </div>
                        <div className="dropdown btn-sm mb-2">
                            <button className="btn btn-secondary dropdown-toggle w-100 d-flex justify-content-between align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                <span>Modelos</span>
                            </button>
                            <ul className="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                <li><a className="dropdown-item" href={`${base_url}analise/modelo/endpoint/AppNavTab`} target="_blank">AppNavTab</a></li>
                            </ul>
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