<div class="app_exec_form"></div>

<script type="text/babel">
    const AppExecForm = () => {

        const [formData, setFormData] = React.useState({
            nome: null,
            profissao: null,
            genero: null,
        });

        // Função handleChange simplificada
        const handleChange = (event) => {
            const { name, value } = event.target;
            console.log('name handleChange: ', name);
            console.log('value handleChange: ', value);

            setFormData((prev) => ({
                ...prev,
                [nome]: value
            }));
        };

        return (
            <div>
                <div className="container mt-5 mb-5">
                    <form className="was-validated">
                        <div>
                            <div className="row">
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="nome" className="form-label">Nome</label>
                                    <input
                                        type="text"
                                        className="form-control"
                                        id="nome"
                                        name="nome"
                                        value={formData.nome || ''}
                                        onChange={handleChange}
                                        aria-label="file example"
                                        required
                                    />
                                    <div className="invalid-feedback">Nome Obrigatório</div>
                                </div>
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="profissao" className="form-label">Profissão/Ocupação</label>
                                    <select
                                        className="form-select"
                                        id="profissao"
                                        name="profissao"
                                        value={formData.profissao || ''}
                                        onChange={handleChange}
                                        aria-label="select example"
                                        required
                                    >
                                        <option value>Nenhuma</option>
                                        <option value={1}>Proferror</option>
                                        <option value={2}>Analista de Sistemas</option>
                                        <option value={3}>Coordenador</option>
                                    </select>
                                    <div className="invalid-feedback">Profissão obrigatória</div>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12 col-sm-6">
                                    <label htmlFor="genero" className="form-label">Genero</label>
                                    <div class="d-flex justify-content-start">
                                        <div className="me-3">
                                            <input
                                                type="radio"
                                                className="form-check-input"
                                                id="genero1"
                                                name="genero"
                                                required
                                            />
                                            <label className="form-check-label ms-3" htmlFor="genero1">Masculino</label>
                                        </div>
                                        <div className="me-3">
                                            <input
                                                type="radio"
                                                className="form-check-input"
                                                id="genero2"
                                                name="genero"
                                                required
                                            />
                                            <label className="form-check-label ms-3" htmlFor="genero2">Feminino</label>
                                            <div className="invalid-feedback">Genero Obrigatório</div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-12 col-sm-6">
                                    <label className="form-check-label" htmlFor="foto">Masculino</label>
                                    <input
                                        type="file"
                                        id="upload_foto"
                                        name="upload_foto"
                                        className="form-control"
                                        aria-label="file example"
                                        required
                                    />
                                    <div className="invalid-feedback">Upload de Imagem Obrigatória</div>
                                </div>
                            </div>
                            <div className="row">
                                <div className="col-12 col-sm-6">
                                </div>
                                <div className="col-12 col-sm-6">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        );

    }
    const rootElement = document.querySelector('.app_exec_form');
    const root = ReactDOM.createRoot(rootElement);
    root.render(<AppExecForm />); 
</script>
<?php
$parametros_backend = array();
?>

<div class="d-flex justify-content-center">
    &nbsp;
</div>