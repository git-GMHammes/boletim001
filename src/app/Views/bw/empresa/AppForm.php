<script type="text/babel">
    const AppForm = ({ parametros = {}, formData: externalFormData, setFormData: externalSetFormData }) => {
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const request_scheme = parametros.request_scheme;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const token_csrf = parametros.token_csrf;
        const origemForm = parametros.origemForm;
        const base_url = parametros.base_url;

        // Lista de APIs
        const api_post_cadastrar_atualizar = parametros.api_post_cadastrar_atualizar;
        // ↓↓↓ Exclui
        const api_empresa_cadastrar = parametros.api_empresa_cadastrar;
        const api_empresa_atualizar = parametros.api_empresa_atualizar;
        const api_empresa_excluir = parametros.api_empresa_excluir;
        // ↑↑↑ Exclui

        // Definindo o estado para controlar a aba ativa
        const [tabNav, setTabNav] = React.useState('form');
        const [showAlert, setShowAlert] = React.useState(false);
        const [alertType, setAlertType] = React.useState('');
        const [alertMessage, setAlertMessage] = React.useState('');

        // Declarar parametros de mensagem
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Inicialização condicional de formData
        const [internalFormData, internalSetFormData] = React.useState({
            token_csrf: token_csrf || '',
            json: "1",
            id: null,
            codigo: null,
            nome: null,
            responsavel: null,
            email_contato: null,
            inicio_vigencia_bom: null,
            active: null,
            data_criacao: null,
        });

        // Use o formData passado externamente, ou o estado interno como fallback
        const formData = externalFormData || internalFormData;
        const setFormData = externalSetFormData || internalSetFormData;

        // Função submitAllForms para envio dos dados
        const submitAllForms = async (apiIdentifier) => {
            console.log('submitAllForms...');
            const data = formData;

            console.log('Dados a serem enviados:', data);
            console.log(`filtro-${origemForm}`);
            console.log(`${base_url}${api_post_cadastrar_atualizar}`);

            try {
                const response = await fetch(`${base_url}${api_post_cadastrar_atualizar}`, {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error(`Erro na requisição: ${response.statusText}`);
                }

                const dataApi = await response.json();
                let resposta = '';

                if (getURI.includes('cadastrar')) {
                    resposta = 'Cadastro';
                } else if (getURI.includes('atualizar')) {
                    resposta = 'Atualização';
                } else {
                    resposta = 'Ação';
                }

                if (dataApi.status === 'success' && dataApi.result?.affectedRows > 0) {
                    console.log("dataApi.result:: ", dataApi.result.insertID)

                    if (dataApi.result && dataApi.result.insertID) {
                        setFormData((prevFormData) => ({
                            ...prevFormData,
                            id: dataApi.result.insertID
                        }));
                    }

                    if (dataApi.result && dataApi.result.updateID) {
                        setFormData((prevFormData) => ({
                            ...prevFormData,
                            id: dataApi.result.updateID
                        }));
                    }

                    setMessage({
                        show: true,
                        type: 'success',
                        message: `${resposta} realizada com sucesso`
                    });
                } else {
                    setMessage({
                        show: true,
                        type: 'danger',
                        message: `Não foi possível realizar o ${resposta}`,
                    });
                }
            } catch (error) {
                console.error('Erro no submitAllForms:', error);
                setMessage({
                    show: true,
                    type: 'danger',
                    message: 'Erro ao tentar enviar o formulário.',
                });
            }
        };

        const dbDelete = async (parameter) => {
            const response = await fetch(`${base_url}${api_empresa_excluir}/${parameter}`);

            if (!response.ok) {
                throw new Error(`Erro na requisição: ${response.statusText}`);
            }

            const dataApi = await response.json();
            console.log('const dataApi :: ', dataApi);
            if (
                dataApi.status &&
                dataApi.status === 'success' &&
                dataApi.result &&
                dataApi.result.affectedRows > 0
            ) {
                setFormData((prevFormData) => ({
                    ...prevFormData,
                    id: null,
                    codigo: null
                }));
                setMessage({
                    show: true,
                    type: 'success',
                    message: 'Exclusão realizada com sucesso'
                });
                // redirectTo('bw/empresa');
            } else {
                setMessage({
                    show: true,
                    type: 'danger',
                    message: 'Não foi possível realizar a exclusão',
                });
            }
        }

        // Função para trocar de aba
        const handleTabClick = (tab) => {
            setTabNav(tab); // Atualiza a aba selecionada
        };

        // Função handleFocus - Foco no objeto
        const handleFocus = (event) => {
            const { name, value } = event.target;

            console.log('name handleFocus: ', name);
            console.log('value handleFocus: ', value);

            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        };

        // Função handleChange - Mudança no valor
        const handleChange = (event) => {
            const { name, value } = event.target;

            console.log('name handleChange: ', name);
            console.log('value handleChange: ', value);

            if (name === "active") {
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

        // Função handleBlur - Ao sair do foco
        const handleBlur = (event) => {
            const { name, value } = event.target;

            console.log('name handleBlur: ', name);
            console.log('value handleBlur: ', value);

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        }

        const redirectTo = (url) => {
            const uri = base_url + url;
            setTimeout(() => {
                window.location.href = uri;
            }, 3000);
        };

        const requiredField = {
            color: '#FF0000',
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

        return (
            <div>
                <div>
                    <form className="was-validated" onSubmit={(e) => {
                        e.preventDefault();
                        submitAllForms(`filtro-${origemForm}`, formData);
                    }}>
                    </form>
                    <form className="was-validated" onSubmit={(e) => {
                        e.preventDefault();
                        submitAllForms(`filtro-${origemForm}`, formData);
                    }}>
                        <input
                            data-api="form-empresa"
                            type="hidden"
                            className="form-control"
                            id="token_csrf"
                            name="token_csrf"
                            value={token_csrf}
                        />
                        <input
                            data-api="form-empresa"
                            type="hidden"
                            className="form-control"
                            id="id"
                            name="id"
                            value={formData.id}
                        />
                        <input
                            data-api="form-empresa"
                            type="hidden"
                            className="form-control"
                            id="json"
                            name="json"
                            value={formData.json}
                        />
                    </form>
                    <div className="row">
                        <div className="col-12 col-sm-6">
                            <div className="row">
                                <div className="col-12 col-sm-3">
                                    {typeof AppID !== "undefined" ? (
                                        <div>
                                            <AppID
                                                formData={formData}
                                                setFormData={setFormData}
                                                parametros={parametros}
                                            />
                                        </div>
                                    ) : (
                                        <div>
                                            <p className="text-danger">AppID não alcançado.</p>
                                        </div>
                                    )}
                                </div>
                                <div className="col-12 col-sm-9">
                                    {typeof AppCodigo !== "undefined" ? (
                                        <div>
                                            <AppCodigo
                                                formData={formData}
                                                setFormData={setFormData}
                                                parametros={parametros}
                                                submitAllForms={submitAllForms}
                                            />
                                        </div>
                                    ) : (
                                        <div>
                                            <p className="text-danger">AppCodigo não lacançado.</p>
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>
                        <div className="col-12 col-sm-6">
                            <AppNome
                                formData={formData}
                                setFormData={setFormData}
                                parametros={parametros}
                                submitAllForms={submitAllForms}
                            />
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-12 col-sm-6">
                            <AppResponsavelEmpresa
                                formData={formData}
                                setFormData={setFormData}
                                parametros={parametros}
                                submitAllForms={submitAllForms}
                            />
                        </div>
                        <div className="col-12 col-sm-6">
                            <AppEmailContato
                                formData={formData}
                                setFormData={setFormData}
                                parametros={parametros}
                                submitAllForms={submitAllForms}
                            />
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-12 col-sm-6">
                            <AppInicioVigenciaBom
                                formData={formData}
                                setFormData={setFormData}
                                parametros={parametros}
                                submitAllForms={submitAllForms}
                            />
                        </div>
                        <div className="col-12 col-sm-6">
                            <AppAtivo
                                formData={formData}
                                setFormData={setFormData}
                                parametros={parametros}
                                submitAllForms={submitAllForms}
                            />
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-12 col-sm-6">
                            <AppDataCriacao
                                formData={formData}
                                setFormData={setFormData}
                                parametros={parametros}
                                submitAllForms={submitAllForms}
                            />
                        </div>
                        <div className="col-12 col-sm-3">
                            <label htmlFor="data_criacao" className="form-label"></label>
                            <div>
                                <button
                                    className="btn btn-outline-dark w-100 p-2"
                                    type="submit"
                                    disabled={formData.id === null ? true : false}
                                >
                                    Enviar
                                </button>
                            </div>
                        </div>
                        <div className="col-12 col-sm-3">
                            <label htmlFor="data_criacao" className="form-label"></label>
                            <div>
                                <button
                                    type="button"
                                    className="btn btn-outline-danger w-100 p-2"
                                    onClick={() => dbDelete(formData.id)}
                                    disabled={formData.id === null ? true : false}
                                >
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} />
            </div>
        );
    };

</script>