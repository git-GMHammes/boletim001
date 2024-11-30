<script type="text/babel">
    const AppVia = ({ formData = {}, setFormData = () => { }, parametros = {}, submitAllForms }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const origemForm = parametros.origemForm || '';

        // Definindo mensagens do Sistema
        const [showAlert, setShowAlert] = React.useState(false);
        const [alertType, setAlertType] = React.useState('');
        const [alertMessage, setAlertMessage] = React.useState('');

        // Estado para mensagens e validação
        const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Validação deVia: aceita apenas letras, números e formatação de milhas
        const isValidCodigo = (via) => {
            const codigoRegex = /^[a-zA-Z0-9.]+$/;  // Expressão regular para letras, números e pontos
            return codigoRegex.test(via) && /^[0-9]{3}\.[0-9]{3}$/.test(via); // Formato de milhas: 000.000
        };

        // Função handleFocus - Foco no objeto
        const handleFocus = (event) => {
            const { name, value } = event.target;

            console.log('name handleFocus (src/app/Views/bw/camposValidacao/AppVia.php): ', name);
            console.log('value handleFocus (src/app/Views/bw/camposValidacao/AppVia.php): ', value);

            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        };

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;
            console.log('name handleChange (src/app/Views/bw/camposValidacao/AppVia.php): ', name);
            console.log('value handleChange (src/app/Views/bw/camposValidacao/AppVia.php): ', value);

            // Remove caracteres inválidos e aplica máscara de milhas
            const filteredValue = value.replace(/[^a-zA-Z0-9.]/g, ''); // Permite apenas letras, números e pontos

            setFormData((prev) => ({
                ...prev,
                [name]: filteredValue
            }));
        };

        // Função handleBlur para limpar o campoVia se for inválido
        const handleBlur = async (event) => {
            const { name, value } = event.target;
            console.log('name handleBlur (src/app/Views/bw/camposValidacao/AppVia.php): ', name);
            console.log('value handleBlur (src/app/Views/bw/camposValidacao/AppVia.php): ', value);

            // Verifica se é o campoVia e faz a validação
            if (name === 'via') {

                if (!value) {
                    setShowEmptyMessage(true);
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    return;
                } else {
                    setShowEmptyMessage(false);
                }

                if (!isValidCodigo(value)) {
                    // console.log(Via OK');
                    await submitAllForms(`filtro-${origemForm}`);
                } else {
                    setMessage({
                        show: true,
                        type: 'light',
                        message: 'Via inválido.Por favor, insira um nome contendo apenas letras.'
                    });
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    console.log('Via Inválido: campo limpo');
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
                    <label htmlFor="via" style={formLabelStyle} className="form-label">Via<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="text"
                        id="via"
                        name="via"
                        value={formData.via || ''}
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
                        Via inválido
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage
                    parametros={message}
                    modalId="modal_codigo"
                />
            </div>
        );
    };
</script>