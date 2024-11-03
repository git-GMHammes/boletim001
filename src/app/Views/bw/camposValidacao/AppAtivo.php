<script type="text/babel">
    const AppAtivo = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const origemForm = parametros.origemForm || '';

        // Estado para mensagens e validação
        const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);

        // Função handleFocus - Foco no objeto
        const handleFocus = (event) => {
            const { name, value } = event.target;
            console.log('name handleFocus:', name);
            console.log('value handleFocus:', value);

            // Oculta a mensagem "Campo Obrigatório" ao focar
            setShowEmptyMessage(false);
        };

        // Função handleChange para atualizar o estado do campo "ativo"
        const handleChange = (event) => {
            const { name, value } = event.target;

            setFormData((prev) => ({
                ...prev,
                [name]: parseInt(value)
            }));
        };

        // Função handleBlur para verificar se o campo "ativo" foi selecionado
        const handleBlur = () => {
            // Verifica se nenhum valor foi selecionado
            if (formData.ativo === undefined) {
                setShowEmptyMessage(true);
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
                <label htmlFor="ativo" style={formLabelStyle} className="form-label">#Ativo<strong style={requiredField}>*</strong></label>
                    <div>
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
                    </div>
                </div>

                {showEmptyMessage && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Campo Obrigatório, escolha sim ou Não
                    </span>
                )}
            </div>
        );
    };
</script>