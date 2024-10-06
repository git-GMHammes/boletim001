<script type="text/babel">
    
    const AppBaseReact = () => {
        const [persons, setPersons] = React.useState([]);

        React.useEffect(() => {
            const url = 'https://fakerapi.it/api/v1/persons?_locale=pt_PT&_quantity=10';

            const fetchData = async () => {
                try {
                    const response = await fetch(url);
                    const data = await response.json();
                    setPersons(data.data); // Armazena os dados recebidos
                } catch (error) {
                    console.error('Erro ao buscar dados:', error);
                }
            };

            fetchData(); // Chama a função assim que o componente é montado
        }, []);

        return (
            <div>
                Teste
            </div>
        );
    }

</script>