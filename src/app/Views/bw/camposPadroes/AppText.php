<script type="text/babel">
    const AppText = ({
        parametros = {},
        formData = {},
        setFormData = () => { },
        fieldAttributes = {}
    }) => {
        // Script que aceita parâmetros, formulário de dados, função de configuração de dados e atributos de campo
        // CEP, CPF, Telefone, Processo
        // console.log('AppText:', parametros, formData, setFormData, fieldAttributes);

        const label = fieldAttributes.label || 'AppTextLabel';
        const name = fieldAttributes.name || 'AppTextName';
        const errorMessage = fieldAttributes.errorMessage || '';
        const attributePlaceholder = fieldAttributes.attributePlaceholder || '';
        const attributeMinlength = fieldAttributes.attributeMinlength || 1;
        const attributeMaxlength = fieldAttributes.attributeMaxlength || 2;
        const attributePattern = fieldAttributes.attributePattern || '';
        const attributeAutocomplete = fieldAttributes.attributeAutocomplete || 'off';
        const attributeRequired = fieldAttributes.attributeRequired || false;
        const attributeReadOnly = fieldAttributes.attributeReadOnly || false;
        const attributeDisabled = fieldAttributes.attributeDisabled || false;
        const attributeMask = fieldAttributes.attributeMask || false;

        const viacep = 'https://viacep.com.br/ws/';
        const opencep = 'https://opencep.com/v1/';
        const [msgError, setMsgError] = React.useState(false);
        const [error, setError] = React.useState('');
        const [valid, setValid] = React.useState(true);
        const cleanInput = (value) => value.replace(/\D/g, '');

        // Máscara CPF
        const applyMaskCPF = (cpf) => {
            cpf = cleanInput(cpf)
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            return cpf;
        };

        // Validação CPF
        const isValidCPF = (cpf) => {
            cpf = cleanInput(cpf);
            if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;
            let soma = 0, resto;
            for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            if (resto !== parseInt(cpf.substring(9, 10))) return false;
            soma = 0;
            for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
            resto = (soma * 10) % 11;
            if (resto === 10 || resto === 11) resto = 0;
            return resto === parseInt(cpf.substring(10, 11));
        };

        // Máscara Telefone
        const applyMaskTelefone = (telefone) => {
            telefone = cleanInput(telefone);
            if (telefone.length === 11) {
                telefone = telefone.replace(/^(\d{2})(\d{1})(\d{4})(\d{4})$/, '($1)$2$3-$4');
            } else if (telefone.length === 10) {
                telefone = telefone.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1)$2-$3');
            }
            return telefone;
        };

        // Máscara CEP
        const applyMaskCEP = (cep) => cleanInput(cep).replace(/^(\d{5})(\d)/, '$1-$2');

        // Função para validar pelo ViaCEP
        const fetchViaCep = async (setCep) => {
            const url = `${viacep}/${setCep}/json`;
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`OpenCEP fetch failed: ${response.statusText}`);
                }
                const data = await response.json();
                console.log('OpenCEP Data:', data);
                return true;
            } catch (error) {
                console.log('Error fetching ViaCEP data:', error);
                return false;
            }
        };

        // Função para validar pelo OpenCEP
        const fetchOpenCep = async (set_cep) => {
            const url = `${opencep}/${set_cep}`;
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`OpenCEP fetch failed: ${response.statusText}`);
                }
                const data = await response.json();
                console.log('OpenCEP Data:', data);
                return true;
            } catch (error) {
                console.log('Error fetching OpenCEP data:', error);
                return false;
            }
        };

        // Máscara Processo
        const applyMaskProcesso = (processo) => cleanInput(processo)
            .replace(/^(\d{7})(\d{2})(\d{4})(\d{1})(\d{2})(\d{4})$/, '$1-$2.$3.$4.$5.$6');

        // Função handleFocus para receber foco
        const handleFocus = (event) => {
            const { name, value } = event.target;
            console.log('handleFocus: ', name, value);
            setFormData((prev) => ({ ...prev, [name]: value }));
        };
        // Remove caractere especial e número
        const removeLastSpecialCharAndNumber = (value) => {
            const specialCharAndNumberRegex = /[^a-zA-Z ]$/; // Exclui tudo que não é letra ou espaço
            let message = errorMessage === '' ? `O Campo ${label} aceita apenas letras` : errorMessage;
            // Se o último caractere for especial ou número, exibe erro
            if (specialCharAndNumberRegex.test(value.slice(-1))) {
                setMsgError(message);
                return value.slice(0, -1); // Remove o caractere inválido
            }

            // Se o valor for apenas letras, limpa a mensagem de erro
            setMsgError(false);
            return value;
        };

        // Remove caractere especial e letra
        const removeLastSpecialCharAndLetter = (value) => {
            const specialCharAndLetterRegex = /[^0-9 ]$/; // Exclui tudo que não é número ou espaço
            let message = errorMessage === '' ? `O Campo ${label} aceita apenas números` : errorMessage;
            // Se o último caractere for especial ou letra, exibe erro
            if (specialCharAndLetterRegex.test(value.slice(-1))) {
                setMsgError(message);
                return value.slice(0, -1); // Remove o caractere inválido
            }

            // Se o valor for apenas números, limpa a mensagem de erro
            setMsgError(false);
            return value;
        };

        // handleChange
        const handleChange = (event) => {
            const { name, value } = event.target;

            if (!value) {
                setFormData((prev) => ({ ...prev, [name]: '' }));
                setMsgError(false);
                return;
            };

            setFormData((prev) => ({
                ...prev,
                [name]: value,
            }));

            console.log("valid :: ", valid);

            let maskedValue = value;

            switch (attributePattern) {
                case 'Inteiro':
                    maskedValue = removeLastSpecialCharAndLetter(value)
                    setFormData((prev) => ({
                        ...prev,
                        [name]: maskedValue,
                    }));
                    console.log('Inteiro:', value);
                    break;

                case 'Caracter':
                    maskedValue = removeLastSpecialCharAndNumber(value)
                    setFormData((prev) => ({
                        ...prev,
                        [name]: maskedValue,
                    }));
                    console.log('Caracter:', value);
                    break;

                case 'Senha':
                    setFormData((prev) => ({
                        ...prev,
                        [name]: value,
                    }));
                    console.log('Senha:', value);
                    break;

                default:
                    break;
            };

            switch (attributeMask) {
                case 'Telefone':
                    maskedValue = applyMaskTelefone(value);
                    setFormData((prev) => ({
                        ...prev,
                        [name]: maskedValue,
                    }));
                    console.log('Telefone:', value);
                    break;

                case 'CPF':
                    maskedValue = applyMaskCPF(value);
                    setFormData((prev) => ({
                        ...prev,
                        [name]: maskedValue,
                    }));
                    console.log('CPF:', value);
                    break;

                case 'CEP':
                    maskedValue = applyMaskCEP(value);
                    setFormData((prev) => ({
                        ...prev,
                        [name]: maskedValue,
                    }));
                    console.log('CEP:', value);
                    break;

                case 'Processo':
                    maskedValue = applyMaskProcesso(value);
                    setFormData((prev) => ({
                        ...prev,
                        [name]: maskedValue,
                    }));
                    console.log('Processo:', value);
                    break;

                default:
                    break;
            }

        };

        const handleBlur = async (event) => {
            const { name, value } = event.target;
            let message = errorMessage === '' ? `Por favor, informe um ${attributeMask} válido.` : errorMessage;
            let isValid = true;

            switch (attributeMask) {
                // Telefone
                case 'Telefone':
                    isValid = cleanInput(value).length >= 10;
                    break;

                // CPF
                case 'CPF':
                    isValid = isValidCPF(value);
                    break;

                // CEP
                case 'CEP':
                    const cleanedCEP = cleanInput(value);
                    if (cleanedCEP.length !== 8) {
                        isValid = false;
                    } else {
                        try {
                            const response = await fetch(`${viacep}${cleanedCEP}/json`);
                            if (!response.ok) throw new Error('Erro na API ViaCEP');
                            const data = await response.json();
                            isValid = !data.erro;
                        } catch (error) {
                            console.log(`Erro ao validar CEP via API: ${error.message}`);
                            isValid = false;
                        }
                    }
                    break;

                // Processo
                case 'Processo':
                    isValid = /^\d{7}-\d{2}\.\d{4}\.\d{1}\.\d{2}\.\d{4}$/.test(value);
                    break;

                default:
                    break;
            }

            console.log('isValid(194) ::', isValid);

            if (isValid) {
                console.log(`Campo(if) ${attributeMask}`);
                setMsgError(false);
            } else {
                console.log(`Campo(else) ${attributeMask}`);
                setMsgError(message);
            }
        };

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

                <div style={formGroupStyle}>
                    <label
                        htmlFor={name}
                        style={formLabelStyle}
                        className="form-label"
                    >
                        {label}
                        {(attributeRequired) && (
                            <strong style={requiredField}>*</strong>
                        )}
                    </label>
                    <input
                        type="text"
                        className={`form-control ${error ? 'is-invalid' : formData[name] ? 'is-valid' : ''}`}
                        style={formControlStyle}
                        id={name}
                        name={name}
                        value={formData[name] || ''}
                        placeHolder={attributePlaceholder}
                        minLength={attributeMinlength}
                        maxLength={attributeMaxlength}
                        autocomplete={attributeAutocomplete}
                        required={attributeRequired}
                        disabled={attributeDisabled}
                        readOnly={attributeReadOnly}
                        list={`${name}-options`}
                        onFocus={handleFocus}
                        onChange={handleChange}
                        onBlur={handleBlur}
                    />
                    <datalist id={`${name}-options`}>
                        <option value=""></option>
                    </datalist>
                </div>
                {(msgError) && (
                    <div className="fw-light text-danger" style={fontErro}>
                        {msgError}
                    </div>
                )}
            </div>
        );
    };

</script>