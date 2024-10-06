<div class="app_exec_api"></div>

<script type="text/babel">
    const AppExecLoading = (setParametros = {}) => {
        const tipoLoading = setParametros.tipoLoading || 'progress';
        const [carregando, setCarregando] = React.useState(true);
        const [progress, setProgress] = React.useState(0);

        // A lógica aumenta o progresso em 10% a cada segundo por 10 segundos e então desliga o estado 'carregando'.
        React.useEffect(() => {
            const loadData = async () => {
                try {
                    for (let i = 1; i <= 10; i++) {
                        await new Promise(resolve => setTimeout(resolve, 1000));
                        setProgress(prevProgress => Math.min(prevProgress + 10, 100));
                    }
                    setCarregando(false);
                } catch (error) {
                    console.error('Erro ao carregar dados:', error);
                } finally {
                    console.log('Fim do processo de carregamento.');
                }
            };

            loadData();
        }, []);

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
                <div className="w-100">
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
            </div>
        );
    };

    const rootElement = document.querySelector('.app_exec_api');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppExecLoading />);
</script>