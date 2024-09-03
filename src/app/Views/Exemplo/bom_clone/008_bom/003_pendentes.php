



	

	
	








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
			
	<script type="text/javascript">

		var listPage;
		$(document).ready(function() {
			listPage = new ListPage(pathName + "/bom/pendentes", "BOM");
			
			listPage.setSearchFieldsIds(["idEmpresa", "mesAnoInicio", "mesAnoFim", "selectStatus"]);
			
			listPage.addColumnDefinition("Empresa", "empresa", {"sWidth": "50%"});
			listPage.addColumnDefinition("Mês/Ano de Referência", "mesAnoReferencia", { fnRender: createRowDateValueRenderFunction( "mesAnoReferencia" ) });
			listPage.addColumnDefinition("Status", "statusPendencia");
			listPage.addColumnDefinition("Limite de Entrega", "dataLimiteFechamento", { fnRender: createRowDateValueRenderFunction( "dataLimiteFechamento" ) });
			listPage.ignoreActionColumn();
			
		});	
		
		//Auto complete da Busca
		$(function() {

			$( "#buscaEmp" ).autocomplete({
				width:352,
				source: function( request, response ) {
					$.ajax({
						url: pathName + "/empresa/busca.json?term="+$( "#buscaEmp" ).val(),
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
					$("#idEmpresa").val(ui.item.data);
				 }
			});
			
			$("#btn_pesquisa").click(function()
				{
					listPage.initialize();
				}
			);

			$("#mesAnoInicio").mask("99/9999");
			$("#mesAnoFim").mask("99/9999");
				
		});
			

	</script>
		<strong class="titulo azul">Pendentes </strong><img src="/images/bomweb_setas.gif" /><strong class="titulo verde"> BOM</strong>
		<a href="#" class="accordion">[ Ocultar Filtro ]</a>
		<div id="filtro">
			<img src="/images/bomweb_filtros_box_up.jpg" />
			<form id="formPesquisa" action='/bom/pendentes' method="post">
				<fieldset>
					
					<p>
						<label for="buscaEmp">Empresa:</label>
						<input type="text" id="buscaEmp" name="filtro.nomeEmpresa" value="" onblur="limpaId(this,'idEmpresa')" style="width:350px;"/>
						<input type="text" id="idEmpresa" name="filtro.empresa" value="" style="visibility: hidden;"/>
					</p>
					
					<p>
						<label for="datepicker">Mês/Ano Inicial:</label>
						<input type="text" id="mesAnoInicio" value="" name="filtro.dataInicial" maxlength="8" size="8">
					</p>
					
					<p>
					    <label for="datepicker">Mês/Ano Final:</label>
						<input type="text" id="mesAnoFim" value="" name="filtro.dataFinal" maxlength="8" size="8" >
					</p>
					<p>
						<label for="selectStatus">Status:</label>
						<select id="selectStatus" name="filtro.status">
							
								<option value="Todos" >Todos</option>
							
								<option value="Aberto" >Aberto</option>
							
								<option value="Reaberto" >Reaberto</option>
							
								<option value="Vencido" >Vencido</option>
							
						</select>
					</p>
		    		<input type="button" name="btn_pesquisa" value="Pesquisar" id="btn_pesquisa">
		    		<input class="reset" type="reset" value="Limpar"/>
		    	</fieldset>
		    	</form>
			<img src="/images/bomweb_filtros_box_dn.jpg" />
		</div>
		<br />
		<div id="divDataTable" style="width: 100%; overflow: auto;">
		</div>
		
		<a id="linkExportPendentes" href="
		/bom
	/exportarPendentes">Exportar</a>
		
	
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