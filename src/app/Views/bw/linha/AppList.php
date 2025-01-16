<script type="text/babel">
    const AppList = ({ parametros = {} }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI || [];
        const debugMyPrint = parametros.DEBUG_MY_PRINT || false;
        const base_url = parametros.base_url || '';
        const api_linha_exibir = parametros.api_linha_exibir || '';
        const api_linha_filtrar = parametros.api_linha_filtrar || '';

        // Estado para armazenar linhas da API
        const [linhas, setLinhas] = React.useState([]);

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
            let getLinha = '';
            let dbResponse = [];
            let response1 = '';
            console.log('Dados a serem enviados:', data);

            if (apiIdentifier === 'filtra-linha') {
                // Convertendo os dados do setPost em JSON
                response1 = await fetch(base_url + api_linha_filtrar, {
                    method: 'POST',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });

                if (!response1.ok) {
                    throw new Error(`Erro na requisição: ${response1.statusText}`);
                }

                getLinha = await response1.json();

                // Processa os dados recebidos da resposta
                if (getLinha.result && getLinha.result.dbResponse && getLinha.result.dbResponse[0]) {
                    console.log('dbResponse: ', dbResponse);
                    dbResponse = getLinha.result.dbResponse;
                    setLinhas(dbResponse);
                    setMessage({
                        show: true,
                        type: 'success',
                        message: 'Linha filtrada com sucesso!'
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
        const fetchLinha = async () => {
            console.log('URL: ', base_url + api_linha_exibir);
            try {
                const response = await fetch(base_url + api_linha_exibir);
                console.log('response: ', response);
                if (response.ok) {
                    const data = await response.json();
                    // Adaptando a resposta JSON para setar apenas o dbResponse
                    setLinhas(data.result.dbResponse);
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
                await fetchLinha();
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
                                    submitAllForms('filtra-linha', formData);
                                }}>
                                    <input
                                        data-api="filtra-linha"
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
                                    submitAllForms('filtra-linha', formData);
                                }}>
                                    <input
                                        data-api="filtra-linha"
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
                                    submitAllForms('filtra-linha', formData);
                                }}>
                                    <input
                                        data-api="filtra-linha"
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
                                Editar
                            </th>
                            <th scope="col">
                                <form className="was-validated mb-3" onSubmit={(e) => {
                                    e.preventDefault();
                                    submitAllForms('filtra-linha', formData);
                                }}>
                                    <button className="btn btn-outline-secondary btn-sm" type="submit">Enviar</button>
                                </form>
                                <hr />
                                Excluir
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {linhas.length > 0 ? linhas.map((linha, index) => (
                            <tr key={index}>
                                <td>{linha.nome}</td>
                                <td>{linha.responsavel}</td>
                                <td>{linha.email_contato}</td>
                                <td>
                                    <button type="button" className="btn btn-outline-primary btn-sm">
                                        <i className="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" className="btn btn-outline-danger btn-sm">
                                        <i className="bi bi-trash3"></i>
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