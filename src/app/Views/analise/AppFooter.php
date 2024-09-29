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
            <div>RODAPÉ</div>
        );
    };
    const rootElement = document.querySelector('.app_footer');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppFooter />);
</script>
<?php
$parametros_backend = array();
?>