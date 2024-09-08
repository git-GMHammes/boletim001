 
<?php
$token_csrf = (session()->get('token_csrf')) ? (session()->get('token_csrf')) : ('erro');
$atualizar_id = isset($result['atualizar_id']) ? ($result['atualizar_id']) : ('erro');

$parametros_backend = array(
    'title' => isset($metadata['page_title']) ? ($metadata['page_title']) : ('TITULO NÃO INFORMADO'),
    'DEBUG_MY_PRINT' => false,
    'token_csrf' => $token_csrf,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'result' => isset($result) ? ($result) : (array()),
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
    'api_url_001' => 'projeto/sub/projeto/api/verbo1',
    'api_url_002' => 'projeto/sub/projeto/api/verbo2',
);
$parametros_backend['api_get_atualizar_objeto'] = ($atualizar_id !== 'erro') ? ('projeto/sub/projeto/api/verbo1' . $atualizar_id) : ('projeto/sub/projeto/api/verbo1/erro');
$parametros_backend['base_paginator'] = implode('/', $parametros_backend['getURI']);
?>

<div class="app_exemple" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppExemple = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_exemple').getAttribute('data-result'));
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
 
        // Base Lista
        const api_url_001 = parametros.api_url_001;
        const api_url_002 = parametros.api_url_002;
        const base_paginator = base_url + parametros.base_paginator;
        const getVar_page = parametros.getVar_page;
        const page = parametros.page;
 
        // Variáveis da API
        const [apiUrlList, setApiUrlList] = React.useState([]);
 
        // Variáveis Uteis
        const [error, setError] = React.useState(null);
        const [isLoading, setIsLoading] = React.useState(true);
        const [pagination, setPagination] = React.useState(null);
 
        // Declare Todos os Campos do Formulário Aqui
        const [formData, setFormData] = React.useState({
            variavel_id: null,
            variavel_001: null,
            variavel_002: null,
            variavel_003: null
        });
 
        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;
            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));
 
            // Verifica se a mudança é no campo 'variavel_001'
            if (name === 'variavel_001') {
                console.log('variavel_001');
                // submitAllForms('filtro-api');
            }
        };
 
        // Função que gerencia atualizações do MODAL
        const handleOpenModal = (parameter) => {
            console.log("handleOpenModal:", parameter);
            setFormData(prontuario);
            // Exemplo
            // {apiUrlList.map((select_value, index) => (...
            // <button type="button" className="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target={`#staticBackdropProntuario${index}`} onClick={() => handleOpenModal(select_value)}>
            //      <i className="bi bi-pencil-square" />
            // </button>
        };
 
        // fetchData abstraido para POST
        const fetchData = async (url, data) => {
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });
                return await response.json();
            } catch (error) {
                console.error('Erro ao enviar dados:', error);
                // Aqui você pode adicionar lógica adicional para exibir o erro para o usuário
                return null;
            }
        };
 
        const submitAllForms = async (apiIdentifier, data) => {
            console.log('Dados a serem enviados:', data);
 
            switch (apiIdentifier) {
 
                case 'filtro-001':
                    console.log('filtro-001');
                    const updateData = captureFormData('filtro-001');
                    const response = await fetchData(`${base_url}/${api_url_001}`, updateData);
                    if (response && response.result && response.result.affectedRows > 0) {
                        console.log('insertID:', response.result.insertID);
                        setFormData(prev => ({
                            ...prev,
                            id: response.result.insertID
                        }));
                        const modal = new bootstrap.Modal(document.getElementById('MensagemSucessoSalvar'));
                        modal.show();
                    }
                    break;
 
                case 'filtro-002':
                    console.log(apiIdentifier, '- OK');
                    const data = captureFormData('filtro-adolescente');
                    const responsavelData = await fetchData(`${base_url}/${api_url_002}`, data);
                    if (responsavelData && responsavelData.result && responsavelData.result.dbResponse && responsavelData.result.dbResponse.length > 0) {
                        console.log('form-responsavel:', responsavelData.result.dbResponse);
                        setResponsaveis(responsavelData.result.dbResponse);
                    }
                    break;
 
                case 'filtro-003':
                    console.log(apiIdentifier, '- OK');
                    break;
 
                default:
                    console.log('Identificador de API desconhecido:', apiIdentifier);
                    break;
            }
        };
 
        React.useEffect(() => {
 
            if (!debugMyPrint) {
                fetchApiGet001();
                fetchApiGet002();
                fetchProntuarios();
            }
            setTimeout(() => {
                setIsLoading(false);
            }, 1000);
        }, []);
 
        // Fetch para obter as APIs
        const fetchApiGet001 = async () => {
            try {
                const response = await fetch(base_url + api_url_001);
                const data = await response.json();
                if (data.result.dbResponse && data.result.dbResponse.length > 0) {
                    console.log('api_url_001: ', data);
                    setProntuarios(data.result.dbResponse);
                    // Não esquecer do dbResponse[0]
                    setFormData(data.result.dbResponse[0]);
                }
            } catch (error) {
                setError('Erro ao carregar api_url_001: ' + error.message);
            }
        };
 
        const fetchApiGet002 = async () => {
            try {
                const response = await fetch(base_url + api_url_002);
                const data = await response.json();
                if (data.result.dbResponse && data.result.dbResponse.length > 0) {
                    console.log('api_url_002: ', data);
                    setProntuarios(data.result.dbResponse);
                    // Não esquecer do dbResponse[0]
                    setFormData(data.result.dbResponse[0]);
                }
            } catch (error) {
                setError('Erro ao carregar api_url_002: ' + error.message);
            }
        };
 
        // Variável para style
        const formGroupStyle = {
            position: 'relative',
            marginTop: '20px',
            padding: '5px',
            borderRadius: '8px',
            border: '1px solid #000',
        };
 
        if (isLoading) {
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
 
        return (
            <div>
                <div className="table-responsive ms-2 me-2 ps-2 pe-2">
                    <table className="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" className="text-nowrap">
                                    COLUMN001
                                </th>
                                <th scope="col" className="text-nowrap">
                                    COLUMN002
                                </th>
                                <th scope="col" className="text-nowrap">
                                    COLUMN003
                                </th>
                                <th scope="col" className="text-nowrap">
                                    COLUMN004
                                </th>
                                <th scope="col" className="text-nowrap">
                                    COLUMN005
                                </th>
                            </tr>
                        </thead>
 
                        <tbody>
                            {apiUrlList.map((mapList_value, index) => (
                                <tr key={index}>
                                    <td>{mapList_value.variavel_id}</td>
                                    <td>{mapList_value.variavel_001}</td>
                                    <td>{mapList_value.variavel_002}</td>
                                    <td>{mapList_value.variavel_003}</td>
                                    <td>
                                        {/* Botão para acionar o modal */}
                                        <button type="button" className="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target={`#staticBackdropObjeto${index}`} onClick={() => handleOpenModal(mapList_value)}>
                                            <i className="bi bi-pencil-square" />
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
 
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </tfoot>
                    </table>
 
                    {/* Modais para cada Objeto */}
                    {apiUrlList.map((mapList_value, index) => (
                        <div key={index} className="modal fade" id={`staticBackdropObjeto${index}`} data-bs-backdrop="static" data-bs-keyboard="false" tabIndex={-1} aria-labelledby={`staticBackdropObjetoLabel${index}`} aria-hidden="true">
                            <div className="modal-dialog modal-xl">
                                <div className="modal-content">
 
                                    <div className="modal-header">
                                        <h5 className="modal-title" id={`staticBackdropObjetoLabel${index}`}>Detalhes do Prontuário</h5>
                                        <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
 
                                    <div className="modal-body">
 
                                        {/* formulário conteudo Modal */}
                                            <div>{mapList_value.variavel_id}</div>
                                            <div>{mapList_value.variavel_001}</div>
                                            <div>{mapList_value.variavel_002}</div>
                                            <div>{mapList_value.variavel_003}</div>
                                            <div>{/*Coluna do botão*/}</div>
                                        {/* formulário conteudo Modal */}
                                    
                                    </div>
 
                                    <div className="modal-footer">
                                        <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    </div>
 
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        );
    };
    ReactDOM.render(<AppExemple />, document.querySelector('.app_exemple'));
</script>
<?php
$parametros_backend = array();
?>