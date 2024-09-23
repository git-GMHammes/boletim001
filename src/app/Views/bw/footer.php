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

        const linkText = {
            textDecoration: 'none'
        }

        return (
            <div>
                <div className="row p-3">
                    <div className="col-12 col-sm-4">
                    </div>
                    <div className="col-12 col-sm-4">
                        <div className="d-flex justify-content-center text-center">
                            <i class="bi bi-geo-alt"></i>
                            &nbsp;
                            Rua Uruguaiana, 118, 6º-12º andar | Centro, Rio de Janeiro | 20050-093
                        </div>
                        <div className="d-flex justify-content-center text-center">
                            <i class="bi bi-calendar3"></i>
                            &nbsp;
                            Seg-Sex 10:00-16:00
                        </div>
                        <div className="d-flex justify-content-center text-center">
                            <i class="bi bi-telephone"></i>
                            &nbsp;
                            (21) 3883-4100
                        </div>
                    </div>
                    <div className="col-12 col-sm-4">
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
