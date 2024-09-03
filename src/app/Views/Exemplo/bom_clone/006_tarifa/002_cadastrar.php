<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <title>BomWeb</title>
    <meta http-equiv="X-UA-Compatible" content="IE=8" />
    <link rel="stylesheet" type="text/css" href="/css/estilos.css" />
    <link rel="stylesheet" type="text/css" href="/css/jquery.ui.all.css" />
    <link rel="stylesheet" type="text/css" href="/css/jquery.simplemodal.css" />
    <link rel="stylesheet" type="text/css" href="/css/jquery.treeview.css" />
    <script type="text/javascript" src="/jscript/jquery-1.5.min.js"></script>
    <script type="text/javascript" src="/jscript/jquery.ui.1.8.min.js"></script>
    <script
      type="text/javascript"
      src="/jscript/jquery.simplemodal.js"
    ></script>
    <script
      type="text/javascript"
      src="/jscript/jquery.maskedinput-1.3.min.js"
    ></script>
    <script
      type="text/javascript"
      src="/jscript/jquery.validate.min.js"
    ></script>
    <script
      type="text/javascript"
      src="/jscript/jquery.tablesorter.min.js"
    ></script>
    <script
      type="text/javascript"
      src="/jscript/jquery.multiselect.js"
    ></script>
    <script type="text/javascript" src="/jscript/jquery.treeview.js"></script>
    <script type="text/javascript" src="/jscript/jquery.maskMoney.js"></script>
    <script
      type="text/javascript"
      src="/jscript/jquery.loading.min.js"
    ></script>
    <script type="text/javascript" src="/jscript/jshashtable-2.1.js"></script>
    <script
      type="text/javascript"
      src="/jscript/jquery.numberformatter-1.2.2.min.js"
    ></script>

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

            <li>
              <a tabindex="-1" href="/tipodeveiculo/list">Tipo de Veículo</a>
            </li>

            <li><a tabindex="-1" href="/tipodelinha/list">Tipo de Linha</a></li>

            <li><a tabindex="-1" href="/tarifa/list">Tarifa</a></li>

            <li><a tabindex="-1" href="/usuario/list">Usuário</a></li>

            <li><a tabindex="-1" href="/bom/list">BOM</a></li>

            <li><a tabindex="-1" href="/relatorio/list">Relatório</a></li>

            <li><a tabindex="-1" href="/log/list">Log</a></li>

            <li>
              <a tabindex="-1" href="/configuracao/list">Configurações</a>
            </li>

            <li>
              <a tabindex="-1" href="/tarifaRetroativa/formUpload"
                >Tarifa Retroativa</a
              >
            </li>

            <li>
              <a tabindex="-1" href="/importaLinha/formUpload"
                >Importar Linhas</a
              >
            </li>

            <li><a tabindex="-1" href="/manual/download">Manual</a></li>
          </ul>
        </div>

        <div id="info"></div>
        <div id="result">
          <span
            ><strong class="titulo azul">Cadastro </strong
            ><img src="/images/bomweb_setas.gif" /><strong class="titulo verde">
              <script
                type="text/javascript"
                src="/jscript/formTarifa.js"
              ></script>

              Tarifa
            </strong></span
          >
          <div id="inclusao">
            <img src="/images/bomweb_filtros_box_up.jpg" />

            <form
              id="form"
              name="form"
              action="
		/tarifa
	/save"
              method="post"
            >
              <fieldset>
                <input type="hidden" name="entity.id" value="" />
                <input type="hidden" name="entity.active" value="" />
                <input type="hidden" name="justificaivaHidden" value="0" />

                <p>
                  <label for="buscaEmp">Empresa:</label>
                  <input
                    id="buscaEmp"
                    name="entity.secao.linhaVigencia.empresa.nome"
                    value=""
                    onblur="limpaId(this,'idEmpresa')"
                    style="width: 350px"
                    class="required"
                  />
                  *
                  <input
                    type="hidden"
                    id="idEmpresa"
                    name="entity.secao.linhaVigencia.empresa.id"
                    value=""
                  />
                </p>
                <p>
                  <label for="buscaLinha">Linha:</label>
                  <input
                    type="hidden"
                    id="idLinha"
                    name="entity.secao.linhaVigencia.id"
                    value=""
                  />
                  <input
                    type="text"
                    id="buscaLinha"
                    class="required"
                    disabled="disabled"
                    onblur="limpaId(this,'idLinha')"
                    style="width: 250px"
                  />
                  *

                  <img
                    class="loading"
                    alt="Carregando"
                    src="/images/carregando.gif"
                  />
                </p>
                <p>
                  <label for="secao">Seção:</label>
                  <select
                    id="secao"
                    name="entity.secao.id"
                    disabled="disabled"
                    class="required"
                  >
                    <option value="">Selecione</option>
                  </select>
                  *
                  <img
                    class="loading"
                    alt="Carregando"
                    src="/images/carregando.gif"
                  />
                </p>

                <p>
                  <label for="valorTarifa">Valor:</label>
                  <input
                    type="text"
                    id="valorTarifa"
                    value=""
                    class="required"
                    name="entity.valor"
                    class="required"
                    size="7"
                    maxlength="7"
                  />
                  *
                </p>
                <p>
                  <label for="datepicker">Data:</label>
                  <input
                    type="text"
                    id="dataInicioVigencia"
                    value=""
                    name="entity.inicioVigencia"
                    class="required"
                    maxlength="10"
                  />
                  *
                </p>

                <div
                  id="modalView2"
                  style="display: none"
                  class="simplemodal-data"
                >
                  <div class="white_content_header">
                    <img
                      src="/bomweb/images/ico_modal_alert.png"
                      align="absmiddle"
                    />
                    Alerta
                  </div>
                  <div class="messageJust white_content_content"></div>
                  <div class="white_content_footer">
                    <input
                      id="btnSimEdicaoRetroativa"
                      type="button"
                      value="Sim"
                    />
                    <input
                      class="simplemodal-close"
                      type="button"
                      value="Não"
                    />
                  </div>
                </div>

                <div id="formControls">
                  <div id="camposObrigatorios">* Campo obrigatório.</div>
                  <input type="submit" value="Salvar" class="submit" />

                  <input
                    type="reset"
                    class="reset"
                    value="Limpar"
                    style="display: none"
                  />

                  <input
                    type="button"
                    id="btnCancelar"
                    value="Cancelar"
                    style="display: none"
                  />
                </div>
              </fieldset>
            </form>
            <img src="/images/bomweb_filtros_box_dn.jpg" />
          </div>
        </div>
      </div>
      <div class="separador"></div>
      <img src="/images/bomweb_footer_space.gif" />
      <div id="footer">
        <div id="version_control">v1.16.0.6</div>
      </div>
    </div>
    <div id="modalView" style="display: none"></div>
  </body>
</html>
