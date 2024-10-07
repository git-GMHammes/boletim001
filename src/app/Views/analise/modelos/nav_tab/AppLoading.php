<script type="text/babel">
    const AppLoading = ({ setParametros = {} }) => {
        // Definindo valores a partir de setParametros ou valores default
        const tipoLoading = setParametros?.tipoLoading ?? 'spinner';
        const carregando = setParametros?.carregando ?? true;
        const [progress, setProgress] = React.useState(0);

        console.log('carregando: ', carregando);
        console.log('tipoLoading: ', tipoLoading);

        React.useEffect(() => {
            let intervalId;
            if (carregando && tipoLoading === 'progress') {
                intervalId = setInterval(() => {
                    setProgress(prevProgress => {
                        if (prevProgress >= 100) {
                            return 0;
                        }
                        return prevProgress + 10;
                    });
                }, 1000);
            }
            return () => clearInterval(intervalId);
        }, [carregando, tipoLoading])

        const renderProgress = (progress = 0) => {
            return (
                <div>
                    <div className="d-flex justify-content-center">
                        <div className="progress w-100">
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
                <div className="d-flex justify-content-center">
                    <div className="spinner-border text-primary" role="status">
                        <span className="visually-hidden">Loading...</span>
                    </div>
                </div>
            );
        };

        return (
            <div>
                {carregando ? (
                    <div>
                        {/* Renderiza "progress" ou "spinner" dependendo de 'tipoLoading' */}
                        {tipoLoading === 'progress' ? renderProgress(progress) : renderSpinners()}
                    </div>
                ) : null}  {/* Não renderiza nada após o carregamento */}
            </div>
        );
    };

</script>