<script type="text/babel">
    const AppForm = ({ parametros = {}, formData: externalFormData, setFormData: externalSetFormData }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const token_csrf = parametros.token_csrf || '';
        const base_url = parametros.base_url || [];

        // Lista de APIs
        const api_empresa_exibir = parametros.api_empresa_exibir || '';
        const api_empresa_filtrar = parametros.api_empresa_filtrar || '';

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

            select_empresa: null,
            select_mult_empresa: [],
        });

        const submitAllForms = async (apiIdentifier) => {
            return apiIdentifier;
        };

        // Função fetch com try, catch, finally
        const fetchFilter = async (
            custonBaseURL = base_url,
            custonApiGetEmpresa = api_empresa_filtrar,
            customPage = getVar_page
        ) => {
            let setPost = internalFormData;
            try {
                const response = await fetch(custonBaseURL + custonApiGetEmpresa + customPage);

                response1 = await fetch(custonBaseURL + custonApiGetEmpresa + customPage, {
                    method: 'POST',
                    body: JSON.stringify(setPost),
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });

                if (response.ok) {
                    console.log("dataApi :: ", dataApi);
                } else {
                    console.error("Erro ao buscar dados :: ", response.status);
                }

                // Adaptando a resposta JSON para setar apenas o dbResponse
                const dataApi = await response.json();
                if (dataApi.result && dataApi.result.dbResponse) {
                    setEmpresas(dataApi.result.dbResponse);
                    console.log("Filtrar dados :: ", response.status);
                }

            } catch (error) {
                console.error("Erro na requisição: ", error);
            } finally {
                console.log("Requisição concluída.");
            }
        };

        // Função fetch com try, catch, finally
        const fetchEmpresa = async (
            custonBaseURL = base_url,
            custonApiGetEmpresa = api_empresa_exibir,
            customPage = getVar_page
        ) => {
            console.log('URL: ', custonBaseURL + custonApiGetEmpresa + customPage);
            try {
                const response = await fetch(custonBaseURL + custonApiGetEmpresa + customPage);
                // console.log('response: ', response);

                if (response.ok) {
                    const dataApi = await response.json();
                    // console.log('dataApi :: ', dataApi);

                    // Adaptando a resposta JSON para setar apenas o dbResponse
                    setEmpresas(dataApi.result.dbResponse);
                    setPaginacaoLista(dataApi.result.linksArray);
                } else {
                    console.error("Erro ao buscar dados: ", response.status);
                }
            } catch (error) {
                console.error("Erro na requisição: ", error);
            } finally {
                console.log("Requisição concluída.");
            }
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

                    <AppEmpresaSelectMult
                        internalFormData={formData}
                        internalSetFormData={setFormData}
                        parametros={parametros}
                        fetchFilter={fetchFilter}
                        fetchEmpresa={fetchEmpresa}
                    />

                    {/* Exibe o componente de alerta */}
                    <AppMessage parametros={message} />
                </div>

            </div>
        );
    };

</script>