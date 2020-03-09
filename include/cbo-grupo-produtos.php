<select name="cboGrupoProduto" id="cboGrupoProduto">
    <option value="" selected>Escolha o grupo do produto</option>
    <?php
    $sqlCboGrpProd = "SELECT 
							GRUPO_PRODUTO, DESCRICAO_GRUPO_PRODUTO 
						FROM 
							grupo_produto 
						WHERE 
							EMPRESA = ".$_SESSION["empresa"]."
						ORDER BY DESCRICAO_GRUPO_PRODUTO ASC";
	$rsCboGrpProd=mysqli_query($conn, $sqlCboGrpProd);
	while($row=mysqli_fetch_object($rsCboGrpProd)){
	?>
    <option value="<?php echo $row->GRUPO_PRODUTO;?>"><?php echo utf8_decode($row->DESCRICAO_GRUPO_PRODUTO);?></option>
    <?php 
	}
	mysqli_free_result($rsCboGrpProd);
	?>
</select>