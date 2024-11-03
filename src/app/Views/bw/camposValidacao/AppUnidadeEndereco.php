<script type="text/babel">
    const AppUnidadeEndereco = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

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

        // Validação de unidades_endereco: Mais de 4 letras e apenas letras
        const isValidNome = (unidades_endereco) => {
            // Verifica se o nome tem mais de 4 letras
            if (unidades_endereco.length < 4) {
                return false;
            }
            // Verifica se o nome contém apenas letras (A-Z, a-z) e espaços
            const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s,]+$/;
            return regex.test(unidades_endereco);
        };

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        const handleBlur = (event) => {
            const { name, value } = event.target;

            // Verifica se é o campo unidades_endereco e faz a validação
            if (name === 'unidades_endereco') {
                if (!isValidNome(value)) {

                    // Função para exibir o alerta (success, danger, warning, info)
                    setMessage({
                        show: true,
                        type: 'warning',
                        message: 'O campo endereço aceita somente letras e números.'
                    });

                    // Limpa o campo se o unidades_endereco for inválido
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    console.log('unidades_endereco Inválido: campo limpo');
                } else {
                    console.log('unidades_endereco OK');
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
                    <label htmlFor="unidades_endereco" style={formLabelStyle} className="form-label">Endereço (Unidade)<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="text"
                        id="unidades_endereco"
                        name="unidades_endereco"
                        value={formData.unidades_endereco || ''}
                        onChange={handleChange}
                        onBlur={handleBlur}
                        style={formControlStyle}
                        className="form-control"
                        required
                    />
                </div>
                {formData.unidades_endereco && !isValidNome(formData.unidades_endereco) && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Endereço inválido. Por favor, insira um endereço contendo apenas letras.
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} />

            </div>
        );
    };
</script>