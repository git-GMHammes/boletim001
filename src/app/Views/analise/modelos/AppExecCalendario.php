<?php
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
    'base_api_calendario' => 'analise/modelo/api/diasmes',
);
?>

<div class="app_exec_calendario" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppExecCalendario = ({ setParametros = {} }) => {
        // Definindo valores a partir de setParametros ou valores default

        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_exec_calendario').getAttribute('data-result'));

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
        const base_api_calendario = parametros.base_api_calendario;

        const [anoMes, setAnoMes] = React.useState({
            ano: new Date().getFullYear(),
            mes: String(new Date().getMonth() + 1).padStart(2, '0')
        });

        const getDiasSemana = () => {
            // Verifica se a largura da janela é menor que 600px
            if (window.innerWidth < 600) {
                console.log('getDiasSemana pequeno');
                return ["D", "S", "T", "Q", "Q", "S", "S"];
            } else {
                console.log('getDiasSemana GRANDE');
                return ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"];
            }
        };

        const [anoCalendario, setAnoCalendario] = React.useState(null);
        const [mesCalendario, setMesCalendario] = React.useState(null);
        const [diasCalendario, setDiasCalendario] = React.useState([]);
        const [diasSemana, setDiasSemana] = React.useState(getDiasSemana());

        // Função que faz o fetch da API com base no ano e mês
        const fetchCalendario = async () => {
            console.log('Passon... fetchCalendario... ');
            try {
                const response = await fetch(`${base_url}${base_api_calendario}/${anoMes.ano}/${anoMes.mes}`);
                const data = await response.json();
                if (data.status === 'success' && data.result && data.result.dias) {
                    console.log('data.result: ', data.result.dias)
                    setDiasCalendario(data.result.dias);
                }
                if (data.status === 'success' && data.result && data.result.ano) {
                    console.log('data.result: ', data.result.ano)
                    setAnoCalendario(data.result.ano);
                }
                if (data.status === 'success' && data.result && data.result.mes) {
                    console.log('data.result: ', data.result.mes)
                    setMesCalendario(data.result.mes);
                }
            } catch (error) {
                console.error("Erro ao carregar o calendário:", error);
            }
        };

        // Função para alterar o ano
        const handleAnoChange = (operacao) => {
            setAnoMes((prevAnoMes) => {
                const novoAno = operacao === 'incrementar' ? prevAnoMes.ano + 1 : prevAnoMes.ano - 1;
                console.log('Novo Ano: ', novoAno);  // Para verificar no console
                return { ...prevAnoMes, ano: novoAno };
            });
        };

        // Função para alterar o mês
        const handleMesChange = (operacao) => {
            setAnoMes((prevAnoMes) => {
                let novoMes = parseInt(prevAnoMes.mes);
                let novoAno = prevAnoMes.ano;

                if (operacao === 'incrementar') {
                    novoMes += 1;
                    if (novoMes > 12) {
                        novoMes = 1;
                        novoAno += 1;  // Avança o ano após o mês 12
                    }
                } else {
                    novoMes -= 1;
                    if (novoMes < 1) {
                        novoMes = 12;
                        novoAno -= 1;  // Retrocede o ano quando o mês vai para antes de janeiro
                    }
                }

                console.log('Novo Mês: ', novoMes, 'Novo Ano: ', novoAno);  // Verificando no console
                return { ano: novoAno, mes: String(novoMes).padStart(2, '0') };
            });
        };

        React.useEffect(() => {
            const handleResize = () => {
                setDiasSemana(getDiasSemana());
            };

            // Adiciona o listener de resize
            window.addEventListener('resize', handleResize);

            // Remove o listener ao desmontar o componente
            return () => {
                window.removeEventListener('resize', handleResize);
            };
        }, []);

        React.useEffect(() => {
            console.log('Passon... React.useEffect ... ');
            fetchCalendario();
        }, [anoMes]);

        // Função que renderiza o calendário começando por domingo
        const renderCalendario = () => {
            let calendario = [];
            let semana = [];

            diasCalendario.forEach((cal_map, index) => {
                semana.push(
                    <td key={index} className={`text-center ${cal_map.semana === 'domingo' || cal_map.semana === 'sábado' ? 'text-secondary' : 'text-dark'}`}>
                        <a className={`btn btn-outline-${cal_map.semana === 'domingo' || cal_map.semana === 'sábado' ? 'danger' : 'dark'} btn-sm rounded-circle`}
                            href="#"
                            role="button"
                            disabled={cal_map.mes !== mesCalendario ? true : null}>
                            {cal_map.dia}
                        </a>
                    </td>
                );

                // Após completar uma semana (7 dias) ou no último dia do mês, adicionar a linha ao calendário
                if (semana.length === 7 || index === diasCalendario.length - 1) {
                    calendario.push(<tr key={`week-${index}`}>{semana}</tr>);
                    semana = [];
                }
            });

            return calendario;
        };

        return (
            <div className="className mt-5">
                <div>
                    <div className="text-center fs-2 text">
                        AGENDAMENTOS
                    </div>

                    <div className="text-center fs-2 text">
                        <button type="button" className="btn btn-sm" onClick={() => handleAnoChange('decrementar')}>
                            <i className="bi bi-arrow-bar-left"></i>
                        </button>
                        &emsp; {anoCalendario} &emsp;
                        <button type="button" className="btn btn-sm" onClick={() => handleAnoChange('incrementar')}>
                            <i className="bi bi-arrow-bar-right"></i>
                        </button>
                    </div>

                    <div className="text-center fs-2 text">
                        <button type="button" className="btn btn-sm" onClick={() => handleMesChange('decrementar')}>
                            <i className="bi bi-chevron-double-left"></i>
                        </button>
                        &emsp; {mesCalendario} &emsp;
                        <button type="button" className="btn btn-sm" onClick={() => handleMesChange('incrementar')}>
                            <i className="bi bi-chevron-double-right"></i>
                        </button>
                    </div>

                    <div className="container border border-dark">
                        <table className="table table-hover">
                            <thead>
                                <tr>
                                    {diasSemana.map((dia, index) => (
                                        <th key={index} scope="col">
                                            <div className="text-center">
                                                {dia}
                                            </div>
                                        </th>
                                    ))}
                                </tr>
                            </thead>
                            <tbody>
                                {renderCalendario()}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        );
    };

    const rootElement = document.querySelector('.app_exec_calendario');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppExecCalendario />);
</script>