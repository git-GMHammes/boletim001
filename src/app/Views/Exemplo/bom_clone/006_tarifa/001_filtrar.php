<script type="text/javascript">

    function pesquisar() {
        listPage.initialize();
    }
</script>
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

                <strong class="titulo azul">Lista </strong><img
                    src="<?= base_url(); ?>assets/bomweb/images/bomweb_setas.gif" /><strong class="titulo verde">
                    <script type="text/javascript">
                        //Auto complete da Busca

                        var listPage;
                        $(document).ready(function () {
                            listPage = new ListPage("/tarifa", "tarifa");

                            listPage.setSearchFieldsIds(["idEmpresa", "idLinha", "secao", "filtroTarifaFutura", "selectValorListTarifa", "selectValorListTarifaFutura"]);
                            //listPage.setLastRowIndex(9);
                            listPage.addColumnDefinition("Código da Linha", "codigoLinha", { "sWidth": "12%" });
                            listPage.addColumnDefinition("Empresa", "empresa");
                            listPage.addColumnDefinition("Linha", "linha");
                            listPage.addColumnDefinition("Código da Seção", "codigoSecao", { "sWidth": "8%" });
                            listPage.addColumnDefinition("Seção", "secao");
                            listPage.addColumnDefinition("Valor", "valor", { "sWidth": "7%" });
                            listPage.addColumnDefinition("Início Vigência", "inicioVigencia", { "sWidth": "10%" });
                            listPage.addColumnDefinition("Fim Vigência", "fimVigencia", { "sWidth": "10%" });

                            listPage.setCreateEditLinkCallback(function (row) {
                                if (row.aData.podeEditar) {
                                    if (row.aData.isFutura || row.aData.temTarifaFutura) {
                                        return "<a href='erro-edit-futura/" + row.aData.id + "' onclick='javascript:ListPage.showModalPanel(this, event)' title='Editar'><img src='../images/editar.png'/></a> &nbsp;";
                                    }
                                    else {
                                        return "<a href='edit/" + row.aData.id + "' title='Editar'><img src='../images/editar.png' alt='Editar' /></a> &nbsp;";
                                    }
                                }
                                else {
                                    return "";
                                }
                            });

                            listPage.setCreateHistoryLinkCallback(function (row) {
                                if (row.aData.podeVerHistorico) {
                                    return "<a href='historico/" + row.aData.id + "' onclick='javascript:ListPage.showModalPanel(this, event)' data-width='650' data-height='350' title='Histórico'><img src='../images/historico.png' alt='Histórico' /></a>";
                                }
                                else {
                                    return "";
                                }
                            });

                        });

                        $(function () {

                            $("#buscaEmp").autocomplete({
                                width: 352,
                                source: function (request, response) {
                                    $.ajax({
                                        url: "/empresa/busca.json?term=" + $("#buscaEmp").val(),
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
                                                    label: item.nome,
                                                    data: item.id,
                                                    value: item.nome
                                                };
                                            }));
                                        }
                                    });
                                },
                                minLength: 0,
                                select: function (event, ui) {
                                    $("#buscaLinha").removeAttr("disabled");
                                    $("#idEmpresa").val(ui.item.data);
                                },
                                open: function () {
                                    //$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                                },
                                close: function () {
                                    //$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
                                }
                            });
                        });

                        function changeValorTarifas(checkbox) {
                            if (checkbox.checked) {
                                $("#selectValorListTarifa").hide();
                                $("#selectValorListTarifaFutura").show();
                            } else {
                                $("#selectValorListTarifa").show();
                                $("#selectValorListTarifaFutura").hide();
                            }
                        }

                        $(function () {

                            $("#buscaLinha").autocomplete({
                                width: 252,
                                source: function (request, response) {
                                    $.ajax({
                                        url: "/tarifa/buscaLinhas.json?term=" + $("#buscaLinha").val() + "&idEmpresa=" + $("#idEmpresa").val(),
                                        dataType: "json",
                                        data: {
                                            featureClass: "P",
                                            style: "full",
                                            maxRows: 12,
                                            name_startsWith: request.term
                                        },
                                        success: function (data) {
                                            response($.map(data.linhas, function (item) {
                                                // FBW-319
                                                var textToShow = item.comboString;
                                                return {
                                                    label: textToShow,
                                                    data: item.id,
                                                    value: textToShow
                                                };
                                            }));
                                        }
                                    });
                                },
                                minLength: 0,
                                select: function (event, ui) {
                                    $("#idLinha").val(ui.item.data);
                                },
                                open: function () {
                                    //$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
                                },
                                close: function () {
                                    bomweb.updateChildSelect($('#idLinha'), $("#secao"), "/tarifa/buscaSecoes.json", "id", ["codigo", "juncao"]);
                                }
                            });
                        });

                    </script>
                    Tarifa
                </strong>

                <a href="#" class="accordion">[ Ocultar Filtro ]</a>

                <div id="filtro">

                    <img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_up.jpg" />

                    <form id="formPesquisa" method="post">

                        <fieldset>


                            <p>
                                <label for="buscaEmp">Empresa:</label>
                                <input id="buscaEmp" name="filtro.nomeEmpresa" value=""
                                    onblur="limpaId(this,'idEmpresa')" style="width:350px;" />
                                <input style="visibility: hidden;" type="text" id="idEmpresa" name="filtro.empresa"
                                    value="" />
                            </p>

                            <p>
                                <label for="buscaLinha">Linha:</label>
                                <input type="text" id="buscaLinha" disabled="disabled" name="filtro.nomeLinha" value=""
                                    onblur="limpaId(this,'idLinha')" style="width:250px;" />

                                <img class="loading" alt="Carregando"
                                    src="<?= base_url(); ?>assets/bomweb/images/carregando.gif">
                                <input style="visibility: hidden;" type="text" id="idLinha" name="filtro.linha"
                                    value="" />
                            </p>
                            <p>
                                <label for="secao">Seção:</label>
                                <select id="secao" name="filtro.secao" disabled="disabled">
                                    <option value="">Selecione</option>

                                </select>
                                <img class="loading" alt="Carregando"
                                    src="<?= base_url(); ?>assets/bomweb/images/carregando.gif">
                            </p>
                            <p>
                                <label for="empresa">Tarifa futura:</label>
                                <input type="checkbox" id="filtroTarifaFutura" name="filtro.tarifaFutura"
                                    onchange="javascript:changeValorTarifas(this)" />
                            </p>
                            <p>
                                <label for="selectValorListTarifa">Valor:</label>
                                <select id="selectValorListTarifa" name="filtro.valor">
                                    <option value="" selected="selected">Selecione</option>

                                    <option value="0.00">0,00</option>

                                    <option value="1.10">1,10</option>

                                    <option value="1.45">1,45</option>

                                    <option value="1.60">1,60</option>

                                    <option value="1.80">1,80</option>

                                    <option value="1.85">1,85</option>

                                    <option value="1.90">1,90</option>

                                    <option value="1.95">1,95</option>

                                    <option value="2.05">2,05</option>

                                    <option value="2.10">2,10</option>

                                    <option value="2.15">2,15</option>

                                    <option value="2.20">2,20</option>

                                    <option value="2.25">2,25</option>

                                    <option value="2.30">2,30</option>

                                    <option value="2.35">2,35</option>

                                    <option value="2.40">2,40</option>

                                    <option value="2.45">2,45</option>

                                    <option value="2.50">2,50</option>

                                    <option value="2.55">2,55</option>

                                    <option value="2.60">2,60</option>

                                    <option value="2.65">2,65</option>

                                    <option value="2.70">2,70</option>

                                    <option value="2.75">2,75</option>

                                    <option value="2.80">2,80</option>

                                    <option value="2.85">2,85</option>

                                    <option value="2.90">2,90</option>

                                    <option value="2.95">2,95</option>

                                    <option value="3.00">3,00</option>

                                    <option value="3.05">3,05</option>

                                    <option value="3.10">3,10</option>

                                    <option value="3.15">3,15</option>

                                    <option value="3.20">3,20</option>

                                    <option value="3.25">3,25</option>

                                    <option value="3.30">3,30</option>

                                    <option value="3.35">3,35</option>

                                    <option value="3.40">3,40</option>

                                    <option value="3.45">3,45</option>

                                    <option value="3.50">3,50</option>

                                    <option value="3.55">3,55</option>

                                    <option value="3.60">3,60</option>

                                    <option value="3.65">3,65</option>

                                    <option value="3.70">3,70</option>

                                    <option value="3.75">3,75</option>

                                    <option value="3.80">3,80</option>

                                    <option value="3.85">3,85</option>

                                    <option value="3.90">3,90</option>

                                    <option value="3.95">3,95</option>

                                    <option value="4.00">4,00</option>

                                    <option value="4.05">4,05</option>

                                    <option value="4.10">4,10</option>

                                    <option value="4.15">4,15</option>

                                    <option value="4.20">4,20</option>

                                    <option value="4.25">4,25</option>

                                    <option value="4.30">4,30</option>

                                    <option value="4.35">4,35</option>

                                    <option value="4.40">4,40</option>

                                    <option value="4.45">4,45</option>

                                    <option value="4.50">4,50</option>

                                    <option value="4.55">4,55</option>

                                    <option value="4.60">4,60</option>

                                    <option value="4.65">4,65</option>

                                    <option value="4.70">4,70</option>

                                    <option value="4.75">4,75</option>

                                    <option value="4.80">4,80</option>

                                    <option value="4.85">4,85</option>

                                    <option value="4.90">4,90</option>

                                    <option value="4.95">4,95</option>

                                    <option value="5.00">5,00</option>

                                    <option value="5.05">5,05</option>

                                    <option value="5.10">5,10</option>

                                    <option value="5.15">5,15</option>

                                    <option value="5.20">5,20</option>

                                    <option value="5.25">5,25</option>

                                    <option value="5.30">5,30</option>

                                    <option value="5.35">5,35</option>

                                    <option value="5.40">5,40</option>

                                    <option value="5.45">5,45</option>

                                    <option value="5.50">5,50</option>

                                    <option value="5.55">5,55</option>

                                    <option value="5.60">5,60</option>

                                    <option value="5.65">5,65</option>

                                    <option value="5.70">5,70</option>

                                    <option value="5.75">5,75</option>

                                    <option value="5.80">5,80</option>

                                    <option value="5.85">5,85</option>

                                    <option value="5.90">5,90</option>

                                    <option value="5.95">5,95</option>

                                    <option value="6.00">6,00</option>

                                    <option value="6.05">6,05</option>

                                    <option value="6.10">6,10</option>

                                    <option value="6.15">6,15</option>

                                    <option value="6.20">6,20</option>

                                    <option value="6.25">6,25</option>

                                    <option value="6.30">6,30</option>

                                    <option value="6.35">6,35</option>

                                    <option value="6.40">6,40</option>

                                    <option value="6.45">6,45</option>

                                    <option value="6.50">6,50</option>

                                    <option value="6.55">6,55</option>

                                    <option value="6.60">6,60</option>

                                    <option value="6.65">6,65</option>

                                    <option value="6.70">6,70</option>

                                    <option value="6.75">6,75</option>

                                    <option value="6.80">6,80</option>

                                    <option value="6.85">6,85</option>

                                    <option value="6.90">6,90</option>

                                    <option value="6.95">6,95</option>

                                    <option value="7.00">7,00</option>

                                    <option value="7.05">7,05</option>

                                    <option value="7.10">7,10</option>

                                    <option value="7.15">7,15</option>

                                    <option value="7.20">7,20</option>

                                    <option value="7.25">7,25</option>

                                    <option value="7.35">7,35</option>

                                    <option value="7.40">7,40</option>

                                    <option value="7.45">7,45</option>

                                    <option value="7.50">7,50</option>

                                    <option value="7.55">7,55</option>

                                    <option value="7.65">7,65</option>

                                    <option value="7.70">7,70</option>

                                    <option value="7.75">7,75</option>

                                    <option value="7.80">7,80</option>

                                    <option value="7.85">7,85</option>

                                    <option value="7.90">7,90</option>

                                    <option value="7.95">7,95</option>

                                    <option value="8.00">8,00</option>

                                    <option value="8.05">8,05</option>

                                    <option value="8.10">8,10</option>

                                    <option value="8.15">8,15</option>

                                    <option value="8.20">8,20</option>

                                    <option value="8.25">8,25</option>

                                    <option value="8.30">8,30</option>

                                    <option value="8.35">8,35</option>

                                    <option value="8.40">8,40</option>

                                    <option value="8.50">8,50</option>

                                    <option value="8.55">8,55</option>

                                    <option value="8.60">8,60</option>

                                    <option value="8.65">8,65</option>

                                    <option value="8.70">8,70</option>

                                    <option value="8.75">8,75</option>

                                    <option value="8.80">8,80</option>

                                    <option value="8.85">8,85</option>

                                    <option value="8.90">8,90</option>

                                    <option value="8.95">8,95</option>

                                    <option value="9.00">9,00</option>

                                    <option value="9.05">9,05</option>

                                    <option value="9.15">9,15</option>

                                    <option value="9.20">9,20</option>

                                    <option value="9.25">9,25</option>

                                    <option value="9.30">9,30</option>

                                    <option value="9.35">9,35</option>

                                    <option value="9.40">9,40</option>

                                    <option value="9.45">9,45</option>

                                    <option value="9.50">9,50</option>

                                    <option value="9.55">9,55</option>

                                    <option value="9.60">9,60</option>

                                    <option value="9.65">9,65</option>

                                    <option value="9.70">9,70</option>

                                    <option value="9.80">9,80</option>

                                    <option value="9.90">9,90</option>

                                    <option value="9.95">9,95</option>

                                    <option value="10.00">10,00</option>

                                    <option value="10.10">10,10</option>

                                    <option value="10.15">10,15</option>

                                    <option value="10.20">10,20</option>

                                    <option value="10.25">10,25</option>

                                    <option value="10.30">10,30</option>

                                    <option value="10.35">10,35</option>

                                    <option value="10.40">10,40</option>

                                    <option value="10.45">10,45</option>

                                    <option value="10.50">10,50</option>

                                    <option value="10.55">10,55</option>

                                    <option value="10.60">10,60</option>

                                    <option value="10.65">10,65</option>

                                    <option value="10.70">10,70</option>

                                    <option value="10.75">10,75</option>

                                    <option value="10.80">10,80</option>

                                    <option value="10.85">10,85</option>

                                    <option value="10.95">10,95</option>

                                    <option value="11.05">11,05</option>

                                    <option value="11.10">11,10</option>

                                    <option value="11.15">11,15</option>

                                    <option value="11.20">11,20</option>

                                    <option value="11.25">11,25</option>

                                    <option value="11.30">11,30</option>

                                    <option value="11.35">11,35</option>

                                    <option value="11.40">11,40</option>

                                    <option value="11.45">11,45</option>

                                    <option value="11.50">11,50</option>

                                    <option value="11.55">11,55</option>

                                    <option value="11.60">11,60</option>

                                    <option value="11.65">11,65</option>

                                    <option value="11.70">11,70</option>

                                    <option value="11.75">11,75</option>

                                    <option value="11.80">11,80</option>

                                    <option value="11.85">11,85</option>

                                    <option value="11.90">11,90</option>

                                    <option value="11.95">11,95</option>

                                    <option value="12.00">12,00</option>

                                    <option value="12.10">12,10</option>

                                    <option value="12.15">12,15</option>

                                    <option value="12.25">12,25</option>

                                    <option value="12.35">12,35</option>

                                    <option value="12.40">12,40</option>

                                    <option value="12.45">12,45</option>

                                    <option value="12.50">12,50</option>

                                    <option value="12.60">12,60</option>

                                    <option value="12.65">12,65</option>

                                    <option value="12.80">12,80</option>

                                    <option value="12.85">12,85</option>

                                    <option value="12.90">12,90</option>

                                    <option value="12.95">12,95</option>

                                    <option value="13.00">13,00</option>

                                    <option value="13.05">13,05</option>

                                    <option value="13.10">13,10</option>

                                    <option value="13.15">13,15</option>

                                    <option value="13.20">13,20</option>

                                    <option value="13.25">13,25</option>

                                    <option value="13.30">13,30</option>

                                    <option value="13.40">13,40</option>

                                    <option value="13.45">13,45</option>

                                    <option value="13.55">13,55</option>

                                    <option value="13.60">13,60</option>

                                    <option value="13.65">13,65</option>

                                    <option value="13.70">13,70</option>

                                    <option value="13.75">13,75</option>

                                    <option value="13.80">13,80</option>

                                    <option value="13.85">13,85</option>

                                    <option value="13.95">13,95</option>

                                    <option value="14.00">14,00</option>

                                    <option value="14.05">14,05</option>

                                    <option value="14.10">14,10</option>

                                    <option value="14.15">14,15</option>

                                    <option value="14.30">14,30</option>

                                    <option value="14.35">14,35</option>

                                    <option value="14.40">14,40</option>

                                    <option value="14.45">14,45</option>

                                    <option value="14.55">14,55</option>

                                    <option value="14.60">14,60</option>

                                    <option value="14.65">14,65</option>

                                    <option value="14.70">14,70</option>

                                    <option value="14.75">14,75</option>

                                    <option value="14.85">14,85</option>

                                    <option value="14.95">14,95</option>

                                    <option value="15.05">15,05</option>

                                    <option value="15.10">15,10</option>

                                    <option value="15.15">15,15</option>

                                    <option value="15.20">15,20</option>

                                    <option value="15.30">15,30</option>

                                    <option value="15.35">15,35</option>

                                    <option value="15.40">15,40</option>

                                    <option value="15.45">15,45</option>

                                    <option value="15.50">15,50</option>

                                    <option value="15.55">15,55</option>

                                    <option value="15.60">15,60</option>

                                    <option value="15.65">15,65</option>

                                    <option value="15.75">15,75</option>

                                    <option value="15.80">15,80</option>

                                    <option value="15.85">15,85</option>

                                    <option value="15.90">15,90</option>

                                    <option value="15.95">15,95</option>

                                    <option value="16.00">16,00</option>

                                    <option value="16.05">16,05</option>

                                    <option value="16.10">16,10</option>

                                    <option value="16.20">16,20</option>

                                    <option value="16.25">16,25</option>

                                    <option value="16.30">16,30</option>

                                    <option value="16.35">16,35</option>

                                    <option value="16.40">16,40</option>

                                    <option value="16.45">16,45</option>

                                    <option value="16.55">16,55</option>

                                    <option value="16.60">16,60</option>

                                    <option value="16.65">16,65</option>

                                    <option value="16.75">16,75</option>

                                    <option value="16.85">16,85</option>

                                    <option value="16.90">16,90</option>

                                    <option value="16.95">16,95</option>

                                    <option value="17.00">17,00</option>

                                    <option value="17.05">17,05</option>

                                    <option value="17.10">17,10</option>

                                    <option value="17.15">17,15</option>

                                    <option value="17.20">17,20</option>

                                    <option value="17.25">17,25</option>

                                    <option value="17.35">17,35</option>

                                    <option value="17.55">17,55</option>

                                    <option value="17.60">17,60</option>

                                    <option value="17.65">17,65</option>

                                    <option value="17.70">17,70</option>

                                    <option value="17.85">17,85</option>

                                    <option value="17.90">17,90</option>

                                    <option value="18.00">18,00</option>

                                    <option value="18.05">18,05</option>

                                    <option value="18.15">18,15</option>

                                    <option value="18.30">18,30</option>

                                    <option value="18.35">18,35</option>

                                    <option value="18.40">18,40</option>

                                    <option value="18.45">18,45</option>

                                    <option value="18.50">18,50</option>

                                    <option value="18.55">18,55</option>

                                    <option value="18.70">18,70</option>

                                    <option value="18.75">18,75</option>

                                    <option value="18.85">18,85</option>

                                    <option value="18.95">18,95</option>

                                    <option value="19.00">19,00</option>

                                    <option value="19.05">19,05</option>

                                    <option value="19.25">19,25</option>

                                    <option value="19.30">19,30</option>

                                    <option value="19.35">19,35</option>

                                    <option value="19.40">19,40</option>

                                    <option value="19.45">19,45</option>

                                    <option value="19.50">19,50</option>

                                    <option value="19.60">19,60</option>

                                    <option value="19.70">19,70</option>

                                    <option value="19.75">19,75</option>

                                    <option value="19.80">19,80</option>

                                    <option value="19.85">19,85</option>

                                    <option value="19.90">19,90</option>

                                    <option value="19.95">19,95</option>

                                    <option value="20.05">20,05</option>

                                    <option value="20.10">20,10</option>

                                    <option value="20.25">20,25</option>

                                    <option value="20.40">20,40</option>

                                    <option value="20.45">20,45</option>

                                    <option value="20.50">20,50</option>

                                    <option value="20.55">20,55</option>

                                    <option value="20.60">20,60</option>

                                    <option value="20.70">20,70</option>

                                    <option value="20.80">20,80</option>

                                    <option value="20.90">20,90</option>

                                    <option value="20.95">20,95</option>

                                    <option value="21.00">21,00</option>

                                    <option value="21.05">21,05</option>

                                    <option value="21.10">21,10</option>

                                    <option value="21.20">21,20</option>

                                    <option value="21.25">21,25</option>

                                    <option value="21.30">21,30</option>

                                    <option value="21.40">21,40</option>

                                    <option value="21.45">21,45</option>

                                    <option value="21.50">21,50</option>

                                    <option value="21.55">21,55</option>

                                    <option value="21.60">21,60</option>

                                    <option value="21.65">21,65</option>

                                    <option value="21.70">21,70</option>

                                    <option value="21.80">21,80</option>

                                    <option value="21.90">21,90</option>

                                    <option value="21.95">21,95</option>

                                    <option value="22.15">22,15</option>

                                    <option value="22.20">22,20</option>

                                    <option value="22.25">22,25</option>

                                    <option value="22.35">22,35</option>

                                    <option value="22.40">22,40</option>

                                    <option value="22.50">22,50</option>

                                    <option value="22.55">22,55</option>

                                    <option value="22.65">22,65</option>

                                    <option value="22.70">22,70</option>

                                    <option value="22.80">22,80</option>

                                    <option value="22.90">22,90</option>

                                    <option value="22.95">22,95</option>

                                    <option value="23.00">23,00</option>

                                    <option value="23.05">23,05</option>

                                    <option value="23.20">23,20</option>

                                    <option value="23.25">23,25</option>

                                    <option value="23.30">23,30</option>

                                    <option value="23.35">23,35</option>

                                    <option value="23.40">23,40</option>

                                    <option value="23.50">23,50</option>

                                    <option value="23.60">23,60</option>

                                    <option value="23.75">23,75</option>

                                    <option value="23.80">23,80</option>

                                    <option value="23.85">23,85</option>

                                    <option value="23.90">23,90</option>

                                    <option value="23.95">23,95</option>

                                    <option value="24.05">24,05</option>

                                    <option value="24.10">24,10</option>

                                    <option value="24.15">24,15</option>

                                    <option value="24.25">24,25</option>

                                    <option value="24.30">24,30</option>

                                    <option value="24.60">24,60</option>

                                    <option value="24.65">24,65</option>

                                    <option value="24.70">24,70</option>

                                    <option value="24.75">24,75</option>

                                    <option value="24.80">24,80</option>

                                    <option value="24.85">24,85</option>

                                    <option value="24.90">24,90</option>

                                    <option value="24.95">24,95</option>

                                    <option value="25.10">25,10</option>

                                    <option value="25.15">25,15</option>

                                    <option value="25.25">25,25</option>

                                    <option value="25.30">25,30</option>

                                    <option value="25.55">25,55</option>

                                    <option value="25.70">25,70</option>

                                    <option value="25.80">25,80</option>

                                    <option value="25.85">25,85</option>

                                    <option value="25.90">25,90</option>

                                    <option value="25.95">25,95</option>

                                    <option value="26.00">26,00</option>

                                    <option value="26.05">26,05</option>

                                    <option value="26.30">26,30</option>

                                    <option value="26.35">26,35</option>

                                    <option value="26.40">26,40</option>

                                    <option value="26.55">26,55</option>

                                    <option value="26.60">26,60</option>

                                    <option value="26.65">26,65</option>

                                    <option value="26.70">26,70</option>

                                    <option value="27.00">27,00</option>

                                    <option value="27.15">27,15</option>

                                    <option value="27.20">27,20</option>

                                    <option value="27.30">27,30</option>

                                    <option value="27.35">27,35</option>

                                    <option value="27.40">27,40</option>

                                    <option value="27.45">27,45</option>

                                    <option value="27.50">27,50</option>

                                    <option value="27.65">27,65</option>

                                    <option value="27.70">27,70</option>

                                    <option value="27.75">27,75</option>

                                    <option value="28.05">28,05</option>

                                    <option value="28.10">28,10</option>

                                    <option value="28.15">28,15</option>

                                    <option value="28.40">28,40</option>

                                    <option value="28.60">28,60</option>

                                    <option value="28.70">28,70</option>

                                    <option value="28.80">28,80</option>

                                    <option value="28.85">28,85</option>

                                    <option value="28.90">28,90</option>

                                    <option value="28.95">28,95</option>

                                    <option value="29.00">29,00</option>

                                    <option value="29.05">29,05</option>

                                    <option value="29.10">29,10</option>

                                    <option value="29.15">29,15</option>

                                    <option value="29.20">29,20</option>

                                    <option value="29.25">29,25</option>

                                    <option value="29.30">29,30</option>

                                    <option value="29.35">29,35</option>

                                    <option value="29.40">29,40</option>

                                    <option value="29.55">29,55</option>

                                    <option value="29.75">29,75</option>

                                    <option value="29.90">29,90</option>

                                    <option value="29.95">29,95</option>

                                    <option value="30.00">30,00</option>

                                    <option value="30.20">30,20</option>

                                    <option value="30.25">30,25</option>

                                    <option value="30.55">30,55</option>

                                    <option value="30.60">30,60</option>

                                    <option value="30.65">30,65</option>

                                    <option value="30.70">30,70</option>

                                    <option value="30.75">30,75</option>

                                    <option value="30.80">30,80</option>

                                    <option value="30.85">30,85</option>

                                    <option value="30.90">30,90</option>

                                    <option value="30.95">30,95</option>

                                    <option value="31.05">31,05</option>

                                    <option value="31.10">31,10</option>

                                    <option value="31.15">31,15</option>

                                    <option value="31.20">31,20</option>

                                    <option value="31.35">31,35</option>

                                    <option value="31.45">31,45</option>

                                    <option value="31.75">31,75</option>

                                    <option value="31.80">31,80</option>

                                    <option value="31.95">31,95</option>

                                    <option value="32.05">32,05</option>

                                    <option value="32.15">32,15</option>

                                    <option value="32.20">32,20</option>

                                    <option value="32.55">32,55</option>

                                    <option value="32.65">32,65</option>

                                    <option value="32.70">32,70</option>

                                    <option value="32.75">32,75</option>

                                    <option value="32.90">32,90</option>

                                    <option value="32.95">32,95</option>

                                    <option value="33.05">33,05</option>

                                    <option value="33.10">33,10</option>

                                    <option value="33.20">33,20</option>

                                    <option value="33.25">33,25</option>

                                    <option value="33.30">33,30</option>

                                    <option value="33.40">33,40</option>

                                    <option value="33.60">33,60</option>

                                    <option value="33.65">33,65</option>

                                    <option value="33.80">33,80</option>

                                    <option value="33.95">33,95</option>

                                    <option value="34.05">34,05</option>

                                    <option value="34.10">34,10</option>

                                    <option value="34.30">34,30</option>

                                    <option value="34.35">34,35</option>

                                    <option value="34.45">34,45</option>

                                    <option value="34.55">34,55</option>

                                    <option value="34.60">34,60</option>

                                    <option value="34.65">34,65</option>

                                    <option value="34.70">34,70</option>

                                    <option value="34.75">34,75</option>

                                    <option value="34.80">34,80</option>

                                    <option value="34.81">34,81</option>

                                    <option value="34.85">34,85</option>

                                    <option value="34.90">34,90</option>

                                    <option value="35.05">35,05</option>

                                    <option value="35.10">35,10</option>

                                    <option value="35.15">35,15</option>

                                    <option value="35.25">35,25</option>

                                    <option value="35.35">35,35</option>

                                    <option value="35.40">35,40</option>

                                    <option value="35.65">35,65</option>

                                    <option value="35.75">35,75</option>

                                    <option value="35.85">35,85</option>

                                    <option value="35.90">35,90</option>

                                    <option value="35.95">35,95</option>

                                    <option value="36.05">36,05</option>

                                    <option value="36.10">36,10</option>

                                    <option value="36.25">36,25</option>

                                    <option value="36.40">36,40</option>

                                    <option value="36.50">36,50</option>

                                    <option value="36.65">36,65</option>

                                    <option value="36.70">36,70</option>

                                    <option value="36.85">36,85</option>

                                    <option value="36.90">36,90</option>

                                    <option value="36.95">36,95</option>

                                    <option value="37.00">37,00</option>

                                    <option value="37.05">37,05</option>

                                    <option value="37.15">37,15</option>

                                    <option value="37.30">37,30</option>

                                    <option value="37.35">37,35</option>

                                    <option value="37.45">37,45</option>

                                    <option value="37.50">37,50</option>

                                    <option value="37.55">37,55</option>

                                    <option value="37.70">37,70</option>

                                    <option value="37.90">37,90</option>

                                    <option value="38.00">38,00</option>

                                    <option value="38.10">38,10</option>

                                    <option value="38.15">38,15</option>

                                    <option value="38.35">38,35</option>

                                    <option value="38.55">38,55</option>

                                    <option value="38.70">38,70</option>

                                    <option value="38.80">38,80</option>

                                    <option value="38.85">38,85</option>

                                    <option value="39.15">39,15</option>

                                    <option value="39.20">39,20</option>

                                    <option value="39.25">39,25</option>

                                    <option value="39.35">39,35</option>

                                    <option value="39.45">39,45</option>

                                    <option value="39.60">39,60</option>

                                    <option value="39.75">39,75</option>

                                    <option value="39.85">39,85</option>

                                    <option value="39.90">39,90</option>

                                    <option value="39.95">39,95</option>

                                    <option value="40.05">40,05</option>

                                    <option value="40.20">40,20</option>

                                    <option value="40.25">40,25</option>

                                    <option value="40.30">40,30</option>

                                    <option value="40.40">40,40</option>

                                    <option value="40.45">40,45</option>

                                    <option value="40.75">40,75</option>

                                    <option value="40.80">40,80</option>

                                    <option value="40.90">40,90</option>

                                    <option value="41.00">41,00</option>

                                    <option value="41.05">41,05</option>

                                    <option value="41.10">41,10</option>

                                    <option value="41.15">41,15</option>

                                    <option value="41.25">41,25</option>

                                    <option value="41.30">41,30</option>

                                    <option value="41.45">41,45</option>

                                    <option value="41.50">41,50</option>

                                    <option value="41.85">41,85</option>

                                    <option value="41.90">41,90</option>

                                    <option value="42.25">42,25</option>

                                    <option value="42.30">42,30</option>

                                    <option value="42.35">42,35</option>

                                    <option value="42.45">42,45</option>

                                    <option value="42.55">42,55</option>

                                    <option value="42.65">42,65</option>

                                    <option value="42.75">42,75</option>

                                    <option value="42.85">42,85</option>

                                    <option value="42.90">42,90</option>

                                    <option value="42.95">42,95</option>

                                    <option value="43.30">43,30</option>

                                    <option value="43.65">43,65</option>

                                    <option value="43.80">43,80</option>

                                    <option value="43.85">43,85</option>

                                    <option value="43.95">43,95</option>

                                    <option value="44.00">44,00</option>

                                    <option value="44.20">44,20</option>

                                    <option value="44.25">44,25</option>

                                    <option value="44.35">44,35</option>

                                    <option value="44.40">44,40</option>

                                    <option value="44.55">44,55</option>

                                    <option value="44.75">44,75</option>

                                    <option value="44.80">44,80</option>

                                    <option value="45.25">45,25</option>

                                    <option value="45.35">45,35</option>

                                    <option value="45.55">45,55</option>

                                    <option value="45.75">45,75</option>

                                    <option value="45.80">45,80</option>

                                    <option value="45.95">45,95</option>

                                    <option value="46.05">46,05</option>

                                    <option value="46.25">46,25</option>

                                    <option value="46.30">46,30</option>

                                    <option value="46.40">46,40</option>

                                    <option value="46.45">46,45</option>

                                    <option value="46.60">46,60</option>

                                    <option value="46.70">46,70</option>

                                    <option value="46.80">46,80</option>

                                    <option value="46.85">46,85</option>

                                    <option value="46.90">46,90</option>

                                    <option value="47.00">47,00</option>

                                    <option value="47.05">47,05</option>

                                    <option value="47.15">47,15</option>

                                    <option value="47.35">47,35</option>

                                    <option value="47.45">47,45</option>

                                    <option value="47.60">47,60</option>

                                    <option value="47.65">47,65</option>

                                    <option value="47.70">47,70</option>

                                    <option value="47.75">47,75</option>

                                    <option value="47.80">47,80</option>

                                    <option value="47.85">47,85</option>

                                    <option value="47.90">47,90</option>

                                    <option value="48.30">48,30</option>

                                    <option value="48.35">48,35</option>

                                    <option value="48.85">48,85</option>

                                    <option value="49.15">49,15</option>

                                    <option value="49.20">49,20</option>

                                    <option value="49.30">49,30</option>

                                    <option value="49.45">49,45</option>

                                    <option value="49.50">49,50</option>

                                    <option value="49.65">49,65</option>

                                    <option value="49.70">49,70</option>

                                    <option value="49.80">49,80</option>

                                    <option value="49.95">49,95</option>

                                    <option value="50.10">50,10</option>

                                    <option value="50.30">50,30</option>

                                    <option value="50.45">50,45</option>

                                    <option value="50.50">50,50</option>

                                    <option value="50.60">50,60</option>

                                    <option value="50.70">50,70</option>

                                    <option value="50.85">50,85</option>

                                    <option value="50.95">50,95</option>

                                    <option value="51.00">51,00</option>

                                    <option value="51.30">51,30</option>

                                    <option value="51.35">51,35</option>

                                    <option value="51.50">51,50</option>

                                    <option value="51.55">51,55</option>

                                    <option value="51.65">51,65</option>

                                    <option value="51.80">51,80</option>

                                    <option value="52.05">52,05</option>

                                    <option value="52.15">52,15</option>

                                    <option value="52.25">52,25</option>

                                    <option value="52.30">52,30</option>

                                    <option value="52.40">52,40</option>

                                    <option value="52.45">52,45</option>

                                    <option value="52.50">52,50</option>

                                    <option value="52.90">52,90</option>

                                    <option value="53.00">53,00</option>

                                    <option value="53.10">53,10</option>

                                    <option value="53.25">53,25</option>

                                    <option value="53.30">53,30</option>

                                    <option value="53.40">53,40</option>

                                    <option value="53.45">53,45</option>

                                    <option value="53.60">53,60</option>

                                    <option value="53.65">53,65</option>

                                    <option value="53.70">53,70</option>

                                    <option value="53.85">53,85</option>

                                    <option value="53.95">53,95</option>

                                    <option value="54.00">54,00</option>

                                    <option value="54.10">54,10</option>

                                    <option value="54.40">54,40</option>

                                    <option value="54.55">54,55</option>

                                    <option value="54.70">54,70</option>

                                    <option value="54.85">54,85</option>

                                    <option value="54.90">54,90</option>

                                    <option value="54.95">54,95</option>

                                    <option value="55.05">55,05</option>

                                    <option value="55.15">55,15</option>

                                    <option value="55.25">55,25</option>

                                    <option value="55.35">55,35</option>

                                    <option value="55.40">55,40</option>

                                    <option value="55.45">55,45</option>

                                    <option value="55.50">55,50</option>

                                    <option value="55.60">55,60</option>

                                    <option value="55.80">55,80</option>

                                    <option value="55.85">55,85</option>

                                    <option value="55.90">55,90</option>

                                    <option value="55.95">55,95</option>

                                    <option value="56.10">56,10</option>

                                    <option value="56.15">56,15</option>

                                    <option value="56.25">56,25</option>

                                    <option value="56.45">56,45</option>

                                    <option value="56.50">56,50</option>

                                    <option value="56.55">56,55</option>

                                    <option value="56.70">56,70</option>

                                    <option value="56.95">56,95</option>

                                    <option value="57.10">57,10</option>

                                    <option value="57.20">57,20</option>

                                    <option value="57.25">57,25</option>

                                    <option value="57.35">57,35</option>

                                    <option value="57.50">57,50</option>

                                    <option value="57.70">57,70</option>

                                    <option value="58.00">58,00</option>

                                    <option value="58.05">58,05</option>

                                    <option value="58.45">58,45</option>

                                    <option value="58.50">58,50</option>

                                    <option value="58.55">58,55</option>

                                    <option value="58.65">58,65</option>

                                    <option value="58.80">58,80</option>

                                    <option value="58.85">58,85</option>

                                    <option value="58.90">58,90</option>

                                    <option value="59.00">59,00</option>

                                    <option value="59.15">59,15</option>

                                    <option value="59.25">59,25</option>

                                    <option value="59.35">59,35</option>

                                    <option value="59.55">59,55</option>

                                    <option value="59.60">59,60</option>

                                    <option value="59.70">59,70</option>

                                    <option value="59.95">59,95</option>

                                    <option value="60.05">60,05</option>

                                    <option value="60.30">60,30</option>

                                    <option value="60.45">60,45</option>

                                    <option value="60.65">60,65</option>

                                    <option value="60.75">60,75</option>

                                    <option value="61.00">61,00</option>

                                    <option value="61.05">61,05</option>

                                    <option value="61.10">61,10</option>

                                    <option value="61.15">61,15</option>

                                    <option value="61.40">61,40</option>

                                    <option value="61.55">61,55</option>

                                    <option value="61.60">61,60</option>

                                    <option value="61.80">61,80</option>

                                    <option value="62.00">62,00</option>

                                    <option value="62.05">62,05</option>

                                    <option value="62.15">62,15</option>

                                    <option value="62.20">62,20</option>

                                    <option value="62.35">62,35</option>

                                    <option value="62.50">62,50</option>

                                    <option value="62.60">62,60</option>

                                    <option value="62.70">62,70</option>

                                    <option value="62.75">62,75</option>

                                    <option value="62.80">62,80</option>

                                    <option value="62.85">62,85</option>

                                    <option value="62.90">62,90</option>

                                    <option value="62.95">62,95</option>

                                    <option value="63.05">63,05</option>

                                    <option value="63.25">63,25</option>

                                    <option value="63.45">63,45</option>

                                    <option value="63.50">63,50</option>

                                    <option value="63.55">63,55</option>

                                    <option value="63.65">63,65</option>

                                    <option value="63.80">63,80</option>

                                    <option value="64.20">64,20</option>

                                    <option value="64.35">64,35</option>

                                    <option value="64.65">64,65</option>

                                    <option value="64.75">64,75</option>

                                    <option value="64.85">64,85</option>

                                    <option value="64.90">64,90</option>

                                    <option value="64.95">64,95</option>

                                    <option value="65.00">65,00</option>

                                    <option value="65.10">65,10</option>

                                    <option value="65.35">65,35</option>

                                    <option value="65.55">65,55</option>

                                    <option value="65.70">65,70</option>

                                    <option value="65.85">65,85</option>

                                    <option value="65.95">65,95</option>

                                    <option value="66.10">66,10</option>

                                    <option value="66.20">66,20</option>

                                    <option value="66.25">66,25</option>

                                    <option value="66.30">66,30</option>

                                    <option value="66.35">66,35</option>

                                    <option value="66.45">66,45</option>

                                    <option value="66.60">66,60</option>

                                    <option value="66.65">66,65</option>

                                    <option value="66.70">66,70</option>

                                    <option value="66.80">66,80</option>

                                    <option value="67.05">67,05</option>

                                    <option value="67.15">67,15</option>

                                    <option value="67.25">67,25</option>

                                    <option value="67.35">67,35</option>

                                    <option value="67.60">67,60</option>

                                    <option value="67.65">67,65</option>

                                    <option value="67.80">67,80</option>

                                    <option value="68.05">68,05</option>

                                    <option value="68.25">68,25</option>

                                    <option value="68.40">68,40</option>

                                    <option value="68.55">68,55</option>

                                    <option value="68.65">68,65</option>

                                    <option value="68.70">68,70</option>

                                    <option value="68.90">68,90</option>

                                    <option value="69.20">69,20</option>

                                    <option value="69.45">69,45</option>

                                    <option value="69.60">69,60</option>

                                    <option value="69.65">69,65</option>

                                    <option value="69.70">69,70</option>

                                    <option value="69.85">69,85</option>

                                    <option value="69.90">69,90</option>

                                    <option value="69.95">69,95</option>

                                    <option value="70.05">70,05</option>

                                    <option value="70.20">70,20</option>

                                    <option value="70.70">70,70</option>

                                    <option value="70.90">70,90</option>

                                    <option value="71.05">71,05</option>

                                    <option value="71.10">71,10</option>

                                    <option value="71.55">71,55</option>

                                    <option value="71.60">71,60</option>

                                    <option value="71.70">71,70</option>

                                    <option value="71.75">71,75</option>

                                    <option value="71.85">71,85</option>

                                    <option value="71.95">71,95</option>

                                    <option value="72.00">72,00</option>

                                    <option value="72.05">72,05</option>

                                    <option value="72.15">72,15</option>

                                    <option value="72.35">72,35</option>

                                    <option value="72.40">72,40</option>

                                    <option value="72.45">72,45</option>

                                    <option value="72.50">72,50</option>

                                    <option value="72.65">72,65</option>

                                    <option value="72.90">72,90</option>

                                    <option value="73.20">73,20</option>

                                    <option value="73.30">73,30</option>

                                    <option value="73.35">73,35</option>

                                    <option value="73.60">73,60</option>

                                    <option value="74.00">74,00</option>

                                    <option value="74.05">74,05</option>

                                    <option value="74.25">74,25</option>

                                    <option value="74.35">74,35</option>

                                    <option value="74.60">74,60</option>

                                    <option value="74.70">74,70</option>

                                    <option value="75.00">75,00</option>

                                    <option value="75.05">75,05</option>

                                    <option value="75.10">75,10</option>

                                    <option value="75.15">75,15</option>

                                    <option value="75.30">75,30</option>

                                    <option value="75.75">75,75</option>

                                    <option value="75.85">75,85</option>

                                    <option value="75.90">75,90</option>

                                    <option value="76.05">76,05</option>

                                    <option value="76.10">76,10</option>

                                    <option value="76.15">76,15</option>

                                    <option value="76.35">76,35</option>

                                    <option value="76.40">76,40</option>

                                    <option value="76.45">76,45</option>

                                    <option value="76.50">76,50</option>

                                    <option value="76.55">76,55</option>

                                    <option value="76.70">76,70</option>

                                    <option value="76.90">76,90</option>

                                    <option value="77.30">77,30</option>

                                    <option value="77.35">77,35</option>

                                    <option value="77.40">77,40</option>

                                    <option value="77.50">77,50</option>

                                    <option value="77.80">77,80</option>

                                    <option value="78.00">78,00</option>

                                    <option value="78.10">78,10</option>

                                    <option value="78.45">78,45</option>

                                    <option value="78.50">78,50</option>

                                    <option value="78.60">78,60</option>

                                    <option value="78.65">78,65</option>

                                    <option value="78.75">78,75</option>

                                    <option value="78.85">78,85</option>

                                    <option value="79.05">79,05</option>

                                    <option value="79.25">79,25</option>

                                    <option value="79.35">79,35</option>

                                    <option value="79.45">79,45</option>

                                    <option value="79.85">79,85</option>

                                    <option value="80.05">80,05</option>

                                    <option value="80.10">80,10</option>

                                    <option value="80.45">80,45</option>

                                    <option value="80.60">80,60</option>

                                    <option value="80.65">80,65</option>

                                    <option value="81.30">81,30</option>

                                    <option value="81.55">81,55</option>

                                    <option value="81.70">81,70</option>

                                    <option value="81.80">81,80</option>

                                    <option value="81.85">81,85</option>

                                    <option value="82.15">82,15</option>

                                    <option value="82.25">82,25</option>

                                    <option value="82.35">82,35</option>

                                    <option value="82.40">82,40</option>

                                    <option value="82.45">82,45</option>

                                    <option value="82.55">82,55</option>

                                    <option value="82.60">82,60</option>

                                    <option value="82.90">82,90</option>

                                    <option value="83.20">83,20</option>

                                    <option value="83.25">83,25</option>

                                    <option value="83.40">83,40</option>

                                    <option value="83.50">83,50</option>

                                    <option value="83.55">83,55</option>

                                    <option value="83.85">83,85</option>

                                    <option value="83.90">83,90</option>

                                    <option value="84.00">84,00</option>

                                    <option value="84.05">84,05</option>

                                    <option value="84.15">84,15</option>

                                    <option value="84.30">84,30</option>

                                    <option value="84.45">84,45</option>

                                    <option value="85.25">85,25</option>

                                    <option value="85.55">85,55</option>

                                    <option value="85.85">85,85</option>

                                    <option value="85.90">85,90</option>

                                    <option value="86.05">86,05</option>

                                    <option value="86.10">86,10</option>

                                    <option value="86.15">86,15</option>

                                    <option value="86.20">86,20</option>

                                    <option value="86.35">86,35</option>

                                    <option value="86.50">86,50</option>

                                    <option value="86.60">86,60</option>

                                    <option value="87.00">87,00</option>

                                    <option value="87.05">87,05</option>

                                    <option value="87.50">87,50</option>

                                    <option value="87.60">87,60</option>

                                    <option value="87.70">87,70</option>

                                    <option value="87.95">87,95</option>

                                    <option value="88.05">88,05</option>

                                    <option value="88.15">88,15</option>

                                    <option value="88.30">88,30</option>

                                    <option value="88.45">88,45</option>

                                    <option value="88.55">88,55</option>

                                    <option value="88.60">88,60</option>

                                    <option value="88.65">88,65</option>

                                    <option value="88.95">88,95</option>

                                    <option value="89.20">89,20</option>

                                    <option value="89.25">89,25</option>

                                    <option value="89.35">89,35</option>

                                    <option value="89.80">89,80</option>

                                    <option value="89.90">89,90</option>

                                    <option value="90.15">90,15</option>

                                    <option value="90.20">90,20</option>

                                    <option value="90.45">90,45</option>

                                    <option value="90.50">90,50</option>

                                    <option value="90.70">90,70</option>

                                    <option value="91.05">91,05</option>

                                    <option value="91.25">91,25</option>

                                    <option value="91.55">91,55</option>

                                    <option value="91.60">91,60</option>

                                    <option value="91.70">91,70</option>

                                    <option value="91.75">91,75</option>

                                    <option value="92.30">92,30</option>

                                    <option value="92.35">92,35</option>

                                    <option value="92.45">92,45</option>

                                    <option value="92.50">92,50</option>

                                    <option value="92.55">92,55</option>

                                    <option value="92.65">92,65</option>

                                    <option value="92.80">92,80</option>

                                    <option value="92.85">92,85</option>

                                    <option value="93.25">93,25</option>

                                    <option value="93.55">93,55</option>

                                    <option value="93.90">93,90</option>

                                    <option value="93.95">93,95</option>

                                    <option value="94.05">94,05</option>

                                    <option value="94.20">94,20</option>

                                    <option value="94.50">94,50</option>

                                    <option value="94.80">94,80</option>

                                    <option value="94.90">94,90</option>

                                    <option value="95.30">95,30</option>

                                    <option value="95.60">95,60</option>

                                    <option value="95.80">95,80</option>

                                    <option value="96.25">96,25</option>

                                    <option value="96.35">96,35</option>

                                    <option value="97.10">97,10</option>

                                    <option value="97.35">97,35</option>

                                    <option value="97.55">97,55</option>

                                    <option value="97.65">97,65</option>

                                    <option value="97.90">97,90</option>

                                    <option value="98.05">98,05</option>

                                    <option value="98.15">98,15</option>

                                    <option value="98.40">98,40</option>

                                    <option value="98.75">98,75</option>

                                    <option value="98.80">98,80</option>

                                    <option value="99.35">99,35</option>

                                    <option value="99.40">99,40</option>

                                    <option value="99.45">99,45</option>

                                    <option value="99.70">99,70</option>

                                    <option value="100.40">100,40</option>

                                    <option value="100.60">100,60</option>

                                    <option value="100.75">100,75</option>

                                    <option value="101.00">101,00</option>

                                    <option value="101.05">101,05</option>

                                    <option value="101.40">101,40</option>

                                    <option value="101.75">101,75</option>

                                    <option value="102.35">102,35</option>

                                    <option value="102.50">102,50</option>

                                    <option value="102.55">102,55</option>

                                    <option value="102.60">102,60</option>

                                    <option value="102.85">102,85</option>

                                    <option value="103.25">103,25</option>

                                    <option value="103.35">103,35</option>

                                    <option value="103.60">103,60</option>

                                    <option value="104.35">104,35</option>

                                    <option value="104.60">104,60</option>

                                    <option value="104.70">104,70</option>

                                    <option value="104.95">104,95</option>

                                    <option value="105.90">105,90</option>

                                    <option value="106.05">106,05</option>

                                    <option value="106.30">106,30</option>

                                    <option value="106.40">106,40</option>

                                    <option value="106.55">106,55</option>

                                    <option value="107.20">107,20</option>

                                    <option value="107.75">107,75</option>

                                    <option value="108.35">108,35</option>

                                    <option value="108.50">108,50</option>

                                    <option value="109.00">109,00</option>

                                    <option value="109.10">109,10</option>

                                    <option value="109.15">109,15</option>

                                    <option value="109.20">109,20</option>

                                    <option value="109.30">109,30</option>

                                    <option value="109.50">109,50</option>

                                    <option value="109.90">109,90</option>

                                    <option value="110.05">110,05</option>

                                    <option value="110.60">110,60</option>

                                    <option value="110.90">110,90</option>

                                    <option value="111.00">111,00</option>

                                    <option value="111.25">111,25</option>

                                    <option value="111.55">111,55</option>

                                    <option value="111.80">111,80</option>

                                    <option value="112.50">112,50</option>

                                    <option value="112.55">112,55</option>

                                    <option value="112.95">112,95</option>

                                    <option value="113.20">113,20</option>

                                    <option value="113.30">113,30</option>

                                    <option value="113.35">113,35</option>

                                    <option value="113.60">113,60</option>

                                    <option value="113.75">113,75</option>

                                    <option value="113.80">113,80</option>

                                    <option value="114.65">114,65</option>

                                    <option value="115.05">115,05</option>

                                    <option value="115.20">115,20</option>

                                    <option value="115.80">115,80</option>

                                    <option value="116.00">116,00</option>

                                    <option value="116.55">116,55</option>

                                    <option value="116.70">116,70</option>

                                    <option value="116.80">116,80</option>

                                    <option value="117.20">117,20</option>

                                    <option value="117.30">117,30</option>

                                    <option value="117.70">117,70</option>

                                    <option value="117.85">117,85</option>

                                    <option value="118.60">118,60</option>

                                    <option value="119.00">119,00</option>

                                    <option value="119.10">119,10</option>

                                    <option value="119.30">119,30</option>

                                    <option value="119.35">119,35</option>

                                    <option value="119.50">119,50</option>

                                    <option value="120.15">120,15</option>

                                    <option value="120.70">120,70</option>

                                    <option value="120.90">120,90</option>

                                    <option value="121.55">121,55</option>

                                    <option value="121.70">121,70</option>

                                    <option value="121.85">121,85</option>

                                    <option value="122.05">122,05</option>

                                    <option value="122.20">122,20</option>

                                    <option value="122.70">122,70</option>

                                    <option value="122.80">122,80</option>

                                    <option value="123.55">123,55</option>

                                    <option value="123.70">123,70</option>

                                    <option value="124.65">124,65</option>

                                    <option value="125.25">125,25</option>

                                    <option value="126.40">126,40</option>

                                    <option value="126.50">126,50</option>

                                    <option value="126.70">126,70</option>

                                    <option value="127.15">127,15</option>

                                    <option value="127.50">127,50</option>

                                    <option value="128.30">128,30</option>

                                    <option value="128.35">128,35</option>

                                    <option value="128.95">128,95</option>

                                    <option value="129.20">129,20</option>

                                    <option value="129.85">129,85</option>

                                    <option value="129.90">129,90</option>

                                    <option value="130.30">130,30</option>

                                    <option value="130.40">130,40</option>

                                    <option value="130.55">130,55</option>

                                    <option value="131.30">131,30</option>

                                    <option value="132.90">132,90</option>

                                    <option value="133.10">133,10</option>

                                    <option value="133.20">133,20</option>

                                    <option value="134.10">134,10</option>

                                    <option value="135.15">135,15</option>

                                    <option value="135.65">135,65</option>

                                    <option value="136.90">136,90</option>

                                    <option value="137.80">137,80</option>

                                    <option value="137.85">137,85</option>

                                    <option value="138.45">138,45</option>

                                    <option value="139.30">139,30</option>

                                    <option value="139.35">139,35</option>

                                    <option value="139.75">139,75</option>

                                    <option value="140.05">140,05</option>

                                    <option value="141.05">141,05</option>

                                    <option value="141.85">141,85</option>

                                    <option value="142.45">142,45</option>

                                    <option value="142.55">142,55</option>

                                    <option value="142.70">142,70</option>

                                    <option value="142.85">142,85</option>

                                    <option value="143.95">143,95</option>

                                    <option value="146.40">146,40</option>

                                    <option value="147.05">147,05</option>

                                    <option value="147.15">147,15</option>

                                    <option value="147.85">147,85</option>

                                    <option value="148.75">148,75</option>

                                    <option value="148.85">148,85</option>

                                    <option value="148.90">148,90</option>

                                    <option value="149.05">149,05</option>

                                    <option value="150.40">150,40</option>

                                    <option value="152.60">152,60</option>

                                    <option value="153.40">153,40</option>

                                    <option value="153.45">153,45</option>

                                    <option value="154.00">154,00</option>

                                    <option value="154.05">154,05</option>

                                    <option value="154.50">154,50</option>

                                    <option value="155.30">155,30</option>

                                    <option value="156.30">156,30</option>

                                    <option value="156.60">156,60</option>

                                    <option value="157.65">157,65</option>

                                    <option value="158.60">158,60</option>

                                    <option value="161.80">161,80</option>

                                    <option value="161.85">161,85</option>

                                    <option value="165.75">165,75</option>

                                    <option value="166.75">166,75</option>

                                    <option value="169.55">169,55</option>

                                    <option value="170.60">170,60</option>

                                    <option value="172.45">172,45</option>

                                    <option value="184.65">184,65</option>

                                    <option value="186.45">186,45</option>

                                    <option value="204.45">204,45</option>

                                    <option value="214.55">214,55</option>

                                    <option value="217.20">217,20</option>

                                    <option value="239.55">239,55</option>

                                    <option value="256.45">256,45</option>

                                    <option value="258.95">258,95</option>

                                    <option value="283.95">283,95</option>

                                    <option value="301.70">301,70</option>

                                </select>
                                <select id="selectValorListTarifaFutura" style="display: none;"
                                    name="filtro.valorFutura">
                                    <option value="" selected="selected">Selecione</option>

                                </select>
                            </p>

                            <input type="button" id="dataTableFetchData" value="Pesquisar"
                                onclick="javascript:pesquisar()">
                            <input class="reset" id="reseta" type="reset" value="Limpar" />
                        </fieldset>

                    </form>

                    <img src="<?= base_url(); ?>assets/bomweb/images/bomweb_filtros_box_dn.jpg" />

                </div>
                <br />


                <a id="insert" href="<?= base_url() . "exemple/group/endpoint/bom_tarifa_cadasrtar"; ?>"
                    class="buttom_azul">Nova Tarifa</a>


                <a id="upload" href="<?= base_url() . "exemple/group/endpoint/bom_tarifa_cadasrtar"; ?>">Importar</a>


                <div id="divDataTable" style="width: 100%; overflow: auto;">
                </div>
                <a id="linkExport" href="<?= base_url() . "exemple/group/endpoint/bom_tarifa_cadasrtar"; ?>">Exportar</a>

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