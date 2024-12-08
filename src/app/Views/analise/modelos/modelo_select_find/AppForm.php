<script type="text/babel">
    const AppForm = ({ parametros = {}, formData: externalFormData, setFormData: externalSetFormData }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const token_csrf = parametros.token_csrf || '';
        const base_url = parametros.base_url || [];
        const debugMyPrint = parametros.DEBUG_MY_PRINT || false;

        // Definindo o estado para controlar a aba ativa        const [showAlert, setShowAlert] = React.useState(false);
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
            busca_empresa: null,

            select_empresa: null,
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

            // Atualiza o estado interno do formulário
            internalSetFormData((prev) => ({
                ...prev,
                [name]: value,
            }));

            // Oculta a mensagem de erro, se houver
            setMessage((prev) => ({
                ...prev,
                show: false,
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
            <div className="container">
                <div className="w-100">

                    <AppEmpresaChecktMult
                        internalFormData={formData}
                        internalSetFormData={setFormData}
                        parametros={parametros}
                    />

                    {/* Exibe o componente de alerta */}
                    <AppMessage parametros={message} />
                </div>

            </div>
        );
    };

</script>