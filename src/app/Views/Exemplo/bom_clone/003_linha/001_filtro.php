
	<script type="text/javascript">
	
    function pesquisar() {
        listPage.initialize();
    }
</script>
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
                include_once (__DIR__ . '/../menu.php');
            ?>
        </ul>
    </div>
    
    <div id="info">
           
      </div>
    <div id="result">
        
    <strong class="titulo azul">Lista </strong><img src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde">
<script type="text/javascript">
<!--
var listPage;
$(document).ready(function()
{
    listPage = new ListPage("/linha", "linha");
    
    listPage.setSearchFieldsIds(["idEmpresa", "codigo", "pontoFinal", "pontoInicial"]);
    
    listPage.addColumnDefinition("Empresa", "empresa");
    listPage.addColumnDefinition("Linha", "linha");
    listPage.addColumnDefinition("Seções", "secoes");
    listPage.addColumnDefinition("Nome da Linha", "nomeDaLinha");
    listPage.addColumnDefinition("Status", "status");
    listPage.addColumnDefinition("Tipos de Veículos Utilizados", "tiposDeVeiculosUtilizados");
    listPage.addColumnDefinition("Extensão A-B", "extensaoAB");
    listPage.addColumnDefinition("Extensão B-A", "extensaoBA");
    listPage.addColumnDefinition("Data de Início", "dataDeInicio");
    listPage.addColumnDefinition("Data de Término", "dataDeTermino");
    
    listPage.setCreateEditLinkCallback(function(row) {
        if (row.aData.temPerfilDetro || row.aData.temPerfilDetroAdmin || row.aData.temPerfilDetro_nivel_1 || row.aData.temPerfilDetro_nivel_2 || row.aData.temPerfilDetro_nivel_3 || row.aData.temPerfilDetro_aud ) {
            if (row.aData.podeEditar) {
                if (row.aData.temLinhaFutura) {
                    return "<a href='edit-confirm/" + row.aData.id + "' onclick='javascript:ListPage.showModalPanel(this, event)' title='Editar'><img src='..<?= base_url(); ?>assets/bomweb/images/editar.png' /></a> &nbsp;";
                }
                else {
                    return "<a href='edit/" + row.aData.id + "' data-futuro='false' title='Editar'><img src='..<?= base_url(); ?>assets/bomweb/images/editar.png' /></a> &nbsp;";
                }
            }
        }
        else if (row.aData.temPerfilEmpresa) {
            return "<a href='edit/" + row.aData.id + "' title='Editar'><img src='..<?= base_url(); ?>assets/bomweb/images/editar.png' /></a>";
        }
        else {
            return "";
        }
    });
});

// Autocomplete do campo empresa.
$(function() {
    $("#buscaEmp").autocomplete(
        {
        width: 352,
        source: function( request, response ) {
            $.ajax({
                url: "/empresa/busca.json?term="+$( "#buscaEmp" ).val(),
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
         },
        open: function() {
            $( this ).removeClass( "ui-corner-all" ).addClass( "autoCompleteSize" );
        },
        close: function() {
            $( this ).removeClass( "ui-corner-top" ).addClass( "autoCompleteSize" );
        }
    });
    
});

// -->
</script>

Linha
</strong>
    
    <a href="#" class="accordion">[ Ocultar Filtro ]</a>
    
    <div id="filtro">
    
        <img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />
    
        <form id="formPesquisa" method="post">
        
            <fieldset>
                
    <p>
        
            <label for="buscaEmp">Empresa:</label>
            <input type="text" id="buscaEmp" name="entityForSearch.linhaVigente.empresa.nome" value="" onblur="limpaId(this,'idEmpresa')" style="width:350px;"/>
            <input style="visibility: hidden;" type="text" id="idEmpresa" name="entityForSearch.linhaVigente.empresa.id" value=""/>
        
    </p>
    <p>	
        <label for="codigo">Código da Linha:</label>
        <input id="codigo" name="entityForSearch.linhaVigente.codigo" value="" size="9" maxlength="9"/>
    </p>
    <p>
        <label for="pontoInicial">Ponto Inicial:</label>
        <input id="pontoInicial" name="entityForSearch.linhaVigente.pontoInicial" value="">
    </p>
    <p>	
        <label for="pontoFinal">Ponto Final:</label>
        <input id="pontoFinal" name="entityForSearch.linhaVigente.pontoFinal" value="">
    </p>

                <input type="button" id="dataTableFetchData" value="Pesquisar" onclick="javascript:pesquisar()">
                <input class="reset" id="reseta" type="reset" value="Limpar"/>
            </fieldset>
        
        </form>
        
        <img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_dn.jpg" />
        
    </div>
    <br />
    
        <a id="insert" href="<?= base_url(); ?>exemple/group/endpoint/bom_linha_cadasrtar" class="buttom_azul">Nova Linha</a>
    

    <div id="divDataTable" style="width: 100%; overflow: auto;">
    </div>
            
        <a id="linkExportSecao" href="
    /linha
/exportarComSecoes">Exportar c/ Seções</a>			
        
    

            
        
        <a id="linkExport" href="
    /linha
/exportar">Exportar</a>
        
    

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