<?php
session_start();
include '../config/conexao.php';

$id = $_POST["id"];
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

$sqlVerProd = "SELECT COUNT(ID) AS Qtd FROM produto WHERE PRODUTO = '".$Produto."' AND EMPRESA = '".$_SESSION["empresa"]."' AND ID = '".$id."'";
$rsVerProd=mysqli_query($conn, $sqlVerProd);
$row=mysqli_fetch_object($rsVerProd);

if ($row->Qtd <= 1){
	$sqlUpdProd = "UPDATE produto ";
	$sqlUpdProd .= "SET PRODUTO='$Produto', DESCRICAO_PRODUTO='$Descricao', APELIDO_PRODUTO='$Apelido', GRUPO_PRODUTO='$GrupoProduto', SUBGRUPO_PRODUTO=$SubGrupoProduto, ";
	$sqlUpdProd .= "PESO_LIQUIDO=$Peso, CLASSIFICACAO_FISCAL='$Classificacao', CODIGO_BARRAS='$CodigoBarra', COLECAO='$Colecao' ";
	$sqlUpdProd .= "WHERE ID = '".$id."'";

	$conn->query($sqlUpdProd);
	echo "1";
}else{
	echo "2";
}
mysqli_free_result($rsVerProd);
mysqli_close($conn);
?>