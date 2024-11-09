<?php
$token_csrf = (session()->get('token_csrf')) ? (session()->get('token_csrf')) : ('erro');
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'token_csrf' => $token_csrf,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
    'api_login' => 'bomweb/usuario/api/exibir'
);
?>

<div class="app_login" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppLogin = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_login').getAttribute('data-result'));
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const token_csrf = parametros.token_csrf;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
        const api_login = parametros.api_login;

        // Constante para exibir o alerta (primary, secondary, success, danger, warning, info, light, dark)
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

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

            if (apiIdentifier === 'login-on') {

                // Função para exibir o alerta (primary, secondary, success, danger, warning, info, light, dark)
                setMessage({
                    show: true,
                    type: 'light',
                    message: `Login realizado com sucesso.`
                });
                // Convertendo os dados do setPost em JSON
                response1 = await fetch(base_url + api_login, {
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

                    // Função para exibir o alerta (primary, secondary, success, danger, warning, info, light, dark)
                    setMessage({
                        show: true,
                        type: 'light',
                        message: `Resultado recebido com sucesso!`
                    });
                    redirectTo('index.php/bw/usuario/endpoint/login');
                    return dbResponse;
                } else {

                    // Função para exibir o alerta (primary, secondary, success, danger, warning, info, light, dark)
                    setMessage({
                        show: true,
                        type: 'light',
                        message: `Erro ao receber o resultado.`
                    });
                    return null;
                }
            }
        };

        // Declare Todos os Campos do Formulário Aqui
        const [formData, setFormData] = React.useState({
            login: '',
            password: '',
        });

        const redirectTo = (url) => {
            const uri = base_url + url;
            setTimeout(() => {
                window.location.href = uri;
            }, 3000);
        };

        // Style
        const styleAlturaMinima = {
            minHeight: '620px'
        };

        const styleLarguraLogin = {
            width: '300px'
        };

        return (
            <div className="d-flex justify-content-center align-items-center min-vh-100">
                <div className="ps-3" style={styleLarguraLogin}>
                    <div className="card-footer text-muted">
                        <div className="card">
                            <div className="card-header text-center">
                                Acesso do Sistema
                            </div>
                            <div className="card-body">
                                <h5 className="card-title text-center mb-3">Login</h5>
                                <form className="was-validated" onSubmit={(e) => {
                                    e.preventDefault();
                                    submitAllForms('update-user', formData);
                                }}>
                                    <input data-api="login-on" type="hidden" id="token_csrf" name="token_csrf" value={`${token_csrf}`} className="form-control" required />
                                    <input data-api="login-on" type="hidden" id="json" name="json" value={`1`} className="form-control" required />
                                </form>
                                <form className="was-validated" onSubmit={(e) => {
                                    e.preventDefault();
                                    submitAllForms('update-user', formData);
                                }}>
                                    <div className="row">
                                        <div className="col-12 col-sm-12">
                                            <div>
                                                <label htmlFor="validationServer01" className="form-label text-start">Login</label>
                                                <input data-api="login-on" type="text" id="login" name="login" className="form-control is-valid" id="validationServer01" required />
                                                <div className="valid-feedback mb-3">
                                                    Login obrigatório
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col-12 col-sm-12">
                                            <div>
                                                <label htmlFor="validationServer02" className="form-label text-start">Senha</label>
                                                <input data-api="login-on" type="password" id="password" name="password" className="form-control is-valid" id="validationServer02" required />
                                                <div className="valid-feedback mb-3">
                                                    Senha obrigatória
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col-12 col-sm-12 text-start">
                                            <button className="btn btn-outline-primary mb-5" onClick={() => submitAllForms('login-on')} type="submit">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div className="card-footer text-muted text-center">
                                Boletim na WEB
                            </div>
                        </div>
                    </div>
                </div>

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_cap_atend" />

            </div>
        );
    }

    const rootElement = document.querySelector('.app_login');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppLogin />);
</script>
<?php
$parametros_backend = array();
?>