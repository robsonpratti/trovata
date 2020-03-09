<?php
function fncGrupo($conn)
{
	$cbo="";
	$cbo.="<select name='cboGrupoProduto' id='cboGrupoProduto' required>";
	$cbo.="	<option value='' selected>Escolha o grupo do produto</option>";
	$sqlCboGrpProd = "SELECT 
						GRUPO_PRODUTO, DESCRICAO_GRUPO_PRODUTO 
					FROM 
						grupo_produto 
					WHERE 
						EMPRESA = ".$_SESSION["empresa"]."
					ORDER BY DESCRICAO_GRUPO_PRODUTO ASC";
	$rsCboGrpProd=mysqli_query($conn, $sqlCboGrpProd);
	while($row=mysqli_fetch_object($rsCboGrpProd)){
		$cbo.="<option value='". $row->GRUPO_PRODUTO."'>".utf8_decode($row->DESCRICAO_GRUPO_PRODUTO)."</option>";
	}
	mysqli_free_result($rsCboGrpProd);
	$cbo.="</select>";
	
	echo $cbo;
}

function fncSubGrupo($conn)
{
	$cbo="";
	$cbo.="<select name='cboSubGrupoProduto' id='cboSubGrupoProduto'>";
	$cbo.="	<option value='' selected>Escolha o subgrupo do produto</option>";
	$sqlCboGrpProd = "SELECT 
						GRUPO_PRODUTO, DESCRICAO_GRUPO_PRODUTO 
					FROM 
						grupo_produto 
					WHERE 
						EMPRESA = ".$_SESSION["empresa"]."
					ORDER BY DESCRICAO_GRUPO_PRODUTO ASC";
	$rsCboGrpProd=mysqli_query($conn, $sqlCboGrpProd);
	while($row=mysqli_fetch_object($rsCboGrpProd)){
		$cbo.="<option value='". $row->GRUPO_PRODUTO."'>".utf8_decode($row->DESCRICAO_GRUPO_PRODUTO)."</option>";
	}
	mysqli_free_result($rsCboGrpProd);
	$cbo.="</select>";
	echo $cbo;
}
?>