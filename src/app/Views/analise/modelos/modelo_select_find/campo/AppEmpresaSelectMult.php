<script type="text/babel">
    const AppEmpresaSelectMult = ({ internalFormData = {}, internalSetFormData = {}, parametros = {}, fetchFilter = () => { }, fetchEmpresa = () => { }}) => {

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

        // Função para simular o comportamento de "Ctrl" ao focar
        const handleFocus = (event) => {
            setMessage((prev) => ({
                ...prev,
                show: false,
            }));
        };

        const handleChange = (event) => {
            const { name, value } = event.target;

            // Obtém os valores atualmente selecionados
            let currentSelection = internalFormData[name] || [];

            if (currentSelection.includes(value)) {
                // Se já estiver selecionado, remove o valor
                currentSelection = currentSelection.filter((item) => item !== value);
            } else {
                // Se não estiver selecionado, adiciona o valor
                currentSelection.push(value);
            }

            console.log('Valores selecionados:', currentSelection);

            // Atualiza o estado com os valores selecionados
            internalSetFormData((prev) => ({
                ...prev,
                [name]: currentSelection,
            }));
        };

        // Função handleBlur - Perde o foco
        const handleBlur = (event) => {
            const { name } = event.target;
            console.log(`Campo ${name} perdeu o foco.`);
        };

        return (
            <div>
                <select
                    className="form-select form-select-sm w-100"
                    name="select_mult_empresa"
                    multiple
                    onFocus={handleFocus} // Foco para ativar o "Ctrl"
                    onChange={handleChange} // Captura as mudanças de seleção
                    onBlur={handleBlur} // Sai do foco e desativa a simulação do "Ctrl"
                    value={internalFormData.select_mult_empresa || []}
                >
                    <option value="" disabled>
                        Open this select menu
                    </option>
                    <option value="1">Valor 1</option>
                    <option value="2">Valor 2</option>
                    <option value="3">Valor 3</option>
                    <option value="4">Valor 4</option>
                    <option value="5">Valor 5</option>
                    <option value="6">Valor 6</option>
                    <option value="7">Valor 7</option>
                    <option value="8">Valor 8</option>
                </select>

                {showEmptyMessage && (
                    <span style={{ color: 'red', fontSize: '12px' }}>
                        Nome inválido. Por favor, insira um nome contendo apenas letras.
                    </span>
                )}

                {/* Componente de mensagem para exibição de alertas */}
                <AppMessage parametros={message} modalId="modal_nome" />
            </div>
        );

    };
</script>