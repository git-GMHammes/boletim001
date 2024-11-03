<script type="text/babel">
    const AppCpf = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT || '';
        const origemForm = parametros.origemForm || '';
        const base_url = parametros.base_url || '';
        const getURI = parametros.getURI || '';

        // Estado para atualizar a página
        const [defineAtualizar, setDefineAtualizar] = React.useState(false);

        // Estado para mensagens e validação
        const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Função handleFocus para garantir que o modal não seja exibido ao receber o foco
        const handleFocus = () => {
            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        };

        console.log("message::", message);

        // Função para adicionar a máscara de CPF
        const applyMaskCPF = (cpf) => {
            cpf = cpf.replace(/\D/g, ''); // Remove tudo que não for dígito
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            return cpf;
        };

        // Validação de CPF
        const isValidCPF = (cpf) => {
            // Remove caracteres não numéricos
            cpf = cpf.replace(/[^\d]+/g, '');

            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

            let soma = 0, resto;
            for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(9, 10))) return false;

            soma = 0;
            for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(10, 11))) return false;

            return true;
        };

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;

            // Aplica a máscara se for o campo CPF
            let maskedValue = value;
            if (name === 'CPF') {
                maskedValue = applyMaskCPF(value);
            }

            console.log('name handleChange (CPF): ', name);
            console.log('value handleChange (CPF): ', maskedValue);

            setFormData((prev) => ({
                ...prev,
                [name]: maskedValue
            }));
        };

        const handleBlur = (event) => {
            const { name, value } = event.target;

            // Verifica se é o campo CPF e se está vazio
            if (name === 'CPF') {
                if (!value) {
                    // Se o CPF estiver em branco, ativa a mensagem
                    setShowEmptyMessage(true);
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    return;
                } else {
                    // Se o CPF tiver algum valor, desativa a mensagem de vazio
                    setShowEmptyMessage(false);
                }

                // Se o CPF tiver algum valor e for inválido, aciona o modal
                if (!isValidCPF(value)) {
                    setMessage({
                        show: true, // Abre o modal
                        type: 'light',
                        message: 'CPF inválido. Por favor, insira um CPF válido.'
                    });

                    // Limpa o campo CPF se for inválido
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    console.log('CPF Inválido: campo limpo');
                } else {
                    console.log('CPF OK');
                    let cpfData = { [name]: value };
                    fetchCadastro(cpfData);
                }
            }
        };

        // Fetch para obter os Cadastros
        const fetchCadastro = async (cpfData) => {
            console.log('fetchCadastro');
            console.log('data_cpf', cpfData);

            try {
                console.log('base_url + api_get_profissao: ', base_url + 'fia/ptpa/cadGeral/api/filtrar');
                const response = await fetch(base_url + 'fia/ptpa/cadGeral/api/filtrar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(cpfData)
                });
                const data = await response.json();

                console.log('data: ', data);

                if (getURI.includes("cadastrar")) {
                    setDefineAtualizar(true);
                    console.log(defineAtualizar);
                }

                if (data.result && data.result.dbResponse && data.result.dbResponse.length > 0 && defineAtualizar) {
                    setMessage({
                        show: true,
                        type: 'light',
                        message: 'Alerta CPF Já existe'
                    });

                    // Limpa o campo se o CPF for inválido
                    setFormData((prev) => ({
                        ...prev,
                        ['CPF']: ''
                    }));
                }

            } catch (error) {
                // Função para exibir o alerta (success, danger, warning, info)
                setMessage({
                    show: true,
                    type: 'light',
                    message: 'Erro ao carregar Profissões: ' + error.message
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
                    <label htmlFor="CPF" style={formLabelStyle} className="form-label">CPF<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="text"
                        id="CPF"
                        name="CPF"
                        value={formData.CPF || ''}
                        maxLength="14"
                        onFocus={handleFocus}
                        onChange={handleChange}
                        onBlur={handleBlur}
                        style={formControlStyle}
                        className="form-control"
                        required
                    />
                </div>

                {showEmptyMessage && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        CPF inválido. Por favor, insira um CPF válido.
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_cpf" />

            </div>
        );
    };
</script>