<script type="text/babel">
    const AppMessage = ({ parametros = {} }) => {
        const [showAlert, setShowAlert] = React.useState(parametros.show ?? false);
        const [alertType, setAlertType] = React.useState(parametros.type ?? '');
        const [alertMessage, setAlertMessage] = React.useState(parametros.message ?? '');
        const [startTransition, setStartTransition] = React.useState(false);

        const getClassForType = () => {
            switch (alertType) {
                case 'primary': return 'bg-primary text-white';
                case 'secondary': return 'bg-secondary text-white';
                case 'success': return 'bg-success text-white';
                case 'danger': return 'bg-danger text-white';
                case 'warning': return 'bg-warning text-dark';
                case 'info': return 'bg-info text-dark';
                case 'light': return 'bg-light text-dark';
                case 'dark': return 'bg-dark text-white';
                default: return 'bg-light text-white';
            }
        };

        const handleClose = () => {
            setShowAlert(false);
        };

        React.useEffect(() => {
            if (parametros.show) {
                setShowAlert(parametros.show);
                setAlertType(parametros.type);
                setAlertMessage(parametros.message);

                setTimeout(() => setStartTransition(true), 50);

                const timer = setTimeout(() => {
                    setStartTransition(false);
                    setShowAlert(false);
                }, 10000);

                return () => clearTimeout(timer);
            }
        }, [parametros]);

        const offcanvasStyles = {
            width: '355px',
            height: '555px',
            transition: 'transform 1s ease-in-out',
            transform: startTransition ? 'translateX(0)' : 'translateX(100%)',
            position: 'fixed',
            top: '10px',
            right: '0',
            zIndex: '1055'
        };

        return (
            showAlert && (
                <div className={`card p-2 ${getClassForType()}`} style={offcanvasStyles}>
                    <div className="card-body d-flex flex-column align-items-center p-2">
                        <div className="bg-light text-dark border border-dark rounded-3 p-2">
                            <p className="card-text text-center">{alertMessage}</p>
                            <button
                                type="button"
                                className="btn btn-outline-success btn-sm mt-3"
                                onClick={handleClose}
                            >
                                Ok
                            </button>
                        </div>

                    </div>
                </div>
            )
        );
    };
</script>