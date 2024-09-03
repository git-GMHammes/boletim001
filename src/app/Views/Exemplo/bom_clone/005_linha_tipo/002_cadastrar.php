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
				include_once (__DIR__ . '/../menu.php');
			?>		
			</ul>
		</div>
		
	    <div id="info">
		       
	  	</div>
		<div id="result">
			
		<span><strong class="titulo azul">Cadastro </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde">
		Tipo de Linha
	</strong></span>
		<div id="inclusao">
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
			
				
						
				
				
			
			<form id="form" name="form" action="
		/tipodelinha
	/save" method="post">
				<fieldset>
					
	<script type="text/javascript">
		$(function(){
			$(".submit").click(function(e) {
				if (! isCheckboxMarked()) {
					$("#errorTV").show();
					e.preventDefault();
				} else {
					$("#errorTV").hide();
				}

				if(! isFieldFilled("#codigo")) {
					$("#errorCodigo").show();
					e.preventDefault();
				} else {
					$("#errorCodigo").hide();
				}
				
				if(! isFieldFilled("#nome")) {
					$("#errorNome").show();
					e.preventDefault();
				} else {
					$("#errorNome").hide();
				}
			});
		});
	</script>
		<input type="hidden" name="entity.id" value="">
		<input type="hidden" name="entity.active" value="">

		<p>
			<label for="codigo">Sigla:</label>
			<input id="codigo" name="entity.sigla" value=""  size="3" maxlength="3" minlength="1" /> *
			<label id="errorCodigo" class="error" style="display: none;">Este campo é obrigatório.</label> 
		</p>
	
		<p>
			<label for="nome">Descrição:</label>
			<input id="nome" name="entity.descricao" value="" size="43" maxlength="32" minlength="2" /> * 
			<label id="errorNome" class="error" style="display: none;">Este campo é obrigatório.</label>
		</p>
		<div id="lista">
   			<fieldset>
   				<legend>Tipos de Veículos: <label id="errorTV" class="error" style="display: none;">Selecione ao menos um Tipo de Veículo.</label></legend>
   				<p>
					<table id="tb_veiculos" class="tablesorter">
						<thead>
							<tr>
								<td></td>
								<td>Código</td>
								<td>Descrição</td>
							</tr>
						</thead>
						<tbody>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[1].id" value="1"/>
									</td>
									<td>
										1
									</td>
									<td>Urbano Convencional</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[2].id" value="2"/>
									</td>
									<td>
										2
									</td>
									<td>Urbano C/AR Condicionado</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[3].id" value="3"/>
									</td>
									<td>
										3
									</td>
									<td>Micro Urbano Convencional</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[4].id" value="4"/>
									</td>
									<td>
										4
									</td>
									<td>Micro Urbano C/AR Condicionado</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[5].id" value="5"/>
									</td>
									<td>
										5
									</td>
									<td>Rodoviário Convencional</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[6].id" value="6"/>
									</td>
									<td>
										6
									</td>
									<td>Rodoviário C/AR</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[7].id" value="7"/>
									</td>
									<td>
										7
									</td>
									<td>Micro Rodoviário Convencional</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[8].id" value="8"/>
									</td>
									<td>
										8
									</td>
									<td>Micro Rodoviário C/AR</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[9].id" value="9"/>
									</td>
									<td>
										9
									</td>
									<td>Rodoviário Convencional C/AR</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[10].id" value="10"/>
									</td>
									<td>
										10
									</td>
									<td>Micro Rodoviário C/AR</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[11].id" value="11"/>
									</td>
									<td>
										11
									</td>
									<td>Rodoviário C/AR e Banheiro</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[12].id" value="12"/>
									</td>
									<td>
										12
									</td>
									<td>Micromaster Urbano</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[13].id" value="13"/>
									</td>
									<td>
										13
									</td>
									<td>Micromaster Urbano c/ Ar</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[14].id" value="14"/>
									</td>
									<td>
										14
									</td>
									<td>Micromaster Rodoviário</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[15].id" value="15"/>
									</td>
									<td>
										15
									</td>
									<td>Micromaster Rodoviário c/ Ar</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[16].id" value="16"/>
									</td>
									<td>
										16
									</td>
									<td>Leito</td>
								</tr>
							
								<tr>
									<td>
										<input type="checkbox" class="require-one validate-checkbox-oneormore" name="tiposVeiculo[17].id" value="17"/>
									</td>
									<td>
										17
									</td>
									<td>Executivo</td>
								</tr>
							
						</tbody>
					</table>
				</fieldset>
				<p></p>
		</div>
	
					
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