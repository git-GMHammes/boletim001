<script type="text/babel">
    const AppRG = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

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

        // Validação de RG: aceita apenas números, traços e pontos
        const isValidRG = (rg) => {
            const rgRegex = /^[0-9.\-]+$/;  // Expressão regular para números, pontos e traços
            return rgRegex.test(rg);
        };

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;

            // Remove caracteres inválidos conforme a validação de RG
            const filteredValue = value.replace(/[^0-9.\-]/g, ''); // Permite apenas números, traços e pontos

            console.log('name handleChange (RG): ', name);
            console.log('value handleChange (RG): ', filteredValue);

            setFormData((prev) => ({
                ...prev,
                [name]: filteredValue
            }));
        };

        // Função handleBlur para limpar o campo RG se for inválido
        const handleBlur = (event) => {
            const { name, value } = event.target;

            // Verifica se é o campo RG e faz a validação
            if (name === 'RG') {
                if (!isValidRG(value)) {

                    // Função para exibir o alerta (success, danger, warning, info)
                    setMessage({
                        show: true,
                        type: 'warning',
                        message: 'Alerta de Validação de RG Ativa'
                    });

                    // Limpa o campo se o RG for inválido
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    console.log('RG Inválido: campo limpo');
                } else {
                    console.log('RG OK');
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
                    <label htmlFor="CPF" style={formLabelStyle} className="form-label">#RG<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="text"
                        id="RG"
                        name="RG"
                        value={formData.RG || ''}
                        onChange={handleChange}
                        onBlur={handleBlur}
                        style={formControlStyle}
                        className="form-control"
                        required
                    />
                </div>
                {formData.RG && !isValidRG(formData.RG) && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        RG inválido
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_rg" />

            </div>
        );
    };
</script>