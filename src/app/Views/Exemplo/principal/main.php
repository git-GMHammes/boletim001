<?php
$parametros_backend = array(
    'DEBUG_MY_PRINT' => false,
    'request_scheme' => $_SERVER['REQUEST_SCHEME'],
    'server_name' => $_SERVER['SERVER_NAME'],
    'server_port' => $_SERVER['SERVER_PORT'],
    'getURI' => isset($metadata['getURI']) ? ($metadata['getURI']) : (array()),
    'base_url' => base_url(),
);
?>

<div class="main_footer" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
    const MainFooter = () => {
        // Variáveis recebidas do Backend
        const parametros = JSON.parse(document.querySelector('.main_footer').getAttribute('data-result'));
        // Prepara as Variáveis do REACT recebidas pelo BACKEND
        const getURI = parametros.getURI;
        const debugMyPrint = parametros.DEBUG_MY_PRINT;
        const request_scheme = parametros.request_scheme;
        const server_name = parametros.server_name;
        const server_port = parametros.server_port;
        const base_url = parametros.base_url;

        return (
            <div>
                <div className="d-flex justify-content-center">
                <form className="was-validated">
                    <div className="mb-3">
                        <label htmlFor="validationTextarea" className="form-label">Textarea</label>
                        <textarea className="form-control is-invalid" id="validationTextarea" placeholder="Required example textarea" required defaultValue={""} />
                    <div className="invalid-feedback">
                        Please enter a message in the textarea.
                    </div>
                    </div>
                    <div className="form-check mb-3">
                        <input type="checkbox" className="form-check-input" id="validationFormCheck1" required />
                        <label className="form-check-label" htmlFor="validationFormCheck1">Check this checkbox</label>
                    <div className="invalid-feedback">Example invalid feedback text</div>
                    </div>
                    <div className="form-check">
                        <input type="radio" className="form-check-input" id="validationFormCheck2" name="radio-stacked" required />
                        <label className="form-check-label" htmlFor="validationFormCheck2">Toggle this radio</label>
                    </div>
                    <div className="form-check mb-3">
                        <input type="radio" className="form-check-input" id="validationFormCheck3" name="radio-stacked" required />
                        <label className="form-check-label" htmlFor="validationFormCheck3">Or toggle this other radio</label>
                    <div className="invalid-feedback">More example invalid feedback text</div>
                    </div>
                    <div className="mb-3">
                    <select className="form-select" required aria-label="select example">
                        <option value>Open this select menu</option>
                        <option value={1}>One</option>
                        <option value={2}>Two</option>
                        <option value={3}>Three</option>
                    </select>
                    <div className="invalid-feedback">Example invalid select feedback</div>
                    </div>
                    <div className="mb-3">
                        <input type="file" className="form-control" aria-label="file example" required />
                    <div className="invalid-feedback">Example invalid form file feedback</div>
                    </div>
                    <div className="mb-3">
                        <button className="btn btn-primary" type="submit" disabled>Submit form</button>
                    </div>
                </form>
                </div>
                
                <div className="d-flex justify-content-center">
                <table className="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colSpan={2}>Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
        );
    };
    ReactDOM.render(<MainFooter />, document.querySelector('.main_footer'));
</script>
<?php
$parametros_backend = array();
?>