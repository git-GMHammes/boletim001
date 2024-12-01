<script type="text/babel">
    const AppEmpresaSelectMult = ({ formData = {}, setFormData = () => { }, parametros = {}, submitAllForms }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT || false;
        const origemForm = parametros.origemForm || '';

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

        // Função handleFocus - Recebe foco
        const handleFocus = (event) => {
            const { name, value } = event.target;

            console.log('name handleFocus (src/app/Views/bw/camposValidacao/AppEmpresaSelectMult.php): ', name);
            console.log('value handleFocus (src/app/Views/bw/camposValidacao/AppEmpresaSelectMult.php): ', value);

            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        };

        // Função handleChange - Muda valor
        const handleChange = (event) => {
            const { name, value } = event.target;
            console.log('name handleChange (src/app/Views/bw/camposValidacao/AppEmpresaSelectMult.php): ', name);
            console.log('value handleChange (src/app/Views/bw/camposValidacao/AppEmpresaSelectMult.php): ', value);

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        // Função handleBlur - Perde o foco
        const handleBlur = async (event) => {
            const { name, value } = event.target;

            console.log('name handleBlur (src/app/Views/bw/camposValidacao/AppEmpresaSelectMult.php): ', name);
            console.log('value handleBlur (src/app/Views/bw/camposValidacao/AppEmpresaSelectMult.php): ', value);

            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        };

        const redirectTo = (url) => {
            const uri = base_url + url;
            setTimeout(() => {
                window.location.href = uri;
            }, 4000);
        };

        return (
            <div>
                {/* Atenção as Consts abaixo*/}
                {/*
                onFocus={handleFocus}
                onChange={handleChange}
                onBlur={handleBlur}
                */}

                Select Mult Empresa

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