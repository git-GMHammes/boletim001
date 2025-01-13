<script type="text/babel">
    const AppDate = ({
        parametros = {},
        formData = {},
        setFormData = () => { },
        fieldAttributes = {}
    }) => {
        // Script que aceita parâmetros, formulário de dados, função de configuração de dados e atributos de campo
        // console.log('AppDate:', parametros, formData, setFormData, fieldAttributes);

        const getURI = parametros.getURI || [];
        const attributeOrigemForm = fieldAttributes.origemForm || '';
        const label = fieldAttributes.label || 'AppTextLabel';
        const name = fieldAttributes.name || 'AppTextName';
        const attributeMin = fieldAttributes.attributeMin || '';
        const attributeMax = fieldAttributes.attributeMax || '';
        const attributeRequired = fieldAttributes.attributeRequired || false;
        const attributeReadOnly = fieldAttributes.attributeReadOnly || false;
        const attributeDisabled = fieldAttributes.attributeDisabled || false;
        const attributeMask = fieldAttributes.attributeMask || false;

        // Estado para mensagens e validação
        const [avisoCampo, setAvisoCampo] = React.useState('');
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        const [msgError, setMsgError] = React.useState(false);
        const [error, setError] = React.useState('');
        const [valid, setValid] = React.useState(true);
        const cleanInput = (value) => value.replace(/\D/g, '');
        const [dateLimits, setDateLimits] = React.useState({ min: '', max: '' });

        const maxDate = (() => {
            switch (attributeMax) {
                //Profisional
                case 'Profissional':
                    // Para "Profissional", limite até hoje
                    return new Date().toISOString().split('T')[0];
                    break;

                case 'Periodo':
                    //Valida se o campo 
                    // Função para realizar todas as validações sequenciais
                    const validarDatas = (setData) => {
                        setData.periodo_data_inicio = setData.periodo_data_inicio + 'T00:00:00';
                        setData.periodo_data_termino = setData.periodo_data_termino + 'T23:59:59';
                        let mensagensErro = [];
                        const {
                            periodo_numero,
                            periodo_data_inicio,
                            periodo_data_termino,
                            ano,
                        } = setData;
                        // console.log("setData :: ", setData)

                        const dataInicio = new Date(periodo_data_inicio);
                        const dataTermino = new Date(periodo_data_termino);
                        const anoSelecionado = parseInt(ano, 10);

                        // Verificação do semestre
                        if (parseInt(periodo_numero, 10) === 1) {
                            const inicioSemestre1 = new Date(`${ano}-01-01T00:00:00`);
                            const fimSemestre1 = new Date(`${ano}-06-30T23:59:59`);
                            if (dataInicio < inicioSemestre1 || dataInicio > fimSemestre1 || dataTermino < inicioSemestre1 || dataTermino > fimSemestre1) {
                                mensagensErro.push("As datas Inicio e Fim devem estar no primeiro semestre selecionado (01/01/AAAA - 30/06/AAAA).");
                            }
                        } else if (parseInt(periodo_numero, 10) === 2) {
                            const inicioSemestre2 = new Date(`${ano}-07-01T00:00:00`);
                            const fimSemestre2 = new Date(`${ano}-12-31T23:59:59`);
                            if (dataInicio < inicioSemestre2 || dataInicio > fimSemestre2 || dataTermino < inicioSemestre2 || dataTermino > fimSemestre2) {
                                mensagensErro.push("As datas Inicio e Fim devem estar no segundo semestre selecionado (01/07/AAAA - 31/12/AAAA).");
                            }
                        }

                        // Verificação se a data de início é maior que a data de término
                        if (dataInicio > dataTermino) {
                            mensagensErro.push("A Data Inicio do Período não deve ser maior do que a Data Termino do Período.");
                        }

                        // Verificação do ano das datas
                        if (
                            dataInicio.getFullYear() !== anoSelecionado ||
                            dataTermino.getFullYear() !== anoSelecionado
                        ) {
                            mensagensErro.push("A Data Inicio do Período e a Data Termino do Período devem estar dentro do mesmo ano informado no campo Ano.");
                        }

                        return mensagensErro;
                    };

                    break;

                default:
                    break;
            }
        })();

        // Função handleFocus para receber foco
        const handleFocus = (event) => {
            const { name, value } = event.target;
            console.log('handleFocus: ', name, value);
            setMessage({ show: false, type: null, message: null });
            setFormData((prev) => ({ ...prev, [name]: value }));
        };

        // handleChange
        const handleChange = (event) => {
            const { name, value } = event.target;

            if (!value) {
                setFormData((prev) => ({ ...prev, [name]: '' }));
                setMsgError(false);
                return;
            };

            setFormData((prev) => ({
                ...prev,
                [name]: value,
            }));
        };

        const handleBlur = async (event) => {
            const { name, value } = event.target;
            console.log('handleBlurAppDate: ', name, value);

            switch (attributeMask) {

                //Período
                case 'Periodo':

                    //Tirado de AppPeriodoDataInicio
                    if (name === 'periodo_data_inicio' && value === '') {
                        return true;
                    }

                    if (name === 'periodo_data_inicio') {

                        setFormData((prev) => ({
                            ...prev,
                            periodo_data_inicio: value
                        }));

                        if (parseInt(formData.periodo_numero, 10) === 1) {
                            console.log('Primeiro semestre: 01/01/AAAA - 30/06/AAAA');
                            if (parseInt(formData.periodo_numero, 10) === 1) {
                                const inicioSemestre1 = new Date(`${formData.periodo_ano}-01-01T00:00:00`);
                                const fimSemestre1 = new Date(`${formData.periodo_ano}-06-30T23:59:59`);
                                const dataInicio = new Date(value + "T00:00:00");

                                console.log('inicioSemestre1 :: ', inicioSemestre1);
                                console.log('fimSemestre1 :: ', fimSemestre1);
                                console.log('dataInicio :: ', dataInicio);

                                if (dataInicio < inicioSemestre1 || dataInicio > fimSemestre1) {
                                    setMessage({
                                        show: true,
                                        type: 'light',
                                        message: 'O campo inicio do período deve estar dentro do 1º semestre.',
                                    });

                                    setFormData((prev) => {
                                        console.log('MENSSAGEM APAGADAAAAAA INICIO TEM QUE ESTAR NO 1 SEMESTRE');
                                        return {
                                            ...prev,
                                            periodo_data_inicio: '',
                                        };
                                    });

                                }
                            }

                        } else if (parseInt(formData.periodo_numero, 10) === 2) {
                            console.log('Segundo semestre: 01/07/AAAA - 31/12/AAAA');
                            const inicioSemestre2 = new Date(`${formData.periodo_ano}-07-01T00:00:00`);
                            const fimSemestre2 = new Date(`${formData.periodo_ano}-12-31T23:59:59`);
                            const dataInicio = new Date(value + "T00:00:00");

                            if (dataInicio < inicioSemestre2 || dataInicio > fimSemestre2) {
                                setMessage({
                                    show: true,
                                    type: 'light',
                                    message: 'O campo inicio do período deve estar dentro do 2º semestre. Verifique se o Campo Ano informado esta correto',
                                });

                                setFormData((prev) => ({
                                    ...prev,
                                    periodo_data_inicio: '',
                                }));
                            }

                        } else {
                            // Caso todas as validações passem, limpa mensagens de erro
                            setMessage({ show: false, type: null, message: null });
                            setFormData((prev) => ({
                                ...prev,
                                periodo_data_inicio: value,
                            }));
                        }

                        console.log('formData.periodo_data_inicio !== "") &&); :: ', formData.periodo_data_inicio !== "")
                        console.log('formData.periodo_data_termino !== "") &&); :: ', formData.periodo_data_termino !== "")
                        console.log('formData.periodo_data_inicio > formData.periodo_data_termino :: ', formData.periodo_data_inicio > formData.periodo_data_termino);

                        if (
                            // (formData.periodo_data_inicio !== "") &&
                            // (formData.periodo_data_termino !== "") &&
                            (formData.periodo_data_inicio > formData.periodo_data_termino)
                        ) {
                            // Verifica se periodo_data_termino é menor que periodo_data_termino
                            setMessage({
                                show: true,
                                type: 'light',
                                message: 'O Campo Termino do Período não deve ser menor do que o Campo Início do período.'
                            });

                            setFormData((prev) => {
                                console.log('MENSSAGEM APAGADAAAAAA TERMINO DO PERIODO É MENOR QUE INICIO');
                                return {
                                    ...prev,
                                    periodo_data_inicio: '',
                                    periodo_data_termino: ''
                                };
                            });
                        }

                    }

                    //Tirado de AppPeriodoDataFim
                    if (name === 'periodo_data_termino' && value === '') {
                        return true;
                    }

                    if (name === 'periodo_data_termino') {

                        const dataTermino = new Date(formData.periodo_data_termino);
                        if (parseInt(formData.periodo_numero, 10) === 1) {
                            console.log('Primeiro semestre: 01/01/AAAA - 30/06/AAAA');
                            const inicioSemestre1 = new Date(`${formData.periodo_ano}-01-01T00:00:00`);
                            const fimSemestre1 = new Date(`${formData.periodo_ano}-06-30T23:59:59`);
                            console.log('inicioSemestre1', inicioSemestre1);
                            console.log('fimSemestre1', fimSemestre1);
                            const dataTermino = new Date(value + "T00:00:00");

                            if (dataTermino < inicioSemestre1 || dataTermino > fimSemestre1) {
                                setMessage({
                                    show: true,
                                    type: 'light',
                                    message: 'O campo termino do periodo deve estar dentro do 1º semestre. Verifique se o Campo Ano informado esta correto',
                                });
                            }

                        } else if (parseInt(formData.periodo_numero, 10) === 2) {
                            console.log('Segundo semestre: 01/07/AAAA - 31/12/AAAA');
                            const inicioSemestre2 = new Date(`${formData.periodo_ano}-07-01T00:00:00`);
                            const fimSemestre2 = new Date(`${formData.periodo_ano}-12-31T23:59:59`);
                            const dataTermino = new Date(value + "T00:00:00");

                            if (dataTermino < inicioSemestre2 || dataTermino > fimSemestre2) {
                                setMessage({
                                    show: true,
                                    type: 'light',
                                    message: 'O campo termino do periodo deve estar dentro do 2º semestre. Verifique se o Campo Ano informado esta correto',
                                });
                            } else if (dataTermino.getFullYear() !== parseInt(formData.periodo_ano, 10)) {
                                // Verifica se o ano de periodo_data_termino é igual ao ano de formData.periodo_ano
                                setMessage({
                                    show: true,
                                    type: 'light',
                                    message: 'O ano informado no campo Termino do Período deve ser igual ao ano informado no campo Ano.',
                                });
                            } else {
                                setMessage({
                                    show: false,
                                    type: null,
                                    message: null
                                });
                            }
                        }

                        if (
                            // (formData.periodo_data_inicio !== "") &&
                            // (formData.periodo_data_termino !== "") &&
                            (formData.periodo_data_inicio > formData.periodo_data_termino)
                        ) {
                            // Verifica se periodo_data_termino é menor que periodo_data_termino
                            setMessage({
                                show: true,
                                type: 'light',
                                message: 'O Campo Termino do Período não deve ser menor do que o Campo Início do período.'
                            });

                            setFormData((prev) => {
                                console.log('MENSSAGEM APAGADAAAAAA TERMINO DO PERIODO É MENOR QUE INICIO');
                                return {
                                    ...prev,
                                    periodo_data_inicio: '',
                                    periodo_data_termino: ''
                                };
                            });
                        }
                    }

                    // handleBlur retirado diretamente do AppForm de Periodo
                    if (!formData.periodo_ano) {
                        setMessage({
                            show: true,
                            type: 'light',
                            message: 'O Campo início do período precisa que o campo Ano esteja preenchido.',
                        });
                        setFormData((prev) => ({ ...prev, [name]: '' }));
                    } else if (dataInicio.getFullYear() !== parseInt(formData.periodo_ano, 10)) {
                        setMessage({
                            show: true,
                            type: 'light',
                            message: 'A data início do período deve corresponder ao ano informado.',
                        });
                        setFormData((prev) => ({ ...prev, [name]: '' }));
                    } else if (formData.periodo_numero === 1 && (dataInicio < new Date(dateLimits.min) || dataInicio > new Date(dateLimits.max))) {
                        setMessage({
                            show: true,
                            type: 'light',
                            message: 'A data início deve estar no 1º semestre.',
                        });
                        setFormData((prev) => ({ ...prev, [name]: '' }));
                    } else if (formData.periodo_numero === 2 && (dataInicio < new Date(dateLimits.min) || dataInicio > new Date(dateLimits.max))) {
                        setMessage({
                            show: true,
                            type: 'light',
                            message: 'A data início deve estar no 2º semestre.',
                        });
                        setFormData((prev) => ({ ...prev, [name]: '' }));
                    } else {
                        setMessage({ show: false, type: null, message: null });
                        // setFormData((prev) => ({ ...prev, [name]: value }));
                    }

                // Profissional
                case 'Profissional':
                    if (name === 'DataAdmissao' && value === '') {
                        return true;
                    }

                    // console.log('Entrou no case Profissional');
                    const dataAtual = new Date();
                    dataAtual.setHours(0, 0, 0, 0); // Ajusta para data atual sem horas para comparação precisa

                    // Converte as datas apenas se os campos tiverem valor
                    const dataAdmissao = formData.DataAdmissao ? new Date(formData.DataAdmissao) : null;
                    const dataDemissao = formData.DataDemissao ? new Date(formData.DataDemissao) : null;
                    const dataSelecionada = value ? new Date(value) : null;

                    let errorMessage = '';

                    // Se o campo estiver vazio, exibe uma mensagem abaixo do campo e redefine o valor
                    if (!value && name === 'DataAdmissao' && message.show === false) {

                        setMessage({
                            show: true,
                            type: 'light',
                            message: "Informe uma data para admissão do funcionário."
                        });

                        setFormData((prev) => ({
                            ...prev,
                            [name]: ''
                        }));
                    } else if (name === 'DataAdmissao' && message.show === false) {
                        const limiteMinimo = new Date(dataAtual);
                        limiteMinimo.setFullYear(limiteMinimo.getFullYear() - 34);

                        // Verifica se a data de admissão é menor que 34 anos a partir da data atual
                        if (dataAdmissao && dataAdmissao < limiteMinimo && message.show === false) {
                            setAvisoCampo('A Data deve ser maior do que 34 anos a partir da data atual');
                        } else if (dataAdmissao && dataAdmissao > dataAtual && message.show === false) {
                            // Verifica se a data de admissão é superior à data atual
                            errorMessage = 'Data de Admissão inválida. Por favor, insira uma data válida não superior à data atual.';

                            setMessage({
                                show: true,
                                type: 'light',
                                message: errorMessage
                            });

                            // Zera o valor do campo de data de admissão
                            setFormData((prev) => ({
                                ...prev,
                                DataAdmissao: ''
                            }));
                        }
                    } else if (name === 'DataDemissao' && message.show === false) {
                        if (dataDemissao && dataDemissao < dataAdmissao && message.show === false) {
                            // Verifica se a data de demissão é anterior à data de admissão
                            setMessage({
                                show: true,
                                type: 'light',
                                message: 'Data de Demissão inválida. Por favor, insira uma data válida superior à Data de Admissão e à data atual.'
                            });

                            // Zera o valor do campo de data de demissão
                            setFormData((prev) => ({
                                ...prev,
                                DataDemissao: ''
                            }));
                        } else if (dataDemissao && dataDemissao > dataAtual && message.show === false) {
                            // Verifica se a data de demissão é superior à data atual
                            errorMessage = 'A Data de Demissão não pode ser superior a hoje';

                            setMessage({
                                show: true,
                                type: 'light',
                                message: errorMessage
                            });

                            // Zera o valor do campo de data de demissão
                            setFormData((prev) => ({
                                ...prev,
                                DataDemissao: ''
                            }));
                        }
                    } else {
                        setFormData((prev) => ({
                            ...prev,
                            [name]: value
                        }));
                        setMessage({ show: false, type: 'light', message: errorMessage });
                    }
                    break;

                default:
                    break;
            }
        };

        // Style 
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

        const requiredField = {
            color: '#FF0000',
        };

        const fontErro = {
            fontSize: '0.7em',
        };

        const formControlStyle = {
            fontSize: '1rem',
            borderColor: '#fff',
        };

        return (
            <div>
                <div>
                    AppDate
                </div>
                <div style={formGroupStyle}>
                    <label
                        htmlFor={name}
                        style={formLabelStyle}
                        className="form-label"
                    >
                        {label}
                        {(attributeRequired) && (
                            <strong style={requiredField}>*</strong>
                        )}
                    </label>
                    <input
                        data-api={`filtro-${attributeOrigemForm}`}
                        type="date"
                        className={`form-control ${error ? 'is-invalid' : formData[name] ? 'is-valid' : ''}`}
                        style={formControlStyle}
                        id={name}
                        name={name}
                        value={formData[name] || ''}
                        min={attributeMin}
                        max={`${maxDate}`}
                        required={attributeRequired}
                        readOnly={attributeReadOnly}
                        disabled={attributeDisabled}
                        onKeyDown={(e) => e.preventDefault()} // Previne a digitação
                        onKeyPress={(e) => e.preventDefault()} // Previne a digitação
                        onFocus={(e) => {
                            e.target.showPicker();
                            handleFocus(e);
                        }}
                        onChange={handleChange}
                        onBlur={handleBlur}
                    />
                </div>
                {/* Exibe o componente de alerta */}
                {typeof AppMessageCard !== "undefined" ? (
                    <div>
                        <AppMessageCard
                            parametros={message} modalId={`modal_date${name}`}
                        />
                    </div>
                ) : (
                    <div>
                        <p className="text-light">AppMessageCard não existe.</p>
                    </div>
                )}
            </div>
        );
    };
</script>