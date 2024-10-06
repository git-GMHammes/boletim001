<div class="app_exec_loading"></div>

<script type="text/babel">
    const AppExecLoading = (setParametros = {}) => {
        const tipoLoading = setParametros.tipoLoading || 'progress';
        const [carregando, setCarregando] = React.useState(true);
        const [progress, setProgress] = React.useState(0);

        React.useEffect(() => {
            let intervalId;
            if (carregando) {
                intervalId = setInterval(() => {
                    setProgress(prevProgress => {
                        if (prevProgress >= 100) {
                            return 0; // Reseta o progresso para 0 quando atingir 100
                        }
                        return prevProgress + 10; // Incrementa o progresso
                    });
                }, 1000); // Incrementa a cada 1 segundo
            }
            return () => clearInterval(intervalId);
        }, [carregando]);

        const handleStopLoading = () => {
            setCarregando(false); // Função que para o loop e define 'carregando' como false
        };

        const renderProgress = (progress = 0) => {
            return (
                <div className="w-100">
                    <div>
                        <div className="progress">
                            <div className="progress-bar" role="progressbar" style={{ width: `${progress}%` }} aria-valuenow={progress} aria-valuemin={0} aria-valuemax={100}>
                                {progress}%
                            </div>
                        </div>
                    </div>
                </div>
            );
        };

        const renderSpinners = () => {
            return (
                <div className="d-flex justify-content-center align-items-center min-vh-100">
                    <div className="spinner-border text-primary" role="status">
                        <span className="visually-hidden">Loading...</span>
                    </div>
                </div>
            );
        };

        return (
            <div>
                {carregando ? (
                    <div className="d-flex justify-content-center align-items-center min-vh-100">
                        {tipoLoading === 'progress' && renderProgress(progress)}
                        {tipoLoading === 'spinner' && renderSpinners()}
                    </div>
                ) : (
                    <div className="d-flex justify-content-center align-items-center min-vh-100">
                        Carregamento concluído!
                    </div>
                )}
                <div className="d-flex justify-content-center mt-3">
                    <input className="btn btn-primary" type="button" value="Parar Carregamento" onClick={handleStopLoading} />
                </div>
            </div>
        );
    };

    const rootElement = document.querySelector('.app_exec_loading');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppExecLoading />);
</script>