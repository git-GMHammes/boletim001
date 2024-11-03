<script type="text/babel">
    const AppResponsavelEmpresa = ({ formData = {}, setFormData = () => {}, parametros = {}, submitAllForms }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const origemForm = parametros.origemForm || '';

        // Estado para mensagens e validação
        const [showPunctuationMessage, setShowPunctuationMessage] = React.useState(false);
        const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Validação de Nome do Responsável: aceita letras e números, mas não pontuação
        const isValidResponsavel = (responsavel) => {
            const punctuationRegex = /[.,/#!$%^&*;:{}=\-_`~()]/; // Expressão para pontuação

            if (punctuationRegex.test(responsavel)) {
                setShowPunctuationMessage(true);
                return false;
            } else {
                setShowPunctuationMessage(false);
            }

            return true;
        };

        // Função handleFocus - Foco no objeto
        const handleFocus = (event) => {
            const { name, value } = event.target;
            setMessage((prev) => ({
                ...prev,
                show: false
            }));
            setShowEmptyMessage(false); // Oculta a mensagem "Campo Obrigatório" ao focar
        };

        // Função handleChange que permite letras, números e espaços
        const handleChange = (event) => {
            const { name, value } = event.target;

            // Permite apenas letras, números e espaços; remove pontuação
            const filteredValue = value.replace(/[^a-zA-Z0-9\s]/g, ''); // Permite letras, números e espaços

            setFormData((prev) => ({
                ...prev,
                [name]: filteredValue
            }));
        };

        // Função handleBlur para validar o campo Responsável
        const handleBlur = async (event) => {
            const { name, value } = event.target;

            // Verifica se é o campo Responsável e faz a validação
            if (name === 'responsavel') {
                if (!value) {
                    setShowEmptyMessage(true);
                    return;
                } else {
                    setShowEmptyMessage(false);
                }

                if (!isValidResponsavel(value)) {
                    await submitAllForms(`filtro-${origemForm}`);
                } else {
                    setMessage({
                        show: true,
                        type: 'light',
                        message: 'Nome do responsável inválido. Apenas letras e números são permitidos.'
                    });
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

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_responsavel" />
            </div>
        );
    };
</script>
