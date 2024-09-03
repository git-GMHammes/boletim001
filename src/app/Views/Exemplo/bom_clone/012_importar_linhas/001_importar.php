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
		
		
		<script type="text/javascript" src="<?= base_url(); ?>assets/bomweb/jscript/jquery.validate.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/bomweb/jscript/jquery.tablesorter.min.js"></script>
	
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
			
		<div id="inclusao">
			<span><strong class="titulo azul">Importar </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde"> Linhas</strong></span>
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />	
			<form id="formUpLoad" action="/linha/uploadLinha" method="post" enctype="multipart/form-data">
				<fieldset>
					<p>
					Esta página permite a alteração de linhas, através da importação de uma planilha XLS.<br/>
					Irá excluir todos os BOMs afetados de acordo com a vigência da tarifa.</p>
					<p>
						<label for="arquivo">Arquivo XLS:</label>
						<input type="file" id="file" name="file" class="required"> * 
					</p>
					<div id="camposObrigatorios">* Campo obrigatório.</div>
					<input type="submit" value="Importar">
					<input type="reset" class="reset" value="Limpar" style="display: none;" />
				</fieldset>
			</form>
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_dn.jpg" />
		</div>		
		
		<div id='confirm' style="display: none;">
			<div class="white_content_header">
				<img src="<?= base_url(); ?>assets/bomweb/images/ico_modal_alert.png" align="absmiddle"> Alerta
			</div>
		
			<br/>
			<div class='message'></div><br/><br/><br/>
			
			<div class="white_content_footer">
				<input type="button" value="Sim" class="yes simplemodal-close">
				<input type="button" value="Não" class="simplemodal-close">
			</div>
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