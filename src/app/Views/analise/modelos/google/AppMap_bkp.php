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

<div class="map-root" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<!-- Script React para renderizar mapa -->
<script type="text/babel">
    // Defina a função global initMap para o Google Maps chamar
    window.initMap = () => {
        const mapElement = document.querySelector('.map-container');
        if (mapElement) {
            new google.maps.Map(mapElement, {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 8,
            });
        }
    };

    const AppMap = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.map-root').getAttribute('data-result'));
        // Variáveis recebidas do Backend
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;

        // Style
        const mapContainerStyle = {
            height: '500px',
            width: '100%'
        };

        React.useEffect(() => {
            if (window.google && window.google.maps) {
                window.initMap();
            }
        }, []);

        return (
            <div className="m-5 p-5">
                <div className="map-container" style={mapContainerStyle}></div>
            </div>
        );
    };

    window.onload = () => {
        const rootElement = document.querySelector('.map-root');
        if (rootElement) {
            const root = ReactDOM.createRoot(rootElement);
            root.render(<AppMap />);
        }
    };
</script>

<?php
$parametros_backend = array();
?>


<?php
$parametros_backend = array();
?>