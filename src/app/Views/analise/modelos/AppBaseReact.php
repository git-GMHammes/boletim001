<?php
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
);
?>

<div class="app_tab" data-result='<?php echo json_encode($parametros_backend); ?>' style="display: none;"></div>

<script type="text/babel">
    const AppTab = () => {

        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_tab').getAttribute('data-result'));

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;

        // Função que retorna uma tabela
        const renderTable = ({ parametros = {} } = {}) => {
            return (
                <table className="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Idade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>João</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Ana</td>
                            <td>22</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Carlos</td>
                            <td>30</td>
                        </tr>
                    </tbody>
                </table>
            );
        };

        return (
            <div>
                {renderTable()}
            </div>
        );
    }
    ReactDOM.render(<AppTab />, document.querySelector('.app_tab'));
</script>

<div class="app_baseReact" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const AppBaseReact = () => {

        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_baseReact').getAttribute('data-result'));

        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;

        // Definindo o estado para controlar a aba ativa
        const [tabNav, setTabNav] = React.useState('aba1');

        // Função para trocar de aba
        const handleTabClick = (tab) => {
            setTabNav(tab); // Atualiza a aba selecionada
        };

        // Função que retorna um formulário
        const renderForm = () => {
            return (
                <form>
                    <div className="mb-3">
                        <label htmlFor="nome" className="form-label">Nome</label>
                        <input type="text" className="form-control" id="nome" />
                    </div>
                    <div className="mb-3">
                        <label htmlFor="email" className="form-label">Email</label>
                        <input type="email" className="form-control" id="email" />
                    </div>
                    <button type="submit" className="btn btn-primary">Enviar</button>
                </form>
            );
        };

        // Função que retorna um texto
        const renderText = () => {
            return (
                <div>
                    <h4>Bem-vindo à Aba 3</h4>
                    <p>Este é um exemplo de conteúdo textual para a terceira aba.</p>
                </div>
            );
        };

        // Nova constante de estilo para o texto "Footer"
        const headerTextStyle = {
            backgroundImage: 'linear-gradient(to right, #14007A, #330033)',
            color: 'white',
            textDecoration: 'none',
            padding: '10px'
        };

        const linkText = {
            textDecoration: 'none'
        }

        return (
            <div>
                <div className="d-flex justify-content-center align-items-center min-vh-100">
                    <div className="container">
                        <ul className="nav nav-tabs border border-top-0 border-start-0 border-end-0 rounded-top">
                            <li className="nav-item">
                                <a
                                    className={`nav-link ${tabNav === 'aba1' ? 'active' : ''}`}
                                    href="#"
                                    onClick={() => handleTabClick('aba1')}
                                >
                                    Aba 1
                                </a>
                            </li>
                            <li className="nav-item">
                                <a
                                    className={`nav-link ${tabNav === 'aba2' ? 'active' : ''}`}
                                    href="#"
                                    onClick={() => handleTabClick('aba2')}
                                >
                                    Aba 2
                                </a>
                            </li>
                            <li className="nav-item">
                                <a
                                    className={`nav-link ${tabNav === 'aba3' ? 'active' : ''}`}
                                    href="#"
                                    onClick={() => handleTabClick('aba3')}
                                >
                                    Aba 3
                                </a>
                            </li>
                        </ul>

                        {/* Carrega todas as funções acima */}
                        <div className="border border-top-0 rounded-bottom p-3">
                            {tabNav === 'aba1' && <AppTab parametros={parametros} />}
                            {tabNav === 'aba2' && renderForm()}
                            {tabNav === 'aba3' && renderText()}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
    const rootElement = document.querySelector('.app_baseReact');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppBaseReact />);
</script>
<?php
$parametros_backend = array();
?>