<script type="text/babel">
    const AppTextGPT = ({
        parametros = {},
        formData = {},
        setFormData = () => { },
        fieldAttributes = {}
    }) => {
        const label = fieldAttributes.label || 'AppTextLabel';
        const name = fieldAttributes.name || 'AppTextName';
        const attributeRequired = fieldAttributes.attributeRequired || false;
        const attributeReadOnly = fieldAttributes.attributeReadOnly || false;
        const attributeMask = fieldAttributes.attributeMask || false;

        const viacep = 'https://viacep.com.br/ws/';
        const opencep = 'https://opencep.com/v1/';
        const [error, setError] = React.useState(false);

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
            const url = `${viacep}${setCep}/json`;
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`ViaCEP fetch failed: ${response.statusText}`);
                }
                const data = await response.json();
                console.log('ViaCEP Data:', data);
                return !data.erro;
            } catch (error) {
                console.error('Error fetching ViaCEP data:', error);
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
                console.error('Error fetching OpenCEP data:', error);
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

        // Função handleChange
        const handleChange = (event) => {
            const { name, value } = event.target;

            if (!value) {
                setFormData((prev) => ({ ...prev, [name]: '' }));
                setError(false);
                return;
            }

            let maskedValue = value;

            switch (attributeMask) {
                case 'Telefone':
                    maskedValue = applyMaskTelefone(value);
                    break;
                case 'CPF':
                    maskedValue = applyMaskCPF(value);
                    break;
                case 'CEP':
                    maskedValue = applyMaskCEP(value);
                    break;
                case 'processo':
                    maskedValue = applyMaskProcesso(value);
                    break;
                default:
                    break;
            }

            setFormData((prev) => ({
                ...prev,
                [name]: maskedValue,
            }));

            setError(false);
        };

        // Função handleBlur
        const handleBlur = async (event) => {
            const { name, value } = event.target;
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
                            console.error(`Erro ao validar CEP via API: ${error.message}`);
                            isValid = false;
                        }
                    }
                    break;

                // Processo
                case 'processo':
                    isValid = /^\d{7}-\d{2}\.\d{4}\.\d{1}\.\d{2}\.\d{4}$/.test(value);
                    break;

                default:
                    break;
            }

            if (!isValid) {
                console.error(`${attributeMask} é inválido!`);
            }
        };

        return ( // <----AQUI
            <div> Valor</div>
        ); // <----AQUI
    };
</script>
