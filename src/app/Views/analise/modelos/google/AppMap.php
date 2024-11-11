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
        let map;
        
        if (mapElement) {
            map = new google.maps.Map(mapElement, {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 8,
            });
        }

        // Verifica se a geolocalização está disponível no navegador
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    // Centraliza o mapa na localização do usuário
                    map.setCenter(userLocation);

                    // Adiciona um marcador na localização do usuário
                    new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: 'Sua localização',
                    });
                },
                () => {
                    console.error('Erro ao capturar localização.');
                }
            );
        } else {
            console.error('Geolocalização não suportada pelo navegador.');
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
                <div className="m-5 p-5">
                    <h3>Aqui está uma lista:</h3>
                    <ul>
                        <li>Adicionar marcadores (markers) personalizados no mapa</li>
                        <li>Exibir informações de localização com InfoWindows</li>
                        <li>Criar rotas de direção (Directions)</li>
                        <li>Calcular distâncias e tempos de viagem entre pontos (Distance Matrix)</li>
                        <li>Integrar camadas de trânsito, tráfego e ciclovias</li>
                        <li>Usar o recurso de Street View</li>
                        <li>Desenhar formas geométricas (círculos, retângulos, polígonos)</li>
                        <li>Criar e gerenciar clusters de marcadores</li>
                        <li>Configurar filtros de busca por proximidade</li>
                        <li>Aplicar eventos personalizados (cliques, arrastos, zoom)</li>
                        <li>Adicionar mapas de calor (heatmaps)</li>
                        <li>Personalizar o estilo do mapa</li>
                        <li>Criar animações de movimento para marcadores</li>
                        <li>Aplicar controle de camadas e sobreposições</li>
                        <li>Implementar geocodificação (endereços para coordenadas e vice-versa)</li>
                        <li>Habilitar geolocalização e rastreamento em tempo real</li>
                        <li>Adicionar controles personalizados (zoom, tipo de mapa, entre outros)</li>
                        <li>Exibir dados de locais com Places API (restaurantes, hotéis, etc.)</li>
                        <li>Implementar mapas offline (exibindo cache de áreas baixadas)</li>
                        <li>Personalizar ícones e etiquetas de marcadores</li>
                    </ul>
                </div>
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