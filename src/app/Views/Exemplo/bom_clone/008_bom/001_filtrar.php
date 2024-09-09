<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<title>BomWeb</title>
	<meta http-equiv="X-UA-Compatible" content="IE=8">
	<?php
	include_once(__DIR__ . '/../head.php');
	?>
	<script type="text/javascript"
		src="<?= base_url(); ?>assets/bomweb/jscript/jquery.numberformatter-1.2.2.min.js"></script>

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

				<script type="text/javascript" src="<?= base_url(); ?>assets/bomweb/jscript/listBom.js"></script>

				<strong class="titulo azul">Lista </strong><img
					src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde">
					BOM</strong>
				<a href="#" class="accordion">[ Ocultar Filtro ]</a>
				<div id="filtro">
					<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
					<form id="formPesquisa" action='/bom/list' method="post">
						<fieldset>
							<p>
								<label for="buscaEmp">Empresa:</label>
								<input type="text" id="buscaEmp" name="bom.empresa.nome" value=""
									onblur="limpaId(this,'idEmpresa')" style="width:350px;" />
								<input type="text" id="idEmpresa" name="bom.empresa.id" value=""
									style="visibility: hidden;" />
							</p>
							<p>
								<label for="mes_referencia">Mês/Ano de Referência:</label>
								<input type="text" id="mes_referencia" name="bom.mesReferencia" value="" size="7" />
							</p>
							<input type="button" name="btn_pesquisa" value="Pesquisar" id="btn_pesquisa">
							<input class="reset" type="reset" value="Limpar" />
							<a class="btn btn-primary btn-sm" href="<?= base_url(); ?>exemple/group/endpoint/bom_relatorio_pendente"
								role="button">
								BOMs Pendentes
							</a>

						</fieldset>
					</form>
					<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_dn.jpg" />
				</div>

				<input type="hidden" value="Detro_Admin" id="perfil" />

				<br />

				<a id="insert" href="<?= base_url(); ?>exemple/group/endpoint/bom_cadasrtar" class="buttom_azul">Novo
					BOM</a>


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
		<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_footer_space.gif" />
		<div id="footer">
			<div id="version_control">v1.16.0.6</div>
		</div>
	</div>
	<div id="modalView" style="display: none">

	</div>
</body>

</html>
