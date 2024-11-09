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
                }, 50000);

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
                    <div className="card-body d-flex flex-column justify-content-center align-items-center h-100">
                        <div className="bg-light text-dark border border-dark rounded-3 p-2 text-center w-100">
                            <div className="bg-light text-dark border border-dark rounded-3 p-4 text-center w-100">
                                <div>
                                    <div className="row">
                                        <div className="col-12 col-sm-12 m-5 p-4">
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div className="row">
                                        <div className="col-12 col-sm-12 m-1 p-1">
                                            <p className="card-text">{alertMessage}</p>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div className="row">
                                        <div className="col-12 col-sm-12 m-5 p-4">
                                            &nbsp;
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div className="row">
                                        <div
                                            className="col-12 col-sm-4">
                                            <button type="button"
                                                className="btn btn-outline-dark btn-sm"
                                                onClick={handleClose}
                                            >
                                                <i className="bi bi-app"></i>
                                            </button>
                                        </div>
                                        <div className="col-12 col-sm-4">
                                            <button
                                                type="button"
                                                className="btn btn-outline-dark btn-sm"
                                                onClick={handleClose}
                                            >
                                                <i className="bi bi-circle"></i>
                                            </button>
                                        </div>
                                        <div
                                            className="col-12 col-sm-4">
                                            <button type="button"
                                                className="btn btn-outline-dark btn-sm"
                                                onClick={handleClose}
                                            >
                                                <i className="bi bi-caret-left"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            )
        );
    };
</script>