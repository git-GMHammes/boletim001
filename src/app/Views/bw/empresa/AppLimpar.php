<script type="text/babel">
    const AppLimpar = ({ parametros = {} }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
        const api_empresa_exibir = parametros.api_empresa_exibir;
        const api_empresa_filtrar = parametros.api_empresa_filtrar;

        // Estado para armazenar empresas da API
        const [empresas, setEmpresas] = React.useState([]);

        // Declare Todos os Campos do Formulário Aqui
        const [formData, setFormData] = React.useState({
            nome: null,
            responsavel: null,
            email_contato: null,
        });

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
        const fetchEmpresa = async () => {
            console.log('URL: ', base_url + api_empresa_exibir);
            try {
                const response = await fetch(base_url + api_empresa_exibir);
                console.log('response: ', response);
                if (response.ok) {
                    const data = await response.json();
                    // Adaptando a resposta JSON para setar apenas o dbResponse
                    setEmpresas(data.result.dbResponse);
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
                                Restaurar
                            </th>
                            <th scope="col">
                                <form className="was-validated mb-3" onSubmit={(e) => {
                                    e.preventDefault();
                                    submitAllForms('filtra-empresa', formData);
                                }}>
                                    <button className="btn btn-outline-secondary btn-sm" type="submit">Enviar</button>
                                </form>
                                <hr />
                                Eliminar
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
                                    <button type="button" className="btn btn-outline-success btn-sm">
                                        <i class="bi bi-database-fill-check"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" className="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-database-fill-x"></i>
                                    </button>
                                </td>
                            </tr>
                        )) : (
                            <tr>
                                <td colSpan="5">Carregando dados...</td>
                            </tr>
                        )}
                    </tbody>
                </table>
                <AppMessage parametros={message} />
            </div>
        );
    }
</script>