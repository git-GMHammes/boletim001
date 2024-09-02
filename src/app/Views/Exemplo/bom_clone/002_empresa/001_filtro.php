<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>BomWeb</title>
		<meta http-equiv="X-UA-Compatible" content="IE=8" >
		<?php
			include_once (__DIR__ . '/../head.php');
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
					include_once (__DIR__ . '/../menu.php');
				?>				
			</ul>
		</div>
		
	    <div id="info">
		       
	  	</div>
		<div id="result">
			
		<strong class="titulo azul">Lista </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde">
	Empresa
	</strong>
		
		<a href="#" class="accordion">[ Ocultar Filtro ]</a>
		
		<div id="filtro">
		
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
		
			<form id="formPesquisa" action="
		/empresa
	/list" method="post">
			
				<fieldset>
					
		<p>
			<label for="codigo">Código:</label>
			<input name="entityForSearch.codigo" value="" size="3" maxlength="3"/>
		</p>
		<p>
			<label for="nome">Nome:</label>
			<input name="entityForSearch.nome" value="" />
		</p>
	
		    		<input type="submit" name="btn_pesquisa" value="Pesquisar" >
					<input class="reset" type="reset" value="Limpar"/>
		    	</fieldset>
		    
			</form>
			
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_dn.jpg" />
			
		</div>
		<br />
		
			<a id="insert" href="<?= base_url(); ?>exemple/group/endpoint/bom_empresa_cadasrtar">Nova Empresa</a>
	
		<div id="tab_relatorio" style="width: 100%; overflow: auto;">
			<table id="tb_list" class="tablesorter">
				<thead>
					<tr>
						
		<th>Código da Empresa</th>
		<th>Nome da Empresa</th>
		<th>Operador</th>
		<th>Email</th>
		<th>Início da Vigência do BOM</th>
		<th>Ações</th>
	
					</tr>
				</thead>
				<tbody>
				
				</tbody>
			</table>
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