



	








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
			
       	<strong class="titulo azul">Log </strong><img src="/images/bomweb_setas.gif" /><strong class="titulo verde"> Sistema</strong>
		
		<a href="#" class="accordion">[ Ocultar Filtro ]</a>
        <div id="filtro">
			<img src="/images/bomweb_filtros_box_up.jpg" />        
			<form id="form" action="/log/list" method="post">
				<fieldset>
					<p>
						<label for="entidade">Entidade:</label>
						<select id="entidade" name="filtro.entidade" class="required">
							<option value="" Selected="true">Selecione uma entidade</option>
							
								<option value="Empresa">Empresa</option>
							
								<option value="Linha">Linha</option>
							
								<option value="TipoDeLinha">Tipo de Linha</option>
							
								<option value="LinhaVigencia">Linha Vigência</option>
							
								<option value="Secao">Seção</option>
							
								<option value="TipoDeVeiculo">Tipo de Veículo</option>
							
								<option value="Tarifa">Tarifa</option>
							
								<option value="Bom">BOM</option>
							
								<option value="Usuario">Usuário</option>
							
								<option value="PerfilPermissao">Perfil/Permissão</option>
							
						</select> * 
					</p>
					<p>
						<label for="operacao">Operação:</label>
						<select id="operacao" name="filtro.revisionType">
							<option value="" Selected="true">Selecione uma operação</option>
								<option value="0">Inclusão</option>
								<option value="1">Alteração</option>
								<option value="2">Deleção</option>
						</select> 
					</p>
					<p>
						<label for="usuario">Usuário:</label>
						<select id="usuario" name="filtro.idUsuario">
							<option value="" selected="selected">Selecione um usuário</option>
							
								<option value="1">Detro</option>
							
								<option value="7">AUTO ÔNIBUS FAGUNDES LTDA.</option>
							
								<option value="8">AUTO COMERCIAL BARRA MANSA LTDA.</option>
							
								<option value="10">AUTO ÔNIBUS VERA CRUZ LTDA.</option>
							
								<option value="11">AUTO VIAÇÃO ABC S/A</option>
							
								<option value="12">AUTO VIAÇÃO TANGUAENSE LTDA.</option>
							
								<option value="13">AUTO VIAÇÃO REGINAS LTDA.</option>
							
								<option value="14">AUTO VIAÇÃO SALINEIRA LTDA.</option>
							
								<option value="15">AUTO VIAÇÃO VERA CRUZ LTDA.</option>
							
								<option value="16">VIAÇÃO SÃO PEDRO D&#039;ALDEIA LTDA.</option>
							
								<option value="17">VIAÇÃO BARRA DO PIRAÍ TURISMO LTDA.</option>
							
								<option value="18">COLITUR TRANSPORTES RODOVIÁRIOS LTDA.</option>
							
								<option value="19">COESA TRANSPORTES LTDA.</option>
							
								<option value="20">EMPRESA DE ÔNIBUS SANJOANENSE CAMPOSTUR LTDA.</option>
							
								<option value="21">AUTO VIAÇÃO JUREMA S/A</option>
							
								<option value="23">EMPRESA BRASIL S/A - TRANSPORTES E TURISMO</option>
							
								<option value="24">CAVALCANTI &amp; CIA. LTDA. (NILOPOLITANA)</option>
							
								<option value="25">EMPRESA DE TRANSPORTES CONTINENTAL LTDA.</option>
							
								<option value="26">EMPRESA DE ÔNIBUS E TURISMO PEDRO ANTONIO LTDA.</option>
							
								<option value="27">EMPRESA SANTA TEREZINHA LTDA.</option>
							
								<option value="28">EMPRESA DE TRANSPORTES FLORES LTDA.</option>
							
								<option value="29">EMPRESA DE TRANSPORTES LIMOUSINE CARIOCA S/A.</option>
							
								<option value="30">EXPRESSO SÃO FRANCISCO LTDA.</option>
							
								<option value="31">EVANIL TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="32">EXPRESSO REAL RIO LTDA.</option>
							
								<option value="33">NITURVIA NOVA IGUAÇU TURISMO E VIAÇÃO LTDA.</option>
							
								<option value="34">EXPRESSO GARCIA LTDA.</option>
							
								<option value="35">TRANSPORTES BLANCO LTDA. EPP</option>
							
								<option value="37">EXPRESSO PINTO &amp; PALMA LTDA.</option>
							
								<option value="39">FACIL TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="40">EXPRESSO RIO DE JANEIRO LTDA.</option>
							
								<option value="41">J.C. GUIMARÃES TRANSPORTES COLETIVOS LTDA.</option>
							
								<option value="42">GARDEL TURISMO LTDA.</option>
							
								<option value="43">LINAVE TRANSPORTES LTDA.</option>
							
								<option value="44">FAZENI TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="46">RÁPIDO SÃO CRISTÓVÃO LTDA.</option>
							
								<option value="47">RIO ITA LTDA.</option>
							
								<option value="49">TRANSPORTES FABIO&#039;S LTDA.</option>
							
								<option value="50">VIAÇÃO NORMANDY DO TRIÂNGULO LTDA.</option>
							
								<option value="52">MASTER TRANSPORTES COLETIVOS DE PASSAGEIROS LTDA.</option>
							
								<option value="53">SÃO JOÃO BATISTA TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="54">TRANSPORTES SANTO ANTÔNIO LTDA.</option>
							
								<option value="55">TRANSPORTES E TURISMO MACHADO LTDA.</option>
							
								<option value="56">TRANSPORTES ÚNICA PETRÓPOLIS LTDA.</option>
							
								<option value="57">TRANSA TRANSPORTE COLETIVO LTDA.</option>
							
								<option value="58">TRANSTURISMO REI LTDA. (TREL)</option>
							
								<option value="59">TRANSTURISMO RIO MINHO LTDA.</option>
							
								<option value="60">TRANSPORTE MAGELI LTDA.</option>
							
								<option value="61">TRANSPORTES E TURISMO ALTO MINHO LTDA.</option>
							
								<option value="62">VIAÇÃO AGULHAS NEGRAS LTDA.</option>
							
								<option value="63">VIAÇÃO BEIRA MAR LTDA.</option>
							
								<option value="65">VIAÇÃO CARAVELE LTDA.</option>
							
								<option value="66">VIAÇÃO CIDADE DO AÇO LTDA.</option>
							
								<option value="67">VIAÇÃO MIRANTE LTDA.</option>
							
								<option value="68">VIAÇÃO ELITE LTDA.</option>
							
								<option value="69">VIAÇÃO ESTRELA S/A</option>
							
								<option value="70">VIAÇÃO FALCÃO LTDA.</option>
							
								<option value="71">VIAÇÃO GALO BRANCO S/A</option>
							
								<option value="72">VIAÇÃO MAUÁ S/A.</option>
							
								<option value="73">VIAÇÃO NOSSA SENHORA DO AMPARO LTDA.</option>
							
								<option value="74">VIAÇÃO NOSSA SENHORA APARECIDA LTDA.</option>
							
								<option value="75">VIAÇÃO NOSSA SENHORA DA PENHA LTDA.</option>
							
								<option value="76">VIAÇÃO PINHEIRAL LTDA.</option>
							
								<option value="77">VIAÇÃO PONTE COBERTA LTDA.</option>
							
								<option value="78">VIAÇÃO PROGRESSO E TURISMO S/A.</option>
							
								<option value="79">VIAÇÃO RESENDENSE INTERMUNICIPAL LTDA.</option>
							
								<option value="80">VIAÇÃO SALUTARIS E TURISMO S/A.</option>
							
								<option value="81">VIAÇÃO SANTA LUZIA LTDA.</option>
							
								<option value="82">VIAÇÃO MONTES BRANCOS LTDA.</option>
							
								<option value="84">VIAÇÃO SÃO JOSÉ LTDA.</option>
							
								<option value="85">VIAÇÃO SUL FLUMINENSE TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="86">VIAÇÃO TERESÓPOLIS E TURISMO LTDA.</option>
							
								<option value="87">VIAÇÃO UNIÃO LTDA.</option>
							
								<option value="88">VIAÇÃO VERA CRUZ S/A.</option>
							
								<option value="89">VIAÇÃO VILA RICA LTDA.</option>
							
								<option value="90">FEITAL TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="91">AUTO LOTAÇÃO INGÁ LTDA.</option>
							
								<option value="92">VIAÇÃO PENDOTIBA S/A.</option>
							
								<option value="93">VIAÇÃO PENEDO LTDA.</option>
							
								<option value="94">J.F. FARINHA AUTO ÔNIBUS LTDA.</option>
							
								<option value="95">EMPRESA DE TRANSPORTES BRASO LISBOA LTDA.</option>
							
								<option value="96">COSTA VERDE TRANSPORTES LTDA.</option>
							
								<option value="97">VIAÇÃO CARMENSE LTDA.</option>
							
								<option value="98">TRANSPORTADORA MACABÚ LTDA.</option>
							
								<option value="100">UNIÃO TRANSPORTE INTERESTADUAL DE LUXO S/A - UTIL</option>
							
								<option value="101">TRANSTUR VILA EMIL LTDA.</option>
							
								<option value="102">TRANSPORTADORA TINGUÁ LTDA.</option>
							
								<option value="103">AUTO VIAÇÃO 1001 LTDA.</option>
							
								<option value="105">RÁPIDO MACAENSE LTDA.</option>
							
								<option value="124">SANTA EUGÊNIA TRANSPORTES E TURISMO LTDA.</option>
							
								<option value="150">UNIRIO TRANSPORTES EIRELI</option>
							
								<option value="151">EXPRESSO RECREIO TRANSPORTE DE PASSAGEIROS LTDA</option>
							
								<option value="183">VIAÇÃO NOVA NIL LTDA.</option>
							
								<option value="108">Operacional</option>
							
								<option value="143">Raphael Almeida</option>
							
								<option value="144">Maria Clara</option>
							
								<option value="184">Carlos Alberto Souza de Oliveira</option>
							
								<option value="185">Aline Leonis</option>
							
								<option value="190">Pedro Machado</option>
							
								<option value="191">Marcio Carvalho</option>
							
								<option value="3">Detro_nivel_1</option>
							
								<option value="182">Ilidio Oliveira Silveira</option>
							
								<option value="5">Detro_nivel_3</option>
							
								<option value="131">Pedro Henrique</option>
							
								<option value="134">Úrsula Assunção</option>
							
								<option value="136">Márcio Muniz</option>
							
								<option value="155">Sergio Marcolini</option>
							
								<option value="156">Álvaro Gonzalez Rodrigues</option>
							
								<option value="161">kenia Gaveiro Herran</option>
							
								<option value="169">Emanuel Pinto de Souza</option>
							
								<option value="170">Monica de Paiva Oliveira</option>
							
								<option value="172">Rodrigo Viana Ribeiro</option>
							
								<option value="176">Thiago David Fernandes da Cunha</option>
							
								<option value="178">Marcelo Fernandes Elizardo Cardoso</option>
							
								<option value="179">Lucas da Silva Molinari Rodrigues</option>
							
								<option value="186">rithielle patricio</option>
							
								<option value="187">wlisses</option>
							
								<option value="189">Gabriel Calvelli</option>
							
								<option value="2">Detro_AUD</option>
							
						</select>
					</p>
					<p>
						<label for="datepicker">Data Inicial:</label>
						<input type="text" id="datainicio" value="" name="filtro.dataInicial" class="required" maxlength="10" > * 
					</p>
					<p>
					    <label for="datepicker">Data Final:</label>
						<input type="text" id="datafim" value="" name="filtro.dataFinal" class="required" maxlength="10" > * 
					</p>
					<div id="camposObrigatorios">* Campo obrigatório.</div>
		    		<input type="submit" name="btn_pesquisa" value="Pesquisar" >
					<input class="reset" type="reset" value="Limpar"/>
		    	</fieldset>
			</form>
			<img src="/images/bomweb_filtros_box_dn.jpg" />
		</div>
		<br />
		
		<div id="tab_relatorio" style="width: 100%; overflow: auto;">
        <table id="tb_list" class="tablesorter">
			<thead>
				<tr>
					<th>Entidade</th>
					<th>Data</th>
					<th>Operação</th>
					<th>Usuário</th>
					<th>Perfil</th>
					<th>IP</th>
					<th>De</th>
					<th>Para</th>
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