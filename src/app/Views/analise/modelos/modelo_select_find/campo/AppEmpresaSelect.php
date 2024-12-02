<script type="text/babel">
    const AppEmpresaSelect = ({ formData = {}, setFormData = () => { }, parametros = {}, submitAllForms }) => {

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

        // Função handleFocus - Recebe foco
        const handleFocus = (event) => {
            const { name, value } = event.target;

            console.log('name handleFocus (src/app/Views/bw/camposValidacao/AppEmpresaSelect.php): ', name);
            console.log('value handleFocus (src/app/Views/bw/camposValidacao/AppEmpresaSelect.php): ', value);

            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        };

        // Função handleChange - Muda valor
        const handleChange = (event) => {
            const { name, value } = event.target;
            console.log('name handleChange (src/app/Views/bw/camposValidacao/AppEmpresaSelect.php): ', name);
            console.log('value handleChange (src/app/Views/bw/camposValidacao/AppEmpresaSelect.php): ', value);

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        // Função handleBlur - Perde o foco
        const handleBlur = async (event) => {
            const { name, value } = event.target;

            console.log('name handleBlur (src/app/Views/bw/camposValidacao/AppEmpresaSelect.php): ', name);
            console.log('value handleBlur (src/app/Views/bw/camposValidacao/AppEmpresaSelect.php): ', value);

            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        };

        return (
            <div>
                <select
                    className="form-select form-select-sm"
                    onFocus={handleFocus}
                    onChange={handleChange}
                    onBlur={handleBlur}
                    value={formData.select_empresa || ''}
                >
                    <option selected>Open this select menu</option>
                    <option value={1}>One</option>
                    <option value={2}>Two</option>
                    <option value={3}>Three</option>
                </select>

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