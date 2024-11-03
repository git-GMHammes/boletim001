<script type="text/babel">
    const AppResponsavelTelefoneRecado = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

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

        // Função para adicionar a máscara de Telefone, permitindo espaço após o DDD
        const applyMaskTelefone = (telefone) => {
            telefone = telefone.replace(/[^\d\s]/g, ''); // Remove tudo que não é número ou espaço
            telefone = telefone.replace(/^(\d{2})(\s?)(\d)/, '($1)$2$3'); // Adiciona parênteses ao DDD e permite o espaço

            if (telefone.length <= 10) { // Caso seja um número fixo (10 dígitos)
                telefone = telefone.replace(/(\d{4})(\d)/, '$1-$2'); // Adiciona o hífen após os primeiros 4 números
            } else { // Caso seja um número de celular (11 dígitos)
                telefone = telefone.replace(/(\d{5})(\d)/, '$1-$2'); // Adiciona o hífen após os primeiros 5 números
            }
            return telefone;
        };

        // Validação de Telefone: permite apenas números, (), espaços e -, aceitando o espaço após o DDD
        const isValidTelefone = (telefone) => {
            const telefoneSemMascara = telefone.replace(/[^\d]/g, ''); // Remove caracteres não numéricos

            // Verifica se o telefone é fixo (10 dígitos) ou celular (11 dígitos) e não é uma sequência de números repetidos
            if ((telefoneSemMascara.length !== 10 && telefoneSemMascara.length !== 11) || /^(\d)\1+$/.test(telefoneSemMascara)) return false;

            return true;
        };



        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;

            // Aplica a máscara se for o campo Telefone
            let maskedValue = value;
            if (name === 'Responsavel_TelefoneRecado') {
                maskedValue = applyMaskTelefone(value);
            }

            setFormData((prev) => ({
                ...prev,
                [name]: maskedValue
            }));
        };

        // Função handleBlur para limpar o campo Telefone se for inválido
        const handleBlur = (event) => {
            const { name, value } = event.target;

            if (name === 'Responsavel_TelefoneRecado') {
                if (!isValidTelefone(value)) {
                    // Função para exibir o alerta (success, danger, warning, info)
                    setMessage({
                        show: true,
                        type: 'warning',
                        message: 'Alerta de Validação de Telefone Ativa: (21)9NNNN-NNNN para celular ou (21)NNNNN-NNN para fixo'
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
                    <label htmlFor="telefone" style={formLabelStyle} className="form-label">#Telefone Recado (Responsável)<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${parametros.origemForm || ''}`}
                        type="text"
                        id="Responsavel_TelefoneRecado"
                        name="Responsavel_TelefoneRecado"
                        value={formData.Responsavel_TelefoneRecado || ''}
                        maxLength="14"
                        onChange={handleChange}
                        onBlur={handleBlur}
                        style={formControlStyle}
                        className="form-control"
                        required
                    />
                </div>
                {formData.Responsavel_TelefoneRecado && !isValidTelefone(formData.Responsavel_TelefoneRecado) && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Telefone inválido
                    </span>
                )}
            </div>
        );
    };
</script>