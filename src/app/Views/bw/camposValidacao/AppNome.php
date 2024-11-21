<script type="text/babel">
    const AppNome = ({ formData = {}, setFormData = () => { }, parametros = {}, submitAllForms }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT || false;
        const origemForm = parametros.origemForm || '';

        // console.log('formData :: ', formData);

        // APIs
        const api_post_cadastrar_atualizar = parametros.api_post_cadastrar_atualizar || '';

        // Estado para mensagens e validação
        const [showAlert, setShowAlert] = React.useState(false);
        const [alertType, setAlertType] = React.useState('');
        const [alertMessage, setAlertMessage] = React.useState('');
        const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Validação de Nome: Mais de 4 letras e apenas letras
        const isValidNome = (nome) => {
            if (nome.length < 4) return false;
            const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/;
            return regex.test(nome);
        };

        // Função handleFocus - Recebe foco
        const handleFocus = (event) => {
            const { name, value } = event.target;

            console.log('name handleFocus (src/app/Views/bw/camposValidacao/AppNome.php): ', name);
            console.log('value handleFocus (src/app/Views/bw/camposValidacao/AppNome.php): ', value);

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
            console.log('name handleBlur (src/app/Views/bw/camposValidacao/AppNome.php): ', name);
            console.log('value handleBlur (src/app/Views/bw/camposValidacao/AppNome.php): ', value);

            if (name === 'nome') {
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

                if (isValidNome(value)) {
                    console.log('Nome OK');
                    await submitAllForms(`filtro-${origemForm}`);
                } else {
                    setMessage({
                        show: true,
                        type: 'light',
                        message: 'Nome inválido. Por favor, insira um nome contendo apenas letras.'
                    });
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    console.log('Nome Inválido: campo limpo');
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
                    <label htmlFor="nome" style={formLabelStyle} className="form-label">Nome<strong style={requiredField}>*</strong></label>
                    <input data-api={`filtro-${origemForm}`}
                        type="text"
                        id="nome"
                        name="nome"
                        value={formData.nome || ''}
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
                        Nome inválido. Por favor, insira um nome contendo apenas letras.
                    </span>
                )}
                <AppMessage parametros={message} modalId="modal_nome" />
            </div>
        );

    };
</script>