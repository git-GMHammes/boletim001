<script type="text/babel">
    const AppDataCriacao = ({ formData = {}, setFormData = () => { }, parametros = {}, submitAllForms }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const origemForm = parametros.origemForm || '';

        // Calcula a data atual
        const dataAtual = new Date();

        // Calcula a data mínima (70 anos no passado) e a data máxima (hoje)
        const calcularDataLimite = (anos) => {
            const data = new Date(dataAtual);
            data.setFullYear(dataAtual.getFullYear() + anos);
            return data.toISOString().split('T')[0];
        };

        const dataMinima = calcularDataLimite(-70);
        const dataMaxima = calcularDataLimite(0);

        // Estado para mensagens e validação
        const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        // Função handleFocus - Foco no objeto
        const handleFocus = () => {
            setMessage((prev) => ({
                ...prev,
                show: false
            }));
            setShowEmptyMessage(false); // Oculta a mensagem "Campo Obrigatório" ao focar
        };

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        // Função handleBlur para validar o campo de data
        const handleBlur = async (event) => {
            const { name, value } = event.target;

            // Verifica se o campo está vazio
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

            // Validação de intervalo de datas
            const dataSelecionada = new Date(value);
            const min = new Date(dataMinima);
            const max = new Date(dataMaxima);

            if (dataSelecionada < min) {
                setMessage({
                    show: true,
                    type: 'warning',
                    message: 'A Data inicio não pode ter menos de 70 anos'
                });
                setFormData((prev) => ({
                    ...prev,
                    [name]: ''
                }));
                console.log('Data fora do intervalo permitido: antes do limite mínimo');
            } else if (dataSelecionada > max) {
                setMessage({
                    show: true,
                    type: 'warning',
                    message: 'A Data inicio não pode ser superior a hoje'
                });
                setFormData((prev) => ({
                    ...prev,
                    [name]: ''
                }));
                console.log('Data fora do intervalo permitido: depois do limite máximo');
            } else {
                await submitAllForms(`filtro-${origemForm}`);
                console.log('Data dentro do intervalo permitido');
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
                    <label htmlFor="data_criacao" style={formLabelStyle} className="form-label">#Data Criação<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="date"
                        id="data_criacao"
                        name="data_criacao"
                        value={formData.data_criacao || ''}
                        min={dataMinima}
                        max={dataMaxima}
                        onFocus={handleFocus}
                        onChange={handleChange}
                        onBlur={handleBlur}
                        style={formControlStyle}
                        className="form-control"
                        disabled={formData.id === null ? true : false}
                    />
                </div>
                {showEmptyMessage && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        O Campo não pode estar em branco
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_data_criacao" />
            </div>
        );
    };
</script>