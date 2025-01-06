<script type="text/babel">
    const AppSelect = (
        {
            parametros = {},
            formData = {},
            setFormData = () => { },
            fieldAttributes = {},
        }
    ) => {
        // Variáveis recebidas do Backend
        const objetoArrayKey = fieldAttributes.objetoArrayKey || [];
        const [objetoGet, setObjetoGet] = React.useState([]);
        const [objetoPost, setObjetoPost] = React.useState([]);
        const [objetoFilter, setObjetoFilter] = React.useState([]);
        const [objetoMapKey, setObjetoMapKey] = React.useState([]);

        // Attributes of APIs
        const api_get = fieldAttributes.api_get || 'api/get';
        const api_post = fieldAttributes.api_post || 'api/post';
        const api_filter = fieldAttributes.api_filter || 'api/filter';

        console.log('api_get', api_get);
        console.log('api_post', api_post);
        console.log('api_filter', api_filter);

        // Simula carregamento de dados
        React.useEffect(() => {
            setObjetoMapKey(objetoArrayKey);
        }, [objetoArrayKey]);

        return (
            <div>
                <div>
                    AppSelect
                </div>
                <div>
                    <label
                        htmlFor="dynamicSelect"
                        className="form-label"
                    >
                        Escolha uma opção:
                    </label>
                    <select
                        id="dynamicSelect"
                        className="form-select"
                    >
                        <option value="" disabled selected>Selecione uma opção</option>
                        {objetoMapKey.map((item) => (
                            <option key={item.key} value={item.key}>
                                {item.value}
                            </option>
                        ))}
                    </select>
                </div>
            </div>
        );
    };
</script>