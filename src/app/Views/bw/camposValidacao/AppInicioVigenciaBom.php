<script type="text/babel">
    const AppInicioVigenciaBom = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const origemForm = parametros.origemForm || '';

        // Calcula a data atual
        const dataAtual = new Date();

        // Calcula a data mínima (30 dias no passado) e a data máxima (30 dias no futuro)
        const calcularDataLimite = (dias) => {
            const data = new Date(dataAtual);
            data.setDate(dataAtual.getDate() + dias);
            return data.toISOString().split('T')[0];
        };

        const dataMinima = calcularDataLimite(-30); // 30 dias antes da data atual
        const dataMaxima = calcularDataLimite(30);  // 30 dias depois da data atual

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
        const handleBlur = (event) => {
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
                    message: 'O Sistema não pode ter seu cadastro a menos de 30 dias no passado'
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
                    message: 'O Sistema não pode ter seu cadastro a maior do que 30 dias no futuro'
                });
                setFormData((prev) => ({
                    ...prev,
                    [name]: ''
                }));
                console.log('Data fora do intervalo permitido: depois do limite máximo');
            } else {
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
                    <label htmlFor="inicio_vigencia_bom" style={formLabelStyle} className="form-label">#Início Vigência BOM<strong style={requiredField}>*</strong></label>
                    <input
                        data-api={`filtro-${origemForm}`}
                        type="date"
                        id="inicio_vigencia_bom"
                        name="inicio_vigencia_bom"
                        value={formData.inicio_vigencia_bom || ''}
                        min={dataMinima}
                        max={dataMaxima}
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
                        O Campo não pode estar em branco
                    </span>
                )}

                {/* Exibe o componente de alerta */}
                <AppMessage parametros={message} modalId="modal_inicio_vigencia_bom" />
            </div>
        );
    };
</script>