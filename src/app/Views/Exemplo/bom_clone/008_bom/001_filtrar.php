



	
	








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
		
		
		<script type="text/javascript" src="/jscript/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="/jscript/ListPage.js"></script>
	
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
			
	<script type="text/javascript" src="/jscript/listBom.js"></script>	
		
		<strong class="titulo azul">Lista </strong><img src="/images/bomweb_setas.gif" /><strong class="titulo verde"> BOM</strong>
		<a href="#" class="accordion">[ Ocultar Filtro ]</a>
		<div id="filtro">
			<img src="/images/bomweb_filtros_box_up.jpg" />
			<form id="formPesquisa" action='/bom/list' method="post">
				<fieldset>
					<p>
						<label for="buscaEmp">Empresa:</label>
						<input type="text" id="buscaEmp" name="bom.empresa.nome" value="" onblur="limpaId(this,'idEmpresa')" style="width:350px;"/>
						<input type="text" id="idEmpresa" name="bom.empresa.id" value="" style="visibility: hidden;"/>
					</p>
					<p>					
						<label for="mes_referencia">Mês/Ano de Referência:</label> 
						<input type="text" id="mes_referencia" name="bom.mesReferencia" value="" size="7"/>
					</p>
		    		<input type="button" name="btn_pesquisa" value="Pesquisar" id="btn_pesquisa">
		    		<input class="reset" type="reset" value="Limpar"/>
		    		
						<input type="button" value="BOMs Pendentes" style="position:relative;left:70%;" onclick="window.location='/bom/pendentes'"/>
					
		    	</fieldset>
			</form>
			<img src="/images/bomweb_filtros_box_dn.jpg" />
		</div>
		
		<input type="hidden" value="Detro_Admin" id="perfil"/>
		
		<br />
		
		<a id="insert" href="/bom/insert" class="buttom_azul">Novo BOM</a>
		
		
		<div id="divDataTable" style="width: 100%; overflow: auto;">
		</div>
		
<div id="modalView" style="display: none;" class="simplemodal-data">
	<div class="white_content_header">
		<img src="/bomweb/images/ico_modal_alert.png" align="absmiddle"> Alerta
	</div>
	
	<div class="messageReabrir white_content_content">
	</div>
	
	<div class="white_content_footer">
		<input id="btnSimReabrirBom" type="button" value="Sim">
		<input class="simplemodal-close" type="button" value="Não">
	</div>

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