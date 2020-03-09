<select name="cboEmpresas" id="cboEmpresas" onchange="fncEmpresaSelecionada(this.value)">
    <option value="" selected>Escolha a empresa</option>
    <?php
    $sqlCboEmpresas = "SELECT 
							A.EMPRESA, A.NOME_FANTASIA, B.DESCRICAO_CIDADE 
						FROM 
							empresa A 
							INNER JOIN cidade B ON A.CIDADE = B.CIDADE 
						WHERE 
							ativo = '1' 
						ORDER BY A.NOME_FANTASIA ASC, B.DESCRICAO_CIDADE ASC";
	$rsCboEmpresas=mysqli_query($conn, $sqlCboEmpresas);
	while($row=mysqli_fetch_object($rsCboEmpresas)){
	?>
    <option value="<?php echo $row->EMPRESA;?>"><?php echo utf8_decode($row->NOME_FANTASIA . " - " . $row->DESCRICAO_CIDADE);?></option>
    <?php 
	}
	mysqli_free_result($rsCboEmpresas);
	?>
</select>