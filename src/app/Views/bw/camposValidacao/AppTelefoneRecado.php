<script type="text/babel">
    const AppTelefoneRecado = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

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

        // Função para adicionar a máscara de Telefone, permitindo espaço após o DDD
        const applyMaskTelefone = (telefone) => {
            telefone = telefone.replace(/\D/g, ''); // Remove tudo que não é número

            if (telefone.length === 11) { // Celular: (21)9NNNN-NNNN
                telefone = telefone.replace(/^(\d{2})(\d{1})(\d{4})(\d{4})$/, '($1)$2$3-$4');
            } else if (telefone.length === 10) { // Fixo: (21)NNNN-NNNN
                telefone = telefone.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1)$2-$3');
            }

            return telefone;
        };

        // Validação de Telefone
        const isValidTelefone = (telefone) => {
            const telefoneSemMascara = telefone.replace(/\D/g, '');
            return (telefoneSemMascara.length === 10 || telefoneSemMascara.length === 11) &&
                !/^(\d)\1+$/.test(telefoneSemMascara);
        };

        // Função handleChange
        const handleChange = (event) => {
            const { name, value } = event.target;
            let maskedValue = value;
            if (name === 'TelefoneRecado') {
                maskedValue = applyMaskTelefone(value);
            }
            setFormData((prev) => ({
                ...prev,
                [name]: maskedValue
            }));
        };

        // Função handleBlur
        const handleBlur = (event) => {
            const { name, value } = event.target;

            // Exibe mensagem se o campo estiver vazio
            if (name === 'TelefoneRecado') {
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

                // Exibe modal se o telefone for inválido
                if (!isValidTelefone(value)) {
                    setMessage({
                        show: true,
                        type: 'warning',
                        message: 'Telefone inválido. Por favor, insira um número de telefone. Ex (21) 9 0000-0000'
                    });
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
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
                    <label htmlFor="TelefoneRecado" style={formLabelStyle} className="form-label">
                        Telefone Recado<strong style={requiredField}>*</strong>
                    </label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="text"
                        id="TelefoneRecado"
                        name="TelefoneRecado"
                        value={formData.TelefoneRecado || ''}
                        maxLength="14"
                        onChange={handleChange}
                        onBlur={handleBlur}
                        style={formControlStyle}
                        className="form-control"
                        required
                    />
                </div>

                {showEmptyMessage && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Telefone inválido. Por favor, insira um número de telefone. Ex (21) 0000-0000
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_telefone" />
            </div>
        );
    };
</script>