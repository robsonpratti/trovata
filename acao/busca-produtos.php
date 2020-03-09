<?php
session_start();
include '../config/conexao.php';

$grpProd = $_POST["grpProd"];
$tpComp = $_POST["tpComp"];
$codigo = $_POST["codigo"];
$apelido = $_POST["apelido"];
$descricao = $_POST["descricao"];
$ordem = $_POST["ordem"];
$pg = $_POST["pg"];

$QtdRegPorPagina=10;
$TotalReg = 0;

$sqlBuscaProd = "SELECT 
	                (
		                SELECT 
			                COUNT(A.ID)
		                FROM
			                produto A
			                INNER JOIN grupo_produto B ON A.GRUPO_PRODUTO = B.GRUPO_PRODUTO
			                INNER JOIN tipo_complemento C ON B.TIPO_COMPLEMENTO = C.IDTIPOCOMPLEMENTO
		                WHERE
			                A.EMPRESA = ".$_SESSION["empresa"];
if (strlen($grpProd) > 0){
	$sqlBuscaProd .= " AND B.GRUPO_PRODUTO = '".$grpProd."'";
}
if (strlen($tpComp) > 0){
	$sqlBuscaProd .= " AND C.IDTIPOCOMPLEMENTO = '".$tpComp."'";
}
if (strlen($codigo) > 0){
	$sqlBuscaProd .= " AND A.ID = '".$codigo."'";
}
if (strlen($apelido) > 0){
	$sqlBuscaProd .= " AND A.APELIDO_PRODUTO = '".$apelido."'";
}
if (strlen($descricao) > 0){
	$sqlBuscaProd .= " AND B.DESCRICAO_GRUPO_PRODUTO = '".$descricao."'";
}
$sqlBuscaProd .= "  ) AS TotalReg,
                    A.ID, A.PRODUTO, B.DESCRICAO_GRUPO_PRODUTO, C.TIPO_COMPLEMENTO, A.APELIDO_PRODUTO, A.DESCRICAO_PRODUTO
                FROM 
	                produto A
                    INNER JOIN grupo_produto B ON A.GRUPO_PRODUTO = B.GRUPO_PRODUTO
                    INNER JOIN tipo_complemento C ON B.TIPO_COMPLEMENTO = C.IDTIPOCOMPLEMENTO
                WHERE
	                A.EMPRESA = ".$_SESSION["empresa"];
if (strlen($grpProd) > 0){
	$sqlBuscaProd .= " AND B.GRUPO_PRODUTO = '".$grpProd."'";
}
if (strlen($tpComp) > 0){
	$sqlBuscaProd .= " AND C.IDTIPOCOMPLEMENTO = '".$tpComp."'";
}
if (strlen($codigo) > 0){
	$sqlBuscaProd .= " AND A.ID = '".$codigo."'";
}
if (strlen($apelido) > 0){
	$sqlBuscaProd .= " AND A.APELIDO_PRODUTO = '".$apelido."'";
}
if (strlen($descricao) > 0){
	$sqlBuscaProd .= " AND B.DESCRICAO_GRUPO_PRODUTO = '".$descricao."'";
}
$sqlBuscaProd .= "  ORDER BY ".$ordem;
if ($pg >= 1){
	$fim=$QtdRegPorPagina*$pg;
	$ini=$fim-$QtdRegPorPagina;
	$sqlBuscaProd .= "  LIMIT $ini, $fim";
}else {
	$sqlBuscaProd .= "  LIMIT 0,$QtdRegPorPagina";
}
$rsBuscaProd=mysqli_query($conn, $sqlBuscaProd);
while($row=mysqli_fetch_object($rsBuscaProd)){
	if ($TotalReg==0){
        $TotalReg = $row->TotalReg;
	}
?>
	<tr>
        <td><?php echo $row->ID;?></td>
        <td><?php echo $row->APELIDO_PRODUTO;?></td>
        <td><?php echo $row->PRODUTO;?></td>
        <td><?php echo $row->DESCRICAO_GRUPO_PRODUTO;?></td>
        <td><?php echo $row->TIPO_COMPLEMENTO;?></td>
        <td><?php echo $row->DESCRICAO_PRODUTO;?></td>
        <td style="text-align:center"><a href="javascript:void()" onclick="fncAlterarProduto('<?php echo $row->ID;?>')" style="margin-right:5px" title="Alterar">[Alterar]</a> <a href="javascript:void()" onclick="fncExcluirProduto('<?php echo $row->ID;?>','<?php echo $row->APELIDO_PRODUTO;?>')" title="Excluir">[X]</a></td>
    </tr>
<?php
}
mysqli_free_result($rsBuscaProd);
mysqli_close($conn);
echo "|$TotalReg";
?>