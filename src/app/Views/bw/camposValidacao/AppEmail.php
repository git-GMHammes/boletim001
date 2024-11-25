<script type="text/babel">
    const AppEmail = ({ formData = {}, setFormData = () => { }, parametros = {}, submitAllForms }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const origemForm = parametros.origemForm || '';

        // Estado para mensagens e validação
        const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Validação de E-mail: permite apenas e-mails com "@" e "." e no formato especificado
        const isValidEmail = (email) => {
            const regexEmail = /^[\w.-]+@([\w-]+\.)+(com|com.br|org|net|digital)$/; // Inclui domínio .digital
            return regexEmail.test(email);
        };

        // Função handleFocus - Foco no objeto
        const handleFocus = (event) => {
            setMessage((prev) => ({
                ...prev,
                show: false
            }));
            setShowEmptyMessage(false);
        };

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;

            // Define o valor no estado
            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        // Função handleBlur para validar o campo E-mail
        const handleBlur = (event) => {
            const { name, value } = event.target;

            // Verifica se o campo está vazio
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

            // Verifica se o valor é um e-mail válido
            if (!isValidEmail(value)) {
                setMessage({
                    show: true,
                    type: 'warning',
                    message: 'E-mail inválido. Por favor, insira um e-mail ex. (usuario@email.com).'
                });

                // Limpa o campo se o e-mail for inválido
                setFormData((prev) => ({
                    ...prev,
                    [name]: ''
                }));
                console.log('E-mail Inválido: campo limpo');
            } else {
                console.log('E-mail OK');
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
                    <label htmlFor="email" style={formLabelStyle} className="form-label">#Email<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="email"
                        id="email"
                        name="email"
                        value={formData.email || ''}
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
                        E-mail inválido. Por favor, insira um e-mail ex. (usuario@email.com).
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_email" />
            </div>
        );
    };
</script>