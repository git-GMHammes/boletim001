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

        const [isCollapsed, setIsCollapsed] = React.useState(false);

        const toggleCollapse = () => {
            setIsCollapsed(!isCollapsed);
        };

        return (
            <div>
                <nav className="navbar navbar-expand-lg navbar-light bg-light">
                    <div className="container-fluid">
                        <a className="navbar-brand" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="true" aria-controls="multiCollapseHead multiCollapseFooter">
                            <i className="bi bi-gear-wide-connected"></i>
                        </a>
                        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span className="navbar-toggler-icon"></span>
                        </button>
                        <div className="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                            <ul className="navbar-nav">
                                <li className="nav-item">
                                    <a className="nav-link active" aria-current="page" href={`#`}><i class="bi bi-graph-up-arrow"></i>&nbsp;Principal</a>
                                </li>
                                <li className="nav-item">
                                    <a className="nav-link active" aria-current="page" href={`#`}><i className="bi bi-card-list"></i>&nbsp;Menu 1</a>
                                </li>
                                <li className="nav-item">
                                    <a className="nav-link active" aria-current="page" href={`#`}><i className="bi bi-bar-chart-steps"></i>&nbsp;Menu 2</a>
                                </li>
                                <li className="nav-item">
                                    <a className="nav-link active" aria-current="page" href={`#`}><i className="bi bi-box-arrow-up-right"></i>&nbsp;Menu 3</a>
                                </li>
                                <li className="nav-item">
                                    <a className="nav-link active" aria-current="page" href={`${base_url}fia/ptpa/principal/endpoint/indicadores`}><i class="bi bi-arrow-through-heart"></i>&nbsp;LocalHost</a>
                                </li>
                            </ul>
                        </div>
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