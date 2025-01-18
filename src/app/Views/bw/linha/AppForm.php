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
        const api_empresa_filtrar = parametros.api_empresa_filtrar;

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
            token_csrf: token_csrf,
            // ...
            id: null,
            active: null,
            empresa_id: null,
            linha_id: null,
            numeroLinha: null,
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
            // console.log('Dados a serem enviados:', data);
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

            if (apiIdentifier == `filtro-${origemForm}`) {
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
                            data-api={`filtro-${origemForm}`}
                            type="hidden"
                            className="form-control"
                            id="token_csrf"
                            name="token_csrf"
                            value={token_csrf}
                        />
                        <input
                            data-api={`filtro-${origemForm}`}
                            type="hidden"
                            className="form-control"
                            id="id"
                            name="id"
                            value={formData.id || ''}
                        />
                    </div>
                </form>
                <div className="row">
                    <div className="col-12 col-sm-6">
                        {typeof AppText !== "undefined" ? (
                            <div>
                                <form className="was-validated" onSubmit={(e) => {
                                    e.preventDefault();
                                    submitAllForms(`filtro-${origemForm}`);
                                }}>
                                    <AppText
                                        parametros={parametros}
                                        formData={formData}
                                        setFormData={setFormData}
                                        fieldAttributes={{
                                            attributeOrigemForm: `${origemForm}`,
                                            label: 'ID',
                                            name: 'id',
                                            errorMessage: '', // Mensagem de Erro personalizada
                                            attributePlaceholder: 'AAA123', // placeholder
                                            attributeMinlength: 2, // minlength
                                            attributeMaxlength: 10, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                            attributePattern: 'Inteiro', // Inteiro, Caracter, Senha
                                            attributeAutocomplete: '', // on, off
                                            attributeRequired: true,
                                            attributeReadOnly: false,
                                            attributeDisabled: true,
                                            attributeMask: '', // CPF, Telefone, CEP, Processo.
                                        }}
                                        submitAllForms={submitAllForms}
                                    />
                                </form>
                            </div>
                        ) : (
                            <div>
                                <p className="text-danger">AppText não lacançado.</p>
                            </div>
                        )}
                    </div>
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppSelect
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Status da Linha1',
                                    name: 'active',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributeRequired: false,
                                    attributeDisabled: false,
                                    attributeFieldKey: ['id', 'key'], // Chave do campo
                                    attributeFieldName: ['bank_column_api', 'value'], // Nome do campo
                                    objetoArrayKey: [
                                        { key: '1', value: 'Ativa' },
                                        { key: '2', value: 'Cancelada' },
                                        { key: '3', value: 'Paralisada' },
                                        { key: '4', value: 'Subjudice' }
                                    ],
                                    api_get: `api/get`,
                                    api_post: `api/post`,
                                    api_filter: `api/filter`,
                                }} 
                                submitAllForms={submitAllForms}
                                />
                        </form>
                    </div>
                </div>
                <div className="row">
                    <div className="col-12 col-sm-12">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppSelect
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Empresa',
                                    name: 'buscaEmp',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributeFieldKey: ['id', 'key'], // Chave do campo
                                    attributeFieldName: ['nome', 'value'], // Nome do campo
                                    attributeRequired: true,
                                    attributeDisabled: false,
                                    objetoArrayKey: [
                                        { key: '1', value: 'Opção 1' },
                                        { key: '2', value: 'Opção 2' },
                                        { key: '3', value: 'Opção 3' },
                                        { key: '4', value: 'Opção 4' }
                                    ],
                                    api_get: `${api_empresa_filtrar}`,
                                    api_post: `${api_empresa_filtrar}`,
                                    api_filter: `${api_empresa_filtrar}`,
                                }} />
                        </form>
                    </div>
                </div>
                <div className="row">
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Código da Linha',
                                    name: 'linha_id',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: 'AAA123', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 10, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Número da Linha',
                                    name: 'numeroLinha',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: 'AAA123', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 10, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                </div>
                <div className="row">
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Nome da Linha',
                                    name: 'id',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: 'Nome da Linha', // placeholder
                                    attributeMinlength: 3, // minlength
                                    attributeMaxlength: 50, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Ponto Inicial',
                                    name: 'pontoInicial',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 100, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }}
                            />
                        </form>
                    </div>
                </div>
                <div className="row">
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Ponto Final',
                                    name: 'pontoFinal',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 100, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }}
                            />
                        </form>
                    </div>
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Via',
                                    name: 'via',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 100, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                </div>
                <div className="row">
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Tipo da Ligação',
                                    name: 'tipoLigacao',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 100, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }}
                            />
                        </form>
                    </div>
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppSelectBtnCheck
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Tipos de Linha',
                                    name: 'tipoLinhas',
                                    attributeFieldKey: ['id', 'key'], // Chave do campo
                                    attributeFieldName: ['bank_column_api', 'value'], // Nome do campo
                                    attributeRequired: true,
                                    attributeDisabled: false,
                                    objetoArrayKey: [
                                        { key: 'Linha Rodoviária', value: 'Linha Rodoviária' },
                                        { key: 'Linha Rodoviária com Ar', value: 'Linha Rodoviária com Ar' },
                                        { key: 'Linha Urbana', value: 'Linha Urbana' },
                                        { key: 'Linha Urbana com Ar', value: 'Linha Urbana com Ar' },
                                        { key: 'Linha de Serviços Especiais', value: 'Linha de Serviços Especiais' },
                                        { key: 'Linha de Serviço Especial Leito', value: 'Linha de Serviço Especial Leito' }
                                    ],
                                    api_get: `api/get`,
                                    api_post: `api/post`,
                                    api_filter: `api/filter`,
                                }} />
                        </form>
                    </div>
                </div>
                <div className="row">
                    <div className="col-12 col-sm-4">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Piso I A-B (Km)',
                                    name: 'piso1AB',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 50, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                    <div className="col-12 col-sm-4">
                        {/* Piso I A-B (Km) */}
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Piso II A-B (Km)',
                                    name: 'piso2AB',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 50, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                    <div className="col-12 col-sm-4">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: ' Extensão A-B',
                                    name: 'extensaoAB',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 10, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: true,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                </div>
                <div className="row">
                    <div className="col-12 col-sm-4">
                        {/* Piso I B-A (Km) */}
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Piso I B-A (Km)',
                                    name: 'piso1BA',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 50, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                    <div className="col-12 col-sm-4">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Piso II B-A (Km)',
                                    name: 'piso2BA',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 50, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                    <div className="col-12 col-sm-4">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: ' Extensão B-A',
                                    name: 'extensaoAB',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 10, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: true,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                </div>
                <div className="row">
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    label: 'Hierarquização',
                                    name: 'hierarquizacao',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 10, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }}
                            />
                        </form>
                    </div>
                    <div className="col-12 col-sm-6">
                        <form className="was-validated" onSubmit={(e) => {
                            e.preventDefault();
                            submitAllForms(`filtro-${origemForm}`);
                        }}>
                            <AppText
                                parametros={parametros}
                                formData={formData}
                                setFormData={setFormData}
                                fieldAttributes={{
                                    attributeOrigemForm: `${origemForm}`,
                                    label: 'Data Vigência:',
                                    name: 'dataInicio',
                                    errorMessage: '', // Mensagem de Erro personalizada
                                    attributePlaceholder: '', // placeholder
                                    attributeMinlength: 2, // minlength
                                    attributeMaxlength: 10, // maxlength - Telefone: 14, CPF: 14, CEP: 9, Processo Judicial: 20
                                    attributePattern: '', // Inteiro, Caracter, Senha
                                    attributeAutocomplete: '', // on, off
                                    attributeRequired: true,
                                    attributeReadOnly: false,
                                    attributeDisabled: false,
                                    attributeMask: '', // CPF, Telefone, CEP, Processo.
                                }} />
                        </form>
                    </div>
                    <div className="row">
                        <div className="col-12 col-sm-6 m-1 p-0">
                            <button className="btn btn-outline-secondary btn-sm m-2" type="submit">Nova Seleção</button>
                            <button className="btn btn-outline-secondary btn-sm m-2" type="submit">Delete Seleção</button>
                        </div>
                        <div className="col-12 col-sm-6 m-0 p-0">
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-12 col-sm-6 m-1 p-0">
                            <div className="container d-flex justify-content-start m-0 pt-3">
                                <form className="was-validated" onSubmit={(e) => {
                                    e.preventDefault();
                                    submitAllForms(`filtro-${origemForm}`);
                                }}>
                                    <button className="btn btn-outline-secondary btn-sm" type="submit">Salvar</button>
                                </form>
                            </div>
                        </div>
                        <div className="col-12 col-sm-6">
                        </div>
                        {/* Exibe o componente de alerta */}
                        < AppMessage parametros={message} />
                    </div>
                </div>
            </div>
        );
    };
</script>