<?php
$parametros_backend = array(
    'title' => isset($metadata['page_title']) ? ($metadata['page_title']) : ('TITULO NÃO INFORMADO'),
    'DEBUG_MY_PRINT' => false,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'result' => isset($result) ? ($result) : (array()),
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
);
$parametros_backend['base_paginator'] = implode('/', $parametros_backend['getURI']);
// myPrint($parametros_backend, '');
?>

<div class="app_funcao_basica" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">

    const AppFuncaoBasica = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.app_funcao_basica').getAttribute('data-result'));
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const title = parametros.title;
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;

        return (
            <div>
                <div>
                    <h1>{title}</h1>
                    <p>Server: {request_scheme}://{server_name}:{server_port}</p>
                    <p>Base URL: {base_url}</p>

                    {/* Exemplo de uso da função form_nome */}
                    <form_nome ('nome', '', 'input_nome', 'Digite seu nome') />
                </div>
            </div>
        );
    };

    // Visual
    const myMinimumHeight = {
        minHeight: '600px'
    }

    const verticalBarStyle = {
        width: '5px',
        height: '60px',
        backgroundColor: '#00BFFF',
        margin: '10px',
        Right: '10px',
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

    const formControlStyle = {
        fontSize: '1rem',
        borderColor: '#fff',
    };

    const requiredField = {
        color: '#FF0000',
    };

    const form_nome = (parametro_nome, parametro_value, parametro_id, parametro_placeholder) => {
        return (
            <form action="" method="post" className="row was-validated m-2">
                <div className="col-12 col-sm-3 mb-3">
                    <div style={formGroupStyle}>
                        <label htmlFor="NomeEscola"style={formLabelStyle} className="form-label">Nome<strong style={requiredField}>*</strong></label>
                    </div>
                </div>
                <input 
                    data-api="form-filtro1"
                    className="form-select" 
                    style={formControlStyle} 
                    type="text" 
                    name={parametro_nome} 
                    value={parametro_value} 
                    id={parametro_id} 
                    placeholder={parametro_placeholder}
                    required
                />
            </form>
        );
    };

    ReactDOM.render(<AppFuncaoBasica />, document.querySelector('.app_funcao_basica'));
</script>
<?php
$parametros_backend = array();
?>