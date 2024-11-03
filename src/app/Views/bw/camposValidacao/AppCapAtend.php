<script type="text/babel">
    const AppCapAtend = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT || '';
        const origemForm = parametros.origemForm || '';
        const base_url = parametros.base_url || '';
        const getURI = parametros.getURI || [];

        // Definindo mensagens do Sistema
        const [defineAtualizar, setDefineAtualizar] = React.useState(false);
        const [tabNav, setTabNav] = React.useState('form');
        const [showAlert, setShowAlert] = React.useState(false);
        const [alertType, setAlertType] = React.useState('');
        const [alertMessage, setAlertMessage] = React.useState('');
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Função para validar Capacidade Atendimento
        const isValidCapacity = (unidades_cap_atendimento) => {
            // Verifica se o valor é válido e converte para string, ou usa uma string vazia como fallback
            unidades_cap_atendimento = unidades_cap_atendimento ? String(unidades_cap_atendimento) : '';
            unidades_cap_atendimento = String(unidades_cap_atendimento).replace(/\D/g, ''); // Remove tudo que não for dígito

            // Converte o valor para número e verifica se é maior que zero
            if (Number(unidades_cap_atendimento) > 0) {
                return true;
            } else {
                return false;
            }
        };

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;

            // Função para validar Capacidade Atendimento
            const filteredValue = value.replace(/\D/g, ''); // Remove tudo que não for dígito

            console.log('name handleChange (Capacidade Atendimento): ', name);
            console.log('value handleChange (Capacidade Atendimento): ', filteredValue);

            setFormData((prev) => ({
                ...prev,
                [name]: filteredValue
            }));
        };

        // Função handleBlur para limpar o campo Capacidade de Atendimento se for inválido
        const handleBlur = (event) => {
            const { name, value } = event.target;

            // Verifica se é o campo Capacidade de Atendimento e faz a validação
            if (name === 'unidades_cap_atendimento') {
                if (!isValidCapacity(value)) {

                    // Função para exibir o alerta (success, danger, warning, info)
                    setMessage({
                        show: true,
                        type: 'warning',
                        message: 'Alerta de Validação de Capacidade de Atendimento Ativa'
                    });

                    // Limpa o campo se a Capacidade de Atendimento for inválida
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    console.log('Capacidade de Atendimento Inválido: campo limpo');
                }
            }
        };

        // Fetch para obter os Unidades
        const fetchUnidades = async (cap_atendimentoData) => {
            console.log('fetchUnidades');
            console.log('data_cap_atendimento', cap_atendimentoData);

            try {
                console.log('base_url + api_get_unidades: ', base_url + 'fia/ptpa/unidade/api/filtrar');
                const response = await fetch(base_url + 'fia/ptpa/unidade/api/filtrar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(cap_atendimentoData)
                });
                const data = await response.json();

                console.log('data: ', data);

                if (getURI.includes("cadastrar")) {
                    setDefineAtualizar(true);
                    console.log(defineAtualizar);
                }

            } catch (error) {
                // Função para exibir o alerta (success, danger, warning, info)
                setMessage({
                    show: true,
                    type: 'danger',
                    message: 'Erro ao carregar: ' + error.message
                });
            }
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

        const requiredField = {
            color: '#FF0000',
        };

        const formControlStyle = {
            fontSize: '1rem',
            borderColor: '#fff',
        };

        return (
            <div>
                <div style={formGroupStyle}>
                    <label
                        htmlFor="unidades_cap_atendimento"
                        style={formLabelStyle}>Capacidade de Atendimento
                        <strong style={requiredField}>*</strong>
                    </label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="text"
                        id="unidades_cap_atendimento"
                        name="unidades_cap_atendimento"
                        value={formData.unidades_cap_atendimento || ''}
                        onChange={handleChange}
                        onBlur={handleBlur}
                        className="form-control"
                        style={formControlStyle}
                        required
                    />
                </div>
                {formData.unidades_cap_atendimento && !isValidCapacity(formData.unidades_cap_atendimento) && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Capacidade de Atendimento inválida. Por favor, insira um valor numérico e não negativo.
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_cap_atend" />

            </div>
        );
    };
</script>