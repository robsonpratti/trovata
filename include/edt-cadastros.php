<?php
function fncGrupo($conn, $id)
{
	$cbo="";
	$cbo.="<select name='cboGrupoProduto' id='cboGrupoProduto' required>";
	$cbo.="	<option value=''>Escolha o grupo do produto</option>";
	$sqlCboGrpProd = "SELECT 
						GRUPO_PRODUTO, DESCRICAO_GRUPO_PRODUTO 
					FROM 
						grupo_produto 
					WHERE 
						EMPRESA = ".$_SESSION["empresa"]."
					ORDER BY DESCRICAO_GRUPO_PRODUTO ASC";
	$rsCboGrpProd=mysqli_query($conn, $sqlCboGrpProd);
	while($row=mysqli_fetch_object($rsCboGrpProd)){
		if ($id==$row->GRUPO_PRODUTO){
			$cbo.="<option value='". $row->GRUPO_PRODUTO."' selected>".utf8_decode($row->DESCRICAO_GRUPO_PRODUTO)."</option>";
		}else{
			$cbo.="<option value='". $row->GRUPO_PRODUTO."'>".utf8_decode($row->DESCRICAO_GRUPO_PRODUTO)."</option>";
		}
	}
	mysqli_free_result($rsCboGrpProd);
	$cbo.="</select>";
	
	echo $cbo;
}

function fncSubGrupo($conn, $id)
{
	$cbo="";
	$cbo.="<select name='cboSubGrupoProduto' id='cboSubGrupoProduto'>";
	if(strlen($id)==0){
		$cbo.="	<option value='' selected>Escolha o subgrupo do produto</option>";
	}else{
		$cbo.="	<option value=''>Escolha o subgrupo do produto</option>";
	}
	$sqlCboGrpProd = "SELECT 
						GRUPO_PRODUTO, DESCRICAO_GRUPO_PRODUTO 
					FROM 
						grupo_produto 
					WHERE 
						EMPRESA = ".$_SESSION["empresa"]."
					ORDER BY DESCRICAO_GRUPO_PRODUTO ASC";
	$rsCboGrpProd=mysqli_query($conn, $sqlCboGrpProd);
	while($row=mysqli_fetch_object($rsCboGrpProd)){
		if ($id==$row->GRUPO_PRODUTO){
			$cbo.="<option value='". $row->GRUPO_PRODUTO."' selected>".utf8_decode($row->DESCRICAO_GRUPO_PRODUTO)."</option>";
		}else{
			$cbo.="<option value='". $row->GRUPO_PRODUTO."'>".utf8_decode($row->DESCRICAO_GRUPO_PRODUTO)."</option>";
		}
	}
	mysqli_free_result($rsCboGrpProd);
	$cbo.="</select>";
	echo $cbo;
}
?>