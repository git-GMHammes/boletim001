<script type="text/babel">
    const AppAtivo = ({ formData = {}, setFormData = () => { }, parametros = {}, submitAllForms }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const origemForm = parametros.origemForm || '';

        // Estado para mensagens e validação
        const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);

        // Função handleFocus - Foco no objeto
        const handleFocus = () => {
            setShowEmptyMessage(false); // Oculta a mensagem "Campo Obrigatório" ao focar
        };

        // Função handleChange simplificada para atualizar o valor do campo
        const handleChange = (event) => {
            const { name, value } = event.target;

            // Converte o valor para número e atualiza o estado
            setFormData((prev) => ({
                ...prev,
                [name]: parseInt(value, 10)
            }));
        };

        // Função handleBlur para verificar a seleção do campo
        const handleBlur = async () => {
            // Verifica se o valor não foi selecionado
            if (formData.ativo !== 1 && formData.ativo !== 0) {
                setShowEmptyMessage(true);
            } else {
                setShowEmptyMessage(false);
                await submitAllForms(`filtro-${origemForm}`);
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

        return (
            <div style={formGroupStyle}>
                <label style={formLabelStyle} className="form-label">#Ativo<strong style={requiredField}>*</strong></label>
                <div className="d-flex justify-content-start p-1">
                    <div className="form-check">
                        <input
                            data-api={`filtro-${origemForm}`}
                            className="form-check-input"
                            type="radio"
                            id="ativoSim"
                            name="ativo"
                            value="1"
                            checked={formData.ativo === 1}
                            onFocus={handleFocus}
                            onChange={handleChange}
                            onBlur={handleBlur}
                        />
                        <label className="form-check-label" htmlFor="ativoSim">Sim</label>
                    </div>&emsp;/&emsp;
                    <div className="form-check">
                        <input
                            data-api={`filtro-${origemForm}`}
                            className="form-check-input"
                            type="radio"
                            id="ativoNao"
                            name="ativo"
                            value="0"
                            checked={formData.ativo === 0}
                            onFocus={handleFocus}
                            onChange={handleChange}
                            onBlur={handleBlur}
                        />
                        <label className="form-check-label" htmlFor="ativoNao">Não</label>
                    </div>
                </div>
                {showEmptyMessage && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Campo Obrigatório, escolha Sim ou Não
                    </span>
                )}
            </div>
        );
    };
</script>