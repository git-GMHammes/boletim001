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
		
		
		<script type="text/javascript" src="<?= base_url(); ?>assets/bomweb/jscript/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="<?= base_url(); ?>assets/bomweb/jscript/ListPage.js"></script>
	
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
			
		<script type="text/javascript">
			var listPage;
			var COLUMN_DEFINITIONS = [ 	{ 0: "Empresa", 1: "empresa", 2: { "bVisible" : true }},
										{ 0: "Código da Linha", 1: "codigoLinha", 2: { "bVisible" : true }},
										{ 0: "Nome da Linha", 1: "nomeLinha", 2: { "bVisible" : true }},
										{ 0: "Mês de Referência", 1: "mesReferencia", 2: { "bVisible" : true }},
										{ 0: "Tipo de Veículo", 1: "descricaoTipoVeiculo", 2: { "bVisible" : true }},
										{ 0: "Número da Linha", 1: "numeroLinha", 2: { "bVisible" : false }},
										{ 0: "Responsável BOM", 1: "responsavelBOM", 2: { "bVisible" : false }},
										{ 0: "Capacidade da Linha", 1: "capacidadeLinha", 2: { "bVisible" : false }},
										{ 0: "Frota", 1: "frota", 2: { "bVisible" : false }},
										{ 0: "Viagens Extraordinárias A-B", 1: "viagensExtraordinariasAB", 2: { "bVisible" : false }},
										{ 0: "Viagens Extraordinárias B-A", 1: "viagensExtraordinariasBA", 2: { "bVisible" : false }},
										{ 0: "Viagens Ordinárias A-B", 1: "viagensOrdinariasAB", 2: { "bVisible" : false }},
										{ 0: "Viagens Ordinárias B-A", 1: "viagensOrdinariasBA", 2: { "bVisible" : false }},
										{ 0: "Extensão Piso I A-B", 1: "piso1AB", 2: { "bVisible" : false }},
										{ 0: "Extensão Piso I B-A", 1: "piso1BA", 2: { "bVisible" : false }},
										{ 0: "Extensão Piso II A-B", 1: "piso2AB", 2: { "bVisible" : false }},
										{ 0: "Extensão Piso II B-A", 1: "piso2BA", 2: { "bVisible" : false }},
										{ 0: "Início Horário de Pico Manhã - A-B", 1: "picoInicioManhaAB", 2: { "bVisible" : false }},
										{ 0: "Início Horário de Pico Manhã - B-A", 1: "picoInicioManhaBA", 2: { "bVisible" : false }},
										{ 0: "Fim Horário de Pico Manhã - A-B", 1: "picoFimManhaAB", 2: { "bVisible" : false }},
										{ 0: "Fim Horário de Pico Manhã - B-A", 1: "picoFimManhaBA", 2: { "bVisible" : false }},
										{ 0: "Início Horário de Pico Tarde - A-B", 1: "picoInicioTardeAB", 2: { "bVisible" : false }},
										{ 0: "Início Horário de Pico Tarde - B-A", 1: "picoInicioTardeBA", 2: { "bVisible" : false }},
										{ 0: "Fim Horário de Pico Tarde - A-B", 1: "picoFimTardeAB", 2: { "bVisible" : false }},
										{ 0: "Fim Horário de Pico Tarde - B-A", 1: "picoFimTardeBA", 2: { "bVisible" : false }},
										{ 0: "Duração Viagem Horário de Pico - A-B", 1: "duracaoViagemPicoAB", 2: { "bVisible" : false }},
										{ 0: "Duração Viagem Horário de Pico - B-A", 1: "duracaoViagemPicoBA", 2: { "bVisible" : false }},
										{ 0: "Duração Viagem Fora Horário de Pico - A-B", 1: "duracaoViagemForaPicoAB", 2: { "bVisible" : false }},
										{ 0: "Duração Viagem Fora Horário de Pico - B-A", 1: "duracaoViagemForaPicoBA", 2: { "bVisible" : false }},
										{ 0: "Hierarquização", 1: "hierarquizacao", 2: { "bVisible" : false }},
										{ 0: "Tipo da Ligação", 1: "tipoLigacao", 2: { "bVisible" : false }},
										{ 0: "Via", 1: "via", 2: { "bVisible" : false }},
										{ 0: "Status da Linha", 1: "statusLinha", 2: { "bVisible" : false }},
										{ 0: "Código da Seção", 1: "codigoSecao", 2: { "bVisible" : false }},
										{ 0: "Junção", 1: "juncaoSecao", 2: { "bVisible" : false }},
										{ 0: "Quantidade de Passageiros A-B", 1: "passageirosAB", 2: { "bVisible" : false }},
										{ 0: "Quantidade de Passageiros B-A", 1: "passageirosBA", 2: { "bVisible" : false }},
										{ 0: "Quantidade de Passageiros A-B - Anterior", 1: "passageirosAnteriorAB", 2: { "bVisible" : false }},
										{ 0: "Quantidade de Passageiros B-A - Anterior", 1: "passageirosAnteriorBA", 2: { "bVisible" : false }},
										{ 0: "Sem Passageiro", 1: "secaoSemPassageiro", 2: { "bVisible" : false }},
										{ 0: "Total Passageiros A-B", 1: "totalPassageirosAB", 2: { "bVisible" : false }},
										{ 0: "Total Passageiros B-A", 1: "totalPassageirosBA", 2: { "bVisible" : false }},
										{ 0: "Total Receita", 1: "totalReceita", 2: { "bVisible" : false }},
										{ 0: "Tarifa Atual", 1: "tarifaAtual", 2: { "bVisible" : false }},
										{ 0: "Tarifa Promocional", 1: "tarifaPromocional", 2: { "bVisible" : false }},
										{ 0: "Tarifa Anterior", 1: "tarifaAnterior", 2: { "bVisible" : false }}];
		
			$(document).ready(function() {
				criaListPage();
				configuraElementos();
			});

			function criaListPage() {
				listPage = new ListPage(pathName + "/relatorio", "relatório");

				listPage.ignoreActionColumn();
				
				listPage.setSearchFieldsIds(["selectEmpresaFormRelatorio", 
				             				"selectLinhaFormRelatorio", 
				             				"selectTipoVeiculoFormRelatorio", 
				             				"mesAnoInicio",
				             				"mesAnoFim",
				             				"camposRelatorio"]);

				for (var i = 0; i < COLUMN_DEFINITIONS.length; i++) {
					listPage.addColumnDefinition(COLUMN_DEFINITIONS[i][0], COLUMN_DEFINITIONS[i][1], COLUMN_DEFINITIONS[i][2]);
				}

				listPage.setAfterDataFetchCallback(habilitaBotaoExportar);
				listPage.setSearchFormValidationFunction(validaSePodeGerarRelatorio);
				
				listPage.initialize();
			}

			function configuraElementos() {
				var temPerfilEmpresa = ("false" == "true");
				
				$("#selectEmpresaFormRelatorio").multiselect({
					checkAllText: "Marcar todas",
					uncheckAllText: "Desmarcar",
					noneSelectedText: "Selecione as empresas",
					selectedText: "# marcada(s)"
				});
				
				$("#selectLinhaFormRelatorio").multiselect({
					checkAllText: "Marcar todas",
					uncheckAllText: "Desmarcar",
					noneSelectedText: "Selecione as linhas",
					selectedText: "# marcada(s)"
				});
				
				$("#selectTipoVeiculoFormRelatorio").multiselect({
					checkAllText: "Marcar todos",
					uncheckAllText: "Desmarcar",
					noneSelectedText: "Selecione os veículos",
					selectedText: "# marcado(s)"
				});
				
				$("#camposRelatorio").multiselect({
					checkAllText: "Marcar todos",
					uncheckAllText: "Desmarcar",
					noneSelectedText: "Selecione os campos",
					selectedText: "# marcado(s)"
				});

				$("#camposRelatorio").bind("multiselectclick", camposRelatorio_onMultiSelectClick);
				$("#camposRelatorio").bind("multiselectcheckall", camposRelatorio_onMultiSelectCheckAll);
				$("#camposRelatorio").bind("multiselectuncheckall", camposRelatorio_onMultiSelectUncheckAll);

				if (!temPerfilEmpresa) {
					$("#divEmpresas").show();
					$("#selectLinhaFormRelatorio").multiselect("disable");
					$("#selectTipoVeiculoFormRelatorio").multiselect("disable");
				}
				
				$("#selectEmpresaFormRelatorio").multiselect({
					close: function(event, ui) {
						bomweb.updateMultiSelect($(this),
												 $("#selectLinhaFormRelatorio"), 
												 pathName + "/relatorio/buscaLinhas.json", 
												 "id", 
												 ["comboString"] 
												 );
					}
				});
				
				$("#selectLinhaFormRelatorio").multiselect({
					close: function(event, ui) {
						$("#selectTipoVeiculoFormRelatorio").multiselect("enable");
					}
				});
				
				$("#mesAnoInicio").mask("99/9999");
				$("#mesAnoFim").mask("99/9999");

				$("#resetButton").click(resetButton_onClick);
				$("#divDataTable").hide();
			}

			function hideDataTable() {
				$("#divDataTable").hide();
			}
			
			/**
			 * Extraído de: http://www.erichynds.com/jquery/jquery-ui-multiselect-widget/
			 * 
			 * event: the original event object
			 * 
			 * ui.value: value of the checkbox
			 * ui.text: text of the checkbox
			 * ui.checked: whether or not the input was checked or unchecked (boolean)
			 */
			function camposRelatorio_onMultiSelectClick(event, ui) {
				var columnIndex = listPage.getColumnIndexByJSONPropertyName(ui.value);

				// Se não encontra a coluna, dá erro.
				if (columnIndex == -1) throw new Error();

				// Não se deve poder selecionar uma das colunas permanentemente visíveis. 
				if (COLUMN_DEFINITIONS[columnIndex][2]["bVisible"]) throw new Error();

				// Se está selecionando, mostra a columa.
				if (ui.checked) {
					listPage.showColumn(columnIndex);
				}
				// Se está deselecionando, esconde a columa.
				else {
					listPage.hideColumn(columnIndex);
				}
				
				hideDataTable();
			}

			/**
			 * Extraído de: http://www.erichynds.com/jquery/jquery-ui-multiselect-widget/
			 * 
			 * event: the original event object
			 */
			function camposRelatorio_onMultiSelectCheckAll(event) {
				for (var i = 0; i < COLUMN_DEFINITIONS.length; i++) {
					// Mostra todas as colunas que não são permanentemente visíveis.
					if (!COLUMN_DEFINITIONS[i][2]["bVisible"]) {
						listPage.showColumn(i);
					}
				}
				
				hideDataTable();
			}

			/**
			 * Extraído de: http://www.erichynds.com/jquery/jquery-ui-multiselect-widget/
			 * 
			 * event: the original event object
			 */
			function camposRelatorio_onMultiSelectUncheckAll(event) {
				for (var i = 0; i < COLUMN_DEFINITIONS.length; i++) {
					// Esconde todas as colunas que não são permanentemente visíveis.
					if (!COLUMN_DEFINITIONS[i][2]["bVisible"]) {
						listPage.hideColumn(i);
					}
				}
				
				hideDataTable();
			}

			function resetButton_onClick(e) {
				var temPerfilEmpresa = ("false" == "true");
				listPage.reset();
				$("#exportButton").hide();
				$("#selectEmpresaFormRelatorio").multiselect("uncheckAll");
				$("#selectLinhaFormRelatorio").multiselect("uncheckAll");
				if(!temPerfilEmpresa) {
					$("#selectLinhaFormRelatorio").multiselect("disable");
				}
				
				$("#selectTipoVeiculoFormRelatorio").multiselect("uncheckAll");
				$("#selectTipoVeiculoFormRelatorio").multiselect("disable");
				$("#camposRelatorio").multiselect("uncheckAll");
				$("#divDataTable").hide();
			}

			function habilitaBotaoExportar(json) {
				if (json.aaData.length > 0) {
					$("#divDataTable").show();
					$("#linkExportRelatorio").show();
				}
				else {
					$("#linkExportRelatorio").hide();
				}
			}

			function validaSePodeGerarRelatorio() {
				var temPerfilEmpresa = ("false" == "true");
				var podeGerarRelatorio = true;
				
				if (!temPerfilEmpresa && !isMultiselectFilled("#selectEmpresaFormRelatorio")) {
					$("#errorEmpresa").show();
					podeGerarRelatorio = false;
				} 
				else {
					$("#errorEmpresa").hide();
				}
				
				if (!isMultiselectFilled("#selectLinhaFormRelatorio")) {
					$("#errorLinha").show();
					podeGerarRelatorio = false;
				} 
				else {
					$("#errorLinha").hide();
				}
									
				if (!isMultiselectFilled("#selectTipoVeiculoFormRelatorio")) {
					$("#errorTipoDeVeiculo").show();
					podeGerarRelatorio = false;
				} 
				else {
					$("#errorTipoDeVeiculo").hide();
				}

				if(!isFieldFilled("#mesAnoInicio")) {
					$("#errorMesAnoInicio").show();
					podeGerarRelatorio = false;
				} 
				else {
					$("#errorMesAnoInicio").hide();
				}	
								
				if(!isFieldFilled("#mesAnoFim")) {
					$("#errorMesAnoFim").show();
					podeGerarRelatorio = false;
				} 
				else {
					$("#errorMesAnoFim").hide();
				}

				return podeGerarRelatorio;
			}
		</script>
       	<strong class="titulo azul">Relatório </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde"> BOM</strong>
		
		<a href="#" class="accordion">[ Ocultar Filtro ]</a>
       	<div id="filtro">
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
			<form id="form" method="post">
				<fieldset>
					<p>
						<label for="empresas">Empresa:</label>
						
						<div id="divEmpresas" style="display: none;">
							<select id="selectEmpresaFormRelatorio" multiple="multiple" name="filtro.empresasComoString">
							
								<option value="2" >AUTO COMERCIAL BARRA MANSA LTDA.</option>
							
								<option value="91" >AUTO LOTAÇÃO INGÁ LTDA.</option>
							
								<option value="1" >AUTO ÔNIBUS FAGUNDES LTDA.</option>
							
								<option value="4" >AUTO ÔNIBUS VERA CRUZ LTDA.</option>
							
								<option value="7" >AUTO VIAÇÃO 1001 LTDA.</option>
							
								<option value="5" >AUTO VIAÇÃO ABC S/A</option>
							
								<option value="17" >AUTO VIAÇÃO JUREMA S/A</option>
							
								<option value="9" >AUTO VIAÇÃO REGINAS LTDA.</option>
							
								<option value="10" >AUTO VIAÇÃO SALINEIRA LTDA.</option>
							
								<option value="6" >AUTO VIAÇÃO TANGUAENSE LTDA.</option>
							
								<option value="11" >AUTO VIAÇÃO VERA CRUZ LTDA.</option>
							
								<option value="20" >CAVALCANTI &amp; CIA. LTDA. (NILOPOLITANA)</option>
							
								<option value="15" >COESA TRANSPORTES LTDA.</option>
							
								<option value="14" >COLITUR TRANSPORTES RODOVIÁRIOS LTDA.</option>
							
								<option value="96" >COSTA VERDE TRANSPORTES LTDA.</option>
							
								<option value="19" >EMPRESA BRASIL S/A - TRANSPORTES E TURISMO</option>
							
								<option value="22" >EMPRESA DE ÔNIBUS E TURISMO PEDRO ANTONIO LTDA.</option>
							
								<option value="95" >EMPRESA DE TRANSPORTES BRASO LISBOA LTDA.</option>
							
								<option value="21" >EMPRESA DE TRANSPORTES CONTINENTAL LTDA.</option>
							
								<option value="24" >EMPRESA DE TRANSPORTES FLORES LTDA.</option>
							
								<option value="25" >EMPRESA DE TRANSPORTES LIMOUSINE CARIOCA S/A.</option>
							
								<option value="23" >EMPRESA SANTA TEREZINHA LTDA.</option>
							
								<option value="27" >EVANIL TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="30" >EXPRESSO GARCIA LTDA.</option>
							
								<option value="33" >EXPRESSO PINTO &amp; PALMA LTDA.</option>
							
								<option value="28" >EXPRESSO REAL RIO LTDA.</option>
							
								<option value="105" >EXPRESSO RECREIO TRANSPORTE DE PASSAGEIROS LTDA</option>
							
								<option value="36" >EXPRESSO RIO DE JANEIRO LTDA.</option>
							
								<option value="26" >EXPRESSO SÃO FRANCISCO LTDA.</option>
							
								<option value="35" >FACIL TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="40" >FAZENI TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="89" >FEITAL TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="38" >GARDEL TURISMO LTDA.</option>
							
								<option value="37" >J.C. GUIMARÃES TRANSPORTES COLETIVOS LTDA.</option>
							
								<option value="94" >J.F. FARINHA AUTO ÔNIBUS LTDA.</option>
							
								<option value="39" >LINAVE TRANSPORTES LTDA.</option>
							
								<option value="50" >MASTER TRANSPORTES COLETIVOS DE PASSAGEIROS LTDA.</option>
							
								<option value="29" >NITURVIA NOVA IGUAÇU TURISMO E VIAÇÃO LTDA.</option>
							
								<option value="42" >RÁPIDO MACAENSE LTDA.</option>
							
								<option value="43" >RÁPIDO SÃO CRISTÓVÃO LTDA.</option>
							
								<option value="44" >RIO ITA LTDA.</option>
							
								<option value="61" >SANTA EUGÊNIA TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="31" >TB TRANSPORTES BLANCO EIRELI</option>
							
								<option value="55" >TRANSA TRANSPORTE COLETIVO LTDA.</option>
							
								<option value="99" >TRANSPORTADORA MACABÚ LTDA.</option>
							
								<option value="48" >TRANSPORTADORA TINGUÁ LTDA.</option>
							
								<option value="58" >TRANSPORTE MAGELI LTDA.</option>
							
								<option value="59" >TRANSPORTES E TURISMO ALTO MINHO LTDA.</option>
							
								<option value="53" >TRANSPORTES E TURISMO MACHADO LTDA.</option>
							
								<option value="46" >TRANSPORTES FABIO&#039;S LTDA.</option>
							
								<option value="52" >TRANSPORTES SANTO ANTÔNIO LTDA.</option>
							
								<option value="54" >TRANSPORTES ÚNICA PETRÓPOLIS LTDA.</option>
							
								<option value="103" >TRANSTUR VILA EMIL LTDA.</option>
							
								<option value="56" >TRANSTURISMO REI LTDA. (TREL)</option>
							
								<option value="57" >TRANSTURISMO RIO MINHO LTDA.</option>
							
								<option value="102" >UNIÃO TRANSPORTE INTERESTADUAL DE LUXO S/A - UTIL</option>
							
								<option value="106" >UNIRIO TRANSPORTES LTDA.</option>
							
								<option value="60" >VIAÇÃO AGULHAS NEGRAS LTDA.</option>
							
								<option value="12" >VIAÇÃO BARRA DO PIRAÍ TURISMO LTDA.</option>
							
								<option value="62" >VIAÇÃO BEIRA MAR LTDA.</option>
							
								<option value="98" >VIAÇÃO CARMENSE LTDA.</option>
							
								<option value="65" >VIAÇÃO CIDADE DO AÇO LTDA.</option>
							
								<option value="67" >VIAÇÃO ELITE LTDA.</option>
							
								<option value="68" >VIAÇÃO ESTRELA S/A</option>
							
								<option value="69" >VIAÇÃO FALCÃO LTDA.</option>
							
								<option value="70" >VIAÇÃO GALO BRANCO S/A</option>
							
								<option value="71" >VIAÇÃO MAUÁ S/A.</option>
							
								<option value="66" >VIAÇÃO MIRANTE LTDA.</option>
							
								<option value="81" >VIAÇÃO MONTES BRANCOS LTDA.</option>
							
								<option value="47" >VIAÇÃO NORMANDY DO TRIÂNGULO LTDA.</option>
							
								<option value="73" >VIAÇÃO NOSSA SENHORA APARECIDA LTDA.</option>
							
								<option value="74" >VIAÇÃO NOSSA SENHORA DA PENHA LTDA.</option>
							
								<option value="72" >VIAÇÃO NOSSA SENHORA DO AMPARO LTDA.</option>
							
								<option value="108" >VIAÇÃO NOVA NIL LTDA.</option>
							
								<option value="92" >VIAÇÃO PENDOTIBA S/A.</option>
							
								<option value="93" >VIAÇÃO PENEDO LTDA.</option>
							
								<option value="75" >VIAÇÃO PINHEIRAL LTDA.</option>
							
								<option value="76" >VIAÇÃO PONTE COBERTA LTDA.</option>
							
								<option value="77" >VIAÇÃO PROGRESSO E TURISMO S/A.</option>
							
								<option value="78" >VIAÇÃO RESENDENSE INTERMUNICIPAL LTDA.</option>
							
								<option value="79" >VIAÇÃO SALUTARIS E TURISMO S/A.</option>
							
								<option value="80" >VIAÇÃO SANTA LUZIA LTDA.</option>
							
								<option value="83" >VIAÇÃO SÃO JOSÉ LTDA.</option>
							
								<option value="13" >VIAÇÃO SÃO PEDRO D&#039;ALDEIA LTDA.</option>
							
								<option value="84" >VIAÇÃO SUL FLUMINENSE TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="85" >VIAÇÃO TERESÓPOLIS E TURISMO LTDA.</option>
							
								<option value="86" >VIAÇÃO UNIÃO LTDA.</option>
							
								<option value="87" >VIAÇÃO VERA CRUZ S/A.</option>
							
								<option value="88" >VIAÇÃO VILA RICA LTDA.</option>
							
							</select> * 
							<label id="errorEmpresa" class="error" for="selectEmpresaFormRelatorio" style="display: none;">Este campo é obrigatório.</label>
						</div>
					</p>
					<p>
						<label for="linhas">Linha:</label>
						<select id="selectLinhaFormRelatorio" multiple="multiple" name="filtro.linhasComoString">
						
						</select> * 
						<label id="errorLinha" class="error" for="selectLinhaFormRelatorio" style="display: none;">Este campo é obrigatório.</label>
						<img class="loading" alt="Carregando" src="/images/carregando.gif">
					</p>
					<p>
						<label for="tipoVeiculos">Tipo de Veículo:</label>
						<select id="selectTipoVeiculoFormRelatorio" multiple="multiple" name="filtro.tiposVeiculoComoString">
						
							<option value="1">Urbano Convencional</option>
						
							<option value="2">Urbano C/AR Condicionado</option>
						
							<option value="5">Rodoviário Convencional</option>
						
							<option value="9">Rodoviário Convencional C/AR</option>
						
							<option value="6">Rodoviário C/AR</option>
						
							<option value="3">Micro Urbano Convencional</option>
						
							<option value="14">Micromaster Rodoviário</option>
						
							<option value="13">Micromaster Urbano c/ Ar</option>
						
							<option value="15">Micromaster Rodoviário c/ Ar</option>
						
							<option value="10">Micro Rodoviário C/AR</option>
						
							<option value="12">Micromaster Urbano</option>
						
							<option value="4">Micro Urbano C/AR Condicionado</option>
						
							<option value="8">Micro Rodoviário C/AR</option>
						
							<option value="11">Rodoviário C/AR e Banheiro</option>
						
						</select> *
						<label id="errorTipoDeVeiculo" class="error" for="selectTipoDeVeiculoFormRelatorio" style="display: none;">Este campo é obrigatório.</label>
						<img class="loading" alt="Carregando" src="/images/carregando.gif">
					</p>
					<p>
						<label for="datepicker">Mês/Ano Inicial:</label>
						<input id="mesAnoInicio" type="text" name="filtro.dataInicial" maxlength="8" size="8" class="required"> *
						<label id="errorMesAnoInicio" class="error" for="selectEmpresaFormRelatorio" style="display: none;">Este campo é obrigatório.</label> 
					</p>
					<p>
					    <label for="datepicker">Mês/Ano Final:</label>
						<input id="mesAnoFim" type="text" name="filtro.dataFinal" maxlength="8" size="8" class="required"> *
						<label id="errorMesAnoFim" class="error" for="selectEmpresaFormRelatorio" style="display: none;">Este campo é obrigatório.</label> 
					</p>
					<p>
						<label for="camposRelatorio">Campos do Relatório:</label>
						<select id="camposRelatorio" multiple="multiple" name="filtro.camposRelatorioComoString">
							<option value="empresa" disabled="disabled" selected="selected">Empresa</option>
							<option value="mesReferencia" disabled="disabled" selected="selected">Mês de Referência</option>
							<option value="responsavelBOM">Responsável BOM</option>
							<optgroup label="Linha">
								<option value="nomeLinha" disabled="disabled" selected="selected">Nome da Linha</option>
								<option value="codigoLinha" disabled="disabled" selected="selected">Código da Linha</option>
								<option value="descricaoTipoVeiculo" disabled="disabled" selected="selected">Tipo de Veículo</option>
								<option value="numeroLinha">Número da Linha</option>
								<option value="capacidadeLinha">Capacidade da Linha</option>
								<option value="frota">Frota</option>
								<option value="viagensExtraordinariasAB">Viagens Extraordinárias A-B</option>
								<option value="viagensExtraordinariasBA">Viagens Extraordinárias B-A</option>
								<option value="viagensOrdinariasAB">Viagens Ordinárias A-B</option>
								<option value="viagensOrdinariasBA">Viagens Ordinárias B-A</option>
								<option value="piso1AB">Extensão Piso I A-B</option>
								<option value="piso1BA">Extensão Piso I B-A</option>
								<option value="piso2AB">Extensão Piso II A-B</option>
								<option value="piso2BA">Extensão Piso II B-A</option>
								<option value="picoInicioManhaAB">Início Horário de Pico Manhã - A-B</option>
								<option value="picoInicioManhaBA">Início Horário de Pico Manhã - B-A</option>
								<option value="picoFimManhaAB">Fim Horário de Pico Manhã - A-B</option>
								<option value="picoFimManhaBA">Fim Horário de Pico Manhã - B-A</option>
								<option value="picoInicioTardeAB">Início Horário de Pico Tarde - A-B</option>
								<option value="picoInicioTardeBA">Início Horário de Pico Tarde - B-A</option>
								<option value="picoFimTardeAB">Fim Horário de Pico Tarde - A-B</option>
								<option value="picoFimTardeBA">Fim Horário de Pico Tarde - B-A</option>
								<option value="duracaoViagemPicoAB">Duração Viagem Horário de Pico - A-B</option>
								<option value="duracaoViagemPicoBA">Duração Viagem Horário de Pico - B-A</option>
								<option value="duracaoViagemForaPicoAB">Duração Viagem Fora Horário de Pico - A-B</option>
								<option value="duracaoViagemForaPicoBA">Duração Viagem Fora Horário de Pico - B-A</option>
								<option value="hierarquizacao">Hierarquização</option>
								<option value="tipoLigacao">Tipo da Ligação</option>
								<option value="via">Via</option>
								<option value="statusLinha">Status da Linha</option>
							</optgroup>
							<optgroup label="Seção">
								<option value="codigoSecao">Código</option>
								<option value="juncaoSecao">Junção</option>
								<option value="passageirosAB">Quantidade de Passageiros A-B</option>
								<option value="passageirosAnteriorAB">Quantidade de Passageiros A-B - Anterior</option>
								<option value="passageirosBA">Quantidade de Passageiros B-A</option>
								<option value="passageirosAnteriorBA">Quantidade de Passageiros B-A - Anterior</option>
								<option value="secaoSemPassageiro">Sem Passageiro</option>
								<option value="totalPassageirosAB">Total Passageiros A-B</option>
								<option value="totalPassageirosBA">Total Passageiros B-A</option>
								<option value="totalReceita">Total Receita</option>
							</optgroup>
							<optgroup label="Tarifa">
								<option value="tarifaAtual">Tarifa Atual</option>
								<option value="tarifaAnterior">Tarifa Anterior</option>
							</optgroup>							
						</select> * 
					</p>
					<div id="camposObrigatorios">* Campo obrigatório.</div>
					
	 			    	<input type="button" id="dataTableFetchData" value="Gerar Relatório"/>
		    		
					<input type="button" id="resetButton" value="Limpar"/>
		    	</fieldset>
			</form>
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_dn.jpg" />
			
				<div>
					<a id="linkExportRelatorio" href="/relatorio/exportar" class="buttom_verde">Exportar</a>
				</div>
			
		</div>
		
		<div id="divDataTable" style="width: 100%; overflow: auto;"></div>
    
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