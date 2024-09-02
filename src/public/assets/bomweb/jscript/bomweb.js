$(document).ready(function() {
	
	bomweb.init();

//	var CAN_SUBMIT = false;
	if( $(location).attr('href').indexOf('/log/list') == -1 ) {
		$('input[type="text"]:first').focus();
	}
	
	$('input[type="text"]').focus(function() {
		if( $(this).attr("readonly") ) {
			$(this).blur();
		}
	});
	
	$(".inputhora").mask("99:99");
	
	// datepicker
	
	$("#data").datepicker();
	$("#datainicio").datepicker();
	$("#datafim").datepicker();
	$("#dataInicioVigencia").datepicker();

	if (  $("#inicioVigenciaBom").attr("readonly"))
	{
		$("#inicioVigenciaBom").datepicker("disable" );
	}
	else
	{
		$("#inicioVigenciaBom").datepicker(); 
	}
	// mask
	
	$("#data").mask("99/99/9999");
	$("#inicioVigenciaBom").mask("99/99/9999");
	$("#datainicio").mask("99/99/9999");
	$("#datafim").mask("99/99/9999");
	$("#dataInicioVigencia").mask("99/99/9999");
	$("#mes_referencia").mask("99/9999");

	// maskMoney
	
	$("#piso1AB").maskMoney({ thousands:".", decimal:",", allowZero:true });
	$("#piso2AB").maskMoney({ thousands:".", decimal:",", allowZero:true });
	$("#piso1BA").maskMoney({ thousands:".", decimal:",", allowZero:true });
	$("#piso2BA").maskMoney({ thousands:".", decimal:",", allowZero:true });
	$("#valorTarifa").maskMoney({ thousands:"", decimal:"," });
	
	// TableSorter
	$(".tablesorter").tablesorter({widgets: ['zebra']});

	// FormValidate
	
	// => Validar Checkboxes
    $.validator.addMethod('validate-checkbox-oneormore', function (value) {
    	var error = false;
    	if($('.require-one:checked').size() == 0) {
    		$(".errorCheck").show();
    		error = true;
    	} 
    	else {
    		$(".errorCheck").hide();
    		error = false;
    	}
        return  !error;},''
    );
    
	// => Validar Checkboxes
    $.validator.addMethod('multi-required', function (value, element) {
    	return element.value != '';},'Os campos abaixo são obrigatórios:'
    );
    
    // Number & Range com virgula como separador decimal.
    $.validator.methods.range = function (value, element, param) {
    	var globalizedValue = value.replace(",", ".");
    	return this.optional(element) || (globalizedValue >= param[0] && globalizedValue <= param[1]);
    };
    
    $.validator.methods.number = function (value, element) {
    	return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:[\s\.,]\d{3})+)(?:[\.,]\d+)?$/.test(value);
    };
    
	$("form").validate({
		submitHandler: function(f) {
			if( f.action.indexOf("/exportar") == -1 ) {
				bomweb.showLoading();
	        	$('form input[type=submit]').attr('disabled', 'disabled');
	        	$('form input[type=reset]').attr('disabled', 'disabled');
	        	$("#btnCancelar").attr('disabled', 'disabled');
	        	$("#btnFinalizar").attr('disabled', 'disabled');
			}
        	f.submit();
		},
		groups: {
		    piso: "entity.linhaVigente.piso1AB entity.linhaVigente.piso2AB entity.linhaVigente.piso1BA entity.linhaVigente.piso2BA",
		    picoAB: "entity.linhaVigente.duracaoViagemPicoAB entity.linhaVigente.picoInicioManhaAB entity.linhaVigente.picoFimManhaAB entity.linhaVigente.duracaoViagemForaPicoAB entity.linhaVigente.picoInicioTardeAB entity.linhaVigente.picoFimTardeAB",
		    picoBA: "entity.linhaVigente.duracaoViagemPicoBA entity.linhaVigente.picoInicioManhaBA entity.linhaVigente.picoFimManhaBA entity.linhaVigente.duracaoViagemForaPicoBA entity.linhaVigente.picoInicioTardeBA entity.linhaVigente.picoFimTardeBA"
		},
		errorPlacement: function(error, element) {
			if (element.attr("name") == "entity.linhaVigente.piso1AB"
                || element.attr("name") == "entity.linhaVigente.piso2AB"
                || element.attr("name") == "entity.linhaVigente.piso1BA"
                || element.attr("name") == "entity.linhaVigente.piso2BA")
			{
				error.insertAfter("#erroPiso");
			}
		    else
		    {
				if (element.attr("name") == "entity.linhaVigente.duracaoViagemPicoAB"
	                || element.attr("name") == "entity.linhaVigente.picoInicioManhaAB"
	                || element.attr("name") == "entity.linhaVigente.picoFimManhaAB"
	                || element.attr("name") == "entity.linhaVigente.duracaoViagemForaPicoAB"
	                || element.attr("name") == "entity.linhaVigente.picoInicioTardeAB"
	    	        || element.attr("name") == "entity.linhaVigente.picoFimTardeAB")
				{
					error.insertBefore("#legendPicoAB");
				}
				else
				{
					if (element.attr("name") == "entity.linhaVigente.duracaoViagemPicoBA"
		                || element.attr("name") == "entity.linhaVigente.picoInicioManhaBA"
		                || element.attr("name") == "entity.linhaVigente.picoFimManhaBA"
		                || element.attr("name") == "entity.linhaVigente.duracaoViagemForaPicoBA"
		                || element.attr("name") == "entity.linhaVigente.picoInicioTardeBA"
		    	        || element.attr("name") == "entity.linhaVigente.picoFimTardeBA")
					{
						error.insertBefore("#legendPicoBA");
					}
					else
						error.insertAfter(element);
				}	
		    }
		      
		}
	});

	// ajaxImageLoad
	$('img.loading').hide();
	$('img.loading').ajaxStart(function() {
		$(this).show();
	});
	$('img.loading').ajaxStop(function() {
		$(this).hide();
	});

	// Exibe (caso possivel) a juncao dos pontos Inicial e Final e as extensões no form de linha
	var url = $(location).attr('href');
	if( url.indexOf('linha/insert') != -1 || url.indexOf('linha/edit') != -1 ) {
		geraNomeLinha();
		atualizaSomaPisos("#piso1AB", "#piso2AB", "#totalPisoAB", "Extensão A-B:");
		atualizaSomaPisos("#piso1BA", "#piso2BA", "#totalPisoBA", "Extensão B-A:");
	}
	
	var maiorLabel = 0;
	$("#form > fieldset > p > label").each(function(index) {
		if( maiorLabel < $(this).width() ) {
			maiorLabel = $(this).width();
		}
	});
	maiorLabel += 5;
	$("#form > fieldset > p > label").css("width", maiorLabel);
	$("#tdPisos").css("width", maiorLabel);
	$("#divEmpresaUsuario > p > label").css("width", maiorLabel);
	
	maiorLabel = 0;
	$("#formPesquisa > fieldset > p > label").each(function(index) {
		if( maiorLabel < $(this).width() ) {
			maiorLabel = $(this).width();
		}
	});
	maiorLabel += 5;
	$("#formPesquisa > fieldset > p > label").css("width", maiorLabel);
	
});

var bomweb = {
		
	config: {
	},	
		
	init: function(config) {
		this.setDatePickerPortuguesBrasil();
		this.setAllClickBinds();
		this.setAllChangeBinds();
		this.setAllBlurBinds();
		this.setPermissoes();		
	},
	
	showLoading: function() {
    	$.loading.classname = 'loadMsg';
    	$.loading({ text: 'Aguarde...', mask:'true', align:'center', delay:'1000' });
	},
	
	hideLoading: function() {
		$.loading(false);
    	$('form input[type=submit]').removeAttr('disabled');
    	$('form input[type=reset]').removeAttr('disabled');
    	$("#btnCancelar").removeAttr('disabled');
    	$("#btnFinalizar").removeAttr('disabled');
    	
	},
	
	clearForm: function() {
		$(':input')
		.not(':button, :submit, :reset, :hidden')
		.val('')
		.removeAttr('checked')
		.removeAttr('selected');
	},
	
	openModalPanel: function(url, width, height) {
		$.get(url, function(data) {
			bomweb.openModalPanelWithData($(data).find("#result").html(), width, height);
		});
	},
	
	openModalPanelWithData: function(data, width, height) {
		bomweb.openModalWithEffect({
			data: data,
			width: width,
			height: height
		});
	},
	
	openModalPanelMessages: function() {
		bomweb.openModalDefaultPanel({
			modalId: "#messages",
			width: 50,
			height: 50
		});
	},
	openModalDefaultPanel: function(options) {
		var options = jQuery.extend({
			modalId: "#modalView", 
			callBackOnOpenFunction: function() {},
			callBackOnCloseFunction: function() {},
			data: "",
			width: 100,
			height: 100
	    },
	    options);		
		if( options.data != "" ) {
			$(options.modalId).html(options.data);
		}
		$(options.modalId).modal({
			minWidth: options.width,
			maxWidth: options.width,
			minHeight: options.height,
			maxHeight: options.height
		});
	},
	openModalWithEffect: function(options) {
		var options = jQuery.extend({
			modalId: "#modalView",
			callBackOnOpenFunction: function() {},
			callBackOnCloseFunction: function() {},
			data: "",
			width: 100,
			height: 100
	    },
	    options);
		if( options.data != "" ) {
			$(options.modalId).html(options.data);
		}
		$(options.modalId).modal({
			minWidth: options.width,
			maxWidth: options.width,
			minHeight: options.height,
			maxHeight: options.height,
			onOpen: function (dialog) {
				options.callBackOnOpenFunction();
				dialog.overlay.fadeIn('fast', function () {
					dialog.container.fadeIn('fast', function () {
						dialog.data.show();
					});
				});
			},
			onClose: function (dialog) {
				options.callBackOnCloseFunction();
				dialog.data.fadeOut('fast', function () {
					dialog.container.hide('fast', function () {
						dialog.overlay.fadeOut('fast', function () {
							$.modal.close();
						});
					});
				});
			}
		});
	},
	
	updateSelect: function (select, url, params, attributeForSelectId, attributeForSelectName) {
		$.getJSON(url, {
			parentId : params
		}, function(data) {
			select.loadSelect(data, attributeForSelectId, attributeForSelectName);
		});
	},
	
	updateMultiSelect: function (parentSelect, childSelect, url, attributeForSelectId, attributeForSelectName) {
		if (parentSelect.val() == null || parentSelect.val().length == 0) {
	    	childSelect.emptySelect();
	    	childSelect.multiselect("disable");
	    } else {
	    	childSelect.multiselect("enable");
	    	$.getJSON(url, {
	            parentId : parentSelect.val()
	        }, function(data) {
	        	childSelect.loadSelectSemLabel(data, attributeForSelectId, attributeForSelectName);
	        	childSelect.multiselect("refresh");
	        });
	    }
	},
	
	updateChildSelect: function (parentInput, childSelect, url, attributeForSelectId, attributeForSelectName) {
	    if (parentInput.val().length == 0) {
	    	childSelect.attr("disabled", true);
	    	childSelect.emptySelect();
	    } else {
	    	childSelect.attr("disabled", false);
	    	$.getJSON(url, {
	            parentId : parentInput.val()
	        }, function(data) {
	        	childSelect.loadSelect(data, attributeForSelectId, attributeForSelectName);
	        });
	    }
	},
	
	setDatePickerPortuguesBrasil: function() {
		// jQuery 1.5 + jQuery Validation
		$.ajaxSettings.cache = false;
		$.ajaxSettings.jsonp = undefined;
		$.ajaxSettings.jsonpCallback = undefined;
		
		// Datepicker
		$.datepicker.regional['pt-BR'] = {
			closeText: 'Fechar',
			prevText: '&#x3c;Anterior',
			nextText: 'Pr&oacute;ximo&#x3e;',
			currentText: 'Hoje',
			monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho', 'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun', 'Jul','Ago','Set','Out','Nov','Dez'],
			dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
			dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],
			weekHeader: 'Sm',
			dateFormat: 'dd/mm/yy',
			firstDay: 0,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''
		};
		
		$.datepicker.setDefaults($.datepicker.regional['pt-BR']);
	},
	
	setAllClickBinds: function() {
	
		// Adicionar Seção da Linha
		$("#addSecao").click(function(e) {
			
			var index = $('#tb_secoes tbody tr').length;
			$('#tb_secoes > tbody:last')
			.append("<tr>"+ 
						"<td><input type=\"checkbox\" name=\"remove\" /></td>" +
						"<td>" +
							"<input type=\"hidden\" name=\"secoes[" + index + "].id\" value=\"\" />" +
							"<input type=\"text\" id=\"codigo" + index + "\" name=\"secoes[" + index + "].codigo\" value=\"\" class=\"required\" size=\"2\" maxlength=\"2\" minlength=\"2\" number=\"true\" />"+
						"</td>" +
						"<td><input type=\"text\" name=\"secoes[" + index + "].pontoInicial\" value=\"\" class=\"required\" size=\"25\" maxlength=\"25\" minlength=\"2\" /></td>" +
						"<td><input type=\"text\" name=\"secoes[" + index + "].pontoFinal\" value=\"\" class=\"required\" size=\"25\" maxlength=\"25\" minlength=\"2\" /></td>" +
					"</tr>");
		});
		
		// Remover Seção da Linha
		$('#rmSecao').click(function () {		
			if( $('input[name="remove"]:checked').length > 0 ) {
				confirm('Deseja realmente excluir essas seções?', function () {
					$('#tb_secoes tbody tr').each(function(n) {
						if( $(this).find('input[name="remove"]').is(':checked') ) {
							$(this).remove();
						};
					});
					
					window.setTimeout(function() {bomweb.openModalDefaultPanel({data: "<div class='white_content_header'><img src='../../images/ico_modal_alert.png' align='absmiddle'> Alerta</div>"
						+ "<div class='white_content_content'><ul><li class='liModal'>As alterações só terão efeito após clicar no botão salvar no final do formulário.</li></ul><br/></div>"
						+ "<div class='white_content_footer'><input type='button' value='Fechar' class='simplemodal-close'></div>"  });}, 250);
				});
				
				bomweb.openModalDefaultPanel({data: "<div class='white_content_header'><img src='../../images/ico_modal_alert.png' align='absmiddle'> Alerta</div>"
					+ "<div class='white_content_content'><ul><li class='liModal'>As alterações só terão efeito após clicar no botão salvar no final do formulário.</li></ul><br/></div>"
					+ "<div class='white_content_footer'><input type='button' value='Fechar' class='simplemodal-close'></div>" 	});
				
			} else {
				var html = "<div class='white_content_header'><img src='../../images/ico_modal_error.png' align='absmiddle'> Erro</div>"
					+ "<div class='white_content_content'><ul><li class='liModal'>Por favor, selecione ao menos uma seção.</li></ul><br/></div>"
					+ "<div class='white_content_footer'><input type='button' value='Fechar' class='simplemodal-close'></div>";
				bomweb.openModalDefaultPanel({data: html});
			}
		});
			
		function confirm(message, callback) {
			$('#confirm').modal({
				onShow: function (dialog) {
					//var modal = this;

					$('.message', dialog.data[0]).append(message);

					// if the user clicks "yes"
					$('.yes', dialog.data[0]).click(function () {
						// call the callback
						if ($.isFunction(callback)) {
							callback.apply();
						}
					});
				}
			});
		}
		
		// Modal 
		$('.link_modal_view').click(function (e) {
			e.preventDefault();
			var width 	= $(this).data('width');
			var height 	= $(this).data('height');
			bomweb.openModalPanel($(this).attr('href'), width, height);
			return false;
		});
		
		// Exportar
		$("#linkExport").click(function(e) {
			e.preventDefault();
			changeAction("#formPesquisa", $(this).attr('href'));
		});
		
		$("#linkExportSecao").click(function(e) {
			e.preventDefault();
			changeAction("#formPesquisa", $(this).attr('href'));
		});
		
		$("#linkExportPendentes").click(function(e) {
			e.preventDefault();
			changeAction("#formPesquisa", $(this).attr('href'));
		});
		
		$("#linkExportBOM").click(function(e) {
			e.preventDefault();
			changeAction("#formBom", $(this).attr('href'));
		});
		
		$("#linkListLinhasRecriarBOM").click(function(e) {
			e.preventDefault();
			changeAction("#formBom", $(this).attr('href'));
		});
		
		$("#linkExportRelatorio").click(function(e) {
			e.preventDefault();
			changeAction("#form", $(this).attr('href'));
		});
		
		// Importar
		$("#uploadBOM").click(function(e) {
			e.preventDefault();
			changeAction("#formBom", $(this).attr('href'));
		});
		
		$('.upLoadTarifa').click(function () {
			if(!($('#dataInicioVigencia').val() == '' ||  $('#file').val() == '')){
				confirm('As tarifas futuras serão substituídas ao realizar esta importação. Deseja Confirmar?', 
						function () {
							$('#formUpLoad').submit();						
						});

			}else{
				var html = "<div class='white_content_header'><img src='../images/ico_modal_error.png' align='absmiddle'> Erro</div>"
					+ "<div class='white_content_content'><ul><li class='liModal'>Por favor, Preencha todos os Campos do Formulário.</li></ul><br/></div>"
					+ "<div class='white_content_footer'><input type='button' value='Fechar' class='simplemodal-close'></div>";
				bomweb.openModalDefaultPanel({data: html});
			}
		});
		
		
		
		
		
		
		
		// Cancelar
		$("#btnCancelar").show();
		$("#btnCancelar").click(function(e) {
			e.preventDefault();
			var paginas = ["/insert", "/edit", "/formUpload"];
			var url = $(location).attr('href');
			var urlRetorno = $(this).data("urlRetorno");
			
			if(urlRetorno != null) {
				if(isNaN(urlRetorno)) {
					$(location).attr('href', urlRetorno);
				}
				else {
					history.go(urlRetorno);
				}
			}
			else {
				for(i=0; i < paginas.length; i++) {
					if( url.indexOf(paginas[i]) != -1 ) {
						url = url.substring(0, url.lastIndexOf(paginas[i]));
						break;
					}
				}
				url = url + "/list";
				$(location).attr('href', url);
			}
		});
		
		// Finalizar
		$("#btnFinalizar").show();
		$("#btnFinalizar").click(function(e) {
			e.preventDefault();
			var paginas = ["/insert", "/edit", "/formUpload"];
			var url = $(location).attr('href');
			var urlRetorno = $(this).data("urlRetorno");
			
			if(urlRetorno != null) {
				if(isNaN(urlRetorno)) {
					$(location).attr('href', urlRetorno);
				}
				else {
					history.go(urlRetorno);
				}
			}
			else {
				for(i=0; i < paginas.length; i++) {
					if( url.indexOf(paginas[i]) != -1 ) {
						url = url.substring(0, url.lastIndexOf(paginas[i]));
						break;
					}
				}
				url = url + "/list";
				$(location).attr('href', url);
			}
		});
		
		// Reset
		$(".reset").show();
		$(".reset").click(function(e) {
			e.preventDefault();
			bomweb.clearForm();
			$("#pNomeLinha").hide();
		});
		
		$(".resetRelatorio").show();
		
		// Fechar Bom
		$("#fecharBomInterno").click(function(e) {
			bomweb.showLoading();
		});
		
		// Check All BomLinha
		$("#checkAllBomLinhas").click(function(e) {
			$(".tablesorter").tablesorter({ 
		        headers: {
		            0: { 
		                sorter: false 
		            }
		        } 
		    });
			if( $(this).is(":checked") ) {
				$("#index").val("-1");
				$("#justificativa").val("");
				bomweb.openModalDefaultPanel({
					callBackOnCloseFunction: function() {
						if( $("#index").val() == -1 ) {
							$("#checkAllBomLinhas").attr("checked", false);
							$('.checkBomLinha').each(function(n) {
								$(this).attr("checked", false);
							});
						} else {
							$("#checkBomLinha" + $("#index").val()).attr("checked", false);
						}
					}
				});
			}
			var checkValue = $(this).is(':checked');
			$('.checkBomLinha').each(function(n) {
				$(this).attr("checked", checkValue);
			});
		});
		
		$(".checkBomLinha").click(function(e) {
			if( $(this).is(":checked") ) {
				$("#index").val( $(this).data("index") );
				$("#justificativa").val("");
				bomweb.openModalDefaultPanel({
					callBackOnCloseFunction: function() {
						if( !$("#salvo").is(":checked") ) {
							if( $("#index").val() == -1 ) {
								$('.checkBomLinha').each(function(n) {
									$(this).attr("checked", false);
								});
							} else {
								$("#checkBomLinha" + $("#index").val()).attr("checked", false);
							}
						}
					}
				});
			}
		});
		
		$(".justificativaBomLinha").click(function(e) {
			var index = $(this).data("index");
			$("#justificativa").val($("#justificativa" + index).val());
			bomweb.openModalDefaultPanel();
		});
		
		$(".justificativas").click(function(e) {
			var index = $(this).data("index");
			$("#justificativa").val($("#justificativa" + index).val());
			e.preventDefault();
			var width 	= 400;
			var height 	= 200;
			bomweb.openModalPanel($(this).attr('href'), width, height);
			
		});
		
		$("#btnSalvarJustificaBomLinha").click(function(e) {			
            if( $("#justificativa").val() == "" ) {
            	
            	$("#checkBomLinha"+ $("#index").val()).attr("checked", false);
            	$("#checkAllBomLinhas").attr("checked", false);
               
            	bomweb.openModalPanelWithData(
                		"<div class='white_content_header'><img src='../../images/ico_modal_alert.png' align='absmiddle'> Alerta</div>"
    					+ "<div class='white_content_content'><ul><li class='liModal'>Por favor, informe uma justificativa.</li></ul><br/></div>"
    					+ "<div class='white_content_footer'><input type='button' value='Fechar' onclick='javascript:fechaModalPanel()'class='simplemodal-close'></div>");
            } else {
                if( $("#index").val() == -1 ) {
                    $('.justificativa').each(function(n) {
                        $(this).val( $("#justificativa").val() );
                    });
                } else {
                    $("#justificativa" + $("#index").val()).val( $("#justificativa").val() );
                }
                $("#salvo").attr("checked", true);
                $.modal.close();
                $("#salvo").attr("checked", false);
            }
        });

		$(".accordion").click(function(e) {
			e.preventDefault();
			var texto = $(this).text();
			if(texto == "[ Ocultar Filtro ]") {
				$(this).text("[ Exibir Filtro ]");
			} else {
				$(this).text("[ Ocultar Filtro ]");
			}
			$("#filtro").slideToggle('fast');
		});
		
	},
	
	setAllChangeBinds: function() {
	//	parentSelect, childSelect, url, attributeForSelectId, attributeForSelectName
	
		$("#selectEmpresaListTarifa").change(function() {
			bomweb.updateChildSelect($(this), $("#selectLinhaListTarifa"), pathName + "/tarifa/buscaLinhas.json", "id", ["codigo", "pontoInicial", "pontoFinal"]);
			$("#secao").attr("disabled", true);
			$("#secao").emptySelect();
		});
		
		$("#selectEmpresaFormTarifa").change(function() {
			bomweb.updateChildSelect($(this), $("#selectLinhaFormTarifa"), pathName + "/tarifa/buscaLinhasSemTarifa.json", "id", ["codigo", "pontoInicial", "pontoFinal"]);
			$("#secao").attr("disabled", true);
			$("#secao").emptySelect();
		});
		
		$("#selectLinhaListTarifa").change(function() {
			bomweb.updateChildSelect($(this), $("#secao"), pathName + "/tarifa/buscaSecoes.json", "id", ["codigo", "juncao"]);
		});
		
		$("#selectLinhaFormTarifa").change(function() {
			bomweb.updateChildSelect($(this), $("#secao"), pathName + "/tarifa/buscaSecoesSemTarifa.json", "id", ["codigo", "juncao"]);
		});
		
		$("#perfilUsuario").change(function() {
			var $comboPerfil = $(this);
			$("label[class='error']").hide();
			if( $comboPerfil.val() == 2 ) {
				$("#divEmpresaUsuario").show();
				$("#empresaUsuario").addClass("required");
				$("#nomeUsuario").attr("readonly", true);
				$("#loginUsuario").attr("readonly", true);
				//TODO substitur por uma função que limpe tudpo
				$("#empresaUsuario").val("");
				$("#nomeUsuario").val("");
				$("#loginUsuario").val("");	
			} else {
				$("#empresaUsuario").removeClass("required");
				$("#divEmpresaUsuario").hide();
				$("#nomeUsuario").attr("readonly", false);
				$("#loginUsuario").attr("readonly", false);

				//TODO substitur por uma função que limpe tudo
				$("#nomeUsuario").val("");
				$("#loginUsuario").val("");
			}
		});
		
		$("#linhaPontoInicial").change(geraNomeLinha);
		$("#linhaPontoFinal").change(geraNomeLinha);
	},
	
	setAllBlurBinds: function() {
		
		$("#piso1AB").blur(function() { 
			atualizaSomaPisos("#piso1AB", "#piso2AB", "#totalPisoAB", "Extensão A-B:");
		});
		
		$("#piso2AB").blur(function() { 
			atualizaSomaPisos("#piso1AB", "#piso2AB", "#totalPisoAB", "Extensão A-B:");
		});
		
		$("#piso1BA").blur(function() { 
			atualizaSomaPisos("#piso1BA", "#piso2BA", "#totalPisoBA", "Extensão B-A:");
		});
		
		$("#piso2BA").blur(function() { 
			atualizaSomaPisos("#piso1BA", "#piso2BA", "#totalPisoBA", "Extensão B-A:");
		});		
	},
	
	setPermissoes: function(){
		
		$("#btn_submit_perfil").hide();
		
		$("#perfil").change(function() {
			
			var url = $(location).attr('href');
			
			if( url.indexOf('list/') != -1 ) {
				url = url.substring(0, url.lastIndexOf('/'));
			}

			if($(this).val()!=""){	
				url = url + "/" + $(this).val();
			}
			$(location).attr('href', url);
			
		});
		
		$("#tree").treeview({
			collapsed: true,
			animated: "fast",
			control:"#sidetreecontrol",
			prerendered: true,
			persist: "location"
		});
		
	}
};

$.fn.emptySelect = function() {
	return this.each(function() {
		if (this.tagName=='SELECT') this.options.length = 0;
	});
};

$.fn.loadSelect = function(data, attributeForSelectId, attributeForSelectName) {
	return this.emptySelect().each(function() {
		if (this.tagName=='SELECT') {
			var selectElement = this;
			var option = new Option("Selecione", "", true);
			if ($.browser.msie) {
				selectElement.add(option); 
			} else {
				selectElement.add(option,null);
			}
			
			$.each(data, function(index, optionData) {
				var attrName = '';
				if(attributeForSelectName instanceof Array) {
					attrName = optionData[attributeForSelectName[0]];
					for (i = 1; i < attributeForSelectName.length; i++) {
						attrName = attrName.concat(" - " + optionData[attributeForSelectName[i]]);
					}
				} else {
					attrName = optionData[attributeForSelectName];
				}				
				
				var option = new Option(attrName, optionData[attributeForSelectId]);
				if ($.browser.msie) {
					selectElement.add(option); 
				} else {
					selectElement.add(option,null);
				}
			});
		}
	});
};

$.fn.loadSelectSemLabel = function(data, attributeForSelectId, attributeForSelectName) {
	return this.emptySelect().each(function() {
		if (this.tagName=='SELECT') {
			var selectElement = this;

			$.each(data, function(index, optionData) {
				var attrName = '';
				if(attributeForSelectName instanceof Array) {
					attrName = optionData[attributeForSelectName[0]];
					for (i = 1; i < attributeForSelectName.length; i++) {
						attrName = attrName.concat(" - " + optionData[attributeForSelectName[i]]);
					}
				} else {
					attrName = optionData[attributeForSelectName];
				}
				
				var option = new Option(attrName, optionData[attributeForSelectId]);
				if ($.browser.msie) {
					selectElement.add(option); 
				} else {
					selectElement.add(option,null);
				}
			});
		}
	});
};

function buscaRegistroEmpresa(parentSelect, url) {
	//supondo que vc vai usar a jQuery sujerida
	$.getJSON(url, {parentId : parentSelect.val()},
	function (data)
	{
	// dependendo da forma como vc tratou os dados, aqui vc vai usar algo pra popular os forms
	// como eu optei por json, vai ser algo do tipo
	$("#nomeUsuario").val(data[0].nome);
	$("#loginUsuario").val("emp" + data[0].codigo);
	$("#senhaUsuario").val("emp$" + data[0].codigo);
	});
}

function mensagem(texto) {
	 if (texto.length > 0) {
		 alert(texto);
	 }
}

function refreshPP(checkBox,url) {
	var idP = document.getElementById("perfil");
	$.getJSON(url, { permissaoId : checkBox.value, perfilId : idP.value } );
}

function importar() {
	var fp = document.getElementById("fileupload");
	$.getJSON( url, { urlUpload : fp.value } );
}

function geraNomeLinha() {
	var $pontoInicial = $("#linhaPontoInicial").val();
	var $pontoFinal = $("#linhaPontoFinal").val();
	
	if($pontoInicial != "" && $pontoFinal != "") {
		$("#nomeLinha").text($pontoInicial + " - " + $pontoFinal);
		$("#nomeLinha").attr("style", "display: auto;");
		$("#pNomeLinha").show();
	} else {
		$("#pNomeLinha").hide();
	}
}

function changeAction(formId, newAction) {
	var $form = $(formId);
	var originalAction = $form.attr("action");
	$form.attr("action", newAction).submit();
	$form.attr("action", originalAction);
} 

function getDoubleValue(value) {
	if( value == null || value == "" ) {
		return parseFloat(0);
	} else {
		if( value.indexOf(",") ) {
			value = value.replace(",", ".");
		}
		return parseFloat(value);
	}
}

function atualizaSomaPisos(piso1, piso2, total, texto) {
	var valor = getDoubleValue($(piso1).val()) + getDoubleValue($(piso2).val());
	$(total).text(texto + " " + valor.toFixed(2).replace(".", ","));
}

function isCheckboxMarked() {
	var checked = $('.require-one:checked').size();
	if (checked == null || (checked==0)) {
		return false;
	}
	return true;
}

function isFieldFilled(field) {
    var value = $(field).val();
    if (value == null || (value=='')) {
        return false;
    }
    return true;
}

function isMultiselectFilled(id) {
	var checked = $(id).multiselect("getChecked");
	if (checked == null || (checked.length==0)) {
		return false;
	}
	return true;
}

function fechaModalPanel(){
	$.modal.close();
}

function limpaId(source, idField)
{
	if(source.value == '')
		$("#"+idField).val('');
}

function setNomeUsuario(idEmpresa) {
	var $inputvalue = idEmpresa.value;
	if($inputvalue != "") {
		$("#nomeUsuario").attr("readonly", true);
		$("#loginUsuario").attr("readonly", true);
		buscaRegistroEmpresa(idEmpresa, pathName + "/usuario/buscaEmpresaSelecionada.json");
	} else {
		$("#nomeUsuario").val("").attr("readonly",true);
		$("#loginUsuario").val("");
	}
}