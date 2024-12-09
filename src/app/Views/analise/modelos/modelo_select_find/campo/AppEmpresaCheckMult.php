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
        const [compoID, setCampoID] = React.useState('');
        const [campoLabel, setCampoLabel] = React.useState('');


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

        // Função para atualizar `internalFormData` com sincronia absoluta
        const syncInternalFormData = (field, value) => {
            internalSetFormData((prev) => {
                const updatedFormData = { ...prev, [field]: value };
                console.log("internalFormData sincronizado:", updatedFormData);
                return updatedFormData;
            });
        };

        // Função para simular o comportamento de "Ctrl" ao focar
        const handleFocus = (event) => {
            const { name } = event.target;

            console.log('name handleFocus: ', name);

            // Limpa o campo `busca_empresa` ao focar
            if (name === 'busca_empresa') {
                internalSetFormData((prev) => ({
                    ...prev,
                    [name]: '', // Limpa o valor do campo
                }));
            }

            fetchFilter();
        };


        const handleChange = (event) => {
            const { id, name, value, checked, dataset } = event.target;
            const label = dataset?.label || ''; // Apenas checkboxes terão o atributo data-label

            console.log('name handleChange: ', name);
            console.log('value handleChange: ', value);

            if (name === 'busca_empresa') {
                // Atualiza apenas o campo de texto
                internalSetFormData((prev) => ({
                    ...prev,
                    [name]: value,
                }));
            } else {
                console.log(`Checkbox ${name} (${id}) está ${checked ? 'marcado' : 'desmarcado'}`);

                if (checked) {
                    // Adiciona o ID e o Label aos arrays
                    setCampoID((prev) => [...prev, value]);
                    setCampoLabel((prev) => [...prev, label]);
                } else {
                    // Remove o ID e o Label correspondentes dos arrays
                    setCampoID((prev) => prev.filter((item) => item !== value));
                    setCampoLabel((prev) => prev.filter((item) => item !== label));
                }
            }

            // Atualiza o estado sincronizado
            syncInternalFormData(name, value);
        };

        // Função handleBlur - Perde o foco
        const handleBlur = (event) => {
            const { name } = event.target;

            console.log('name handleBlur: ', name);

            // Preenche o campo `busca_empresa` com os labels selecionados
            if (name === 'busca_empresa') {
                const empresasSelecionadas = campoLabel.join(', '); // Concatena os labels com ", "
                internalSetFormData((prev) => ({
                    ...prev,
                    [name]: empresasSelecionadas, // Define o texto das empresas selecionadas
                }));
                console.log('Empresas selecionadas:', empresasSelecionadas);
            }
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

        // Debounce para evitar chamadas excessivas à API
        const debounce = (func, delay) => {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => func(...args), delay);
            };
        };

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
            console.log('internalFormData ::', internalFormData);

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

                // Faz o parse da resposta JSON
                const dataApi = await response.json();
                console.log("dataApi :: ", dataApi);

                // Verifica e processa a resposta
                if (dataApi.result && dataApi.result.dbResponse && dataApi.result.dbResponse.length > 0) {
                    console.log("dataApi.result :: 0");
                    setEmpresas(dataApi.result.dbResponse);
                    setDbResponse(dataApi.result.dbResponse);
                } else {
                    console.log("dataApi.result :: Não tem dbResponse");
                }

                if (dataApi.result && dataApi.result.linksArray && dataApi.result.linksArray.length > 0) {
                    console.log("dataApi.result :: 0");
                    setPaginacaoLista(dataApi.result.linksArray);
                } else {
                    console.log("dataApi.result :: Não tem dbResponse");
                }
            } catch (error) {
                console.error("Erro na requisição: ", error);
            } finally {
                console.log("Requisição concluída.");
            }
        };

        // Observa mudanças no campo "busca_empresa" e dispara a busca com debounce
        React.useEffect(() => {
            if (internalFormData.busca_empresa && internalFormData.busca_empresa.trim().length > 0) {
                debounceFetchFilter();
            } else {
                fetchFilter();
            }
        }, [internalFormData.busca_empresa]);

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
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`Erro na requisição: ${response.status} - ${response.statusText}`);
                }

                const dataApi = await response.json();

                // Verifica e processa a resposta
                if (dataApi.result) {
                    if (Array.isArray(dataApi.result.dbResponse)) {
                        if (dataApi.result.dbResponse.length > 0) {
                            console.log('Dados da Empresa:', dataApi.result.dbResponse);
                            setEmpresas(dataApi.result.dbResponse);
                            setDbResponse(dataApi.result.dbResponse);
                        } else {
                            console.warn("Resposta válida, mas sem dados encontrados:", dataApi);
                            setEmpresas([]);
                            setDbResponse([]);
                        }
                    } else {
                        console.error("dbResponse não é um array válido:", dataApi.result.dbResponse);
                    }

                    if (Array.isArray(dataApi.result.linksArray)) {
                        setPaginacaoLista(dataApi.result.linksArray || []);
                    }
                } else {
                    console.error("Estrutura de resposta da API inválida:", dataApi);
                }
            } catch (error) {
                console.error("Erro na requisição: ", error);
            } finally {
                console.log("Requisição concluída.");
            }
        };

        // Debounced fetchFilter
        const debounceFetchFilter = debounce(fetchFilter, 500);

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
                                                        name={`checkbox_${item.id}`}
                                                        data-label={item.nome}
                                                        onFocus={handleFocus}
                                                        onChange={handleChange}
                                                        onBlur={handleBlur}
                                                        defaultChecked={false}
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