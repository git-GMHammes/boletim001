<script type="text/babel">
    const AppNlinhas = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const origemForm = parametros.origemForm || '';

        // Definindo mensagens do Sistema
        const [tabNav, setTabNav] = React.useState('form');
        const [showAlert, setShowAlert] = React.useState(false);
        const [alertType, setAlertType] = React.useState('');
        const [alertMessage, setAlertMessage] = React.useState('');
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Validação de numeroLinha: aceita apenas números, traços e pontos
        const isValidNumero = (numero) => {
            const rgRegex = /^[0-9.\-]+$/;  // Expressão regular para números, pontos e traços
            return rgRegex.test(numero);
        };

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;

            // Remove caracteres inválidos conforme a validação de numeroLinha
            const filteredValue = value.replace(/[^0-9.\-]/g, ''); // Permite apenas números, traços e pontos

            console.log('name handleChange (numeroLinha): ', name);
            console.log('value handleChange (numeroLinha): ', filteredValue);

            setFormData((prev) => ({
                ...prev,
                [name]: filteredValue
            }));
        };

        // Função handleBlur para limpar o campo numeroLinha se for inválido
        const handleBlur = (event) => {
            const { name, value } = event.target;

            // Verifica se é o campo numeroLinha e faz a validação
            if (name === 'numeroLinha') {
                if (!isValidNumero(value)) {

                    // Função para exibir o alerta (success, danger, warning, info)
                    setMessage({
                        show: true,
                        type: 'warning',
                        message: 'Alerta de Validação de numeroLinha Ativa'
                    });

                    // Limpa o campo se o numeroLinha for inválido
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    console.log('numeroLinha Inválido: campo limpo');
                } else {
                    console.log('numeroLinha OK');
                }
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
                    <label htmlFor="numeroLinha" style={formLabelStyle} className="form-label">Número da Linha<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="text"
                        id="numeroLinha"
                        name="numeroLinha"
                        value={formData.numeroLinha || ''}
                        onChange={handleChange}
                        onBlur={handleBlur}
                        style={formControlStyle}
                        className="form-control"
                        required
                    />
                </div>
                {formData.numeroLinha && !isValidNumero(formData.numeroLinha) && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Numero da Linha inválido
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage
                    parametros={message}
                    modalId="modal_rg"
                />
            </div>
        );
    };
</script>