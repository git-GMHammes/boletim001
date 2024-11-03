<script type="text/babel">
    const AppResponsavelEmpresa = ({ formData = {}, setFormData = () => { }, parametros = {}, submitAllForms }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const origemForm = parametros.origemForm || '';

        // Estado para mensagens e validação
        const [showPunctuationMessage, setShowPunctuationMessage] = React.useState(false);
        const [showNumberMessage, setShowNumberMessage] = React.useState(false);
        const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Validação de Empresa: Mais de 4 caracteres e apenas letras e números
        const isValidEmpresa = (empresa) => {
            if (empresa.length < 4) return false;
            const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ0-9\s]+$/;
            return regex.test(empresa);
        };

        // Função handleFocus - Foco no objeto
        const handleFocus = (event) => {
            const { name, value } = event.target;

            console.log('name handleFocus (src/app/Views/bw/camposValidacao/AppResponsavelEmpresa.php): ', name);
            console.log('value handleFocus (src/app/Views/bw/camposValidacao/AppResponsavelEmpresa.php): ', value);

            setMessage((prev) => ({
                ...prev,
                show: false
            }));
            setShowEmptyMessage(false); // Oculta a mensagem "Campo Obrigatório" ao focar
        };

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;
            console.log('name handleChange (src/app/Views/bw/camposValidacao/AppResponsavelEmpresa.php): ', name);
            console.log('value handleChange (src/app/Views/bw/camposValidacao/AppResponsavelEmpresa.php): ', value);

            // Remove pontuação e números se inválidos
            const filteredValue = value.replace(/[^a-zA-Z0-9\s]/g, ''); // Permite letras, números e espaços

            setFormData((prev) => ({
                ...prev,
                [name]: filteredValue
            }));
        };

        // Função handleBlur para validar o campo Responsável
        const handleBlur = async (event) => {
            const { name, value } = event.target;
            console.log('name handleBlur (src/app/Views/bw/camposValidacao/AppResponsavelEmpresa.php): ', name);
            console.log('value handleBlur (src/app/Views/bw/camposValidacao/AppResponsavelEmpresa.php): ', value);

            // Verifica se é o campo Responsável e faz a validação
            if (name === 'responsavel') {
                if (!value) {
                    setShowEmptyMessage(true);
                    return;
                } else {
                    setShowEmptyMessage(false);
                }

                // Lógica de validação no handleBlur
                if (isValidEmpresa(value)) {
                    console.log('Empresa OK');
                    await submitAllForms(`filtro-${origemForm}`);
                } else {
                    setMessage({
                        show: true,
                        type: 'light',
                        message: 'Nome de empresa inválido. Por favor, insira um nome contendo apenas letras e números.'
                    });
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    console.log('Empresa Inválido: campo limpo');
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
                    <label htmlFor="responsavel" style={formLabelStyle} className="form-label">#Responsável<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="text"
                        id="responsavel"
                        name="responsavel"
                        value={formData.responsavel || ''}
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
                        Campo Obrigatório
                    </span>
                )}
                {showPunctuationMessage && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Pontuação inválida
                    </span>
                )}
                {showNumberMessage && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        O Campo Nome não aceita número
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_responsavel" />
            </div>
        );
    };
</script>