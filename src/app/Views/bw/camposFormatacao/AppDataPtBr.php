<script type="text/babel">
    const AppDataPtBr = ({ parametros }) => {
        // Converte a data recebida no formato "AAAA-MM-DD" para "DD-MM-AAAA"
        const formatarDataPtBr = (dataIso) => {
            const data = new Date(dataIso);
            const dia = String(data.getDate()).padStart(2, '0');
            const mes = String(data.getMonth() + 1).padStart(2, '0');
            const ano = data.getFullYear();
            return `${dia}-${mes}-${ano}`;
        };

        return (
            <span>{formatarDataPtBr(parametros)}</span>
        );
    };
</script>
<!-- <AppDataPtBr key={index} parametros={item.periodo_data_inicio} /> -->