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

        // Field Attributes
        const label = fieldAttributes.label || 'AppTextLabel';
        const name = fieldAttributes.name || 'AppTextName';
        const attributeRequired = fieldAttributes.attributeRequired || false;
        const attributeReadOnly = fieldAttributes.attributeReadOnly || false;
        const attributeDisabled = fieldAttributes.attributeDisabled || false;

        // Attributes of APIs
        const api_get = fieldAttributes.api_get || 'api/get';
        const api_post = fieldAttributes.api_post || 'api/post';
        const api_filter = fieldAttributes.api_filter || 'api/filter';

        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        console.log('api_get', api_get);
        console.log('api_post', api_post);
        console.log('api_filter', api_filter);

        // Função handleFocus para receber foco
        const handleFocus = (event) => {
            const { name, value } = event.target;

            console.log('handleFocus: ', name);
            console.log('handleFocus: ', value);

            setMessage({ show: false, type: null, message: null });

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));

            // Verifica se a mudança de campo
            if (name === 'variavel_001') {
                console.log('variavel_001');
                // submitAllForms('filtro-api');
            }
        };

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;

            console.log('handleChange: ', name);
            console.log('handleChange: ', value);

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));

            // Verifica se a mudança é no campo 'variavel_001'
            if (name === 'variavel_001') {
                console.log('variavel_001');
                // submitAllForms('filtro-api');
            }
            setMessage({ show: false, type: null, message: null });
        };

        // Função que executa após a retirada do foco
        const handleBlur = (event) => {
            const { name, value } = event.target;

            console.log('name handleBlur: ', name);
            console.log('value handleBlur: ', value);

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));

            // Verifica se a mudança é no campo 'variavel_001'
            if (name === 'variavel_001') {
                console.log('variavel_001');
                // submitAllForms('filtro-api');
            }
            setMessage({ show: false, type: null, message: null });
        }

        // Simula carregamento de dados
        React.useEffect(() => {
            setObjetoMapKey(objetoArrayKey);
        }, [objetoArrayKey]);

        // Style 
        const formGroupStyle = {
            position: 'relative',
            marginTop: '20px',
            padding: '5px',
            borderRadius: '8px',
            border: '1px solid #000',
        };

        const formLabelStyle = {
            position: 'absolute',
            top: '-15px',
            left: '20px',
            backgroundColor: 'white',
            padding: '0 5px',
        };

        const requiredField = {
            color: '#FF0000',
        };

        const fontErro = {
            fontSize: '0.7em',
        };

        const formControlStyle = {
            fontSize: '1rem',
            borderColor: '#fff',
        };

        return (
            <div>
                <div>
                    AppSelect
                </div>
                <div style={formGroupStyle}>
                    <label
                        htmlFor="dynamicSelect"
                        style={formLabelStyle}
                        className="form-label"
                    >
                        {label}
                    </label>
                    <select
                        className="form-select"
                        style={formControlStyle}
                        id={name}
                        name={name}
                        value={formData[name] || ''}
                        required={attributeRequired}
                        readOnly={attributeReadOnly}
                        disabled={attributeDisabled}
                        onFocus={handleFocus}
                        onChange={handleChange}
                        onBlur={handleBlur}
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