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

		<script type="text/javascript">
			function showVeiculo(obj) {
				index = obj.selectedIndex;
				count = obj.options.length;
				for(i=1;i<count;i++)
					document.getElementById('veic'+(i-1)).style.display = 'none';
				if(index > 0)
					document.getElementById('veic'+(index-1)).style.display = 'block';
			}
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
				include_once(__DIR__ . '/../menu.php');
				?>				
			</ul>
		</div>
		
	    <div id="info">
		       
	  	</div>
		<div id="result">
			
		<span><strong class="titulo azul">Cadastro </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde">
	<script type="text/javascript" src="/jscript/formLinha.js"></script>
	<script type="text/javascript">

		</script>
		Linha
	</strong></span>
		<div id="inclusao">
			<img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
			
			<form id="form" name="form" action="
		/linha
	/save" method="post">
				<fieldset>
					
	
		<input type="hidden" name="entity.futuro" value="">
		<input type="hidden" name="entity.id" value="">
		<input type="hidden" name="entity.active" value="">
		<input type="hidden" name="entity.linhaVigente.id" value="">
		<input type="hidden" name="entity.linhaVigente.active" value="">

		
		<p>
			<label for="status">Status da Linha: </label>
   			<select id="status" name="entity.linhaVigente.status" class="required">
             	
             		
	               		<option value="0" selected="true">Ativa</option>
             		
             		
             	
             		
	               		<option value="1" >Cancelada</option>
             		
             		
             	
             		
	               		<option value="2" >Paralisada</option>
             		
             		
             	
             		
	               		<option value="3" >Subjudice</option>
             		
             		
             	
			</select> * 
		</p>
		
		
		
		
		
		<p>
			<label for="buscaEmp">Empresa: </label>

			<input type="text" id="buscaEmp" name="entity.linhaVigente.empresa.nome" value="" onblur="limpaId(this,'idEmpresa')" style="width:350px;" class="required"/>  *
			<input type="hidden" id="idEmpresa" name="entity.linhaVigente.empresa.id" value=""/>
		</p>
		
		
		
		
		<p>
			<label for="codigo">Código da Linha:</label>
			<input id="codigo" type="text" name="entity.linhaVigente.codigo" value="" class="required" size="9" number="true" maxlength="9" minlength="9"  /> * 
		</p>
   		<p>
			<label for="numeroLinha">Número da Linha:</label>
			<input type="text" id="numeroLinha" value="" name="entity.linhaVigente.numeroLinha" size="9" maxlength="9"  > 
		</p>   		
		<p id="pNomeLinha">
			<label for="nomeLinha">Nome da Linha:</label>
			<label id="nomeLinha"></label>
			<br/>
		</p>
		<p>
			<label for="linhaPontoInicial">Ponto Inicial:</label>
			<input id="linhaPontoInicial" type="text" name="entity.linhaVigente.pontoInicial" value="" class="required" size="30" minlength="2"  /> * 
		</p>
		<p>
			<label for="linhaPontoFinal">Ponto Final:</label>
			<input id="linhaPontoFinal" type="text" name="entity.linhaVigente.pontoFinal" value="" class="required" size="30" minlength="2"  /> * 
		</p>
   		<p>
			<label for="via">Via:</label>
			<input type="text" id="via" value="" name="entity.linhaVigente.via" size="30"  > 
		</p>   		
   		<p>
			<label for="tipoLigacao">Tipo da Ligação:</label>
			<input type="text" id="tipoLigacao" value="" name="entity.linhaVigente.tipoLigacao" class="required" size="30"  > * 
		</p>   		
		
		
   		
   		<p>
   		    <label for="tipoDeLinha">Tipos de Linha:</label>
   			
  				<input id="tipoDeLinha" type="checkbox" class="require-one validate-checkbox-oneormore" name="tipoLinhas[0].id" value="1" >Linha Rodoviária&nbsp;&nbsp;
            
  				<input id="tipoDeLinha" type="checkbox" class="require-one validate-checkbox-oneormore" name="tipoLinhas[1].id" value="2" >Linha Rodoviária com Ar&nbsp;&nbsp;
            
  				<input id="tipoDeLinha" type="checkbox" class="require-one validate-checkbox-oneormore" name="tipoLinhas[2].id" value="3" >Linha Urbana&nbsp;&nbsp;
            
  				<input id="tipoDeLinha" type="checkbox" class="require-one validate-checkbox-oneormore" name="tipoLinhas[3].id" value="4" >Linha Urbana com Ar&nbsp;&nbsp;
            
  				<input id="tipoDeLinha" type="checkbox" class="require-one validate-checkbox-oneormore" name="tipoLinhas[4].id" value="5" >Linha de Serviços Especiais&nbsp;&nbsp;
            
  				<input id="tipoDeLinha" type="checkbox" class="require-one validate-checkbox-oneormore" name="tipoLinhas[5].id" value="6" >Linha de Serviço Especial Leito&nbsp;&nbsp;
             <span class="errorCheck" style="display: none;">Selecione ao menos um Tipo de Linha.</span> *
   		</p>
   		
   		<span id="erroPiso" style="display: none;"></span>
		<div id="pisos">
   				<table width="90%">
						<tbody>
							<tr>
								<td id="tdPisos" style="padding-bottom: 10px;">
									<label for="piso1AB">Piso I A-B (Km):</label>
								</td>
								<td style="padding-bottom: 10px;" nowrap="nowrap">
									<input id="piso1AB" type="text" name="entity.linhaVigente.piso1AB" value="" size="7" maxlength="8" minlength="1" number="true"  />  
								</td>
								<td align="right" style="padding-bottom: 10px;" nowrap="nowrap">
									<label for="piso2AB">Piso II A-B (Km):</label>
								</td>
								<td style="padding-bottom: 10px;" nowrap="nowrap"> 
									<input id="piso2AB" type="text" name="entity.linhaVigente.piso2AB" value="" size="7" maxlength="8" minlength="1" number="true"  />  
								</td>
								<td style="padding-bottom: 10px;" nowrap="nowrap"> 
									<span id="totalPisoAB">Extensão A-B: 0,00</span>
								</td>
							</tr>
							<tr>	
								<td>
									<label for="piso1BA">Piso I B-A (Km):</label> 
								</td>
								<td>
									<input id="piso1BA" type="text" name="entity.linhaVigente.piso1BA" value="" size="7" maxlength="8" minlength="1" number="true"  /> 
								</td>
								<td>
									<label for="piso2BA">Piso II B-A (Km):</label>
								</td>
								<td> 
									<input id="piso2BA" type="text" name="entity.linhaVigente.piso2BA" value="" size="7" maxlength="8" minlength="1" number="true"  />  
								</td>
								<td>
								 	<span id="totalPisoBA">Extensão B-A: 0,00</span>
								</td>
							</tr>
						</tbody>
				</table>
		</div>   		
   		
   		<p>
			<label for="hierarquizacao">Hierarquização:</label>
			<input type="text" id="hierarquizacao" value="" name="entity.linhaVigente.hierarquizacao" size="30"  > 
		</p>   		
   		<p>
			<label for="dataInicioVigencia">Data Vigência:</label>
			<input type="text" id="dataInicioVigencia" value="" name="entity.linhaVigente.dataInicio" class="required" maxlength="10" size="10"  > * 
		</p>

   		
		
		
   		<div id="lista">
   			<fieldset>
   				<legend>Seções:</legend>
   				<p>
					<input id="addSecao" type="button" value="Nova Seção" />
    				<input id="rmSecao" type="button" value="Delete Seção" />
					<table id="tb_secoes" class="tablesorter">
						<thead>
							<tr>
								<td></td>
								<td>Código</td>
								<td>Ponto Inicial da Seção</td>
								<td>Ponto Final da Seção</td>
							</tr>
						</thead>
						<tbody>
										
						</tbody>
					</table>
				</fieldset>
				<p></p>
		</div>

<div id="modalView2" style="display: none;" class="simplemodal-data">

	<div class="white_content_header">
		<img src="/bomweb<?= base_url(); ?>assets/bomweb/images/ico_modal_alert.png" align="absmiddle"> Alerta
	</div>
	<div class="messageJust white_content_content">
	</div>
	<div class="white_content_footer">
		<input id="btnSimEdicaoRetroativa" type="button" value="Sim">
		<input class="simplemodal-close" type="button" value="Não">
	</div>

</div>
<div id="justRequerida" style="display: none;" class="simplemodal-data">
	
       	<div class="white_content_header">
			<img src="/bomweb<?= base_url(); ?>assets/bomweb/images/ico_modal_alert.png" align="absmiddle"> Alerta
		</div>
		Por favor, informe uma justificativa.
		<br />
		<div class="white_content_footer">
			<input type="button" value="OK" class="simplemodal-close">
		</div>    		
		
</div>

				<div id='confirm' style="display: none;">
			<div class="white_content_header">
				<img src="<?= base_url(); ?>assets/bomweb/images/ico_modal_alert.png" align="absmiddle"> Alerta
			</div>
		
			<div class='message'></div><br>
			
			<div class="white_content_footer">
				<input type="button" value="Sim" class="yes simplemodal-close">
				<input type="button" value="Não" class="simplemodal-close">
			</div>
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