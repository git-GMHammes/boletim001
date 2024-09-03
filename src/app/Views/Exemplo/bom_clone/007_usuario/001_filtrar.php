



	
		
		
		
	
	
		



	








<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>BomWeb</title>
		<meta http-equiv="X-UA-Compatible" content="IE=8" >
		<link rel="stylesheet" type="text/css" href="/css/estilos.css">
		<link rel="stylesheet" type="text/css" href="/css/jquery.ui.all.css">
		<link rel="stylesheet" type="text/css" href="/css/jquery.simplemodal.css">
		<link rel="stylesheet" type="text/css" href="/css/jquery.treeview.css">
		<script type="text/javascript" src="/jscript/jquery-1.5.min.js"></script>
		<script type="text/javascript" src="/jscript/jquery.ui.1.8.min.js"></script>
		<script type="text/javascript" src="/jscript/jquery.simplemodal.js"></script>
		<script type="text/javascript" src="/jscript/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="/jscript/jquery.validate.min.js"></script>
		<script type="text/javascript" src="/jscript/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="/jscript/jquery.multiselect.js"></script>
		<script type="text/javascript" src="/jscript/jquery.treeview.js"></script>	
		<script type="text/javascript" src="/jscript/jquery.maskMoney.js"></script>
		<script type="text/javascript" src="/jscript/jquery.loading.min.js"></script>
		<script type="text/javascript" src="/jscript/jshashtable-2.1.js"></script>
		<script type="text/javascript" src="/jscript/jquery.numberformatter-1.2.2.min.js"></script>

		<script type="text/javascript">
		var pathName = "";	
		</script>
		
		
		<script type="text/javascript" src="/jscript/bomweb.js?3"></script>
		<script type="text/javascript" src="/jscript/bom.js?3"></script>	
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
				
				<li><a tabindex="-1" href="/empresa/list">Empresa</a></li>
				
				
				<li><a tabindex="-1" href="/linha/list">Linha</a></li>
				
				
				<li><a tabindex="-1" href="/tipodeveiculo/list">Tipo de Veículo</a></li>
				
				
				<li><a tabindex="-1" href="/tipodelinha/list">Tipo de Linha</a></li>
								
				
				<li><a tabindex="-1" href="/tarifa/list">Tarifa</a></li>
				 
				
				<li><a tabindex="-1" href="/usuario/list">Usuário</a></li>
				
				
				<li><a tabindex="-1" href="/bom/list">BOM</a></li>
				
				
				<li><a tabindex="-1" href="/relatorio/list">Relatório</a></li>	
				
				
				<li><a tabindex="-1" href="/log/list">Log</a></li>
				
				
				<li><a tabindex="-1" href="/configuracao/list">Configurações</a></li>
				
				 
				<li><a tabindex="-1" href="/tarifaRetroativa/formUpload" >Tarifa Retroativa</a></li>
				
				 
				<li><a tabindex="-1" href="/importaLinha/formUpload" >Importar Linhas</a></li>
				
				<li><a tabindex="-1" href="/manual/download">Manual</a></li>				
			</ul>
		</div>
		
	    <div id="info">
		       
	  	</div>
		<div id="result">
			
		<strong class="titulo azul">Lista </strong><img src="/images/bomweb_setas.gif" /><strong class="titulo verde">
	Usuário
	</strong>
		
		<a href="#" class="accordion">[ Ocultar Filtro ]</a>
		
		<div id="filtro">
		
			<img src="/images/bomweb_filtros_box_up.jpg" />
		
			<form id="formPesquisa" action="
		/usuario
	/list" method="post">
			
				<fieldset>
					
		<p>
			<label for="perfil">Perfil:</label>
			<select id="perfilUsuario" name="entityForSearch.perfil.id">
				<option value="" Selected="true">Selecione um perfil</option>
				
					<option value="1" >Detro</option>
				
					<option value="2" >Empresa</option>
				
					<option value="3" >Operacional</option>
				
					<option value="4" >Detro_Admin</option>
				
					<option value="5" >Detro_nivel_1</option>
				
					<option value="6" >Detro_nivel_2</option>
				
					<option value="7" >Detro_nivel_3</option>
				
					<option value="8" >Detro_AUD</option>
				
			</select>
		</p>
		<p>
			<label for="nome">Nome:</label>
			<input id="nome" name="entityForSearch.usuario.nome" value="" />
		</p>	
		
		    		<input type="submit" name="btn_pesquisa" value="Pesquisar" >
					<input class="reset" type="reset" value="Limpar"/>
		    	</fieldset>
		    
			</form>
			
			<img src="/images/bomweb_filtros_box_dn.jpg" />
			
		</div>
		<br />
		
			
				<a id="insert" href="/usuario/insert" class="buttom_azul">Novo Usuário</a>
			
		
		<div id="tab_relatorio" style="width: 100%; overflow: auto;">
			<table id="tb_list" class="tablesorter">
				<thead>
					<tr>
						
		<th>Perfil</th>
		<th>Nome</th>
		<th>Login</th>
		<th>Email do Responsável</th>		
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
	<img src="/images/bomweb_footer_space.gif" />
	<div id="footer">
		<div id="version_control">v1.16.0.6</div>
	</div>
</div>
<div id="modalView" style="display: none">
	
</div>
</body>
</html>