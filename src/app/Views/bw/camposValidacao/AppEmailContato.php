<script type="text/babel">
    const AppEmailContato = ({ formData = {}, setFormData = () => { }, parametros = {}, submitAllForms }) => {

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

        // Validação de E-mail: formato atualizado para aceitar .com, .com.br, .net, etc.
        const isValidEmail = (email_contato) => {
            const regexEmail = /^[a-zA-Z][\w.-]{4,}@[\w-]{5,}\.[a-z]{2,}(\.[a-z]{2})?$/;
            return regexEmail.test(email_contato);
        };

        // Função handleFocus - Recebe foco
        const handleFocus = (event) => {
            const { name, value } = event.target;
            console.log('name handleFocus (src/app/Views/bw/camposValidacao/AppEmailContato.php): ', name);
            console.log('value handleFocus (src/app/Views/bw/camposValidacao/AppEmailContato.php): ', value);
            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        };

        // Função handleChange - Muda valor
        const handleChange = (event) => {
            const { name, value } = event.target;
            console.log('name handleChange (src/app/Views/bw/camposValidacao/AppNome.php): ', name);
            console.log('value handleChange (src/app/Views/bw/camposValidacao/AppNome.php): ', value);

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        // Função handleBlur - Perde o foco
        const handleBlur = async (event) => {
            const { name, value } = event.target;
            console.log('name handleBlur (src/app/Views/bw/camposValidacao/AppEmailContato.php): ', name);
            console.log('value handleBlur (src/app/Views/bw/camposValidacao/AppEmailContato.php): ', value);

            if (name === 'email_contato') {
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
                if (isValidEmail(value)) {
                    await submitAllForms(`filtro-${origemForm}`);
                    setMessage({
                        show: true,
                        type: 'success',
                        message: 'E-mail validado com sucesso.'
                    });
                } else {
                    // Limpa o campo se o e-mail for inválido
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    setMessage({
                        show: true,
                        type: 'danger',
                        message: 'E-mail inválido. Por favor, insira um e-mail ex. (usuario@email.com).'
                    });
                    console.log('E-mail Inválido: campo limpo');
                }
            }
        };

        const redirectTo = (url) => {
            const uri = base_url + url;
            setTimeout(() => {
                window.location.href = uri;
            }, 4000);
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
                    <label htmlFor="email_contato" style={formLabelStyle} className="form-label">#Email<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="text"
                        id="email_contato"
                        name="email_contato"
                        value={formData.email_contato || ''}
                        onFocus={handleFocus}
                        onChange={handleChange}
                        onBlur={handleBlur}
                        style={formControlStyle}
                        className="form-control"
                        disabled={formData.id === null ? true : false}
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
