<script type="text/babel">
    const AppMessage = ({ setParametros = {} }) => {

        console.log('setParametros: ', setParametros);
        // Estado para controlar o alerta
        const [showAlert, setShowAlert] = React.useState(setParametros.show ?? false);
        const [alertType, setAlertType] = React.useState(setParametros.type ?? '');
        const [alertMessage, setAlertMessage] = React.useState(setParametros.message ?? '');
        const [startTransition, setStartTransition] = React.useState(false);

        // Função para exibir o alerta (success, danger, warning, info)
        React.useEffect(() => {
            if (setParametros.show) {
                setShowAlert(setParametros.show);
                setAlertType(setParametros.type);
                setAlertMessage(setParametros.message);

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
        }, [setParametros]);


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