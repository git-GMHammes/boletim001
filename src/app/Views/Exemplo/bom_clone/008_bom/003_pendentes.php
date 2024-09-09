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
					$(document).ready(function () {
						listPage = new ListPage(pathName + "/bom/pendentes", "BOM");

						listPage.setSearchFieldsIds(["idEmpresa", "mesAnoInicio", "mesAnoFim", "selectStatus"]);

						listPage.addColumnDefinition("Empresa", "empresa", { "sWidth": "50%" });
						listPage.addColumnDefinition("Mês/Ano de Referência", "mesAnoReferencia", { fnRender: createRowDateValueRenderFunction("mesAnoReferencia") });
						listPage.addColumnDefinition("Status", "statusPendencia");
						listPage.addColumnDefinition("Limite de Entrega", "dataLimiteFechamento", { fnRender: createRowDateValueRenderFunction("dataLimiteFechamento") });
						listPage.ignoreActionColumn();

					});

					//Auto complete da Busca
					$(function () {

						$("#buscaEmp").autocomplete({
							width: 352,
							source: function (request, response) {
								$.ajax({
									url: pathName + "/empresa/busca.json?term=" + $("#buscaEmp").val(),
									dataType: "json",
									data: {
										featureClass: "P",
										style: "full",
										maxRows: 12,
										name_startsWith: request.term
									},
									success: function (data) {
										response($.map(data.empresa, function (item) {
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
							select: function (event, ui) {
								$("#idEmpresa").val(ui.item.data);
							}
						});

						$("#btn_pesquisa").click(function () {
							listPage.initialize();
						}
						);

						$("#mesAnoInicio").mask("99/9999");
						$("#mesAnoFim").mask("99/9999");

					});


				</script>
				<strong class="titulo azul">Pendentes </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong
					class="titulo verde"> BOM</strong>
				<a href="#" class="accordion">[ Ocultar Filtro ]</a>
				<div id="filtro">
					<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
					<form id="formPesquisa" action='/bom/pendentes' method="post">
						<fieldset>

							<p>
								<label for="buscaEmp">Empresa:</label>
								<input type="text" id="buscaEmp" name="filtro.nomeEmpresa" value=""
									onblur="limpaId(this,'idEmpresa')" style="width:350px;" />
								<input type="text" id="idEmpresa" name="filtro.empresa" value=""
									style="visibility: hidden;" />
							</p>

							<p>
								<label for="datepicker">Mês/Ano Inicial:</label>
								<input type="text" id="mesAnoInicio" value="" name="filtro.dataInicial" maxlength="8"
									size="8">
							</p>

							<p>
								<label for="datepicker">Mês/Ano Final:</label>
								<input type="text" id="mesAnoFim" value="" name="filtro.dataFinal" maxlength="8"
									size="8">
							</p>
							<p>
								<label for="selectStatus">Status:</label>
								<select id="selectStatus" name="filtro.status">

									<option value="Todos">Todos</option>

									<option value="Aberto">Aberto</option>

									<option value="Reaberto">Reaberto</option>

									<option value="Vencido">Vencido</option>

								</select>
							</p>
							<input type="button" name="btn_pesquisa" value="Pesquisar" id="btn_pesquisa">
							<input class="reset" type="reset" value="Limpar" />
						</fieldset>
					</form>
					<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_dn.jpg" />
				</div>
				<br />
				<div id="divDataTable" style="width: 100%; overflow: auto;">
				</div>

				<a id="linkExportPendentes" href="/bom/exportarPendentes">Exportar</a>


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