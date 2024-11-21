<script type="text/babel">
    const AppList = ({ parametros = {} }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI || '';
        const debugMyPrint = parametros.DEBUG_MY_PRINT || '';
        const base_url = parametros.base_url || '';
        const api_empresa_exibir = parametros.api_empresa_exibir || '';
        const getVar_page = parametros.getVar_page || '';
        const api_empresa_filtrar = parametros.api_empresa_filtrar || '';

        // Paginação 
        const [paginacaoLista, setPaginacaoLista] = React.useState([]);

        // Estado para armazenar empresas da API
        const [empresas, setEmpresas] = React.useState([]);

        // Declare Todos os Campos do Formulário Aqui
        const [formData, setFormData] = React.useState({
            token_csrf: parametros.token_csrf || '',  // Passe o token_csrf aqui
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

        // Função para abrir o modal e preencher o formData com os dados da empresa selecionada
        const handleOpenModal = (empresa) => {
            setFormData({
                ...formData,
                id: empresa.id,
                codigo: empresa.codigo,
                nome: empresa.nome,
                responsavel: empresa.responsavel,
                email_contato: empresa.email_contato,
                inicio_vigencia_bom: empresa.inicio_vigencia_bom,
                active: empresa.active,
                data_criacao: empresa.data_criacao,
            });
        };

        const handleChange = (event) => {
            const { name, value } = event.target;
            console.log('name handleChange: ', name);
            console.log('value handleChange: ', value);

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        const [showAlert, setShowAlert] = React.useState(false);
        const [alertType, setAlertType] = React.useState('');
        const [alertMessage, setAlertMessage] = React.useState('');

        // Declarar parametros de mensagem
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        const submitAllForms = async (apiIdentifier) => {
            console.log('submitAllForms...');
            const data = formData;
            let getEmpresa = '';
            let dbResponse = [];
            let response1 = '';
            console.log('Dados a serem enviados:', data);

            if (apiIdentifier === 'filtra-empresa') {
                // Convertendo os dados do setPost em JSON
                response1 = await fetch(base_url + api_empresa_filtrar, {
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
                if (getEmpresa.result && getEmpresa.result.dbResponse && getEmpresa.result.dbResponse[0]) {
                    console.log('dbResponse: ', dbResponse);
                    dbResponse = getEmpresa.result.dbResponse;
                    setEmpresas(dbResponse);
                    setMessage({
                        show: true,
                        type: 'success',
                        message: 'Empresa filtrada com sucesso!'
                    });
                    return dbResponse;
                } else {
                    setMessage({
                        show: true,
                        type: 'danger',
                        message: 'Erro de conexão com o servidor.'
                    });
                    return null;
                }
            }
        };

        // Função fetch com try, catch, finally
        const fetchEmpresa = async (
            custonBaseURL = base_url,
            custonApiGetEmpresaExibir = api_empresa_exibir,
            customPage = getVar_page
        ) => {
            console.log('URL: ', custonBaseURL + custonApiGetEmpresaExibir + customPage);
            try {
                const response = await fetch(custonBaseURL + custonApiGetEmpresaExibir + customPage);
                // console.log('response: ', response);

                if (response.ok) {
                    const dataApi = await response.json();
                    // console.log('dataApi :: ', dataApi);

                    // Adaptando a resposta JSON para setar apenas o dbResponse
                    setEmpresas(dataApi.result.dbResponse);
                    setPaginacaoLista(dataApi.result.linksArray);
                } else {
                    console.error("Erro ao buscar dados: ", response.status);
                }
            } catch (error) {
                console.error("Erro na requisição: ", error);
            } finally {
                console.log("Requisição concluída.");
            }
        };

        // useEffect para acionar a função fetch ao carregar o componente
        React.useEffect(() => {
            const carregarDados = async () => {
                await fetchEmpresa();
                // Aqui pode-se chamar qualquer outra função auxiliar no futuro
            };
            carregarDados();
        }, []);

        return (
            <div>
                <table className="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">
                                <form className="was-validated mb-3" onSubmit={(e) => {
                                    e.preventDefault();
                                    submitAllForms('filtra-empresa', formData);
                                }}>
                                    <input
                                        data-api="filtra-empresa"
                                        type="text"
                                        className="form-control"
                                        id="nome"
                                        name="nome"
                                        placeholder="Um nome ou sobrenome"
                                        value={formData.nome || ''}
                                        onChange={handleChange}
                                    />
                                </form>
                                <hr />
                                Nome
                            </th>
                            <th scope="col">
                                <form className="was-validated mb-3" onSubmit={(e) => {
                                    e.preventDefault();
                                    submitAllForms('filtra-empresa', formData);
                                }}>
                                    <input
                                        data-api="filtra-empresa"
                                        type="text"
                                        className="form-control"
                                        id="responsavel"
                                        name="responsavel"
                                        placeholder="Um nome ou sobrenome"
                                        value={formData.responsavel || ''}
                                        onChange={handleChange}
                                    />
                                </form>
                                <hr />
                                Responsável
                            </th>
                            <th scope="col">
                                <form className="was-validated mb-3" onSubmit={(e) => {
                                    e.preventDefault();
                                    submitAllForms('filtra-empresa', formData);
                                }}>
                                    <input
                                        data-api="filtra-empresa"
                                        type="email"
                                        className="form-control"
                                        id="email_contato"
                                        name="email_contato"
                                        placeholder="mail@servidor.com"
                                        value={formData.email_contato || ''}
                                        onChange={handleChange}
                                    />
                                </form>
                                <hr />
                                Email Contato
                            </th>
                            <th scope="col">
                                <hr />
                                <div className="d-flex justify-content-center">
                                    Editar
                                </div>
                            </th>
                            <th scope="col">
                                <form className="was-validated mb-3" onSubmit={(e) => {
                                    e.preventDefault();
                                    submitAllForms('filtra-empresa', formData);
                                }}>
                                    <button className="btn btn-outline-secondary btn-sm" type="submit">Filtrar</button>
                                </form>
                                <hr />
                                <div className="d-flex justify-content-center">
                                    Excluir
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {empresas.length > 0 ? empresas.map((empresa, index) => (
                            <tr key={index}>
                                <td>{empresa.nome}</td>
                                <td>{empresa.responsavel}</td>
                                <td>{empresa.email_contato}</td>
                                <td>
                                    <div className="d-flex justify-content-center">
                                        {/* Botão que ativa o modal específico para cada empresa */}
                                        <button
                                            type="button"
                                            className="btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target={`#staticBackdrop-${index}`}
                                            onClick={() => handleOpenModal(empresa)}
                                        >
                                            <i className="bi bi-pencil-square"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    <div className="d-flex justify-content-center">
                                        <button type="button" className="btn btn-outline-danger btn-sm">
                                            <i className="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        )) : (
                            <tr>
                                <td colSpan="5">Carregando dados...</td>
                            </tr>
                        )}
                    </tbody>
                </table>
                {/* Modal */}
                {empresas.length > 0 ? empresas.map((empresa, index) => (
                    <div key={index}>
                        {/* Modal específico para cada empresa */}
                        <div
                            className="modal fade"
                            id={`staticBackdrop-${index}`}
                            data-bs-backdrop="static"
                            data-bs-keyboard="false"
                            tabIndex="-1"
                            aria-labelledby={`staticBackdropLabel-${index}`}
                            aria-hidden="true"
                        >
                            <div className="modal-dialog">
                                <div className="modal-content">
                                    <div className="modal-header">
                                        <h5 className="modal-title" id={`staticBackdropLabel-${index}`}>
                                            Atualizar {`(${empresa.nome})`}
                                        </h5>
                                        <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div className="modal-body">
                                        {/* Conteúdo personalizado para cada empresa */}
                                        <AppForm
                                            parametros={parametros}
                                            formData={formData}
                                            setFormData={setFormData}
                                        />
                                        Informações sobre {empresa.nome}
                                    </div>
                                    <div className="modal-footer">
                                        <button type="button" className="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                                            Fechar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                )) : null}
                {/* Paginação */}
                {paginacaoLista ? (
                    <nav aria-label="Page navigation example">
                        <ul className="pagination">
                            {paginacaoLista.map((paginacao_value, index) => (
                                <li key={index} className={`page-item ${paginacao_value.active ? 'active' : ''}`}>
                                    <button
                                        className="page-link"
                                        onClick={() => fetchEmpresa(base_url, api_empresa_exibir, paginacao_value.href)}
                                    >
                                        {paginacao_value.text.trim()}
                                    </button>
                                </li>
                            ))}
                        </ul>
                    </nav>
                ) : (
                    null
                )}
                <AppMessage parametros={message} />
            </div>
        );
    }
</script>