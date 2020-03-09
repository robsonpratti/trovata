<?php
session_start();
include '../config/conexao.php';

$Produto = $_POST["txtProduto"];
$Apelido = $_POST["txtApelido"];
$Descricao = $_POST["txtDescricao"];
$GrupoProduto = $_POST["cboGrupoProduto"];
$SubGrupoProduto = $_POST["cboSubGrupoProduto"];
if (strlen($SubGrupoProduto) == 0){$SubGrupoProduto = 1;}
$Peso = $_POST["txtPeso"];
if (strlen($Peso) == 0){$Peso = 0;}
$Classificacao = $_POST["txtClassificacao"];
if (strlen($Classificacao) == 0){$Classificacao = '';}
$CodigoBarra = $_POST["txtCodigoBarra"];
if (strlen($CodigoBarra) == 0){$CodigoBarra = '';}
$Colecao = $_POST["txtColecao"];
if (strlen($Colecao) == 0){$Colecao = '';}

$sqlVerProd = "SELECT COUNT(ID) AS Qtd FROM produto WHERE PRODUTO = '".$Produto."' AND EMPRESA = '".$_SESSION["empresa"]."'";
$rsVerProd=mysqli_query($conn, $sqlVerProd);
$row=mysqli_fetch_object($rsVerProd);
if ($row->Qtd == 0){
	$sqlInsProd = "INSERT INTO produto ";
	$sqlInsProd .= "(PRODUTO, DESCRICAO_PRODUTO, APELIDO_PRODUTO, GRUPO_PRODUTO, SUBGRUPO_PRODUTO, SITUACAO, PESO_LIQUIDO, CLASSIFICACAO_FISCAL, CODIGO_BARRAS, COLECAO, EMPRESA)";
	$sqlInsProd .= "VALUES";
	$sqlInsProd .= "('$Produto', '$Descricao', '$Apelido', '$GrupoProduto', $SubGrupoProduto, 'S', $Peso, '$Classificacao', '$CodigoBarra', '$Colecao', '".$_SESSION["empresa"]."')";
	
	$conn->query($sqlInsProd);
	echo "1";
}else{
	echo "2";
}
mysqli_free_result($rsVerProd);
mysqli_close($conn);
?>