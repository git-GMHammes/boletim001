<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>BomWeb</title>
		<meta http-equiv="X-UA-Compatible" content="IE=8" >
		<?php 
		include_once(__DIR__ . '/../head.php');	
		?>
		<script type="text/javascript">
		var pathName = "";	
		</script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/bomweb/jscript/bomweb.js?3"></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/bomweb/jscript/bom.js?3"></script>	
	</head>
<body onunload="javascript: bomweb.hideLoading();">
<div id="page">
	<div id="header"></div>
	<div id="access_control">
		<div>
			Pedro Machado [ Detro_Admin ] &nbsp;&nbsp;
			<ul>
				<li><a tabindex="-1" href="/trocarsenha">Trocar Senha</a></li>
				<li><a tabindex="-1" href="/sair">Sair</a></li>
			</ul>
		</div>
	</div>
	<div id="container">	
		<div class="separador"></div>
		<div id="menu">
			<?php 
			include_once(__DIR__ . '/../menu.php');
			?>
		</div>
		
	    <div id="info">
		       
	  	</div>
		<div id="result">
			
	<strong class="titulo azul">Principal </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde"> BOMWeb</strong>
	<div id="home">
		<p style="text-align: justify;">
		Olá! Você acaba de acessar um sistema on-line criado especialmente para simplificar o canal de comunicação entre as Empresas Operadoras de Transporte Público do Estado do Rio de Janeiro e o Detro-RJ.
		</p>
		<p style="text-align: justify;">
		Com ele, o envio do Boletim de Operação Mensal (BOM) ficará mais simples, mais seguro e mais transparente. 
		Este sistema muda apenas a forma de enviar o boletim ao Detro. Os dados a serem transmitidos continuam os mesmos. 
		</p>
		<p style="text-align: justify;">
		Qualquer computador com acesso à Internet permite a utilização deste sistema. Acesse o menu de opções à esquerda da tela, insira os dados e conheça as vantagens deste sistema.
		</p>
	</div>
    
		</div>
	</div>
	<div class="separador"></div>
	<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_footer_space.gif" />
	<div id="footer">
		<div id="version_control">v1.16.0.6</div>
	</div>
</div>
<div id="modalView" style="display: none">
	
</div>
</body>
</html>