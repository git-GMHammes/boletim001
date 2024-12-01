<script type="text/babel">
    const AppForm = ({ parametros = {}, formData: externalFormData, setFormData: externalSetFormData }) => {
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const request_scheme = parametros.request_scheme;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const token_csrf = parametros.token_csrf;
        const origemForm = parametros.origemForm;
        const base_url = parametros.base_url;

        // Lista de APIs


        // Definindo o estado para controlar a aba ativa
        // const [tabNav, setTabNav] = React.useState('form');
        const [showAlert, setShowAlert] = React.useState(false);
        const [alertType, setAlertType] = React.useState('');
        const [alertMessage, setAlertMessage] = React.useState('');

        // Declarar parametros de mensagem
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Inicialização condicional de formData
        const [internalFormData, internalSetFormData] = React.useState({
            token_csrf: token_csrf || '',
            json: "1",
            select_empresa: null,
            select_mult_empresa: null,
        });

        const submitAllForms = async (apiIdentifier) => {
            return apiIdentifier;
        };


        // Use o formData passado externamente, ou o estado interno como fallback
        const formData = externalFormData || internalFormData;
        const setFormData = externalSetFormData || internalSetFormData;

        // Função handleFocus - Foco no objeto
        const handleFocus = (event) => {
            const { name, value } = event.target;

            console.log('name handleFocus: ', name);
            console.log('value handleFocus: ', value);

            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        };

        // Função handleChange - Mudança no valor
        const handleChange = (event) => {
            const { name, value } = event.target;

            console.log('name handleChange: ', name);
            console.log('value handleChange: ', value);

            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        };

        // Função handleBlur - Ao sair do foco
        const handleBlur = (event) => {
            const { name, value } = event.target;

            console.log('name handleChange: ', name);
            console.log('value handleChange: ', value);

            setMessage((prev) => ({
                ...prev,
                show: false
            }));
        }

        const redirectTo = (url) => {
            const uri = base_url + url;
            setTimeout(() => {
                window.location.href = uri;
            }, 3000);
        };

        return (
            <div>
                <div>
                    <AppEmpresaSelect
                        formData={formData}
                        setFormData={setFormData}
                        parametros={parametros}
                        submitAllForms={submitAllForms}
                    />
                    <AppEmpresaSelectMult
                        formData={formData}
                        setFormData={setFormData}
                        parametros={parametros}
                        submitAllForms={submitAllForms}
                    />
                </div>

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} />
            </div>
        );
    };

</script>