



	








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
			
		<div id="filtro">
			<span><strong class="titulo azul">Permissões </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde"> Perfil</strong></span>
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
			<form name="formPerfil" action="/permissao/save">
				<fieldset>
		     		<p>
						<label for="perfil">Perfil:</label>
						<select id="perfil" name="perfil.id" class="required">
							<option value="">Selecione o Perfil</option>
							
								<option value="1" >Detro</option>
							
								<option value="2" >Empresa</option>
							
								<option value="3" >Operacional</option>
							
								<option value="4" >Detro_Admin</option>
							
								<option value="5" >Detro_nivel_1</option>
							
								<option value="6" >Detro_nivel_2</option>
							
								<option value="7" >Detro_nivel_3</option>
							
								<option value="8" >Detro_AUD</option>
							
						</select>
						<input id="btn_submit_perfil" type="submit" value="Selecionar" />
					</p>
				</fieldset>
		</div>
		<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_dn.jpg" />
			<p></p>
			
		</form>
    
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