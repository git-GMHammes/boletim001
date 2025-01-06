<script type="text/babel">
    const AppSelectMultipleCtr = (
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

        console.log('objetoArrayKey', objetoArrayKey);

        // Attributes of APIs
        const [attributeGet, setAttributeGet] = React.useState('');
        const [attributePost, setAttributePost] = React.useState('');
        const [attributeFilter, setAttributeFilter] = React.useState('');

        // Simula carregamento de dados
        React.useEffect(() => {
            setAttributeGet(attributeGet.api_get || 'api/get');
            setAttributePost(attributePost.api_post || 'api/post');
            setAttributeFilter(attributeFilter.api_filter || 'api/filter');
        }, [
            attributeGet,
            attributePost,
            attributeFilter,
        ]);

        return (
            <div>
                AppSelectMultipleCtr
            </div >
        );
    };
</script>