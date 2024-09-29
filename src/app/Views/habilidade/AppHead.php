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

<div class="app_head" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
  const AppHead = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_head').getAttribute('data-result'));
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;

        // Nova constante de estilo para o texto "Footer"
        const headerTextStyle = {
            backgroundImage: 'linear-gradient(to right, #330033, #14007A)',
            color: 'white',
            textDecoration: 'none',
            padding: '10px'
        };
        return (
            <div>CABEÇALHO</div>
        );
    };
    const rootElement = document.querySelector('.app_head');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppHead />);

</script>
<?php
$parametros_backend = array();
?>

