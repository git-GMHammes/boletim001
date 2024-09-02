$(document).ready(function() {
	bom.init();
});

var bom = {
		
	config: {
	},

	init: function(config) {
		$("#totalizadorBomSecao").show();
		
		$("#tarifaAtual").maskMoney({allowZero:"true", thousands:"", decimal:"," });
		$("#tarifaAnterior").maskMoney({allowZero:"true", thousands:"", decimal:"," });
				
		$("#tarifaAtual").blur(function() { bom.calculaValoresSecao(); bom.calcularValoresLinha(); });
		$("#tarifaAnterior").blur(function() { bom.calculaValoresSecao(); bom.calcularValoresLinha(); });
		
		$("#passageiroAB").blur(function() { bom.calculaValoresSecao(); });
		$("#passageiroBA").blur(function() { bom.calculaValoresSecao(); });
		$("#passageiroAnteriorAB").blur(function() { bom.calculaValoresSecao(); });
		$("#passageiroAnteriorBA").blur(function() { bom.calculaValoresSecao(); });
	
		
		this.calculaValoresSecao();
		
		$("#viagensOrdinariasAB").change(function() { bom.calcularValoresLinha(); });
		$("#viagensOrdinariasBA").change(function() { bom.calcularValoresLinha(); });
		$("#viagensExtraordinariasAB").change(function() { bom.calcularValoresLinha(); });
		$("#viagensExtraordinariasBA").change(function() { bom.calcularValoresLinha(); });
		
		this.calcularValoresLinha();
	},
	
	getIntValue: function(value) {
		valor = 0;
		
		if(value == undefined) return valor;
		
		if( value.indexOf(".") ) {
			value = value.replace(".", "");
		}
		if( !isNaN(parseInt(value)) ) {
			valor += parseInt(value);
		}
		return valor;
	},

	getDoubleValue: function (value) {
		if( value == null || value == "" ) {
			return parseFloat(0);
		} else {
			if( value.indexOf(",") ) {
				value = value.replace(",", ".");
			}
			return parseFloat(value);
		}
	},
	
	// -- Tarifa
	
	tarifaAtual: function() {
		return this.getDoubleValue( $("#tarifaAtual").val() );
	},
	
	tarifaAnterior: function() {
		return this.getDoubleValue( $("#tarifaAnterior").val() );
	},
	
	// -- AB
	
	passageiroAB: function() {
		return this.getIntValue($("#passageiroAB").val());
	},
	
	passageiroAnteriorAB: function() {
		return this.getIntValue($("#passageiroAnteriorAB").val());
	},
		
	totalAB: function() {
		return this.passageiroAB() + this.passageiroAnteriorAB();
	},
	
	
	
	// -- BA
	
	passageiroBA: function() {
		return this.getIntValue($("#passageiroBA").val());
	},
	
	passageiroAnteriorBA: function() {
		return this.getIntValue($("#passageiroAnteriorBA").val());
	},
	
	totalBA: function() {
		return this.passageiroBA() + this.passageiroAnteriorBA();
	},
	
	// -- Totalizadores
	
	totalPassageiro: function() {
		return this.totalAB() + this.totalBA();
	},
	
	totalPassageiroVale: function() {
		return this.totalValeAB() + this.totalValeBA();
	},
	
	totalPassageiroGeral: function() {
		return this.totalPassageiro();
	},
	
	totalValorEspecie: function() {
		return this.tarifaAtual() * (this.passageiroAB() + this.passageiroBA());
	},
	
	totalValorEspecieAnterior: function() {
		return this.tarifaAnterior() * (this.passageiroAnteriorAB() + this.passageiroAnteriorBA());
	},
	
	totalValorVale: function() {
		return this.tarifaAtual() * (this.passageiroValeAB() + this.passageiroValeBA());
	},
	
	totalValorValeAnterior: function() {
		return this.tarifaAnterior() * (this.passageiroValeAnteriorAB() + this.passageiroValeAnteriorBA());
	},
	
	totalGeralValor: function() {
		return this.tarifaAtual() * (this.passageiroAB() + this.passageiroBA());
	},
	
	totalGeralValorAnterior: function() {
		return this.tarifaAnterior() * (this.passageiroAnteriorAB() + this.passageiroAnteriorBA());
	},
	
	calculaValoresSecao: function() {
		$("#totalGeralValor").text(this.totalGeralValor().toFixed(2).replace(".", ","));
		$("#totalGeralValorAnterior").text(this.totalGeralValorAnterior().toFixed(2).replace(".", ","));
		
		$("#totalPassageiro").text(this.totalPassageiro());	
		//$("#totalPassageiro").text($.formatNumber(this.totalPassageiro(), {format:"#,###", locale:"br"}));
	},
	
	// --
	
	extensaoAB: function() {
		return this.getDoubleValue($("#extensaoAB").val());
	},

	extensaoBA: function() {
		return this.getDoubleValue($("#extensaoBA").val());
	},
	
	viagensOrdinariasAB: function() {
		return this.getIntValue($("#viagensOrdinariasAB").val());
	},
	
	viagensOrdinariasBA: function() {
		return this.getIntValue($("#viagensOrdinariasBA").val());
	},
	
	viagensExtraordinariasAB: function() {
		return this.getIntValue($("#viagensExtraordinariasAB").val());
	},
	
	viagensExtraordinariasBA: function() {
		return this.getIntValue($("#viagensExtraordinariasBA").val());
	},
	
	kmPercorridaMensalAB: function() {
		return this.extensaoAB() * ( this.viagensOrdinariasAB() + this.viagensExtraordinariasAB() );
	},
	
	kmPercorridaMensalBA: function() {
		return this.extensaoBA() * ( this.viagensOrdinariasBA() + this.viagensExtraordinariasBA() );
	},
	
	totalKm: function() {
		return this.extensaoAB() + this.extensaoBA();
	},
	
	totalViagensOrdinarias: function() {
		return this.viagensOrdinariasAB() + this.viagensOrdinariasBA();
	},
	
	totalViagensExtraordinarias: function() {
		return this.viagensExtraordinariasAB() + this.viagensExtraordinariasBA();
	},
	
	totalKmPercorridaMensal: function() {
		return this.kmPercorridaMensalAB() + this.kmPercorridaMensalBA();
	},
	
	calcularValoresLinha: function() 
	{
		//FBW-74 - Comentado até termos uma solução de layout que não induza ao erro nas contas
		//$("#kmPercorridaMensalAB").text(this.kmPercorridaMensalAB().toFixed(2).replace(".", ","));
		//$("#kmPercorridaMensalBA").text(this.kmPercorridaMensalBA().toFixed(2).replace(".", ","));
		//$("#totalExtensaoKM").text(this.totalKm().toFixed(2).replace(".", ","));
		//$("#totalViagensOrdinarias").text(this.totalViagensOrdinarias().toFixed(0));
		//$("#totalViagensExtraordinarias").text(this.totalViagensExtraordinarias().toFixed(0));
		$("#totalKmPercorridaMensal").text(this.totalKmPercorridaMensal().toFixed(2).replace(".", ","));
	},

};