<?php
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'result' => isset($result) ? ($result) : (array()),
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
    'api_get_value_Objeto' => 'fia/ptpa/Objeto/api/exibir/20',
    'api_get_municipio' => 'fia/ptpa/municipio/api/exibir',
    'api_get_unidade' => '',
    'api_get_genero' => '',
    'api_get_sexo' => '',
    'api_get_perfil' => '',
);
?>

<div class="app_form_Objeto" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppFormObjeto = () => {        
        
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_form_Objeto').getAttribute('data-result'));
        
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
        const api_get_value_Objeto = parametros.api_get_value_Objeto;
        const api_get_municipio = parametros.api_get_municipio;

        // Declare todas as Listas, NO PLURAL de APIs aqui:
        const [municipios, setMunicipios] = React.useState([]);
        const [generos, setGeneros] = React.useState([]);
        const [sexos, setSexos] = React.useState([]);
        const [perfis, setPerfis] = React.useState([]);
        const [unidades, setUnidades] = React.useState([]);

        // Decalre Todos os Campos do Formulário Aqui
        const [formData, setFormData] = React.useState({
            nome: null,
            sexo: null,
            municipio: null
        });

        const [error, setError] = React.useState(null);
        const [isLoading, setIsLoading] = React.useState(true);

        React.useEffect(() => {
            // Fetch para obter os municípios
            const fetchMunicipios = async () => {
                try {
                    const response = await fetch(base_url + api_get_municipio);
                    const data = await response.json();
                    if (data.result.dbResponse && data.result.dbResponse.length > 0) {
                        setMunicipios(data.result.dbResponse);
                    }
                } catch (error) {
                    setError('Erro ao carregar municípios: ' + error.message);
                }
            };
            // Fetch para obter os dados do usuário
            const fetchUserData = async () => {
                try {
                    const response = await fetch(base_url + api_get_value_Objeto);
                    const data = await response.json();
                    if (data.result && data.result.dbResponse && data.result.dbResponse.length > 0) {
                        const user = data.result.dbResponse[0];
                        setFormData({
                            nome: user.Nome,
                            sexo: user.SexoBiologico,
                            municipio: user.MunicipioUnidade,
                        });
                    }
                } catch (error) {
                    setError('Erro ao buscar dados: ' + error.message);
                } finally {
                    setIsLoading(false);
                }
            };
            
            // Informe todos os FETCHs Desenvolvidos aqui
            const loadData = async () => {
                await fetchMunicipios();
                await fetchUserData();
                setIsLoading(false);
            };
            loadData();

        }, []);
        
        // Styles
        const myMinimumHeight = {
            minHeight: '600px'
        }

        // Lidar com a mudanças (Handle Change)
        const handleChange = (event) => {
            const { name, value } = event.target;
            setFormData(prevState => ({
                ...prevState,
                [name]: value
            }));
        };

        const handleSubmit = (event) => {
            event.preventDefault();
            // console.log('Form data:', formData);
        };

        if(isLoading){
            return <div className="d-flex align-items-center justify-content-center" style={myMinimumHeight}>
                        <div className="spinner-border text-primary" role="status">
                            <span className="visually-hidden">Loading...</span>
                        </div>
                    </div>
        }

        if (error) {
            return <div className="d-flex align-items-center justify-content-center" style={myMinimumHeight}>
                        <div className="alert alert-danger" role="alert">
                            {error}
                        </div>
                    </div>
        }
        //
        console.log('form Data Aqui: ', formData)
        return (
            <div style={myMinimumHeight}>
                <form onSubmit={handleSubmit}>
                    <div className="mb-3">
                        <label htmlFor="nome" className="form-label">Nome</label>
                        <input type="text" className="form-control" id="nome" name="nome" value={formData.nome} onChange={handleChange} />
                    </div>
                    <div className="mb-3">
                        <label className="form-label">Sexo</label>
                        <div>
                            <div className="form-check form-check-inline">
                                <input className="form-check-input" type="radio" id="sexoMasculino" name="sexo" value="Masculino" checked={formData.sexo==='Masculino' } onChange={handleChange} />
                                <label className="form-check-label" htmlFor="sexoMasculino">Masculino</label>
                            </div>
                            <div className="form-check form-check-inline">
                                <input className="form-check-input" type="radio" id="sexoFeminino" name="sexo" value="Feminino" checked={formData.sexo==='Feminino' } onChange={handleChange} />
                                <label className="form-check-label" htmlFor="sexoFeminino">Feminino</label>
                            </div>
                        </div>
                    </div>
                    <div className="mb-3">
                        <label htmlFor="municipio" className="form-label">Município</label>
                        <select className="form-select" id="municipio" name="municipio" value={formData.municipio} onChange={handleChange}>
                            <option value="">Seleção Nula</option>
                            {municipios.map(municipio => (
                                <option key={municipio.id} value={municipio.nome_municipio}>
                                    {municipio.nome_municipio}
                                </option>
                            ))}
                        </select>
                    </div>
                    <button type="submit" className="btn btn-primary">Enviar</button>
                </form>
            </div>
        );
    };

    ReactDOM.render(<AppFormObjeto />, document.querySelector('.app_form_Objeto'));
</script>
<?php
$parametros_backend = array();
?>