<script type="text/babel">
  const AppNomeLinha = ({ formData = {}, setFormData = () => { }, parametros = {} }) => {

    // Prepara as Variáveis do REACT recebidas pelo BACKEND
    const debugMyPrint = parametros.DEBUG_MY_PRINT || '';
    const origemForm = parametros.origemForm || '';
    const base_url = parametros.base_url || '';
    const getURI = parametros.getURI || '';

    // Estado para atualizar a página
    const [defineAtualizar, setDefineAtualizar] = React.useState(false);

    // Estado para mensagens e validação
    const [showEmptyMessage, setShowEmptyMessage] = React.useState(false);
    const [message, setMessage] = React.useState({
      show: false,
      type: null,
      message: null
    });

    // Função handleFocus para garantir que o modal não seja exibido ao receber o foco
    const handleFocus = () => {
      const { name, value } = event.target;

      console.log('name handleFocus (CPF): ', name);
      console.log('value handleFocus (CPF): ', maskedValue);

      setMessage((prev) => ({
        ...prev,
        show: false
      }));
    };

    // Função handleChange simplificada
    const handleChange = (event) => {
      const { name, value } = event.target;

      console.log('name handleChange (CPF): ', name);
      console.log('value handleChange (CPF): ', maskedValue);

      setFormData((prev) => ({
        ...prev,
        [name]: maskedValue
      }));
    };

    const handleBlur = (event) => {
      const { name, value } = event.target;

      console.log('name handleBlur (CPF): ', name);
      console.log('value handleBlur (CPF): ', maskedValue);

      setFormData((prev) => ({
        ...prev,
        [name]: ''
      }));

    };

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
          <label
            htmlFor="active"
            style={formLabelStyle}
            className="form-label">Empresa<strong style={requiredField}>*</strong></label>
          <select data-api={`filtro-${origemForm}`} id="active" name="active" value={formData.active || ''} onChange={handleChange} style={formControlStyle} className="form-select" aria-label="Default select 1" required>
            <option value="">Seleção Nula</option>
          </select>
        </div>
      </div>
    );
  };

</script>