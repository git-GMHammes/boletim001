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
    // Api Reponsável
    'api_get_responsavel' => 'fia/ptpa/responsavel/api/exibir/247',
    'api_get_municipio' => 'fia/ptpa/municipio/api/exibir',
    // Filtor Municipio
    'api_post_municipio_filtro' => 'fia/ptpa/municipio/api/filtro'
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
        
        // Post Fomulário
        const api_get_responsavel = parametros.api_get_responsavel;
        const api_get_municipio = parametros.api_get_municipio;
        
        // Post filtro
        const api_post_municipio_filtro = parametros.api_post_municipio_filtro;

        // Variáveis Mapeaveis para Listas e Grids
        const [responsavel, setResponsavel] = React.useState([]);
        const [municipio, setMunicipio] = React.useState([]);
        const [options, setOptions] = React.useState([]);

        // Variáveis Uteis
        const [error, setError] = React.useState(null);
        const [isLoading, setIsLoading] = React.useState(true);
        const [pagination, setPagination] = React.useState(null);
        const [successMessage, setSuccessMessage] = React.useState("");
        const [errorMessage, setErrorMessage] = React.useState("");

        // Declare Todos os Campos do Formulário
        const [formData, setFormData] = React.useState({
            id: null,
            Nome: null,
            CPF: null,
            MunicipioId: null,
            MunicipioCadastro: null,
        });

         // Inicializando o debounceTimeout com useRef
        const debounceTimeout = React.useRef(null);

        // Função handleChange simplificada e expandida
        const handleChange = (event) => {
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

            // Fetch para obter os Responsavel
            const fetchResponsavel = async () => {
                try {
                    const response = await fetch(base_url + api_get_responsavel);
                    const data = await response.json();
                    if (data.result.dbResponse && data.result.dbResponse.length > 0) {
                        console.log('Responsavel: ', data);
                        setResponsavel(data.result.dbResponse);
                        setFormData(data.result.dbResponse[0]);
                    }
                } catch (error) {
                    setError('Erro ao carregar Responsavel: ' + error.message);
                }
            };
            
            // Fetch para obter os Municipio
            const fetchMunicipio = async () => {
                try {
                    const response = await fetch(base_url + api_get_municipio);
                    const data = await response.json();
                    if (data.result.dbResponse && data.result.dbResponse.length > 0) {
                        console.log('Municipio: ', data);
                        setMunicipio(data.result.dbResponse);
                        setOptions(data.result.dbResponse);
                    }
                } catch (error) {
                    setError('Erro ao carregar Municipio: ' + error.message);
                }
            };

            // Informe todos os FETCHs Desenvolvidos aqui
            const loadData = async () => {
                // console.log('loadData');
                
                // Lista de fetch
                await fetchResponsavel();
                await fetchMunicipio();

                // Fecha o Loading
                setIsLoading(false);
            };

            loadData();

        }, []);

        const HybridInputSelect = ({ options }) => {
            const [inputValue, setInputValue] = React.useState('');
            const [selectedId, setSelectedId] = React.useState('');
            const [filteredOptions, setFilteredOptions] = React.useState([]);
            const [isDropdownVisible, setIsDropdownVisible] = React.useState(false);

            React.useEffect(() => {
                if (inputValue.length > 0) {  // Só processa se houver algo digitado
                    const newFilteredOptions = options
                        .filter(option => option && option.nome_municipio)
                        .map(option => ({
                            nome: option.nome_municipio,
                            id: option.id
                        }))
                        .filter(item => item.nome.toLowerCase().includes(inputValue.toLowerCase()));
                    setFilteredOptions(newFilteredOptions);
                    setIsDropdownVisible(newFilteredOptions.length > 0);
                } else {
                    setIsDropdownVisible(false);  // Esconde o dropdown se não houver entrada
                }
            }, [inputValue, options]);

            const handleChange = (e) => {
                setInputValue(e.target.value);
            };

            const handleOptionClick = (option) => {
                setInputValue(option.nome);
                setSelectedId(option.id);
                setIsDropdownVisible(false);
            };

            return (
                <div class="mb-5">
                    <div style={{ position: 'relative', display: 'inline-block' }}>
                        <input 
                            type="text" 
                            value={inputValue}
                            name="Cidade"  // Ajustado de "nome" para "name" que é o correto em HTML
                            onChange={handleChange}
                            onFocus={() => setIsDropdownVisible(true)}
                            placeholder="Digite para buscar..."
                            style={{ width: '200px', padding: '5px' }}
                        />
                        <input 
                            data-api="form-responsavel"
                            type="text" 
                            name="municipio_id"  // Ajustado de "nome" para "name" que é o correto em HTML
                            value={selectedId}
                            readOnly
                            placeholder="ID do município"
                            style={{ width: '200px', padding: '5px', marginTop: '5px' }}
                        />
                        {isDropdownVisible && (
                            <ul style={{ 
                                border: '1px solid #ccc', 
                                padding: 0, 
                                margin: 0, 
                                listStyleType: 'none', 
                                position: 'absolute', 
                                width: '100%', 
                                maxHeight: '150px', 
                                overflowY: 'auto', 
                                backgroundColor: '#fff',
                                zIndex: 1
                            }}>
                                {filteredOptions.map((option, index) => (
                                    <li 
                                        key={index} 
                                        onClick={() => handleOptionClick(option)}
                                        style={{ 
                                            padding: '5px', 
                                            cursor: 'pointer' 
                                        }}
                                    >
                                        {option.nome}
                                    </li>
                                ))}
                            </ul>
                        )}
                    </div>
                </div>
            );
        };

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
                                {/*
                                    Aqui implmenta em outro codigo: AppObjeto
                                */}
                                    <HybridInputSelect options={options} />

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