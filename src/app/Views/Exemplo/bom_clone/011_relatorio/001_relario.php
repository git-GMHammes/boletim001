<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<title>BomWeb</title>
	<meta http-equiv="X-UA-Compatible" content="IE=8">
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
					var COLUMN_DEFINITIONS = [{ 0: "Empresa", 1: "empresa", 2: { "bVisible": true } },
					{ 0: "Código da Linha", 1: "codigoLinha", 2: { "bVisible": true } },
					{ 0: "Nome da Linha", 1: "nomeLinha", 2: { "bVisible": true } },
					{ 0: "Mês de Referência", 1: "mesReferencia", 2: { "bVisible": true } },
					{ 0: "Tipo de Veículo", 1: "descricaoTipoVeiculo", 2: { "bVisible": true } },
					{ 0: "Número da Linha", 1: "numeroLinha", 2: { "bVisible": false } },
					{ 0: "Responsável BOM", 1: "responsavelBOM", 2: { "bVisible": false } },
					{ 0: "Capacidade da Linha", 1: "capacidadeLinha", 2: { "bVisible": false } },
					{ 0: "Frota", 1: "frota", 2: { "bVisible": false } },
					{ 0: "Viagens Extraordinárias A-B", 1: "viagensExtraordinariasAB", 2: { "bVisible": false } },
					{ 0: "Viagens Extraordinárias B-A", 1: "viagensExtraordinariasBA", 2: { "bVisible": false } },
					{ 0: "Viagens Ordinárias A-B", 1: "viagensOrdinariasAB", 2: { "bVisible": false } },
					{ 0: "Viagens Ordinárias B-A", 1: "viagensOrdinariasBA", 2: { "bVisible": false } },
					{ 0: "Extensão Piso I A-B", 1: "piso1AB", 2: { "bVisible": false } },
					{ 0: "Extensão Piso I B-A", 1: "piso1BA", 2: { "bVisible": false } },
					{ 0: "Extensão Piso II A-B", 1: "piso2AB", 2: { "bVisible": false } },
					{ 0: "Extensão Piso II B-A", 1: "piso2BA", 2: { "bVisible": false } },
					{ 0: "Início Horário de Pico Manhã - A-B", 1: "picoInicioManhaAB", 2: { "bVisible": false } },
					{ 0: "Início Horário de Pico Manhã - B-A", 1: "picoInicioManhaBA", 2: { "bVisible": false } },
					{ 0: "Fim Horário de Pico Manhã - A-B", 1: "picoFimManhaAB", 2: { "bVisible": false } },
					{ 0: "Fim Horário de Pico Manhã - B-A", 1: "picoFimManhaBA", 2: { "bVisible": false } },
					{ 0: "Início Horário de Pico Tarde - A-B", 1: "picoInicioTardeAB", 2: { "bVisible": false } },
					{ 0: "Início Horário de Pico Tarde - B-A", 1: "picoInicioTardeBA", 2: { "bVisible": false } },
					{ 0: "Fim Horário de Pico Tarde - A-B", 1: "picoFimTardeAB", 2: { "bVisible": false } },
					{ 0: "Fim Horário de Pico Tarde - B-A", 1: "picoFimTardeBA", 2: { "bVisible": false } },
					{ 0: "Duração Viagem Horário de Pico - A-B", 1: "duracaoViagemPicoAB", 2: { "bVisible": false } },
					{ 0: "Duração Viagem Horário de Pico - B-A", 1: "duracaoViagemPicoBA", 2: { "bVisible": false } },
					{ 0: "Duração Viagem Fora Horário de Pico - A-B", 1: "duracaoViagemForaPicoAB", 2: { "bVisible": false } },
					{ 0: "Duração Viagem Fora Horário de Pico - B-A", 1: "duracaoViagemForaPicoBA", 2: { "bVisible": false } },
					{ 0: "Hierarquização", 1: "hierarquizacao", 2: { "bVisible": false } },
					{ 0: "Tipo da Ligação", 1: "tipoLigacao", 2: { "bVisible": false } },
					{ 0: "Via", 1: "via", 2: { "bVisible": false } },
					{ 0: "Status da Linha", 1: "statusLinha", 2: { "bVisible": false } },
					{ 0: "Código da Seção", 1: "codigoSecao", 2: { "bVisible": false } },
					{ 0: "Junção", 1: "juncaoSecao", 2: { "bVisible": false } },
					{ 0: "Quantidade de Passageiros A-B", 1: "passageirosAB", 2: { "bVisible": false } },
					{ 0: "Quantidade de Passageiros B-A", 1: "passageirosBA", 2: { "bVisible": false } },
					{ 0: "Quantidade de Passageiros A-B - Anterior", 1: "passageirosAnteriorAB", 2: { "bVisible": false } },
					{ 0: "Quantidade de Passageiros B-A - Anterior", 1: "passageirosAnteriorBA", 2: { "bVisible": false } },
					{ 0: "Sem Passageiro", 1: "secaoSemPassageiro", 2: { "bVisible": false } },
					{ 0: "Total Passageiros A-B", 1: "totalPassageirosAB", 2: { "bVisible": false } },
					{ 0: "Total Passageiros B-A", 1: "totalPassageirosBA", 2: { "bVisible": false } },
					{ 0: "Total Receita", 1: "totalReceita", 2: { "bVisible": false } },
					{ 0: "Tarifa Atual", 1: "tarifaAtual", 2: { "bVisible": false } },
					{ 0: "Tarifa Promocional", 1: "tarifaPromocional", 2: { "bVisible": false } },
					{ 0: "Tarifa Anterior", 1: "tarifaAnterior", 2: { "bVisible": false } }];

					$(document).ready(function () {
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
							close: function (event, ui) {
								bomweb.updateMultiSelect($(this),
									$("#selectLinhaFormRelatorio"),
									pathName + "/relatorio/buscaLinhas.json",
									"id",
									["comboString"]
								);
							}
						});

						$("#selectLinhaFormRelatorio").multiselect({
							close: function (event, ui) {
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
						if (!temPerfilEmpresa) {
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

						if (!isFieldFilled("#mesAnoInicio")) {
							$("#errorMesAnoInicio").show();
							podeGerarRelatorio = false;
						}
						else {
							$("#errorMesAnoInicio").hide();
						}

						if (!isFieldFilled("#mesAnoFim")) {
							$("#errorMesAnoFim").show();
							podeGerarRelatorio = false;
						}
						else {
							$("#errorMesAnoFim").hide();
						}

						return podeGerarRelatorio;
					}
				</script>
				<strong class="titulo azul">Relatório </strong><img
					src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde">
					BOM</strong>

				<a href="#" class="accordion">[ Ocultar Filtro ]</a>
				<div id="filtro">
					<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
					<form id="form" method="post">
						<fieldset>
							<p>
								<label for="empresas">Empresa:</label>

							<div id="divEmpresas" style="display: none;">
								<select id="selectEmpresaFormRelatorio" multiple="multiple"
									name="filtro.empresasComoString">

									<option value="2">AUTO COMERCIAL BARRA MANSA LTDA.</option>

									<option value="91">AUTO LOTAÇÃO INGÁ LTDA.</option>

									<option value="1">AUTO ÔNIBUS FAGUNDES LTDA.</option>

									<option value="4">AUTO ÔNIBUS VERA CRUZ LTDA.</option>

									<option value="7">AUTO VIAÇÃO 1001 LTDA.</option>

									<option value="5">AUTO VIAÇÃO ABC S/A</option>

									<option value="17">AUTO VIAÇÃO JUREMA S/A</option>

									<option value="9">AUTO VIAÇÃO REGINAS LTDA.</option>

									<option value="10">AUTO VIAÇÃO SALINEIRA LTDA.</option>

									<option value="6">AUTO VIAÇÃO TANGUAENSE LTDA.</option>

									<option value="11">AUTO VIAÇÃO VERA CRUZ LTDA.</option>

									<option value="20">CAVALCANTI &amp; CIA. LTDA. (NILOPOLITANA)</option>

									<option value="15">COESA TRANSPORTES LTDA.</option>

									<option value="14">COLITUR TRANSPORTES RODOVIÁRIOS LTDA.</option>

									<option value="96">COSTA VERDE TRANSPORTES LTDA.</option>

									<option value="19">EMPRESA BRASIL S/A - TRANSPORTES E TURISMO</option>

									<option value="22">EMPRESA DE ÔNIBUS E TURISMO PEDRO ANTONIO LTDA.</option>

									<option value="95">EMPRESA DE TRANSPORTES BRASO LISBOA LTDA.</option>

									<option value="21">EMPRESA DE TRANSPORTES CONTINENTAL LTDA.</option>

									<option value="24">EMPRESA DE TRANSPORTES FLORES LTDA.</option>

									<option value="25">EMPRESA DE TRANSPORTES LIMOUSINE CARIOCA S/A.</option>

									<option value="23">EMPRESA SANTA TEREZINHA LTDA.</option>

									<option value="27">EVANIL TRANSPORTES E TURISMO LTDA.</option>

									<option value="30">EXPRESSO GARCIA LTDA.</option>

									<option value="33">EXPRESSO PINTO &amp; PALMA LTDA.</option>

									<option value="28">EXPRESSO REAL RIO LTDA.</option>

									<option value="105">EXPRESSO RECREIO TRANSPORTE DE PASSAGEIROS LTDA</option>

									<option value="36">EXPRESSO RIO DE JANEIRO LTDA.</option>

									<option value="26">EXPRESSO SÃO FRANCISCO LTDA.</option>

									<option value="35">FACIL TRANSPORTES E TURISMO LTDA.</option>

									<option value="40">FAZENI TRANSPORTES E TURISMO LTDA.</option>

									<option value="89">FEITAL TRANSPORTES E TURISMO LTDA.</option>

									<option value="38">GARDEL TURISMO LTDA.</option>

									<option value="37">J.C. GUIMARÃES TRANSPORTES COLETIVOS LTDA.</option>

									<option value="94">J.F. FARINHA AUTO ÔNIBUS LTDA.</option>

									<option value="39">LINAVE TRANSPORTES LTDA.</option>

									<option value="50">MASTER TRANSPORTES COLETIVOS DE PASSAGEIROS LTDA.</option>

									<option value="29">NITURVIA NOVA IGUAÇU TURISMO E VIAÇÃO LTDA.</option>

									<option value="42">RÁPIDO MACAENSE LTDA.</option>

									<option value="43">RÁPIDO SÃO CRISTÓVÃO LTDA.</option>

									<option value="44">RIO ITA LTDA.</option>

									<option value="61">SANTA EUGÊNIA TRANSPORTES E TURISMO LTDA.</option>

									<option value="31">TB TRANSPORTES BLANCO EIRELI</option>

									<option value="55">TRANSA TRANSPORTE COLETIVO LTDA.</option>

									<option value="99">TRANSPORTADORA MACABÚ LTDA.</option>

									<option value="48">TRANSPORTADORA TINGUÁ LTDA.</option>

									<option value="58">TRANSPORTE MAGELI LTDA.</option>

									<option value="59">TRANSPORTES E TURISMO ALTO MINHO LTDA.</option>

									<option value="53">TRANSPORTES E TURISMO MACHADO LTDA.</option>

									<option value="46">TRANSPORTES FABIO&#039;S LTDA.</option>

									<option value="52">TRANSPORTES SANTO ANTÔNIO LTDA.</option>

									<option value="54">TRANSPORTES ÚNICA PETRÓPOLIS LTDA.</option>

									<option value="103">TRANSTUR VILA EMIL LTDA.</option>

									<option value="56">TRANSTURISMO REI LTDA. (TREL)</option>

									<option value="57">TRANSTURISMO RIO MINHO LTDA.</option>

									<option value="102">UNIÃO TRANSPORTE INTERESTADUAL DE LUXO S/A - UTIL</option>

									<option value="106">UNIRIO TRANSPORTES LTDA.</option>

									<option value="60">VIAÇÃO AGULHAS NEGRAS LTDA.</option>

									<option value="12">VIAÇÃO BARRA DO PIRAÍ TURISMO LTDA.</option>

									<option value="62">VIAÇÃO BEIRA MAR LTDA.</option>

									<option value="98">VIAÇÃO CARMENSE LTDA.</option>

									<option value="65">VIAÇÃO CIDADE DO AÇO LTDA.</option>

									<option value="67">VIAÇÃO ELITE LTDA.</option>

									<option value="68">VIAÇÃO ESTRELA S/A</option>

									<option value="69">VIAÇÃO FALCÃO LTDA.</option>

									<option value="70">VIAÇÃO GALO BRANCO S/A</option>

									<option value="71">VIAÇÃO MAUÁ S/A.</option>

									<option value="66">VIAÇÃO MIRANTE LTDA.</option>

									<option value="81">VIAÇÃO MONTES BRANCOS LTDA.</option>

									<option value="47">VIAÇÃO NORMANDY DO TRIÂNGULO LTDA.</option>

									<option value="73">VIAÇÃO NOSSA SENHORA APARECIDA LTDA.</option>

									<option value="74">VIAÇÃO NOSSA SENHORA DA PENHA LTDA.</option>

									<option value="72">VIAÇÃO NOSSA SENHORA DO AMPARO LTDA.</option>

									<option value="108">VIAÇÃO NOVA NIL LTDA.</option>

									<option value="92">VIAÇÃO PENDOTIBA S/A.</option>

									<option value="93">VIAÇÃO PENEDO LTDA.</option>

									<option value="75">VIAÇÃO PINHEIRAL LTDA.</option>

									<option value="76">VIAÇÃO PONTE COBERTA LTDA.</option>

									<option value="77">VIAÇÃO PROGRESSO E TURISMO S/A.</option>

									<option value="78">VIAÇÃO RESENDENSE INTERMUNICIPAL LTDA.</option>

									<option value="79">VIAÇÃO SALUTARIS E TURISMO S/A.</option>

									<option value="80">VIAÇÃO SANTA LUZIA LTDA.</option>

									<option value="83">VIAÇÃO SÃO JOSÉ LTDA.</option>

									<option value="13">VIAÇÃO SÃO PEDRO D&#039;ALDEIA LTDA.</option>

									<option value="84">VIAÇÃO SUL FLUMINENSE TRANSPORTES E TURISMO LTDA.</option>

									<option value="85">VIAÇÃO TERESÓPOLIS E TURISMO LTDA.</option>

									<option value="86">VIAÇÃO UNIÃO LTDA.</option>

									<option value="87">VIAÇÃO VERA CRUZ S/A.</option>

									<option value="88">VIAÇÃO VILA RICA LTDA.</option>

								</select> *
								<label id="errorEmpresa" class="error" for="selectEmpresaFormRelatorio"
									style="display: none;">Este campo é obrigatório.</label>
							</div>
							</p>
							<p>
								<label for="linhas">Linha:</label>
								<select id="selectLinhaFormRelatorio" multiple="multiple"
									name="filtro.linhasComoString">

								</select> *
								<label id="errorLinha" class="error" for="selectLinhaFormRelatorio"
									style="display: none;">Este campo é obrigatório.</label>
								<img class="loading" alt="Carregando"
									src="<?= base_url(); ?>assets/bomweb/images/carregando.gif">
							</p>
							<p>
								<label for="tipoVeiculos">Tipo de Veículo:</label>
								<select id="selectTipoVeiculoFormRelatorio" multiple="multiple"
									name="filtro.tiposVeiculoComoString">

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
								<label id="errorTipoDeVeiculo" class="error" for="selectTipoDeVeiculoFormRelatorio"
									style="display: none;">Este campo é obrigatório.</label>
								<img class="loading" alt="Carregando"
									src="<?= base_url(); ?>assets/bomweb/images/carregando.gif">
							</p>
							<p>
								<label for="datepicker">Mês/Ano Inicial:</label>
								<input id="mesAnoInicio" type="text" name="filtro.dataInicial" maxlength="8" size="8"
									class="required"> *
								<label id="errorMesAnoInicio" class="error" for="selectEmpresaFormRelatorio"
									style="display: none;">Este campo é obrigatório.</label>
							</p>
							<p>
								<label for="datepicker">Mês/Ano Final:</label>
								<input id="mesAnoFim" type="text" name="filtro.dataFinal" maxlength="8" size="8"
									class="required"> *
								<label id="errorMesAnoFim" class="error" for="selectEmpresaFormRelatorio"
									style="display: none;">Este campo é obrigatório.</label>
							</p>
							<p>
								<label for="camposRelatorio">Campos do Relatório:</label>
								<select id="camposRelatorio" multiple="multiple"
									name="filtro.camposRelatorioComoString">
									<option value="empresa" disabled="disabled" selected="selected">Empresa</option>
									<option value="mesReferencia" disabled="disabled" selected="selected">Mês de
										Referência</option>
									<option value="responsavelBOM">Responsável BOM</option>
									<optgroup label="Linha">
										<option value="nomeLinha" disabled="disabled" selected="selected">Nome da Linha
										</option>
										<option value="codigoLinha" disabled="disabled" selected="selected">Código da
											Linha</option>
										<option value="descricaoTipoVeiculo" disabled="disabled" selected="selected">
											Tipo de Veículo</option>
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
										<option value="duracaoViagemPicoAB">Duração Viagem Horário de Pico - A-B
										</option>
										<option value="duracaoViagemPicoBA">Duração Viagem Horário de Pico - B-A
										</option>
										<option value="duracaoViagemForaPicoAB">Duração Viagem Fora Horário de Pico -
											A-B</option>
										<option value="duracaoViagemForaPicoBA">Duração Viagem Fora Horário de Pico -
											B-A</option>
										<option value="hierarquizacao">Hierarquização</option>
										<option value="tipoLigacao">Tipo da Ligação</option>
										<option value="via">Via</option>
										<option value="statusLinha">Status da Linha</option>
									</optgroup>
									<optgroup label="Seção">
										<option value="codigoSecao">Código</option>
										<option value="juncaoSecao">Junção</option>
										<option value="passageirosAB">Quantidade de Passageiros A-B</option>
										<option value="passageirosAnteriorAB">Quantidade de Passageiros A-B - Anterior
										</option>
										<option value="passageirosBA">Quantidade de Passageiros B-A</option>
										<option value="passageirosAnteriorBA">Quantidade de Passageiros B-A - Anterior
										</option>
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

							<input type="button" id="dataTableFetchData" value="Gerar Relatório" />

							<input type="button" id="resetButton" value="Limpar" />
						</fieldset>
					</form>
					<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_dn.jpg" />

					<div>
						<a id="linkExportRelatorio" href="/relatorio/exportar" class="buttom_verde">Exportar</a>
					</div>
					<div>
						Esta divi deve substituir o campo empresas acima.
					</div>
					<div>
						<ul class="ui-multiselect-checkboxes ui-helper-reset" style="height: 175px;">
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-0"
									class="ui-corner-all"><input id="ui-multiselect-selectEmpresaFormRelatorio-option-0"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="2"
										title="AUTO COMERCIAL BARRA MANSA LTDA."><span>AUTO COMERCIAL BARRA MANSA
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-1"
									class="ui-corner-all"><input id="ui-multiselect-selectEmpresaFormRelatorio-option-1"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="91"
										title="AUTO LOTAÇÃO INGÁ LTDA."><span>AUTO LOTAÇÃO INGÁ LTDA.</span></label>
							</li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-2"
									class="ui-corner-all"><input id="ui-multiselect-selectEmpresaFormRelatorio-option-2"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="1"
										title="AUTO ÔNIBUS FAGUNDES LTDA."><span>AUTO ÔNIBUS FAGUNDES
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-3"
									class="ui-corner-all ui-state-hover"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-3"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="4"
										title="AUTO ÔNIBUS VERA CRUZ LTDA."><span>AUTO ÔNIBUS VERA CRUZ
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-4"
									class="ui-corner-all"><input id="ui-multiselect-selectEmpresaFormRelatorio-option-4"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="7"
										title="AUTO VIAÇÃO 1001 LTDA."><span>AUTO VIAÇÃO 1001 LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-5"
									class="ui-corner-all"><input id="ui-multiselect-selectEmpresaFormRelatorio-option-5"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="5"
										title="AUTO VIAÇÃO ABC S/A"><span>AUTO VIAÇÃO ABC S/A</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-6"
									class="ui-corner-all"><input id="ui-multiselect-selectEmpresaFormRelatorio-option-6"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="17"
										title="AUTO VIAÇÃO JUREMA S/A"><span>AUTO VIAÇÃO JUREMA S/A</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-7"
									class="ui-corner-all"><input id="ui-multiselect-selectEmpresaFormRelatorio-option-7"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="9"
										title="AUTO VIAÇÃO REGINAS LTDA."><span>AUTO VIAÇÃO REGINAS LTDA.</span></label>
							</li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-8"
									class="ui-corner-all"><input id="ui-multiselect-selectEmpresaFormRelatorio-option-8"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="10"
										title="AUTO VIAÇÃO SALINEIRA LTDA."><span>AUTO VIAÇÃO SALINEIRA
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-9"
									class="ui-corner-all"><input id="ui-multiselect-selectEmpresaFormRelatorio-option-9"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="6"
										title="AUTO VIAÇÃO TANGUAENSE LTDA."><span>AUTO VIAÇÃO TANGUAENSE
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-10"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-10"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="11"
										title="AUTO VIAÇÃO VERA CRUZ LTDA."><span>AUTO VIAÇÃO VERA CRUZ
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-11"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-11"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="20"
										title="CAVALCANTI &amp; CIA. LTDA. (NILOPOLITANA)"><span>CAVALCANTI &amp; CIA.
										LTDA. (NILOPOLITANA)</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-12"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-12"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="15"
										title="COESA TRANSPORTES LTDA."><span>COESA TRANSPORTES LTDA.</span></label>
							</li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-13"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-13"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="14"
										title="COLITUR TRANSPORTES RODOVIÁRIOS LTDA."><span>COLITUR TRANSPORTES
										RODOVIÁRIOS LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-14"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-14"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="96"
										title="COSTA VERDE TRANSPORTES LTDA."><span>COSTA VERDE TRANSPORTES
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-15"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-15"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="19"
										title="EMPRESA BRASIL S/A - TRANSPORTES E TURISMO"><span>EMPRESA BRASIL S/A -
										TRANSPORTES E TURISMO</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-16"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-16"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="22"
										title="EMPRESA DE ÔNIBUS E TURISMO PEDRO ANTONIO LTDA."><span>EMPRESA DE ÔNIBUS
										E TURISMO PEDRO ANTONIO LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-17"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-17"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="95"
										title="EMPRESA DE TRANSPORTES BRASO LISBOA LTDA."><span>EMPRESA DE TRANSPORTES
										BRASO LISBOA LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-18"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-18"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="21"
										title="EMPRESA DE TRANSPORTES CONTINENTAL LTDA."><span>EMPRESA DE TRANSPORTES
										CONTINENTAL LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-19"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-19"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="24"
										title="EMPRESA DE TRANSPORTES FLORES LTDA."><span>EMPRESA DE TRANSPORTES FLORES
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-20"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-20"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="25"
										title="EMPRESA DE TRANSPORTES LIMOUSINE CARIOCA S/A."><span>EMPRESA DE
										TRANSPORTES LIMOUSINE CARIOCA S/A.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-21"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-21"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="23"
										title="EMPRESA SANTA TEREZINHA LTDA."><span>EMPRESA SANTA TEREZINHA
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-22"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-22"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="27"
										title="EVANIL TRANSPORTES E TURISMO LTDA."><span>EVANIL TRANSPORTES E TURISMO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-23"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-23"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="30"
										title="EXPRESSO GARCIA LTDA."><span>EXPRESSO GARCIA LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-24"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-24"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="33"
										title="EXPRESSO PINTO &amp; PALMA LTDA."><span>EXPRESSO PINTO &amp; PALMA
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-25"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-25"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="28"
										title="EXPRESSO REAL RIO LTDA."><span>EXPRESSO REAL RIO LTDA.</span></label>
							</li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-26"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-26"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="105"
										title="EXPRESSO RECREIO TRANSPORTE DE PASSAGEIROS LTDA"><span>EXPRESSO RECREIO
										TRANSPORTE DE PASSAGEIROS LTDA</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-27"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-27"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="36"
										title="EXPRESSO RIO DE JANEIRO LTDA."><span>EXPRESSO RIO DE JANEIRO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-28"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-28"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="26"
										title="EXPRESSO SÃO FRANCISCO LTDA."><span>EXPRESSO SÃO FRANCISCO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-29"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-29"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="35"
										title="FACIL TRANSPORTES E TURISMO LTDA."><span>FACIL TRANSPORTES E TURISMO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-30"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-30"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="40"
										title="FAZENI TRANSPORTES E TURISMO LTDA."><span>FAZENI TRANSPORTES E TURISMO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-31"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-31"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="89"
										title="FEITAL TRANSPORTES E TURISMO LTDA."><span>FEITAL TRANSPORTES E TURISMO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-32"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-32"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="38"
										title="GARDEL TURISMO LTDA."><span>GARDEL TURISMO LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-33"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-33"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="37"
										title="J.C. GUIMARÃES TRANSPORTES COLETIVOS LTDA."><span>J.C. GUIMARÃES
										TRANSPORTES COLETIVOS LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-34"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-34"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="94"
										title="J.F. FARINHA AUTO ÔNIBUS LTDA."><span>J.F. FARINHA AUTO ÔNIBUS
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-35"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-35"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="39"
										title="LINAVE TRANSPORTES LTDA."><span>LINAVE TRANSPORTES LTDA.</span></label>
							</li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-36"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-36"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="50"
										title="MASTER TRANSPORTES COLETIVOS DE PASSAGEIROS LTDA."><span>MASTER
										TRANSPORTES COLETIVOS DE PASSAGEIROS LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-37"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-37"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="29"
										title="NITURVIA NOVA IGUAÇU TURISMO E VIAÇÃO LTDA."><span>NITURVIA NOVA IGUAÇU
										TURISMO E VIAÇÃO LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-38"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-38"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="42"
										title="RÁPIDO MACAENSE LTDA."><span>RÁPIDO MACAENSE LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-39"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-39"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="43"
										title="RÁPIDO SÃO CRISTÓVÃO LTDA."><span>RÁPIDO SÃO CRISTÓVÃO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-40"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-40"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="44"
										title="RIO ITA LTDA."><span>RIO ITA LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-41"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-41"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="61"
										title="SANTA EUGÊNIA TRANSPORTES E TURISMO LTDA."><span>SANTA EUGÊNIA
										TRANSPORTES E TURISMO LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-42"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-42"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="31"
										title="TB TRANSPORTES BLANCO EIRELI"><span>TB TRANSPORTES BLANCO
										EIRELI</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-43"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-43"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="55"
										title="TRANSA TRANSPORTE COLETIVO LTDA."><span>TRANSA TRANSPORTE COLETIVO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-44"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-44"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="99"
										title="TRANSPORTADORA MACABÚ LTDA."><span>TRANSPORTADORA MACABÚ
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-45"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-45"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="48"
										title="TRANSPORTADORA TINGUÁ LTDA."><span>TRANSPORTADORA TINGUÁ
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-46"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-46"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="58"
										title="TRANSPORTE MAGELI LTDA."><span>TRANSPORTE MAGELI LTDA.</span></label>
							</li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-47"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-47"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="59"
										title="TRANSPORTES E TURISMO ALTO MINHO LTDA."><span>TRANSPORTES E TURISMO ALTO
										MINHO LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-48"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-48"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="53"
										title="TRANSPORTES E TURISMO MACHADO LTDA."><span>TRANSPORTES E TURISMO MACHADO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-49"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-49"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="46"
										title="TRANSPORTES FABIO'S LTDA."><span>TRANSPORTES FABIO'S LTDA.</span></label>
							</li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-50"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-50"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="52"
										title="TRANSPORTES SANTO ANTÔNIO LTDA."><span>TRANSPORTES SANTO ANTÔNIO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-51"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-51"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="54"
										title="TRANSPORTES ÚNICA PETRÓPOLIS LTDA."><span>TRANSPORTES ÚNICA PETRÓPOLIS
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-52"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-52"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="103"
										title="TRANSTUR VILA EMIL LTDA."><span>TRANSTUR VILA EMIL LTDA.</span></label>
							</li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-53"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-53"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="56"
										title="TRANSTURISMO REI LTDA. (TREL)"><span>TRANSTURISMO REI LTDA.
										(TREL)</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-54"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-54"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="57"
										title="TRANSTURISMO RIO MINHO LTDA."><span>TRANSTURISMO RIO MINHO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-55"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-55"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="102"
										title="UNIÃO TRANSPORTE INTERESTADUAL DE LUXO S/A - UTIL"><span>UNIÃO TRANSPORTE
										INTERESTADUAL DE LUXO S/A - UTIL</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-56"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-56"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="106"
										title="UNIRIO TRANSPORTES LTDA."><span>UNIRIO TRANSPORTES LTDA.</span></label>
							</li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-57"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-57"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="60"
										title="VIAÇÃO AGULHAS NEGRAS LTDA."><span>VIAÇÃO AGULHAS NEGRAS
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-58"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-58"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="12"
										title="VIAÇÃO BARRA DO PIRAÍ TURISMO LTDA."><span>VIAÇÃO BARRA DO PIRAÍ TURISMO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-59"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-59"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="62"
										title="VIAÇÃO BEIRA MAR LTDA."><span>VIAÇÃO BEIRA MAR LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-60"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-60"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="98"
										title="VIAÇÃO CARMENSE LTDA."><span>VIAÇÃO CARMENSE LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-61"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-61"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="65"
										title="VIAÇÃO CIDADE DO AÇO LTDA."><span>VIAÇÃO CIDADE DO AÇO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-62"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-62"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="67"
										title="VIAÇÃO ELITE LTDA."><span>VIAÇÃO ELITE LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-63"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-63"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="68"
										title="VIAÇÃO ESTRELA S/A"><span>VIAÇÃO ESTRELA S/A</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-64"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-64"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="69"
										title="VIAÇÃO FALCÃO LTDA."><span>VIAÇÃO FALCÃO LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-65"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-65"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="70"
										title="VIAÇÃO GALO BRANCO S/A"><span>VIAÇÃO GALO BRANCO S/A</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-66"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-66"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="71"
										title="VIAÇÃO MAUÁ S/A."><span>VIAÇÃO MAUÁ S/A.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-67"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-67"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="66"
										title="VIAÇÃO MIRANTE LTDA."><span>VIAÇÃO MIRANTE LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-68"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-68"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="81"
										title="VIAÇÃO MONTES BRANCOS LTDA."><span>VIAÇÃO MONTES BRANCOS
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-69"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-69"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="47"
										title="VIAÇÃO NORMANDY DO TRIÂNGULO LTDA."><span>VIAÇÃO NORMANDY DO TRIÂNGULO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-70"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-70"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="73"
										title="VIAÇÃO NOSSA SENHORA APARECIDA LTDA."><span>VIAÇÃO NOSSA SENHORA
										APARECIDA LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-71"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-71"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="74"
										title="VIAÇÃO NOSSA SENHORA DA PENHA LTDA."><span>VIAÇÃO NOSSA SENHORA DA PENHA
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-72"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-72"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="72"
										title="VIAÇÃO NOSSA SENHORA DO AMPARO LTDA."><span>VIAÇÃO NOSSA SENHORA DO
										AMPARO LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-73"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-73"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="108"
										title="VIAÇÃO NOVA NIL LTDA."><span>VIAÇÃO NOVA NIL LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-74"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-74"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="92"
										title="VIAÇÃO PENDOTIBA S/A."><span>VIAÇÃO PENDOTIBA S/A.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-75"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-75"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="93"
										title="VIAÇÃO PENEDO LTDA."><span>VIAÇÃO PENEDO LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-76"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-76"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="75"
										title="VIAÇÃO PINHEIRAL LTDA."><span>VIAÇÃO PINHEIRAL LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-77"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-77"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="76"
										title="VIAÇÃO PONTE COBERTA LTDA."><span>VIAÇÃO PONTE COBERTA
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-78"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-78"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="77"
										title="VIAÇÃO PROGRESSO E TURISMO S/A."><span>VIAÇÃO PROGRESSO E TURISMO
										S/A.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-79"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-79"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="78"
										title="VIAÇÃO RESENDENSE INTERMUNICIPAL LTDA."><span>VIAÇÃO RESENDENSE
										INTERMUNICIPAL LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-80"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-80"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="79"
										title="VIAÇÃO SALUTARIS E TURISMO S/A."><span>VIAÇÃO SALUTARIS E TURISMO
										S/A.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-81"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-81"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="80"
										title="VIAÇÃO SANTA LUZIA LTDA."><span>VIAÇÃO SANTA LUZIA LTDA.</span></label>
							</li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-82"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-82"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="83"
										title="VIAÇÃO SÃO JOSÉ LTDA."><span>VIAÇÃO SÃO JOSÉ LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-83"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-83"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="13"
										title="VIAÇÃO SÃO PEDRO D'ALDEIA LTDA."><span>VIAÇÃO SÃO PEDRO D'ALDEIA
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-84"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-84"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="84"
										title="VIAÇÃO SUL FLUMINENSE TRANSPORTES E TURISMO LTDA."><span>VIAÇÃO SUL
										FLUMINENSE TRANSPORTES E TURISMO LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-85"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-85"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="85"
										title="VIAÇÃO TERESÓPOLIS E TURISMO LTDA."><span>VIAÇÃO TERESÓPOLIS E TURISMO
										LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-86"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-86"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="86"
										title="VIAÇÃO UNIÃO LTDA."><span>VIAÇÃO UNIÃO LTDA.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-87"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-87"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="87"
										title="VIAÇÃO VERA CRUZ S/A."><span>VIAÇÃO VERA CRUZ S/A.</span></label></li>
							<li class=""><label for="ui-multiselect-selectEmpresaFormRelatorio-option-88"
									class="ui-corner-all"><input
										id="ui-multiselect-selectEmpresaFormRelatorio-option-88"
										name="multiselect_selectEmpresaFormRelatorio" type="checkbox" value="88"
										title="VIAÇÃO VILA RICA LTDA."><span>VIAÇÃO VILA RICA LTDA.</span></label></li>
						</ul>
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