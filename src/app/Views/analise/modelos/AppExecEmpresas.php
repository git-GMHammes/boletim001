<?php
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
    'api_empresa_exibir' => 'bw/empresa/api/exibir',
);
?>

<div class="app_exec_empresa" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppExecEmpresa = () => {

        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_exec_empresa').getAttribute('data-result'));

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;
        const api_empresa_exibir = parametros.api_empresa_exibir;

        // Estado para armazenar empresas da API
        const [empresas, setEmpresas] = React.useState([]);

        // Função fetch com try, catch, finally
        const fetchEmpresa = async () => {
            try {
                const response = await fetch(`${base_url}/${api_empresa_exibir}`);
                if (response.ok) {
                    const data = await response.json();
                    // Adaptando a resposta JSON para setar apenas o dbResponse
                    setEmpresas(data.result.dbResponse);
                } else {
                    console.error("Erro ao buscar dados: ", response.status);
                }
            } catch (error) {
                console.error("Erro na requisição: ", error);
            } finally {
                console.log("Requisição concluída.");
            }
        };

        // useEffect para acionar a função fetch ao carregar o componente
        React.useEffect(() => {
            const carregarDados = async () => {
                await fetchEmpresa();
                // Aqui pode-se chamar qualquer outra função auxiliar no futuro
            };
            carregarDados();
        }, []);

        return (
            <div>
                <table className="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Responsável</th>
                            <th scope="col">Email Contato</th>
                        </tr>
                    </thead>
                    <tbody>
                        {empresas.length > 0 ? empresas.map((empresa, index) => (
                            <tr key={index}>
                                <td>{empresa.nome}</td>
                                <td>{empresa.responsavel}</td>
                                <td>{empresa.email_contato}</td>
                            </tr>
                        )) : (
                            <tr>
                                <td colSpan="3">Nenhum dado disponível</td>
                            </tr>
                        )}
                    </tbody>
                </table>
            </div>
        );

    }
    const rootElement = document.querySelector('.app_exec_empresa');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppExecEmpresa />);

</script>
<?php
$parametros_backend = array();
?>