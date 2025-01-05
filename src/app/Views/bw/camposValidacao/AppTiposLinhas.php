<script type="text/babel">
    const AppTiposLinhas = (
        {
            parametros = {},
            formData = {},
            setFormData = () => { },
        }
    ) => {
        // Variáveis recebidas do Backend
        const origemForm = parametros.origemForm || 'erro';

        // Variáveis de estado
        const [tipos, setTipos] = React.useState([]);
        const [isLoading, setIsLoading] = React.useState(true);
        const [selectedLines, setSelectedLines] = React.useState([]);
        const debounceTimeout = React.useRef(null);
        const [message, setMessage] = React.useState({
            show: false,
            type: null,
            message: null
        });

        const lines = [
            { id: 1, label: "Linha Rodoviária" },
            { id: 2, label: "Linha Rodoviária com Ar" },
            { id: 3, label: "Linha Urbana" },
            { id: 4, label: "Linha Urbana com Ar" },
            { id: 5, label: "Linha de Serviços Especiais" },
            { id: 6, label: "Linha de Serviço Especial Leito" },
        ];

        // Função para lidar com seleção de linhas
        const handleSelection = (id) => {
            setSelectedLines((prev) =>
                prev.includes(id) ? prev.filter((line) => line !== id) : [...prev, id]
            );
        };

        // Função handleFocus para receber foco
        const handleFocus = (event) => {
            const { name, value } = event.target;

            console.log('handleFocus: ', name);
            console.log('handleFocus: ', value);

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));

            setMessage({ show: false, type: null, message: null });
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

            setFormData((prev) => ({
                ...prev,
                adolescente_id: id,
                adolescente_nome: nome
            }));

            setMessage({ show: false, type: null, message: null });
        };

        // Função handleBlur para perder foco
        const handleBlur = (event) => {
            const { name, value } = event.target;

            console.log('handleBlur: ', name);
            console.log('handleBlur: ', value);

            fetchAdolescente();

            setFormData((prev) => ({
                ...prev,
                [name]: value
            }));
        };

        // POST fetchAdolescente 
        const fetchPseudoTipo = async () => {
            setIsLoading(true);
            return null;
        };

        // React.useEffect
        React.useEffect(() => {
            console.log('React.useEffect - Carregar Dados Iniciais');

            // Função para carregar todos os dados necessários
            const loadData = async () => {
                console.log('loadData iniciando...');

                try {
                    await fetchPseudoTipo();

                } catch (error) {
                    console.error('Erro ao carregar dados:', error);
                } finally {
                    console.log('loadData finalizado...');
                    setIsLoading(false);
                }
            };

            loadData();
        }, []);

        // Styles
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

        const formControlStyle = {
            fontSize: '1rem',
            borderColor: '#fff',
        };

        return (
            <div>
                <div style={formGroupStyle}>
                    <label htmlFor="adolescente_id" style={formLabelStyle} className="form-label">
                        Tipo de Linha<strong style={requiredField}>*</strong>
                    </label>
                    {(isLoading) ? (
                        <div>
                            <div>&nbsp;</div>
                            <AppLoading
                                parametros={{ tipoLoading: 'progress', carregando: true }}
                            />
                        </div>
                    ) : (
                        <div className="btn-group w-100">
                            <button
                                className="btn d-flex justify-content-between align-items-center w-100"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <span>
                                    {selectedLines.length > 0
                                        ? selectedLines.map(
                                            (id) => lines.find((line) => line.id === id).label
                                        ).join(", ")
                                        : "Seleção Nula"}
                                </span>
                                <i className="bi bi-chevron-down"></i>
                            </button>
                            <div className="dropdown-menu w-100 overflow-auto" style={{ height: "380px" }}>
                                <input
                                    type="text"
                                    id="pesquisa_nome_ado"
                                    name="pesquisa_nome_ado"
                                    value={formData.pesquisa_nome_ado || ''}
                                    onFocus={handleFocus}
                                    onChange={handleChange}
                                    onBlur={handleBlur}
                                    className="form-control"
                                    style={formControlStyle}
                                    placeholder="Filtrar linhas..."
                                />
                                <div className="mt-2">
                                    {lines.map((line) => (
                                        <div key={line.id}>
                                            <div className="m-1">
                                                <input
                                                    type="checkbox"
                                                    className="btn-check"
                                                    id={`btn-${line.id}`}
                                                    autoComplete="off"
                                                    checked={selectedLines.includes(line.id)}
                                                    onChange={() => handleSelection(line.id)}
                                                    style={formControlStyle}
                                                />
                                                <label
                                                    className="btn btn-outline w-100 text-start"
                                                    htmlFor={`btn-${line.id}`}
                                                >
                                                    {line.label}
                                                </label>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        );
    };

</script>