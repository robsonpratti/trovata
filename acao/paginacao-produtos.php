<?php
session_start();
$TotalReg = $_POST["TotalReg"];
$pg = $_POST["pg"];
$QtdRegPorPagina = $_POST["QtdRegPorPagina"];
?>
<tr style="background:#d6ffae">
    <td colspan="7" style="text-align:center">
        <?php
        $TotalPag = ceil($TotalReg / $QtdRegPorPagina);
        for ($i = 1; $i <= ($TotalPag); $i++){
            if ($i>1){
                echo "<span style='margin-left:5px;margin-right:5px'>|</span>";
            }
            if ($pg == $i){
                $lnk = " style='font-weight:bold'";
			}else{
                $lnk = "href=\"javascript:void(0)\" onclick=\"fncPaginacao('".$i."','".$QtdRegPorPagina."','".$TotalReg."')\"";
			}
        ?>
            <a <?php echo $lnk;?> title="<?php echo $i;?>"><?php echo $i;?></a>
        <?php
        }
        ?>
    </td>
</tr>