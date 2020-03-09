//Robson Pratti Gonçalves
function fncEmpresaSelecionada(sVl){
	$.post("/acao/seleciona-empresa.php", { emp: sVl }, function (data) {
		location.href = "/lista-produtos.php"
	})
}
function fncAlterarProduto(id){
	location.href='/alterar-produtos.php?id='+id
}
function fncExcluirProduto(id,Produto) {
	if(confirm("Deseja excluir este produto?\n"+Produto)){
		$.post("/acao/excluir-produtos.php", { id: id }, function (data) {
			location.href = "/lista-produtos.php"
		})
	}
}
function fncPaginacao(pg, iQtdRegPorPagina, iTotalReg){
	var sGrpProd = $.trim($("#cboGrupoProduto").val());
	var sTpComp = $.trim($("#cboTpComp").val());
	var sCodigo = $.trim($("#txtCodigo").val());
	var sApelido = $.trim($("#txtApelido").val());
	var sDescricao = $.trim($("#txtDescricao").val());
	var sOrdem = $.trim($("#hddOrdem").val());
	$.post("acao/busca-produtos.php", { grpProd: sGrpProd, tpComp: sTpComp, codigo: sCodigo, apelido: sApelido, descricao: sDescricao, ordem: sOrdem, pg: pg }, function (data) {
		$("#ListaProdutos").html(data);
		$.post("acao/paginacao-produtos.php", { pg: pg, TotalReg: iTotalReg, QtdRegPorPagina: iQtdRegPorPagina}, function (data1) {
			$("#RodapeListaProdutos").html(data1)
		})
	})
}

$(document).ready(function () {
	$("#btnNovoProd").click(function () {
		location.href = '/cadastrar-produtos.php'
	})
	$("#btnBuscar").click(function () {
		var sGrpProd = $.trim($("#cboGrupoProduto").val());
		var sTpComp = $.trim($("#cboTpComp").val());
		var sCodigo = $.trim($("#txtCodigo").val());
		var sApelido = $.trim($("#txtApelido").val());
		var sDescricao = $.trim($("#txtDescricao").val());
		$.post("acao/busca-produtos.php", { grpProd: sGrpProd, tpComp: sTpComp, codigo: sCodigo, apelido: sApelido, descricao: sDescricao, ordem: '2 ASC', pg: 1 }, function (data) {
			var aDados = data.split("|");
			$("#ListaProdutos").html(aDados[0]);
			var iQtdRegPorPagina = $.trim($("#hddQtdRegPorPagina").val());
			var iTotalReg = aDados[1];
			fncPaginacao(1, iQtdRegPorPagina, iTotalReg)
		})
	})
	$("#btnCadProduto").click(function () {
		var frm = $('form');
		if (frm[0].checkValidity()) {
			var sProduto = $("#txtProduto").val();
			var sApelido = $("#txtApelido").val();
			var sDescricao = $("#txtDescricao").val();
			var iGrupoProduto = $("#cboGrupoProduto").val();
			var iProduto = $("#cboSubGrupoProduto").val();
			var sPeso = $("#txtPeso").val();
			var sClassificacao = $("#txtClassificacao").val();
			var sCodigoBarra = $("#txtCodigoBarra").val();
			var sColecao = $("#txtColecao").val();
			$.post("acao/cadastra-produtos.php", { txtProduto: sProduto, txtApelido: sApelido, txtDescricao: sDescricao, cboGrupoProduto: iGrupoProduto, cboSubGrupoProduto: iProduto, txtPeso: sPeso, txtClassificacao: sClassificacao, txtCodigoBarra: sCodigoBarra, txtColecao: sColecao }, function (data) {
				if (data == "1") {
					alert("Cadastro efetuado com sucesso!");
					location.href = '/lista-produtos.php'
				} else {
					alert(data)
				}
			})
		}
	})
	$("#btnEdtProduto").click(function () {
		var frm = $('form');
		if (frm[0].checkValidity()) {
			var iId = $("#hddId").val();
			var sProduto = $("#txtProduto").val();
			var sApelido = $("#txtApelido").val();
			var sDescricao = $("#txtDescricao").val();
			var iGrupoProduto = $("#cboGrupoProduto").val();
			var iProduto = $("#cboSubGrupoProduto").val();
			var sPeso = $("#txtPeso").val();
			var sClassificacao = $("#txtClassificacao").val();
			var sCodigoBarra = $("#txtCodigoBarra").val();
			var sColecao = $("#txtColecao").val();
			$.post("acao/editar-produtos.php", { id: iId, txtProduto: sProduto, txtApelido: sApelido, txtDescricao: sDescricao, cboGrupoProduto: iGrupoProduto, cboSubGrupoProduto: iProduto, txtPeso: sPeso, txtClassificacao: sClassificacao, txtCodigoBarra: sCodigoBarra, txtColecao: sColecao }, function (data) {
				if (data == "1") {
					alert("Alteração efetuada com sucesso!");
					location.href = '/lista-produtos.php'
				} else {
					alert(data)
				}
			})
		}
	})
	$("#btnVoltar").click(function () {
		location.href = '/lista-produtos.php';
	})
})
function fncOrdenar(col, qtdCol){
	var sGrpProd = $.trim($("#cboGrupoProduto").val());
	var sTpComp = $.trim($("#cboTpComp").val());
	var sCodigo = $.trim($("#txtCodigo").val());
	var sApelido = $.trim($("#txtApelido").val());
	var sDescricao = $.trim($("#txtDescricao").val());
	if ($("#hddOrdem").val() != col) {
		var aOrdem = col.split(" ");
		for (var i = 1; i <= qtdCol; i++) {
			if (aOrdem[0] == i) {
				if ($.trim(aOrdem[1]) == "ASC") {
					$("#ord" + aOrdem[0]).attr("onclick", "fncOrdenar('" + aOrdem[0] + " DESC', " + qtdCol + ")");
				} else {
					$("#ord" + aOrdem[0]).attr("onclick", "fncOrdenar('" + aOrdem[0] + " ASC', " + qtdCol + ")");
				}
				$("#hddOrdem").val(col);
			} else {
				$("#ord" + i).attr("onclick", "fncOrdenar('" + i + " ASC', " + qtdCol + ")");
			}
		}
	}
	$.post("acao/busca-produtos.php", { grpProd: sGrpProd, tpComp: sTpComp, codigo: sCodigo, apelido: sApelido, descricao: sDescricao, ordem: col, pg: 1 }, function (data) {
		var aDados = data.split("|");
		$("#ListaProdutos").html(aDados[0]);
		var iQtdRegPorPagina = $.trim($("#hddQtdRegPorPagina").val());
		var iTotalReg = aDados[1];
		fncPaginacao(1, iQtdRegPorPagina, iTotalReg)
	})
}