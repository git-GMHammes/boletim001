<?php
$token_csrf = false;
if (session()->get('token_csrf')) {
    $token_csrf = session()->get('token_csrf');
}
$parametros_backend = array(
    // DEBUG
    'DEBUG_MY_PRINT' => false,
    // Informação Frontend
    'title' => isset($metadata['page_title']) ? ($metadata['page_title']) : ('TITULO NÃO INFORMADO'),
    // Dados Backend
    'result' => isset($result) ? ($result) : (array()),
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'token_csrf' => $token_csrf,
    // Dados webserver base url
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'base_url' => base_url(),
    // Campos Select com mais de 10 itens
    'api_post_filter_objeto1' => 'projeto/subrotina/objeto/api/verbo',
    'api_post_filter_objeto2' => 'projeto/subrotina/objeto/api/verbo',
    // Tabela/lista/grid
    'api_get_objeto1' => 'fia/ptpa/responsavel/api/exibir/247',
    'api_get_objeto2' => 'fia/ptpa/municipio/api/exibir',
    'api_post_responsavel' => 'fia/ptpa/responsavel/api/atualizar',
    // Paginação para listas e grids
    'getVar_page' => isset($metadata['getVar_page']) ? ('?page=' . $metadata['getVar_page']) : ('?page=' . '1'),
    'page' => isset($metadata['getVar_page']) ? ($metadata['getVar_page']) : ('1'),
);
$parametros_backend['base_paginator'] = implode('/', $parametros_backend['getURI']);
// myPrint($parametros_backend, '');
?>

<div class="app_objeto" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppObjeto = () => {

        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_objeto').getAttribute('data-result'));

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const title = parametros.title;
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
        const token_csrf = parametros.token_csrf;

        // Campos Select com mais de 10 itens
        const api_post_filter_objeto1 = parametros.api_post_filter_objeto1;
        const api_post_filter_objeto2 = parametros.api_post_filter_objeto2;

        // Tabela/lista/grid
        const api_get_objeto1 = parametros.api_get_objeto1;
        const api_get_objeto2 = parametros.api_get_objeto2;
        const [paginacaoObjeto1, setPaginacaoObjeto1] = React.useState(null);
        const [paginacaoObjeto2, setPaginacaoObjeto2] = React.useState(null);

        // Paginação para tabela/lista/grid
        const base_paginator = base_url+parametros.base_paginator;
        const getVar_page = parametros.getVar_page;
        const page = parametros.page;

        // Post Fomulário
        const api_post_responsavel = parametros.api_post_responsavel;

        // Variáveis Mapeaveis para Listas e Grids
        const [objeto1, setObjeto1] = React.useState([]);
        const [objeto2, setObjeto2] = React.useState([]);

        // Filtros Selects Mapeaveis com mais de 10 itens
        const [filtroSelect1, setFiltroSelect1] = React.useState([]);
        const [filtroSelect2, setFiltroSelect2] = React.useState([]);

        // Variáveis Uteis
        const [error, setError] = React.useState(null);
        const [isLoading, setIsLoading] = React.useState(true);
        const [pagination, setPagination] = React.useState(null);
        const [successMessage, setSuccessMessage] = React.useState("");
        const [errorMessage, setErrorMessage] = React.useState("");

        // Declare Todos os Campos do Filtro
        const [formFilter, setFormFilter] = React.useState({
            Municipio: null
        });

        // Declare Todos os Campos do Formulário
        const [formData, setFormData] = React.useState({
            id: null,
            Nome: null,
            CPF: null,
            RG: null,
            token_csrf: null,
            ExpedidorRG: null,
            ExpedicaoRG: null,
            CadastroId: null,
            ResponsavelID: null,
            Responsavel_Nome: null,
            Responsavel_Email: null,
            Responsavel_TelefoneFixo: null,
            Responsavel_TelefoneMovel: null,
            Responsavel_TelefoneRecado: null,
            Responsavel_Endereco: null,
            Responsavel_CPF: null,
            PerfilId: null,
            PerfilDescricao: null,
            SexoId: null,
            SexoBiologico: null,
            GeneroIdentidadeeId: null,
            Genero: null,
            GeneroIdentidadeDescricao: null,
            MunicipioId: null,
            MunicipioCadastro: null,
            AcessoCadastroID: null,
            UnidadeId: null,
            Unidade: null,
            NomeUnidade: null,
            AcessoId: null,
            AcessoDescricao: null,
            ProntuarioId: null,
            NomeMae: null,
            Nascimento: null,
            Endereco: null,
            Bairro: null,
            UF: null,
            TelefoneFixo: null,
            TelefoneMovel: null,
            TelefoneRecado: null,
            Email: null,
            NMatricula: null,
            Certidao: null,
            Etnia: null,
            Escolaridade: null,
            NumRegistro: null,
            Folha: null,
            Livro: null,
            Circunscricao: null,
            Zona: null,
            UFRegistro: null,
            TipoEscola: null,
            TurnoEscolarAdolesc: null,
            NomeEscola: null,
            DataCadastramento: null,
            DataTermUnid: null,
            DataInicioUnid: null,
            CodProfissao: null,
            EnderecoUnidade: null,
        });

         // Inicializando o debounceTimeout com useRef
        const debounceTimeout = React.useRef(null);

        // Função handleChange simplificada e expandida
        const handleChange = (event) => {
            const { name, value } = event.target;
            // console.log('name handleChange: ', name);
            // console.log('value handleChange: ', value);

            // Atualização básica do estado com debounce
            if (debounceTimeout.current) {
                clearTimeout(debounceTimeout.current);
            }

            debounceTimeout.current = setTimeout(() => {
                setFormData(prev => {
                    // Se o campo alterado for o ID do município, também atualize o nome do município
                    if (name === "MunicipioId") {
                        const selectedMunicipio = objeto2.find(municipio => municipio.id === value);
                        return {
                            ...prev,
                            [name]: value,
                            MunicipioCadastro: selectedMunicipio ? selectedMunicipio.nome_municipio : "Escolha um Município"
                        };
                    } else {
                        return {
                            ...prev,
                            [name]: value
                        };
                    }
                });
                // console.log('debounceTimeout');
            }, 300);
        };

        // Função FilterChange simplificada
        const FilterChange = (event) => {
            const { name, value } = event.target;
            // console.log('name FilterChange: ', name);
            // console.log('value FilterChange: ', value);
            
            setFormFilter((prev) => ({
                ...prev,
                [name]: value
            }));
            
            // Implementa debounce para evitar múltiplas requisições
            if (debounceTimeout.current) {
                clearTimeout(debounceTimeout.current);
            }

            debounceTimeout.current = setTimeout(() => {
                // console.log('debounceTimeout');
            }, 300);

        };

        // Simplificação do Estado
        const handleResponse = (data) => {
            if (data.result) {
                const municipioId = data.result.dbUpdate.municipio_id;
                setFormData({ MunicipioId: municipioId }); // Simplificação para teste
            }
        };

        // Função que será chamada para submeter todos os formulários de uma vez
        const submitAllForms = (apiIdentifier) => {
            const data = {};
            const inputs = document.querySelectorAll(`input[data-api="${apiIdentifier}"]`);
            inputs.forEach(input => {
                data[input.name] = input.value;
            });

            if (apiIdentifier === 'form-responsavel') {
                fetch(`${base_url}${api_post_responsavel}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.result && data.result.dbUpdate) {
                        // Primeiro, atualize os dados do formulário
                        setFormData(prevFormData => ({
                            ...prevFormData,
                            ...data.result.dbUpdate // Espalha todos os dados de dbUpdate para atualizar todos campos pertinentes
                        }));
                        // Em seguida, configure a mensagem de sucesso
                        setSuccessMessage("Cadastro realizado com sucesso");
                        setErrorMessage("");  // Limpa a mensagem de erro anterior, se houver
                    } else {
                        // Se não houver dados para atualizar, configure a mensagem de erro
                        setErrorMessage("Não foi possível realizar o seu cadastro");
                        setSuccessMessage(""); // Limpa a mensagem de sucesso anterior, se houver
                    }
                })
                .catch(error => {
                    setErrorMessage(`Erro ao enviar form-responsável: ${error.message}`);
                    setSuccessMessage(""); // Limpa a mensagem de sucesso anterior, se houver
                });
            }
        };

        // React.useEffect
        React.useEffect(()=>{
            // console.log('React.useEffect');

            console.log('MunicipioId alterado: ', formData.MunicipioId);

            // Fetch para obter os Objeto1
            const fetchObjeto1 = async () => {
                try {
                    const response = await fetch(base_url + api_get_objeto1);
                    const data = await response.json();
                    // console.log('Objeto1: ', data);
                    if (data.result.dbResponse && data.result.dbResponse.length > 0) {
                        setObjeto1(data.result.dbResponse);
                        setFormData(data.result.dbResponse[0]);
                    }
                } catch (error) {
                    setError('Erro ao carregar Objeto1: ' + error.message);
                }
            };
            
            // Fetch para obter os Objeto2
            const fetchObjeto2 = async () => {
                try {
                    const response = await fetch(base_url + api_get_objeto2 + getVar_page);
                    const data = await response.json();
                    if (data.result.dbResponse && data.result.dbResponse.length > 0) {
                        // console.log('Objeto2: ', data);
                        setObjeto2(data.result.dbResponse);
                        setPagination(false);
                    }
                    if (data.result.linksArray && data.result.linksArray.length > 0) {
                        setPaginacaoObjeto2(data.result.linksArray);
                    }
                } catch (error) {
                    setError('Erro ao carregar Objeto2: ' + error.message);
                }
            };

            // Informe todos os FETCHs Desenvolvidos aqui
            const loadData = async () => {
                // console.log('loadData');
                
                // Lista de fetch
                await fetchObjeto1();
                await fetchObjeto2();

                // Fecha o Loading
                setIsLoading(false);
            };

            loadData();

        }, []);

        
        // Style
        const myMinimumHeight = {
            minHeight: '600px'
        }

        const verticalBarStyle = {
            width: '5px',
            height: '60px',
            backgroundColor: '#00BFFF',
            margin: '10px',
            Right: '10px',
        };

        const formGroupStyle = {
            position: 'relative',
            marginTop: '20px',
            padding: '5px',
            borderRadius: '8px',
            border: '1px solid #000',
        };

        const formLabelStyle = {
            position: 'absolute',
            top: '-15px',
            left: '20px',
            backgroundColor: 'white',
            padding: '0 5px',
        };

        const formControlStyle = {
            fontSize: '1rem',
            borderColor: '#fff',
        };

        const requiredField = {
            color: '#FF0000',
        };

        // Loading do Sistema
        if(isLoading){
            return <div className="d-flex align-items-center justify-content-center" style={myMinimumHeight}>
                        <div className="spinner-border text-primary" role="status">
                            <span className="visually-hidden">Loading...</span>
                        </div>
                    </div>
        }

        // Mensagem de erro do Sistema
        if (error) {
            return <div className="d-flex align-items-center justify-content-center" style={myMinimumHeight}>
                        <div className="alert alert-danger" role="alert">
                            {error}
                        </div>
                    </div>
        }

        return (
            <div style={myMinimumHeight}>
                <div className="d-flex justify-content-center">
                    {successMessage && <div className="alert alert-success text-center w-100" role="alert">{successMessage}</div>}
                    {errorMessage && <div className="alert alert-danger text-center w-100" role="alert">{errorMessage}</div>}
                </div>
                <div className="d-flex justify-content-center">
                    <div className="card text-center" style={{width: '25rem'}}>
                        <div className="card-header">
                            Título do Formulário
                        </div>
                        <div className="card-body">
                            <h5 className="card-title">Subtitulo</h5>
                            <div className="text-start">
                                
                                {/* Campo TOKEN/HIDDEN*/}
                                <form className="was-validated mb-2">
                                    <label htmlFor="Nome" className="form-label">ID</label>
                                    <input 
                                    data-api="form-responsavel"
                                        type="text" 
                                        className="form-control is-valid" 
                                        name="token_csrf" 
                                        id="token_csrf" 
                                        value={token_csrf || false} 
                                        onChange={handleChange}
                                        required/>
                                    <div className="invalid-feedback">
                                        Token Obrigatório.
                                    </div>
                                </form>
                                
                                {/* Campo ID/TEXT*/}
                                <form className="was-validated mb-2">
                                    <label htmlFor="Nome" className="form-label">ID</label>
                                    <input 
                                    data-api="form-responsavel"
                                        type="text" 
                                        className="form-control is-valid" 
                                        name="id" 
                                        id="id" 
                                        value={formData.id || ''} 
                                        onChange={handleChange}
                                        required/>
                                    <div className="invalid-feedback">
                                        ID Obrigatório.
                                    </div>
                                </form>
                                
                                {/* Campo Nome/TEXT*/}
                                <form className="was-validated mb-2">
                                    <label htmlFor="Nome" className="form-label">Nome</label>
                                    <input 
                                        data-api="form-responsavel"
                                        type="text" 
                                        className="form-control is-valid" 
                                        name="Nome" 
                                        id="Nome" 
                                        value={formData.Nome || ''} 
                                        onChange={handleChange}
                                        required/>
                                    <div className="invalid-feedback">
                                        Nome Obrigatório.
                                    </div>
                                </form>
                                
                                {/* Campo CPF/TEXT*/}
                                <form className="was-validated mb-2">
                                    <label htmlFor="CPF" className="form-label">CPF</label>
                                    <input 
                                        data-api="form-responsavel"
                                        type="text" 
                                        className="form-control is-valid" 
                                        name="CPF" 
                                        id="CPF" 
                                        value={formData.CPF || ''} 
                                        onChange={handleChange}
                                        required/>
                                    <div className="invalid-feedback">
                                        CPF Obrigatório.
                                    </div>
                                </form>
                                
                                {/* Campo Cidade/SELECT/OPTION*/}
                                <label htmlFor="municipio_id" className="form-label">Cidade</label>

                                {/* Dropdown para campo select*/}
                                <div className="mb-2">
                                    <div className="dropdown">
                                        <div className="btn btn-outline-dark dropdown-toggle w-100 text-start" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            {formData.MunicipioCadastro || 'Escolha um Município'}
                                        </div>
                                        <div className="dropdown-menu w-100 m-0 p-0" aria-labelledby="dropdownMenuLink">
                                        
                                            {/* Campo Municipip/HIDDEN*/}
                                            <form className="was-validated m-0 p-0">
                                                <input 
                                                    data-api="form-responsavel"
                                                    type="text" 
                                                    className="form-control is-valid" 
                                                    name="municipio_id" 
                                                    id="municipio_id" 
                                                    placeholder="Buscar Cidade"
                                                    value={formData.MunicipioId || ''} 
                                                    onChange={handleChange} 
                                                />
                                                <div className="invalid-feedback">
                                                    Teste Municipio Oculto.
                                                </div>
                                            </form>
                                        
                                            {/* Campo Municipip/TEXT*/}
                                            <form className="was-validated m-0 p-0">
                                                <input 
                                                    data-api="filter-municipio"
                                                    type="text" 
                                                    className="form-control is-valid" 
                                                    name="Municipio" 
                                                    id="Municipio" 
                                                    placeholder="Buscar Cidade"
                                                    onChange={FilterChange}
                                                />
                                                <div className="invalid-feedback">
                                                    Municipio Obrigatório.
                                                </div>
                                            </form>

                                            {/* Campo Select */}
                                            <form className="was-validated mb-0">
                                                <select 
                                                    data-api="form-responsavel"
                                                    className="form-select" 
                                                    name="MunicipioId" 
                                                    id="MunicipioId" 
                                                    value={formData.MunicipioId || ''} 
                                                    onChange={handleChange} 
                                                    aria-label="Default select 0"
                                                    required >
                                                    <option value="">Seleção Nula</option>
                                                    {objeto2.map(objeto2_select => (
                                                        <option className="w-100" key={objeto2_select.id} value={objeto2_select.id}>
                                                            {`(${objeto2_select.nome_municipio})`}
                                                        </option>
                                                    ))}
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div className="mb-2">
                                    <a href="#" className="btn btn-dark w-100">Botão Fake</a>
                                </div>
                                <div className="mb-2">
                                    <button className="btn btn-dark w-100" onClick={() => submitAllForms('form-responsavel')}>Enviar Formulário Responsável</button>
                                </div>
                            </div>
                        </div>
                        <div className="card-footer text-muted">
                            Rodapé do Cartão
                        </div>
                    </div>
                </div>
            </div>
        );
    };

    ReactDOM.render(<AppObjeto />, document.querySelector('.app_objeto'));
</script>
<?php
    $parametros_backend = array();
?>