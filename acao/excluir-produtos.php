<?php
session_start();
include '../config/conexao.php';

$id = $_POST["id"];
$sqlVerProd = "SELECT COUNT(ID) AS Qtd FROM produto WHERE id = '".$id."' AND EMPRESA = '".$_SESSION["empresa"]."'";
$rsVerProd=mysqli_query($conn, $sqlVerProd);
$row=mysqli_fetch_object($rsVerProd);
if ($row->Qtd > 0){
    $sqlDelProd = "DELETE FROM produto WHERE id = '".$id."' AND EMPRESA = '".$_SESSION["empresa"]."'";
	
	$conn->query($sqlDelProd);
	echo "1";
}else{
    echo "2";
}
mysqli_free_result($rsVerProd);
mysqli_close($conn);
?>