<script type="text/babel">
    const AppResponsavelNome = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

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

        // Validação de Nome: Mais de 4 letras e apenas letras
        const isValidNome = (Nome) => {
            // Verifica se o nome tem mais de 4 letras
            if (Nome.length < 4) {
                return false;
            }
            // Verifica se o nome contém apenas letras (A-Z, a-z) e espaços
            const regex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/;
            return regex.test(Nome);
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

            // Verifica se é o campo Nome e faz a validação
            if (name === 'Nome') {
                if (!isValidNome(value)) {

                    // Função para exibir o alerta (success, danger, warning, info)
                    setMessage({
                        show: true,
                        type: 'warning',
                        message: 'Alerta de Validação de Nome do Responsável Ativa'
                    });


                    // Limpa o campo se o Nome for inválido
                    setFormData((prev) => ({
                        ...prev,
                        [name]: ''
                    }));
                    console.log('Nome Inválido: campo limpo');
                } else {
                    console.log('Nome OK');
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
                    <label htmlFor="Responsavel_Nome" style={formLabelStyle} className="form-label">#Nome (Responsável)<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="text"
                        id="Responsavel_Nome"
                        name="Responsavel_Nome"
                        value={formData.Responsavel_Nome || ''}
                        onChange={handleChange}
                        onBlur={handleBlur}
                        style={formControlStyle}
                        className="form-control"
                        disabled={formData.id === null ? true : false}
                    />
                </div>
                {formData.Responsavel_Nome && !isValidNome(formData.Responsavel_Nome) && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Nome Responsavel inválido
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_resp_nome" />

            </div>
        );
    };
</script>