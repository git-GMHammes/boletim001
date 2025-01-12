<script type="text/babel">
    const AppMessageCard = ({ parametros = {}, modalId = {} }) => {

        const [showAlert, setShowAlert] = React.useState(false);
        const [alertType, setAlertType] = React.useState('');
        const [alertMessage, setAlertMessage] = React.useState('');

        React.useEffect(() => {
            if (parametros.show) {
                setShowAlert(true);
                setAlertType(parametros.type);
                setAlertMessage(parametros.message);

                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    try {
                        const modalInstance = new bootstrap.Modal(modalElement);
                        modalInstance.show();

                        // Listener para fechar o modal ao pressionar Tab
                        const handleTabPress = (event) => {
                            if (event.key === 'Tab') {
                                modalInstance.hide();
                            }
                        };

                        window.addEventListener('keydown', handleTabPress);
                        return () => {
                            window.removeEventListener('keydown', handleTabPress);
                        };
                    } catch (error) {
                        console.error("Erro ao inicializar o modal:", error);
                    }
                }
            }
        }, [parametros, modalId]);

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

        // console.log('AppMessageCard :: ', parametros);
        // console.log('showAlert :: ', showAlert);

        return (
            <div>
                <div className="modal fade m-0 p-0" id={modalId} tabIndex={-1} aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div className="modal-dialog modal-dialog-centered">
                        <div className="modal-content bg-dark">
                            <div className={`card ${getClassForType()}`} style={{ width: '100%', height: '100%', borderRadius: '0' }}>
                                <div className="card-body d-flex flex-column align-items-center m-3 p-3">
                                    <p
                                        className="card-text text-center"
                                        dangerouslySetInnerHTML={{ __html: alertMessage }}
                                    >
                                    </p>
                                    <button
                                        type="button"
                                        className="btn btn-outline-dark btn-sm m-2 p-2"
                                        data-bs-dismiss="modal"
                                        onClick={handleClose}
                                    >
                                        Ok
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    };

</script>