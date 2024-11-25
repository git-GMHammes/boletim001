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
        const origemForm = parametros.origemForm;

        // Lista de APIs
        const api_empresa_cadastrar = parametros.api_empresa_cadastrar;
        const api_empresa_atualizar = parametros.api_empresa_atualizar;

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
            ponto_inicial: null,
            ponto_final: null,
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

            if (apiIdentifier === `filtro-${origemForm}`) {
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

        const formGroupStyle = {
            position: 'relative',
            marginTop: '20px',
            padding: '5px',
            borderRadius: '8px',
            border: '1px solid #000',
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

        const requiredField = {
            color: '#FF0000',
        };

        return (
            <div>
                <form className="was-validated" onSubmit={(e) => {
                    e.preventDefault();
                    submitAllForms(`filtro-${origemForm}`, formData);
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
                    </div>
                </form>

                <form className="was-validated" onSubmit={(e) => {
                    e.preventDefault();
                    submitAllForms(`filtro-${origemForm}`, formData);
                }}>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div style={formGroupStyle}>
                                <label
                                    htmlFor="active"
                                    style={formLabelStyle}
                                    className="form-label">Ativo<strong style={requiredField}>*</strong></label>
                                <select data-api={`filtro-${origemForm}`} id="active" name="active" value={formData.active || ''} onChange={handleChange} style={formControlStyle} className="form-select" aria-label="Default select 1" required>
                                    <option value="">Seleção Nula</option>
                                    <option value={`0`}>Ativa</option>
                                    <option value={`1`}>Cancelada</option>
                                    <option value={`2`}>Paralisada</option>
                                    <option value={`3`}>Subjudice</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div style={formGroupStyle}>
                                <label
                                    htmlFor="empresa_id"
                                    style={formLabelStyle}
                                    className="form-label">Empresa<strong style={requiredField}>*</strong></label>
                                <input
                                    data-api={`filtro-${origemForm}`}
                                    type="text"
                                    id="empresa_id"
                                    name="empresa_id"
                                    value={formData.empresa_id || ''}
                                    onChange={handleChange}
                                    style={formControlStyle}
                                    className="form-control" required
                                />
                            </div>
                        </div>
                    </div>
                </form>

                <form className="was-validated" onSubmit={(e) => {
                    e.preventDefault();
                    submitAllForms(`filtro-${origemForm}`, formData);
                }}>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div style={formGroupStyle}>
                                <label
                                    htmlFor="codigo"
                                    style={formLabelStyle}
                                    className="form-label">Código<strong style={requiredField}>*</strong></label>
                                <input
                                    data-api={`filtro-${origemForm}`}
                                    type="text"
                                    id="codigo"
                                    name="codigo"
                                    value={formData.codigo || ''}
                                    onChange={handleChange}
                                    style={formControlStyle}
                                    className="form-control" required
                                />
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div style={formGroupStyle}>
                                <label
                                    htmlFor="numeroLinha"
                                    style={formLabelStyle}
                                    className="form-label">Número da Linha<strong style={requiredField}>*</strong>
                                </label>
                                <input
                                    data-api={`filtro-${origemForm}`}
                                    type="text"
                                    id="numeroLinha"
                                    name="numeroLinha"
                                    value={formData.numeroLinha || ''}
                                    onChange={handleChange}
                                    style={formControlStyle}
                                    className="form-control" required
                                />
                            </div>
                        </div>
                    </div>
                </form>

                <form className="was-validated" onSubmit={(e) => {
                    e.preventDefault();
                    submitAllForms(`filtro-${origemForm}`, formData);
                }}>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div style={formGroupStyle}>
                                <label
                                    htmlFor="linha_id"
                                    style={formLabelStyle}
                                    className="form-label">Nome da Linha<strong style={requiredField}>*</strong>
                                </label>
                                <input
                                    data-api={`filtro-${origemForm}`}
                                    type="text"
                                    id="linha_id"
                                    name="linha_id"
                                    value={formData.linha_id || ''}
                                    onChange={handleChange}
                                    style={formControlStyle}
                                    className="form-control" required
                                />
                            </div>
                        </div>
                    </div>
                </form>

                <form className="was-validated" onSubmit={(e) => {
                    e.preventDefault();
                    submitAllForms(`filtro-${origemForm}`, formData);
                }}>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div style={formGroupStyle}>
                                <label
                                    htmlFor="ponto_inicial"
                                    style={formLabelStyle}
                                    className="form-label">Ponto Inicial<strong style={requiredField}>*</strong>
                                </label>
                                <input
                                    data-api={`filtro-${origemForm}`}
                                    type="text"
                                    id="ponto_inicial"
                                    name="ponto_inicial"
                                    value={formData.ponto_inicial || ''}
                                    onChange={handleChange}
                                    style={formControlStyle}
                                    className="form-control" required
                                />
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div style={formGroupStyle}>
                                <label
                                    htmlFor="ponto_final"
                                    style={formLabelStyle}
                                    className="form-label">Ponto Final<strong style={requiredField}>*</strong>
                                </label>
                                <input
                                    data-api={`filtro-${origemForm}`}
                                    type="text"
                                    id="ponto_final"
                                    name="ponto_final"
                                    value={formData.ponto_final || ''}
                                    onChange={handleChange}
                                    style={formControlStyle}
                                    className="form-control" required
                                />
                            </div>
                        </div>
                    </div>
                </form>

                <form className="was-validated" onSubmit={(e) => {
                    e.preventDefault();
                    submitAllForms(`filtro-${origemForm}`, formData);
                }}>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div style={formGroupStyle}>
                                <label
                                    htmlFor="via"
                                    style={formLabelStyle}
                                    className="form-label">Via<strong style={requiredField}>*</strong>
                                </label>
                                <input
                                    data-api={`filtro-${origemForm}`}
                                    type="text"
                                    id="via"
                                    name="via"
                                    value={formData.via || ''}
                                    onChange={handleChange}
                                    style={formControlStyle}
                                    className="form-control" required
                                />
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div style={formGroupStyle}>
                                <label
                                    htmlFor="tipoLigacao"
                                    style={formLabelStyle}
                                    className="form-label">Tipo de Ligação<strong style={requiredField}>*</strong>
                                </label>
                                <input
                                    data-api={`filtro-${origemForm}`}
                                    type="text"
                                    id="tipoLigacao"
                                    name="tipoLigacao"
                                    value={formData.tipoLigacao || ''}
                                    onChange={handleChange}
                                    style={formControlStyle}
                                    className="form-control" required
                                />
                            </div>
                        </div>
                    </div>
                </form>

                <form className="was-validated" onSubmit={(e) => {
                    e.preventDefault();
                    submitAllForms(`filtro-${origemForm}`, formData);
                }}>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div style={formGroupStyle}>
                                <label
                                    htmlFor="tipoLigacao"
                                    style={formLabelStyle}
                                    className="form-label">Tipo de Linhas<strong style={requiredField}>*</strong>
                                </label>
                                <div className="card mb-4">
                                    <div className="card-body">
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">

                        </div>
                    </div>
                </form>

                <form className="was-validated" onSubmit={(e) => {
                    e.preventDefault();
                    submitAllForms(`filtro-${origemForm}`, formData);
                }}>
                    <div class="row">
                        <div class="col-12 col-sm-6">

                        </div>
                        <div class="col-12 col-sm-6">

                        </div>
                    </div>
                </form>

                {/* Exibe o componente de alerta */}
                < AppMessage parametros={message} />
            </div >
        );
    };

</script>