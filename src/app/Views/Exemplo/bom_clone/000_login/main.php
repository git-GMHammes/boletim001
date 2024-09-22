<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<title>BomWeb</title>
	<meta http-equiv="X-UA-Compatible" content="IE=8">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bomweb/css/estilos.css">
	<script type="text/javascript" src="<?= base_url(); ?>assets/bomweb/jscript/jquery-1.5.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$("#login2").focus();
		});
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

	<!-- React -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.development.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.development.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>

</head>

<body>
	<div id="page">
		<div id="header"></div>
		<div id="container">
			<div class="separador"></div>
			<div class="d-flex justify-content-center">
				<a class="btn btn-outline-secondary btn-sm" href="<?= base_url(); ?>bw/usuario/endpoint/login"
					role="button">Novo Login</a>
			</div>
			<div id="login">
				<div class="separador"></div>
				<span><strong>Bem vindo ao Sistema Online BomWeb!</strong><br />Entre com seus dados para ter
					acesso.</span><br />

				<form action="/autenticar" method="post">
					<fieldset>
						<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_menu_arrow.png"> Login <input
							id="login2" type="text" name="credentials.username" class="required" maxlength="30"
							tabindex="1" /><br />
						<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_menu_arrow.png"> Senha <input id="senha"
							type="password" name="credentials.password" class="required" maxlength="30"
							tabindex="2" /><br />
						<a class="btn" href="<?= base_url() . "exemple/group/endpoint/bom_main" ?>" role="button">
							<span>Esqueceu sua senha, <strong>clique aqui</strong></span><br />
						</a><br />
						<a class="btn" href="<?= base_url() . "exemple/group/endpoint/bom_main" ?>" role="button">
							<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_buttom_entrar.png" alt="">
						</a>
					</fieldset>
				</form>
			</div>
		</div>
		<div class="separador"></div>
		<div id="footer">
			<div id="version_control">v1.16.0.6</div>
		</div>
	</div>
</body>

</html>