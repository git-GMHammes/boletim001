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
                    const data = captureFormData('filtro-Objeto');
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

                <div>

                    <div className="input-group mb-3">
                        <div className="input-group-prepend">
                            <span className="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" className="form-control" placeholder="Username" aria-label="Username"
                            aria-describedby="basic-addon1" />
                    </div>

                    <div className="input-group mb-3">
                        <input type="text" className="form-control" placeholder="Recipient's username" aria-label="Recipient's username"
                            aria-describedby="basic-addon2" />
                        <div className="input-group-append">
                            <span className="input-group-text" id="basic-addon2">@example.com</span>
                        </div>
                    </div>

                    <label htmlFor="basic-url">Your vanity URL</label>
                    <div className="input-group mb-3">
                        <div className="input-group-prepend">
                            <span className="input-group-text" id="basic-addon3">https://example.com/users/</span>
                        </div>
                        <input type="text" className="form-control" id="basic-url" aria-describedby="basic-addon3" />
                    </div>

                    <div className="input-group mb-3">
                        <div className="input-group-prepend">
                            <span className="input-group-text">$</span>
                        </div>
                        <input type="text" className="form-control" aria-label="Amount (to the nearest dollar)" />
                        <div className="input-group-append">
                            <span className="input-group-text">.00</span>
                        </div>
                    </div>

                    <div className="input-group">
                        <div className="input-group-prepend">'
                            <span className="input-group-text">With textarea</span>
                        </div>
                        <textarea className="form-control" aria-label="With textarea" defaultValue={""} />
                    </div>

                </div>

            </div>
        );
    };
    ReactDOM.render(<AppExemple />, document.querySelector('.app_exemple'));
</script>
<?php
$parametros_backend = array();
?>

<button type="button" class="btn btn-primary btn-sm">Small button</button>
<button type="button" class="btn btn-primary btn-lg">Large button</button>
<button type="button" class="btn btn-primary btn-lg btn-block">Block level button</button>

Nº
1º
2º
3º
4º

<?php
if (isset($result['value'])) {
    $value = $result['value'];
} else {
    $value = array();
}
$uri_post = 'www/caminho/api'
?>
<?= form_open_multipart($uri_post, 'class="was-validated"'); ?>
<!-- Campos do Formulário -->
<select class="form-select form-select-sm" aria-label=".form-select-sm example" disabled>
    <option selected>Open this select menu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
</select>
<select class="form-select form-select-sm" multiple aria-label="multiple select example" disabledv>
    <option selected>Open this select menu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
</select>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled>
    <label class="form-check-label" for="flexCheckDefault">
        Default checkbox
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
    <label class="form-check-label" for="flexCheckChecked">
        Checked checkbox
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" disabled>
    <label class="form-check-label" for="flexRadioDefault1">
        Default radio
    </label>
</div>
<div class="form-check">
    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
    <label class="form-check-label" for="flexRadioDefault2">
        Default checked radio
    </label>
</div>
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
    <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
</div>
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
    <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
</div>
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled" disabled>
    <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled switch checkbox input</label>
</div>
<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckCheckedDisabled" checked disabled>
    <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled checked switch checkbox input</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
    <label class="form-check-label" for="inlineCheckbox1">1</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
    <label class="form-check-label" for="inlineCheckbox2">2</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
    <label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
    <label class="form-check-label" for="inlineCheckbox1">1</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
    <label class="form-check-label" for="inlineCheckbox2">2</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
    <label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
    <label class="form-check-label" for="inlineRadio1">1</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
    <label class="form-check-label" for="inlineRadio2">2</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
    <label class="form-check-label" for="inlineRadio3">3 (disabled)</label>
</div>
<div class="input-group mb-3">
    <div class="input-group-text">
        <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
    </div>
    <input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox">
</div>

<div class="input-group">
    <div class="input-group-text">
        <input class="form-check-input mt-0" type="radio" value="" aria-label="Radio button for following text input">
    </div>
    <input type="text" class="form-control form-control-sm" aria-label="Text input with radio button">
</div>
<label for="disabledRange" class="form-label">Disabled range</label>
<input type="range" class="form-range" id="disabledRange" disabled>
<label for="customRange3" class="form-label">Example range</label>
<input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">@</span>
    <input type="text" class="form-control form-control-sm" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
</div>

<div class="input-group mb-3">
    <input type="text" class="form-control form-control-sm" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
    <span class="input-group-text" id="basic-addon2">@example.com</span>
</div>

<label for="basic-url" class="form-label">Your vanity URL</label>
<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
    <input type="text" class="form-control form-control-sm" id="basic-url" aria-describedby="basic-addon3">
</div>

<div class="input-group mb-3">
    <span class="input-group-text">$$</span>
    <input type="text" class="form-control form-control-sm" aria-label="Amount (to the nearest dollar)">
    <span class="input-group-text">.00</span>
</div>

<div class="input-group mb-3">
    <input type="text" class="form-control form-control-sm" placeholder="Username" aria-label="Username">
    <span class="input-group-text">@</span>
    <input type="text" class="form-control form-control-sm" placeholder="Server" aria-label="Server">
</div>

<div class="input-group">
    <span class="input-group-text">With textarea</span>
    <textarea class="form-control form-control-sm" aria-label="With textarea"></textarea>
</div>
<div class="input-group mb-3">
    <label class="input-group-text" for="inputGroupFile01">Upload</label>
    <input type="file" class="form-control form-control-sm" id="inputGroupFile01">
</div>

<div class="input-group mb-3">
    <input type="file" class="form-control form-control-sm" id="inputGroupFile02">
    <label class="input-group-text" for="inputGroupFile02">Upload</label>
</div>

<div class="input-group mb-3">
    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon03">Button</button>
    <input type="file" class="form-control form-control-sm" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
</div>

<div class="input-group">
    <input type="file" class="form-control form-control-sm" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Button</button>
</div>
<div class="form-floating mb-3">
    <input type="email" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
    <label for="floatingInput">Email address</label>
</div>
<div class="form-floating">
    <input type="password" class="form-control form-control-sm" id="floatingPassword" placeholder="Password">
    <label for="floatingPassword">Password</label>
</div>
<div class="form-floating">
    <textarea class="form-control form-control-sm" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
    <label for="floatingTextarea">Comments</label>
</div>
<div class="mb-3">
    <label for="formGroupExampleInput" class="form-label">Example label</label>
    <input type="text" class="form-control form-control-sm" id="formGroupExampleInput" placeholder="Example input placeholder">
</div>
<div class="mb-3">
    <label for="formGroupExampleInput2" class="form-label">Another label</label>
    <input type="text" class="form-control form-control-sm" id="formGroupExampleInput2" placeholder="Another input placeholder">
</div>
<div class="row">
    <div class="col">
        <input type="text" class="form-control form-control-sm" placeholder="First name" aria-label="First name">
    </div>
    <div class="col">
        <input type="text" class="form-control form-control-sm" placeholder="Last name" aria-label="Last name">
    </div>
</div>
<div class="row">
    <div class="col">
        <input type="text" class="form-control form-control-sm" placeholder="First name" aria-label="First name">
    </div>
    <div class="col">
        <input type="text" class="form-control form-control-sm" placeholder="Last name" aria-label="Last name">
    </div>
</div>

<div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control form-control-sm" id="inputEmail4">
</div>
<div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control form-control-sm" id="inputPassword4">
</div>
<div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control form-control-sm" id="inputAddress" placeholder="1234 Main St">
</div>
<div class="col-12">
    <label for="inputAddress2" class="form-label">Address 2</label>
    <input type="text" class="form-control form-control-sm" id="inputAddress2" placeholder="Apartment, studio, or floor">
</div>
<div class="col-md-6">
    <label for="inputCity" class="form-label">City</label>
    <input type="text" class="form-control form-control-sm" id="inputCity">
</div>
<div class="col-md-4">
    <label for="inputState" class="form-label">State</label>
    <select id="inputState" class="form-select">
        <option selected>Choose...</option>
        <option>...</option>
    </select>
</div>
<div class="col-md-2">
    <label for="inputZip" class="form-label">Zip</label>
    <input type="text" class="form-control form-control-sm" id="inputZip">
</div>
<div class="col-12">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck">
        <label class="form-check-label" for="gridCheck">
            Check me out
        </label>
    </div>
</div>
<div class="col-12">
    <button type="submit" class="btn btn-primary">Sign in</button>
</div>

<div class="col-md-4">
    <label for="validationServer01" class="form-label">First name</label>
    <input type="text" class="form-control is-valid" id="validationServer01" value="Mark" required>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
<div class="col-md-4">
    <label for="validationServer02" class="form-label">Last name</label>
    <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>
    <div class="valid-feedback">
        Looks good!
    </div>
</div>
<div class="col-md-4">
    <label for="validationServerUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend3">@</span>
        <input type="text" class="form-control is-invalid" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
        <div id="validationServerUsernameFeedback" class="invalid-feedback">
            Please choose a username.
        </div>
    </div>
</div>
<div class="col-md-6">
    <label for="validationServer03" class="form-label">City</label>
    <input type="text" class="form-control is-invalid" id="validationServer03" aria-describedby="validationServer03Feedback" required>
    <div id="validationServer03Feedback" class="invalid-feedback">
        Please provide a valid city.
    </div>
</div>
<div class="col-md-3">
    <label for="validationServer04" class="form-label">State</label>
    <select class="form-select is-invalid" id="validationServer04" aria-describedby="validationServer04Feedback" required>
        <option selected disabled value="">Choose...</option>
        <option>...</option>
    </select>
    <div id="validationServer04Feedback" class="invalid-feedback">
        Please select a valid state.
    </div>
</div>
<div class="col-md-3">
    <label for="validationServer05" class="form-label">Zip</label>
    <input type="text" class="form-control is-invalid" id="validationServer05" aria-describedby="validationServer05Feedback" required>
    <div id="validationServer05Feedback" class="invalid-feedback">
        Please provide a valid zip.
    </div>
</div>
<div class="col-12">
    <div class="form-check">
        <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" required>
        <label class="form-check-label" for="invalidCheck3">
            Agree to terms and conditions
        </label>
        <div id="invalidCheck3Feedback" class="invalid-feedback">
            You must agree before submitting.
        </div>
    </div>
</div>
<div class="col-12">
    <button class="btn btn-primary" type="submit">Submit form</button>
</div>

<?= form_close("&nbsp;"); ?>