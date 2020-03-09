<select name="cboTpComp" id="cboTpComp">
    <option value="" selected>Escolha o tipo de complemento</option>
    <?php
    $sqlCboTpComp = "SELECT 
							IDTIPOCOMPLEMENTO, TIPO_COMPLEMENTO
						FROM 
							tipo_complemento 
						WHERE 
							EMPRESA = ".$_SESSION["empresa"]."
						ORDER BY TIPO_COMPLEMENTO ASC";
	$rsCboTpComp=mysqli_query($conn, $sqlCboTpComp);
	while($row=mysqli_fetch_object($rsCboTpComp)){
	?>
    <option value="<?php echo $row->IDTIPOCOMPLEMENTO;?>"><?php echo utf8_decode($row->TIPO_COMPLEMENTO);?></option>
    <?php 
	}
	mysqli_free_result($rsCboTpComp);
	?>
</select>