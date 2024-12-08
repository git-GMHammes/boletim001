<script type="text/babel">
    const AppEmpresaChecktMult = (
        {
            internalFormData = {},
            internalSetFormData = {},
            parametros = {}
        }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI || [];
        const base_url = parametros.base_url || '';
        const getVar_page = parametros.getVar_page || '1';
        const debugMyPrint = parametros.DEBUG_MY_PRINT || false;

        const [dbResponse, setDbResponse] = React.useState({});

        // Lista de APIs
        const api_empresa_exibir = parametros.api_empresa_exibir;
        const api_empresa_filtrar = parametros.api_empresa_filtrar;

        const [empresas, setEmpresas] = React.useState('');

        const [paginacaoLista, setPaginacaoLista] = React.useState('');

        // Estado para mensagens e validação
        // const [showAlert, setShowAlert] = React.useState(false);
        // const [alertType, setAlertType] = React.useState('');
        // const [alertMessage, setAlertMessage] = React.useState('');
        const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Função para simular o comportamento de "Ctrl" ao focar
        const handleFocus = (event) => {
            const { name, value } = event.target;

            console.log('name handleFocus: ', name);
            console.log('value handleFocus: ', value);

            internalSetFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        const handleChange = (event) => {
            const { name, value } = event.target;

            console.log('name handleChange: ', name);
            console.log('value handleChange: ', value);

            // Atualiza o estado com os valores selecionados
            internalSetFormData((prev) => {
                const updatedFormData = {
                    ...prev,
                    [name]: value
                };

                // Verifica se o campo alterado é 'busca_empresa'
                if (name === "busca_empresa") {
                    // Chama o fetchFilter com os dados atualizados
                    fetchFilter();
                }
            });

            // Atualiza o estado com os valores selecionados
            internalSetFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        // Função handleBlur - Perde o foco
        const handleBlur = (event) => {
            const { name, value } = event.target;

            console.log('name handleBlur: ', name);
            console.log('value handleBlur: ', value);

            internalSetFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        // React.useEffect
        React.useEffect(() => {
            console.log('React.useEffect - Carregar Dados Iniciais');

            // Função para carregar todos os dados necessários
            const loadData = async () => {
                console.log('loadData iniciando...');

                try {
                    // Chama as funções de fetch para carregar os dados
                    await fetchEmpresa();
                } catch (error) {
                    console.error('Erro ao carregar dados:', error);
                } finally {
                    console.log('React.useEffect - Fim.');
                }
            };

            loadData();
        }, []);

        // Função fetch com try, catch, finally
        const fetchFilter = async (
            custonBaseURL = base_url || '',
            custonApiGetEmpresa = api_empresa_filtrar || '',
            customPage = getVar_page || '?page=1'
        ) => {
            let setPost = internalFormData;

            // Validação básica dos parâmetros
            if (!custonBaseURL || !custonApiGetEmpresa) {
                console.error("Base URL ou endpoint da API não definidos!");
                return;
            }

            // Constrói a URL final
            const url = `${custonBaseURL}${custonApiGetEmpresa}${customPage}&limit=1000`;
            console.log('URL:', url);

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: JSON.stringify(setPost),
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });

                if (!response.ok) {
                    throw new Error(`Erro na requisição: ${response.status} - ${response.statusText}`);
                }

                // Adaptando a resposta JSON para setar apenas o dbResponse
                const dataApi = await response.json();
                console.log("dataApi :: ", dataApi);

                // Verifica e processa a resposta
                if (
                    dataApi.result
                    && dataApi.result.dbResponse
                    && dataApi.result.dbResponse.length > 0
                    && Array.isArray(dataApi.result.dbResponse)
                ) {
                    setEmpresas(dataApi.result.dbResponse);
                    setDbResponse(dataApi.result.dbResponse);
                } else {
                    console.error("Resposta inválida da dataApi:", dataApi);
                }

                if (
                    dataApi.result
                    && dataApi.result.linksArray
                    && dataApi.result.linksArray.length > 0
                    && Array.isArray(dataApi.result.linksArray)
                ) {
                    setDbResponse(dataApi.result.linksArray);
                    setPaginacaoLista(dataApi.result.linksArray || []);
                }

            } catch (error) {
                console.error("Erro na requisição: ", error);
            } finally {
                console.log("Requisição concluída.");
            }
        };

        // Função fetch com try, catch, finally
        const fetchEmpresa = async (
            custonBaseURL = base_url,
            custonApiGetEmpresa = api_empresa_exibir,
            customPage = getVar_page
        ) => {

            // Validação básica dos parâmetros
            if (!custonBaseURL || !custonApiGetEmpresa) {
                console.error("Base URL ou endpoint da API não definidos!");
                return;
            }

            // Constrói a URL final
            const url = `${custonBaseURL}${custonApiGetEmpresa}${customPage}`;
            console.log('URL:', url);

            try {
                // Realiza a requisição
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`Erro na requisição: ${response.status} - ${response.statusText}`);
                }

                // Faz o parse do JSON
                const dataApi = await response.json();
                // console.log('Resposta da dataApi:', dataApi);

                // Verifica e processa a resposta
                if (
                    dataApi.result
                    && dataApi.result.dbResponse
                    && dataApi.result.dbResponse.length > 0
                    && Array.isArray(dataApi.result.dbResponse)
                ) {
                    console.log('Empresa :', dataApi.result.dbResponse);
                    setEmpresas(dataApi.result.dbResponse);
                    setDbResponse(dataApi.result.dbResponse);
                } else {
                    console.error("Resposta inválida da dataApi:", dataApi);
                }

                if (
                    dataApi.result
                    && dataApi.result.linksArray
                    && dataApi.result.linksArray.length > 0
                    && Array.isArray(dataApi.result.linksArray)
                ) {
                    // setDbResponse(dataApi.result.linksArray);
                    setPaginacaoLista(dataApi.result.linksArray || []);
                }

            } catch (error) {
                console.error("Erro na requisição: ", error);
            } finally {
                console.log("Requisição concluída.");
            }
        };

        return (
            <div>
                {/* Canpo Check com multiplos seletores */}
                <div>
                    <div className="btn-group w-100">
                        <button
                            className="btn btn-secondary btn-sm dropdown"
                            type="button"
                            data-bs-toggle="dropdown"
                            data-bs-auto-close="false"
                            aria-expanded="false"
                        >
                            <div className="d-flex justify-content-between">
                                Empresa
                                <i className="bi bi-caret-down" />
                            </div>
                        </button>
                        <div className="dropdown-menu m-0 p-0 w-100">
                            <div className="d-flex justify-content-between">
                                <input
                                    type="text"
                                    className="form-control form-control-sm"
                                    id="busca_empresa"
                                    name="busca_empresa"
                                    value={internalFormData.busca_empresa || ''}
                                    onFocus={handleFocus}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    aria-label="Recipient's username"
                                    aria-describedby="basic-addon2"
                                />
                                <button
                                    className="btn btn-outline-Secondary btn-sm"
                                    type="submit"
                                >
                                    <i className="bi bi-search"></i>
                                </button>
                            </div>
                            <div>
                                {/* Lista de checkboxes */}
                                <div>
                                    <div className="mt-3 border overflow-auto" style={{ height: '200px' }} >
                                        {empresas.length > 0 ? (
                                            empresas.map((item) => (
                                                <div className="form-check" key={item.id}>
                                                    <input
                                                        className="form-check-input"
                                                        type="checkbox"
                                                        value={item.id}
                                                        id={`checkbox_${item.id}`}
                                                        defaultChecked={item.active === '1'}
                                                    />
                                                    <label
                                                        className="form-check-label"
                                                        htmlFor={`checkbox_${item.id}`}
                                                    >
                                                        {item.nome}
                                                    </label>
                                                </div>
                                            ))
                                        ) : (
                                            <p>Carregando empresas...</p>
                                        )}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <AppJson
                    parametros={parametros}
                    dbResponse={dbResponse}
                />
                {showEmptyMessage && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Nome inválido. Por favor, insira um nome contendo apenas letras.
                    </span>
                )}

                {/* Componente de mensagem para exibição de alertas */}
                <AppMessage parametros={message} modalId="modal_nome" />
            </div>
        );

    };
</script>