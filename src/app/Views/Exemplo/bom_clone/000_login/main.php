




<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>BomWeb</title>
<meta http-equiv="X-UA-Compatible" content="IE=8" >
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bomweb/css/estilos.css">
<script type="text/javascript" src="<?= base_url(); ?>assets/bomweb/jscript/jquery-1.5.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#login2").focus();
});
</script>
</head>
<body>

<div id="page">
	<div id="header"></div>
	<div id="container">
		<div class="separador"></div>
		<div id="login">
			<div class="separador"></div>
			<span><strong>Bem vindo ao Sistema Online BomWeb!</strong><br/>Entre com seus dados para ter acesso.</span><br />
			
			<form action="/autenticar" method="post">
				<fieldset>
					<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_menu_arrow.png"> Login <input id="login2" type="text" name="credentials.username" class="required" maxlength="30" tabindex="1"/><br />
					<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_menu_arrow.png"> Senha <input id="senha" type="password" name="credentials.password" class="required"  maxlength="30" tabindex="2"/><br />
					<span><a href="<?= base_url(); ?>assets/bomweb/css/esquecisenha" tabindex="4">Esqueceu sua senha, <strong>clique aqui</strong>.</a></span><br />
					<input type="image"src="<?= base_url(); ?>assets/bomweb/images/bomweb_buttom_entrar.png" class="buttom_entrar" tabindex="3"/>
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