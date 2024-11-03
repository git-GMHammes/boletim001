<script type="text/babel">
    const AppMessage = ({ parametros = {} }) => {

        // console.log('parametros: ', parametros);
        // Estado para controlar o alerta
        const [showAlert, setShowAlert] = React.useState(parametros.show ?? false);
        const [alertType, setAlertType] = React.useState(parametros.type ?? '');
        const [alertMessage, setAlertMessage] = React.useState(parametros.message ?? '');
        const [startTransition, setStartTransition] = React.useState(false);

        const handleBlur = (event) => {
            const { name, value } = event.target;
            // Zera o valor do campo de data de admissão
            setFormData((prev) => ({
                ...prev,
                DataAdmissao: ''
            }));
        }

        // Função para exibir o alerta (success, danger, warning, info)
        React.useEffect(() => {
            if (parametros.show) {
                setShowAlert(parametros.show);
                setAlertType(parametros.type);
                setAlertMessage(parametros.message);

                // Inicia a transição após o componente ser renderizado
                setTimeout(() => {
                    setStartTransition(true);
                }, 50);

                // Oculta o alerta após 5 segundos
                setTimeout(() => {
                    setStartTransition(false);
                    setShowAlert(false);
                }, 5000);
            }
        }, [parametros]);

        const offcanvasStyles = {
            width: '250px',
            height: '150px',
            transition: 'transform 1s ease-in-out',
            transform: startTransition ? 'translateX(0)' : 'translateX(100%)',
            position: 'fixed',
            top: '10px',
            right: '0',
            zIndex: '1055'
        };

        return (
            showAlert && (
                <div className={`bg-${alertType} text-white p-3`} style={offcanvasStyles}>
                    {alertMessage}
                </div>
            )
        );
    };

</script>