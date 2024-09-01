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

<div class="app_footer" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppFooter = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_footer').getAttribute('data-result'));
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;

        // Nova constante de estilo para o texto "Footer"
        const headerTextStyle = {
            backgroundImage: 'linear-gradient(to right, #14007A, #330033)',
            color: 'white',
            textDecoration: 'none',
            padding: '10px'
        };

        return (
            <div>
                <div className="row m-0 p-0">
                    <div className="col m-0 p-0">
                        <div className="collapse multi-collapse show  m-0 p-0" id="multiCollapseHead">
                            <div className="card card-body m-0 p-0">
                                <div style={headerTextStyle}>
                                    <div className="row">
                                        <div className="col-12 col-sm-3 m-0 p-2">
                                            <div className="d-flex justify-content-center m-0 p-0">
                                                <img className="figure-img img-fluid rounded" src={`${base_url}assets/img/footer/logo-proderj1.png`} alt="assets/img/footer/logo-proderj1.png" />
                                            </div>
                                        </div>
                                        <div className="col-12 col-sm-5 d-flex align-items-center justify-content-center m-0 p-0">
                                            <p className="fs-2">
                                                RODAPÉ para o Exemplo do Bootstrap
                                            </p>
                                        </div>
                                        <div className="col-12 col-sm-4 m-0 p-0">
                                            <div className="d-flex justify-content-center mt-1">
                                                <nav className="navbar navbar-expand-lg navbar-light" style={{ backgroundColor: 'transparent' }}>
                                                    <div className="container-fluid">
                                                        <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLinks" aria-controls="navbarLinks" aria-expanded="false" aria-label="Toggle navigation" style={{ filter: 'invert(1)' }}>
                                                            <span className="navbar-toggler-icon"></span>
                                                        </button>
                                                        <div className="collapse navbar-collapse" id="navbarLinks">
                                                            <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                                                                <li className="nav-item"><a className="nav-link active text-white fs-6" href="http://www.rj.gov.br/rioabracavacina">Coronavírus</a></li>
                                                                <li className="nav-item"><a className="nav-link active text-white fs-6" href="http://www.governoaberto.rj.gov.br">Portal da Transparência</a></li>
                                                                <li className="nav-item"><a className="nav-link active text-white fs-6" href="http://www.esicrj.rj.gov.br">Acesso à Informação</a></li>
                                                                <li className="nav-item"><a className="nav-link active text-white fs-6" href="https://falabr.cgu.gov.br/publico/RJ/Manifestacao/RegistrarManifestacao">Fala.BR</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </nav>
                                            </div>
                                            <div className="d-flex justify-content-evenly mt-1">
                                                <a style={{ color: 'white', textDecoration: 'none' }} href="https://instagram.com/govrj" target="_blank"><i className="bi bi-instagram fs-1"></i></a>
                                                <a style={{ color: 'white', textDecoration: 'none' }} href="https://facebook.com/governodorio" target="_blank"><i className="bi bi-facebook fs-1"></i></a>
                                                <a style={{ color: 'white', textDecoration: 'none' }} href="https://twitter.com/GovRJ" target="_blank"><i className="bi bi-twitter-x fs-1"></i></a>
                                                <a style={{ color: 'white', textDecoration: 'none' }} href="https://youtube.com/user/GovRJ" target="_blank"><i className="bi bi-youtube fs-1"></i></a>
                                            </div>
                                            <div className="d-flex justify-content-center mt-2">
                                                <?php myDateSystem('Rio de Janeiro'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    };
    ReactDOM.render(<AppFooter />, document.querySelector('.app_footer'));
</script>
<?php
$parametros_backend = array();
?>