


	








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
			<ul>
			<?php 
			include_once(__DIR__ . '/../menu.php');
			?>
			</ul>
		</div>
		
	    <div id="info">
		       
	  	</div>
		<div id="result">
			
		<strong class="titulo azul">Configurações </strong>
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" />
		<strong class="titulo verde"> BOM</strong>
		<div id="filtro">
			
				<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
			
			
			<form id="form" action="/configuracao/salvar" method="post">
			<fieldset>
				
					<input type="hidden" name="configuracoes[0].id" value="1" />
					<p>
						<label for="valor0">Dias p/ fechar o BOM</label>
						<input type="text" id="valor0" name="configuracoes[0].valor" class="required" value="25" size="4" number="true" />
					</p>
				
					<input type="hidden" name="configuracoes[1].id" value="2" />
					<p>
						<label for="valor1">Dias p/ fechar o BOM ap?s reaberto pelo Detro</label>
						<input type="text" id="valor1" name="configuracoes[1].valor" class="required" value="25" size="4" number="true" />
					</p>
				
					<input type="hidden" name="configuracoes[2].id" value="5" />
					<p>
						<label for="valor2">Dias p/ fechar o BOM ap?s reaberto pela empresa</label>
						<input type="text" id="valor2" name="configuracoes[2].valor" class="required" value="30" size="4" number="true" />
					</p>
				
				<p>
					<input type="submit" value="Salvar" />
					<input type="button" id="btnCancelar" value="Cancelar" data-urlRetorno="/configuracao/list" />
				</p>
			</fieldset>
			</form>
			
			
				<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_dn.jpg" />
			
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