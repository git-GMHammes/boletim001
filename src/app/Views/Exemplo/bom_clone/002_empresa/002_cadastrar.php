





	
	
	



	








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
			
		<span><strong class="titulo azul">Cadastro </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde">
		Empresa
	</strong></span>
		<div id="inclusao">
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
			
				
						
				
				
			
			<form id="form" name="form" action="
		/empresa
	/save" method="post">
				<fieldset>
					
		<input type="hidden" name="entity.id" value="">
		<input type="hidden" name="entity.active" value="">
		<input type="hidden" name="entity.dataCriacao" value="">

		<p>
			<label for="codigo" class="obrigatorio">Código:</label>
			<input id="codigo" type="text" name="entity.codigo" value="" class="required" size="3" maxlength="3" minlength="3" number="true"  /> * 
		</p>
	
		<p>
			<label for="nome" class="obrigatorio">Nome:</label>
			<input id="nome" type="text" name="entity.nome" value="" class="required" size="60" maxlength="52" minlength="2"  /> * 
		</p>

		<p>
			<label for="responsavel" class="obrigatorio">Operador:</label>
			<input id="responsavel" type="text" name="entity.responsavel" value="" size="40" maxlength="40" minlength="2"   /> 
		</p>

		<p>
			<label for="emailContato" class="obrigatorio">Email:</label>
			<input id="emailContato" type="text" name="entity.emailContato" value="" class="email" size="40" maxlength="40"   />     
		</p>
		
		<p>
			<label for="inicioVigenciaBom">Início da Vigência do BOM:</label>
			
			
				<input id="inicioVigenciaBom" type="text" name="entity.inicioVigenciaBom" value="01/09/2024"
				 class="required" size="10" maxlength="10" minlength="10"   /> *
			
			
			 
		</p>
		
	
					
						<div id="formControls"> 
							<div id="camposObrigatorios">* Campo obrigatório.</div>
							<input type="submit" value="Salvar" class="submit" />
							
								<input type="reset" class="reset" value="Limpar" style="display: none;" />
							  
							<input type="button" id="btnCancelar" value="Cancelar" style="display: none;" />
						</div>
					
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