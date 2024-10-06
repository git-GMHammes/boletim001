<div class="app_exec_api"></div>

<script type="text/babel">
    const AppExectApi = () => {
        const url_api_pessoas = 'https://fakerapi.it/api/v1/persons?_locale=pt_PT&_quantity=3';

        // Listas
        const [persons, setPersons] = React.useState([]);

        // React.useEffect
        React.useEffect(() => {
            console.log('React.useEffect - Carregar Dados Iniciais');

            // Função para carregar todos os dados necessários
            const loadData = async () => {
                console.log('loadData iniciando...');
                // 
                try {
                    // Chama as funções de fetch para carregar os dados
                    await fetchData();
                } catch (error) {
                    console.error('Erro ao carregar dados:', error);
                } finally {
                    console.log("Fim do useEffect");
                }
            };

            loadData();
        }, []);

        const fetchData = async () => {
            try {
                const response = await fetch(url_api_pessoas);
                const data = await response.json();
                console.log("Dados Pessoas: ", data)
                setPersons(data.data);
            } catch (error) {
                console.error('Erro ao buscar dados:', error);
            }
        };

        return (
            <div>
                <div className="d-flex justify-content-center align-items-center min-vh-100">
                    <table className="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Aniversário</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefone</th>
                            </tr>
                        </thead>
                        <tbody>
                            {persons.map((person, index) => (
                                <tr key={person.id}>
                                    <th scope="row">{index + 1}</th>
                                    <td>{`${person.firstname} ${person.lastname}`}</td>
                                    <td>{person.birthday}</td>
                                    <td>{person.email}</td>
                                    <td>{person.phone}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        );

    }
    const rootElement = document.querySelector('.app_exec_api');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppExectApi />); 
</script>
<?php
$parametros_backend = array();
?>