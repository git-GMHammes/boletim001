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

<div class="app_head" data-result='<?php echo json_encode($parametros_backend); ?>'></div>

<script type="text/babel">
  const AppHead = () => {
    // Variáveis recebidas do Backend
    const parametros = JSON.parse(document.querySelector('.app_head').getAttribute('data-result'));
    // Prepara as Variáveis do REACT recebidas pelo BACKEND
    const getURI = parametros.getURI;
    const debugMyPrint = parametros.DEBUG_MY_PRINT;
    const request_scheme = parametros.request_scheme;
    const server_name = parametros.server_name;
    const server_port = parametros.server_port;
    const base_url = parametros.base_url;

    // Nova constante de estilo para o texto "Footer"
    const headerTextStyle = {
      backgroundImage: 'linear-gradient(to right, #330033, #14007A)',
      color: 'white',
      textDecoration: 'none',
      padding: '10px'
    };

    // Style
    const navyBlueDark = {
      backgroundColor: "#000080"
    };

    const navyBlueDegradeAberto = {
      background: "linear-gradient(to right, #000080 15%, white 30%, white 70%, #000080 85%)"
    };

    const navyBlueDegradeFechado = {
      background: "linear-gradient(to right, #000080 20%, white 34%, white 66%, #000080 80%)"
    };

    const circleWithRadialGradient = {
      width: "50px",
      height: "50px",
      background: "radial-gradient(circle, white 30%, #000080 70%)",
      border: "3px solid #000080",
      borderRadius: "50%",
      display: "flex",
      justifyContent: "center",
      alignItems: "center",
      textAlign: "center"
    };

    return (
      <div>
        <div className="row">
          <div className="col-12 col-sm-3" style={navyBlueDark}>
            &nbsp;
          </div>
          <div className="col-12 col-sm-3" style={navyBlueDark}>
            &nbsp;
          </div>
          <div className="col-12 col-sm-3" style={navyBlueDark}>
            &nbsp;
          </div>
          <div className="col-12 col-sm-3" style={navyBlueDark}>
            &nbsp;
          </div>
        </div>
        <div className="row">
          <div className="col-12 col-sm-3" style={navyBlueDark}>
            &nbsp;
          </div>
          <div className="col-12 col-sm-3" style={navyBlueDegradeAberto}>
            <div className="d-flex justify-content-center align-items-center p-2">
              <img src="<?= base_url(); ?>assets/bomweb/images/logo_relatorio.gif" alt="src/assets/bomweb/images/logo_relatorio.gif" />
              &emsp;
              <img src="<?= base_url(); ?>assets/bomweb/images/detro.jpg" alt="assets/bomweb/images/detro.jpg" />
            </div>
          </div>
          <div className="col-12 col-sm-3" style={navyBlueDark}>
            <div className="d-flex justify-content-around align-items-center flex-wrap m-5">
              <div style={circleWithRadialGradient}>
                <i className="bi bi-instagram"></i>
              </div>
              <div style={circleWithRadialGradient}>
                <i className="bi bi-facebook"></i>
              </div>
              <div style={circleWithRadialGradient}>
                <i className="bi bi-twitter-x"></i>
              </div>
              <div style={circleWithRadialGradient}>
                <i className="bi bi-tiktok"></i>
              </div>
              <div style={circleWithRadialGradient}>
                <i className="bi bi-whatsapp"></i>
              </div>
            </div>
          </div>
          <div className="col-12 col-sm-3 d-flex justify-content-center align-items-center" style={navyBlueDegradeFechado}>
            <div className="p-2">
              <img src="<?= base_url(); ?>assets/bomweb/images/governo.jpg" alt="assets/bomweb/images/governo.jpg" />
            </div>
          </div>
        </div>
        <div className="row">
          <div className="col-12 col-sm-3" style={navyBlueDark}>
            &nbsp;
          </div>
          <div className="col-12 col-sm-3" style={navyBlueDark}>
            &nbsp;
          </div>
          <div className="col-12 col-sm-3" style={navyBlueDark}>
            &nbsp;
          </div>
          <div className="col-12 col-sm-3" style={navyBlueDark}>
            &nbsp;
          </div>
        </div>
      </div>
    );
  };
  const rootElement = document.querySelector('.app_head');
  const root = ReactDOM.createRoot(rootElement);
  root.render(<AppHead />);
</script>
<?php
$parametros_backend = array();
?>