<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>BomWeb</title>
		<meta http-equiv="X-UA-Compatible" content="IE=8" >
		<?php
			include_once (__DIR__ . '/../head.php');
		?>
		<script type="text/javascript" src="<?= base_url(); ?>assets/bomweb/jscript/jquery.numberformatter-1.2.2.min.js"></script>

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
				include_once (__DIR__ . '/../menu.php');
			?>
			</ul>
		</div>
		
	    <div id="info">
		       
	  	</div>
		<div id="result">
			
		<span><strong class="titulo azul">Cadastro </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde">
	<script type="text/javascript">

		//Auto complete da Busca
		$(function() {

			$( "#buscaEmp" ).autocomplete({
				width:352,
				source: function( request, response ) {
					$.ajax({
						url: "/usuario/busca.json?term="+$( "#buscaEmp" ).val(),
						dataType: "json",
						data: {
							featureClass: "P",
							style: "full",
							maxRows: 12,
							name_startsWith: request.term
						},
						success: function( data ) {
							response( $.map( data.empresa, function( item ) {
								return {
									value: item.nome,
									data: item.id,
									label: item.nome,
								};
							}));
						}
					});
				},
				minLength: 0,
				select: function(event, ui) { 
					$("#empresaUsuario").val(ui.item.data);
					setNomeUsuario($("#empresaUsuario"));
				 }
			});
		});

	</script>
		Usuário
	</strong></span>
		<div id="inclusao">
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
			
				
						
				
				
			
			<form id="form" name="form" action="
		/usuario
	/save" method="post">
				<fieldset>
					
		<input type="hidden" name="entity.usuario.id" value="">
		<p>
			<label for="perfilUsuario">Perfil:</label>
   			<select id="perfilUsuario" name="entity.perfil.id" class="required"  />
   				<option value="" Selected="true">Selecione um perfil</option>
             	
               		<option value="1" >Detro</option>
             	
               		<option value="2" >Empresa</option>
             	
               		<option value="3" >Operacional</option>
             	
               		<option value="4" >Detro_Admin</option>
             	
               		<option value="5" >Detro_nivel_1</option>
             	
               		<option value="6" >Detro_nivel_2</option>
             	
               		<option value="7" >Detro_nivel_3</option>
             	
               		<option value="8" >Detro_AUD</option>
             	
			</select> * 
		</p>
	   	<div id="divEmpresaUsuario" style="display: none">
			<p>
				<label for="empresaUsuario">Empresa:</label>
				<input type="text" id="buscaEmp" name="entity.usuario.empresa.nome" value="" onblur="limpaId(this,'empresaUsuario');"  style="width:350px;"/>
				<input type="text" id="empresaUsuario" name="entity.usuario.empresa.id" value="" style="visibility: hidden;"/>
			</p>
		</div>
		<p>
			<label for="nomeUsuario">Nome:</label>
			<input type="text" id="nomeUsuario" name="entity.usuario.nome" value="" class="required" /> * 
		</p>
		<p>
			<label for="loginUsuario">Login:</label>
			<input type="text" id="loginUsuario" name="entity.usuario.login" value="" class="required"  /> * 
		</p>
		<p>
			<label for="emailUsuario">Email do Responsável:</label>
			<input type="text" id="emailUsuario" name="entity.usuario.email" value="" class="email required" size="40" maxlength="100" /> * 
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