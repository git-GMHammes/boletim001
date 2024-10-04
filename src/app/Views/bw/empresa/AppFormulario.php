<?php
$token_csrf = (session()->get('token_csrf')) ? (session()->get('token_csrf')) : ('erro');
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
    'api_empresa_cadastrar' => 'api/cadastrar',
    'api_empresa_atualizar' => 'api/atualizar',
);
// myPrint($parametros_backend, 'src\app\Views\bw\empresa\AppFormulario.php', true);
?>

<div class="app_formulario" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppFormulario = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_formulario').getAttribute('data-result'));
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
        const api_empresa_cadastrar = parametros.api_empresa_cadastrar;
        const api_empresa_atualizar = parametros.api_empresa_atualizar;

        // Definindo o estado para controlar a aba ativa
        const [tabNav, setTabNav] = React.useState('form');

        // Estado para controlar o alerta
        const [showAlert, setShowAlert] = React.useState(false);
        const [alertType, setAlertType] = React.useState('');
        const [alertMessage, setAlertMessage] = React.useState('');
        const [startTransition, setStartTransition] = React.useState(false);

        // Função para trocar de aba
        const handleTabClick = (tab) => {
            setTabNav(tab); // Atualiza a aba selecionada
        };

        // Declare Todos os Campos do Formulário Aqui
        const [formData, setFormData] = React.useState({
            id: null,
            codigo: null,
            nome: null,
            responsavel: null,
            email_contato: null,
            inicio_vigencia_bom: null,
            active: null,
            data_criacao: null,
        });

        const handleChange = (event) => {
            const { name, type, checked, value } = event.target;

            console.log('name handleChange: ', name);
            console.log('value handleChange: ', value);

            if (name === 'active') {
                showOffcanvasAlert('info', 'Acionou o Ativo');
                // Atualize o estado com o valor correto para checkboxes
                setFormData((prev) => ({
                    ...prev,
                    [name]: checked  // Para checkbox, usamos "checked"
                }));
            } else {
                // Para outros campos, use o valor normal
                setFormData((prev) => ({
                    ...prev,
                    [name]: value
                }));
            }
        };


        const captureFormData = (apiIdentifier) => {
            const data = {};
            const inputs = document.querySelectorAll(`input[type="hidden"][data-api="${apiIdentifier}"], 
            input[type="text"][data-api="${apiIdentifier}"], input[type="radio"][data-api="${apiIdentifier}"], 
            input[type="checkbox"][data-api="${apiIdentifier}"], input[type="number"][data-api="${apiIdentifier}"], 
            input[type="email"][data-api="${apiIdentifier}"], input[type="password"][data-api="${apiIdentifier}"], 
            input[type="file"][data-api="${apiIdentifier}"], input[type="date"][data-api="${apiIdentifier}"], 
            input[type="datetime-local"][data-api="${apiIdentifier}"], input[type="month"][data-api="${apiIdentifier}"], 
            input[type="week"][data-api="${apiIdentifier}"], input[type="time"][data-api="${apiIdentifier}"], 
            input[type="range"][data-api="${apiIdentifier}"], input[type="tel"][data-api="${apiIdentifier}"], 
            input[type="url"][data-api="${apiIdentifier}"], input[type="search"][data-api="${apiIdentifier}"], 
            input[type="color"][data-api="${apiIdentifier}"], select[data-api="${apiIdentifier}"], textarea[data-api="${apiIdentifier}"], 
            button[data-api="${apiIdentifier}"], datalist[data-api="${apiIdentifier}"], output[data-api="${apiIdentifier}"], 
            progress[data-api="${apiIdentifier}"], meter[data-api="${apiIdentifier}"]`);

            inputs.forEach(input => {
                if (input.name) {
                    switch (input.type) {
                        case 'checkbox':
                        case 'radio':
                            if (input.checked) {
                                data[input.name] = input.value;
                            }
                            break;
                        case 'date':
                        case 'datetime-local':
                        case 'email':
                        case 'number':
                        case 'text':
                        case 'textarea':
                        case 'select-one':
                        case 'select-multiple':
                            data[input.name] = input.value;
                            break;
                        default:
                            data[input.name] = input.value;
                            break;
                    }
                }
            });
            return data;
        };

        const submitAllForms = async (apiIdentifier) => {
            console.log('submitAllForms...');
            const data = captureFormData(apiIdentifier);
            let getUser = '';
            let response1 = '';
            console.log('Dados a serem enviados:', data);

            if (apiIdentifier === 'form-empresa') {
                // showOffcanvasAlert('info', 'Acionou a mensagem em modo INFO');
                // Convertendo os dados do setPost em JSON
                response1 = await fetch(base_url + api_empresa_cadastrar, {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });

                if (!response1.ok) {
                    throw new Error(`Erro na requisição: ${response1.statusText}`);
                }

                getUser = await response1.json();

                // Processa os dados recebidos da resposta
                if (getUser && getUser.result.dbResponse[0]) {
                    const dbResponse = getUser.result.dbResponse[0];
                    console.log('dbResponse: ', getUser.result.dbResponse[0]);
                    showOffcanvasAlert('success', 'Link de Homologação atualizado com sucesso!');
                    redirectTo('index.php/bw/usuario/endpoint/login');
                    return dbResponse;
                } else {
                    showOffcanvasAlert('danger', 'Não foi possível atualizar o Link de Homologação!');
                    return null;
                }
            }
        };

        // Função que retorna um formulário
        const renderForm = () => {
            return (
                <div>
                    <form className="was-validated">
                        <div>
                            <div className="row">
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="codigo" className="form-label">Código</label>
                                    <input data-api="form-empresa" type="text" className="form-control" id="codigo" name="codigo" value={formData.codigo || ''} onChange={handleChange} required />
                                </div>
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="nome" className="form-label">Nome</label>
                                    <input data-api="form-empresa" type="text" className="form-control" id="nome" name="nome" value={formData.nome || ''} onChange={handleChange} required />
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="responsavel" className="form-label">Responsável</label>
                                    <input data-api="form-empresa" type="text" className="form-control" id="responsavel" name="responsavel" value={formData.responsavel || ''} onChange={handleChange} required />
                                </div>
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="email_contato" className="form-label">E-mail</label>
                                    <input data-api="form-empresa" type="email" className="form-control" id="email_contato" name="email_contato" value={formData.email_contato || ''} onChange={handleChange} required />
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="inicio_vigencia_bom" className="form-label">Início Vigência BOM</label>
                                    <input data-api="form-empresa" type="date" className="form-control" id="inicio_vigencia_bom" name="inicio_vigencia_bom" value={formData.inicio_vigencia_bom || ''} onChange={handleChange} required />
                                </div>
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="active" className="form-label">Ativo</label>
                                    <div className="border border-dark ps-2 pe-1 pt-1 pb-1 ps-1 rounded">
                                        <div class="form-check form-switch">
                                            <input className="form-check-input" type="checkbox" id="active" name="active" checked={formData.active || false} onChange={handleChange} />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="data_criacao" className="form-label">Data de Criação</label>
                                    <input data-api="form-empresa" type="datetime-local" className="form-control" id="data_criacao" name="data_criacao" value={formData.data_criacao || ''} onChange={handleChange} required />
                                </div>
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="data_criacao" className="form-label">&nbsp;</label>
                                    <div>
                                        <input className="btn btn-outline-dark w-100" type="submit" value="Enviar" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            );
        };

        // Função que retorna uma lista
        const renderList = () => {
            return (
                <div>
                    LISTA
                </div>
            );
        };

        // Função que retorna um Exluir
        const renderDel = () => {
            return (
                <div>
                    EXCLUIR
                </div>
            );
        };

        // Função que retorna Ajuda
        const renderHelp = () => {
            return (
                <div>
                    AJUDA
                </div>
            );
        };

        // Offcanvas (success, danger, warning, info)
        // Função para exibir o alerta
        const showOffcanvasAlert = (type, message) => {
            setAlertType(type);
            setAlertMessage(message);
            setShowAlert(true);

            // Inicia a transição após o componente ser renderizado
            setTimeout(() => {
                setStartTransition(true);
            }, 50);

            setTimeout(() => {
                setStartTransition(false);
                setShowAlert(false);
            }, 5000);
        };

        const redirectTo = (url) => {
            const uri = base_url + url;
            setTimeout(() => {
                window.location.href = uri;
            }, 3000);
        };

        // Style

        const offcanvasStyles = {
            width: '250px',
            height: '150px',
            transition: 'transform 1s ease-in-out',
            transform: startTransition ? 'translateX(0)' : 'translateX(100%)',
            position: 'fixed',
            top: '10px',
            right: '0',
            zIndex: '1055'
        };

        return (
            <div id="top" className="d-flex justify-content-center align-items-center min-vh-100">
                <div className="container">
                    <ul className="nav nav-tabs border border-top-0 border-start-0 border-end-0 rounded-top">
                        <li className="nav-item">
                            <a
                                className={`nav-link ${tabNav === 'form' ? 'active' : ''}`}
                                href="#top"
                                onClick={() => handleTabClick('form')}
                            >
                                Formulario
                            </a>
                        </li>
                        <li className="nav-item">
                            <a
                                className={`nav-link ${tabNav === 'list' ? 'active' : ''}`}
                                href="#top"
                                onClick={() => handleTabClick('list')}
                            >
                                Listar
                            </a>
                        </li>
                        <li className="nav-item">
                            <a
                                className={`nav-link ${tabNav === 'del' ? 'active' : ''}`}
                                href="#top"
                                onClick={() => handleTabClick('del')}
                            >
                                Excluir
                            </a>
                        </li>
                        <li className="nav-item">
                            <a
                                className={`nav-link ${tabNav === 'help' ? 'active' : ''}`}
                                href="#top"
                                onClick={() => handleTabClick('help')}
                            >
                                Ajuda
                            </a>
                        </li>
                    </ul>

                    {/* Carrega todas as funções acima */}
                    <div className="border border-top-0 rounded-bottom p-3">
                        {tabNav === 'form' && renderForm()}
                        {tabNav === 'list' && renderList()}
                        {tabNav === 'del' && renderDel()}
                        {tabNav === 'help' && renderHelp()}
                    </div>
                    {showAlert && (
                        <div
                            className={`bg-${alertType} text-white p-3`}
                            style={offcanvasStyles}
                        >
                            {alertMessage}
                        </div>
                    )}
                </div>
            </div>
        );
    };
    const rootElement = document.querySelector('.app_formulario');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppFormulario />);

</script>
<?php
$parametros_backend = array();
?>
