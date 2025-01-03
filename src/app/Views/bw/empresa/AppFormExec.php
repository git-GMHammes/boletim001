<script type="text/babel">
    const AppForm = ({ parametros = {} }) => {
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
        const token_csrf = parametros.token_csrf;

        // Lista de APIs
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
            token_csrf: token_csrf,
            id: null,
            codigo: null,
            nome: null,
            responsavel: null,
            email_contato: null,
            inicio_vigencia_bom: null,
            ativo: null,
            data_criacao: null,
        });

        const handleChange = (event) => {
            const { name, value } = event.target;
            console.log('name handleChange: ', name);
            console.log('value handleChange: ', value);

            if (name === "ativo") {
                setFormData((prev) => ({
                    ...prev,
                    [name]: parseInt(value)
                }));
            } else {
                setFormData((prev) => ({
                    ...prev,
                    [name]: value
                }));
            }
        };

        const submitAllForms = async (apiIdentifier) => {
            console.log('submitAllForms...');
            const data = formData;
            let getEmpresa = '';
            let dbResponse = [];
            let response1 = '';
            console.log('Dados a serem enviados:', data);

            if (apiIdentifier === 'form-empresa') {
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

                getEmpresa = await response1.json();

                // Processa os dados recebidos da resposta
                if (getEmpresa.result.affectedRows && getEmpresa.result.affectedRows > 0) {
                    dbResponse = getEmpresa.result.dbCreate;
                    console.log('dbResponse: ', dbResponse);
                    showOffcanvasAlert('success', 'Cadastro atualizado com sucesso!');
                    // redirectTo('index.php/bw/empresa/endpoint/cadastrar');
                    return dbResponse;
                } else {
                    showOffcanvasAlert('danger', 'Não foi possível cadastrar!');
                    return null;
                }
            }
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
            <div>
                <form className="was-validated" onSubmit={(e) => {
                    e.preventDefault();
                    submitAllForms('form-empresa', formData);
                }}>
                    <div>
                        <input data-api="form-empresa" type="hidden" className="form-control" id="token_csrf" name="token_csrf" value={token_csrf} />
                        <input data-api="form-empresa" type="hidden" className="form-control" id="id" name="id" value={formData.id || ''} />
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
                                    <div class="d-flex justify-content-start">
                                        <div className="form-check">
                                            <input
                                                data-api="form-empresa"
                                                className="form-check-input"
                                                type="radio"
                                                id="ativoSim"
                                                name="ativo"
                                                value="1"
                                                checked={formData.ativo === 1}
                                                onChange={handleChange}
                                            />
                                            <label className="form-check-label" htmlFor="ativoSim">Sim</label>
                                        </div>&emsp;/&emsp;
                                        <div className="form-check">
                                            <input
                                                data-api="form-empresa"
                                                className="form-check-input"
                                                type="radio"
                                                id="ativoNao"
                                                name="ativo"
                                                value="0"
                                                checked={formData.ativo === 0}
                                                onChange={handleChange}
                                            />
                                            <label className="form-check-label" htmlFor="ativoNao">Não</label>
                                        </div>
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
                                    <button className="btn btn-outline-dark mb-5 w-100" type="submit">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                {showAlert && (
                    <div
                        className={`bg-${alertType} text-white p-3`}
                        style={offcanvasStyles}
                    >
                        {alertMessage}
                    </div>
                )}
            </div>
        );
    };

</script>