<script type="text/babel">
    const AppForm = ({ setParametros = {} }) => {
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = setParametros.getURI;
        const debugMyPrint = setParametros.DEBUG_MY_PRINT;
        const request_scheme = setParametros.request_scheme;
        const server_name = setParametros.server_name;
        const server_port = setParametros.server_port;
        const base_url = setParametros.base_url;
        const token_csrf = setParametros.token_csrf;

        // Lista de APIs
        const api_empresa_cadastrar = setParametros.api_empresa_cadastrar;
        const api_empresa_atualizar = setParametros.api_empresa_atualizar;

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

        // Função para trocar de aba
        const handleTabClick = (tab) => {
            setTabNav(tab); // Atualiza a aba selecionada
        };

        // Declare Todos os Campos do Formulário Aqui
        const [formData, setFormData] = React.useState({
            filterEmpresa: null,
            // ...
            token_csrf: token_csrf,
            id: null,
            empresa_id: null,
            linha_id: null,
            active: null,
            codigo: null,
            data_criacao: null,
            data_inicio: null,
            data_termino: null,
            duracaoViagemForaPicoAB: null,
            duracaoViagemForaPicoBA: null,
            duracaoViagemPicoAB: null,
            duracaoViagemPicoBA: null,
            hierarquizacao: null,
            idLinhaVigenciaAntiga: null,
            numeroLinha: null,
            observacao: null,
            picoFimManhaAB: null,
            picoFimManhaBA: null,
            picoFimTardeAB: null,
            picoFimTardeBA: null,
            picoInicioManhaAB: null,
            picoInicioManhaBA: null,
            picoInicioTardeAB: null,
            picoInicioTardeBA: null,
            piso1AB: null,
            piso1BA: null,
            piso2AB: null,
            piso2BA: null,
            ponto_final: null,
            ponto_inicial: null,
            status: null,
            tipoLigacao: null,
            via: null,
            created_at: null,
            updated_at: null,
            deleted_at: null
            // ...
            
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
                    setMessage({
                        show: true,
                        type: 'success',
                        message: 'Empresa cadastrada com sucesso!'
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

            if (apiIdentifier == 'filter-empresa') {
                console.log('filter-empresa - OK');
                // Envia uma requisição POST para a API com os dados coletados
                fetch(`${base_url}${api_post_filter_responsaveis}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('data:', data);
                        if (data.result.dbResponse && data.result.dbResponse.length > 0) {
                            console.log('form-empresa:', data.result.dbResponse);
                            setResponsaveis(data.result.dbResponse);
                        }
                    })
                    .catch((error) => {
                        console.log('form-empresa: ', error);
                        // setError('Erro ao Enviar Filtro: ' + error.message);
                    });
            }
        };

        const redirectTo = (url) => {
            const uri = base_url + url;
            setTimeout(() => {
                window.location.href = uri;
            }, 3000);
        };

        return (
            <div>
                <form className="was-validated" onSubmit={(e) => {
                    e.preventDefault();
                    submitAllForms('form-empresa', formData);
                }}>
                    <div>
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
                            value={formData.id || ''}
                        />
                        <div className="row">
                            <div className="col-12 col-sm-6">
                                <label htmlFor="active" className="form-label">Ativo</label>
                                <select data-api={`filtro-linhaVigencia`} id="active" name="active" value={formData.active || ''} onChange={handleChange} style={formControlStyle} className="form-select" aria-label="Default select 1" required>
                                    <option value="">Seleção Nula</option>
                                    <option value={`0`}>Inativo</option>
                                    <option value={`1`}>Ativo</option>
                                </select>
                            </div>
                            <div className="col-12 col-sm-6">

                                <label htmlFor="empresa_id" style={formLabelStyle} className="form-label">
                                    Responsável<strong style={requiredField}>*</strong>
                                    <button type="button" className="btn btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#empresaCadastrarModal">
                                        <i className="bi bi-plus-circle" />
                                    </button>
                                </label>

                                <div className="dropdown">
                                    <button className="btn w-100 text-start" type="button" id="empresaID" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                        {formData.empresa_Nome || 'Nome do empresa'}
                                    </button>
                                    <div className="dropdown-menu w-100 text-start" aria-labelledby="empresaID">

                                        <form className="row was-validated m-2" onSubmit={handleSubmit}>
                                            <div className="input-group m-0">
                                                <input data-api="filtrar-empresa" type="text" id="filterEmpresa" name="filterEmpresa" value={formData.filterEmpresa || ''} onChange={handleChange} style={formControlStyle} className="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" />
                                                <button className="btn" type="button" onClick={() => submitAllForms('filtrar-empresa')} id="button-addon2">
                                                    <i className="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </form>

                                        {/* Buscar Empresa */}
                                        <form className="row was-validated m-2" onSubmit={handleSubmit}>
                                            <select data-api="filtrar-empresa" id="empresaID" name="empresaID" value={formData.empresaID || ''} onChange={handleChange} className="form-select" style={formControlStyle} size="10" aria-label="Default select 0">
                                                <option value="">Seleção Nula</option>
                                                {/* Opções mapeadas */}
                                                {responsaveis.map((empresa_select, index) => (
                                                    <option key={`${empresa_select.id}-${index}`} value={empresa_select.id}>
                                                        {`Cod: ${empresa_select.id} - Nome: ${empresa_select.Nome}`}
                                                    </option>
                                                ))}
                                                {/* Adiciona o option caso o formData.empresa_id não esteja na lista */}
                                                {formData.empresa_id && !responsaveis.some(encontre => encontre.id === formData.empresa_id) && (
                                                    <option value={formData.empresa_id}>
                                                        {`Cod: ${formData.id} - Nome: ${formData.Nome || 'Nome não encontrado'}`}
                                                    </option>
                                                )}
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-12 col-sm-6">
                                <label htmlFor="empresa" className="form-label">Responsável</label>
                                <input
                                    data-api="form-empresa"
                                    type="text"
                                    className="form-control"
                                    id="empresa"
                                    name="empresa"
                                    value={formData.empresa || ''}
                                    onChange={handleChange}
                                    equired
                                />
                            </div>
                            <div className="col-12 col-sm-6">
                                <label htmlFor="email_contato" className="form-label">E-mail</label>
                                <input data-api="form-empresa" type="email" className="form-control" id="email_contato" name="email_contato" value={formData.email_contato || ''} onChange={handleChange} required />
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-12 col-sm-6">
                                <label htmlFor="inicio_vigencia_bom" className="form-label">Início Vigência BOM</label>
                                <input
                                    data-api="form-empresa"
                                    type="date"
                                    className="form-control"
                                    id="inicio_vigencia_bom"
                                    name="inicio_vigencia_bom"
                                    value={formData.inicio_vigencia_bom || ''}
                                    onChange={handleChange}
                                    required
                                />
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
                                <input
                                    data-api="form-empresa"
                                    type="datetime-local"
                                    className="form-control"
                                    id="data_criacao"
                                    name="data_criacao"
                                    value={formData.data_criacao || ''}
                                    onChange={handleChange}
                                    required
                                />
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
                {/* Exibe o componente de alerta */}
                <AppMessage setParametros={message} />
            </div>
        );
    };

</script>