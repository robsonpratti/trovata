<?php
session_start();
include 'config/conexao.php';
header('Content-Type: text/html; charset=ISO-8859-1');
?>
<!DOCTYPE html><!--Deus é Fiel - Em nome de Jesus - Amém--><html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="ISO-8859-1"/>
    <title>:: Trovata :: Teste ::</title>
    <style>
    p{margin:0;padding:0}
    table{width:99.9%;border-spacing:0;border-collapse:collapse;border:1px solid #000}
    th,td{padding:0;border:1px solid #000}
    </style>
    <script src="lib/jquery-3.2.1.min.js"></script><script src="lib/trovata.js"></script>
</head>
<body>
    <div style="float:left;clear:both;width:99.9%;min-height:99.8%;left:0;top:0;border:0;z-index:1">
        <div style="float:left;clear:both;width:99.9%;left:0;top:0;border:0;z-index:2">
            <div style="float:left;clear:both;width:99.9%;left:0;top:0;border:0;z-index:2">
                <fieldset style="background:#e4c8c8">
                    <legend><b>Escolha a empresa na qual deseja trabalhar</b></legend>
                    <p><?php include 'include/cbo-empresas.php';?></p>
                </fieldset>
            </div>
            <div style="float:left;clear:both;width:99.9%;left:0;top:0;border:0;z-index:2">
                <fieldset style="background:#afd1f2">
                    <legend><b>Dados da Empresa:</b></legend>
                    <?php
                    $sqlEmpresa = "SELECT 
                                        A.EMPRESA, A.CNPJ, A.IE, A.NOME_FANTASIA, A.RAZAO_SOCIAL, A.ENDERECO, A.BAIRRO, A.CEP, 
                                        B.DESCRICAO_CIDADE, B.UF, B.PAIS,
                                        A.TELEFONE, A.FAX
                                    FROM 
                                        empresa A
                                        INNER JOIN cidade B ON A.CIDADE = B.CIDADE
                                    WHERE 
                                        A.EMPRESA = ".$_SESSION["empresa"];
                    $rsEmpresa=mysqli_query($conn, $sqlEmpresa);
                    $row=mysqli_fetch_object($rsEmpresa);
                    ?>
                    <p><b>CNPJ:</b> <label style="padding-right:20px"><?php echo $row->CNPJ;?></label> <b>IE:</b> <label><?php echo $row->IE;?></label></p>
                    <p><b>Nome Fantasia:</b> <label><?php echo utf8_decode($row->NOME_FANTASIA);?></label></p>
                    <p><b>Razão Social:</b> <label><?php echo utf8_decode($row->RAZAO_SOCIAL);?></label></p>
                    <p><b>Endereço:</b> <label><?php echo utf8_decode($row->ENDERECO . " - " . $row->BAIRRO . " - " . $row->CEP);?></label></p>
                    <p><b>Cidade:</b> <label><?php echo utf8_decode($row->DESCRICAO_CIDADE . " - " . $row->UF . " - " . $row->PAIS);?></label></p>
                    <p><b>Telefone:</b> <label><?php echo $row->TELEFONE;?></label></p>
                    <p><b>FAX:</b> <label><?php echo $row->FAX;?></label></p>
                    <?php
                    mysqli_free_result($rsEmpresa);
                    ?>
                </fieldset>
            </div>
        </div>
        <div style="float:left;clear:both;width:99.9%;left:0;top:0;border:0;margin-top:10px;margin-bottom:10px;padding-top:10px;padding-bottom:10px;z-index:2;background:#aeb4ff">
            <button id="btnNovoProd">Cadastrar Produto</button>
        </div>
        <div style="float:left;clear:both;width:99.9%;left:0;top:0;border:0;z-index:2">
            <fieldset style="background:#f3ff73">
                <legend><b>Filtros:</b></legend>
                <p><?php include 'include/cbo-grupo-produtos.php';?> <?php include 'include/cbo-tipo-complemento.php';?></p>
                <p style="margin-top:5px"><input type="text" id="txtCodigo" name="txtCodigo" placeholder="Código"/> <input type="text" id="txtApelido" name="txtApelido" placeholder="Apelido"/> <input type="text" id="txtDescricao" name="txtDescricao" placeholder="Descrição"/></p>
                <p style="margin-top:5px"><button id="btnBuscar">Buscar</button></p><input type="hidden" id="hddOrdem" name="hddOrdem" value="2 ASC">
            </fieldset>
        </div>
        <div style="float:left;clear:both;width:99.9%;left:0;top:0;border:0;margin-top:10px;z-index:2">
            <table>
                <thead>
                    <tr style="background:#d6ffae">
                        <th id="ord1" onclick="fncOrdenar('1 ASC', 6)" style="cursor:pointer">Código</th>
                        <th id="ord2" onclick="fncOrdenar('2 ASC', 6)" style="cursor:pointer">Apelido</th>
                        <th id="ord3" onclick="fncOrdenar('3 DESC', 6)" style="cursor:pointer">Produtos</th>
                        <th id="ord4" onclick="fncOrdenar('4 ASC', 6)" style="cursor:pointer">Grupo</th>
                        <th id="ord5" onclick="fncOrdenar('5 ASC', 6)" style="cursor:pointer">Tipo</th>
                        <th id="ord6" onclick="fncOrdenar('6 ASC', 6)" style="cursor:pointer">Descrição</th>
                        <th style="width:100px"></th>
                    </tr>
                </thead>
                <tbody id="ListaProdutos">
                    <?php
                    $QtdRegPorPagina=10;
                    $TotalReg = 0;
                    $sqlLstProdutos = "SELECT 
	                                        (
		                                        SELECT 
			                                        COUNT(A.ID)
		                                        FROM
			                                        produto A
			                                        INNER JOIN grupo_produto B ON A.GRUPO_PRODUTO = B.GRUPO_PRODUTO
			                                        INNER JOIN tipo_complemento C ON B.TIPO_COMPLEMENTO = C.IDTIPOCOMPLEMENTO
		                                        WHERE
			                                        A.EMPRESA = ".$_SESSION["empresa"]." 
                                            ) AS TotalReg,
                                            A.ID, A.PRODUTO, B.DESCRICAO_GRUPO_PRODUTO, C.TIPO_COMPLEMENTO, A.APELIDO_PRODUTO, A.DESCRICAO_PRODUTO
                                        FROM 
	                                        produto A
                                            INNER JOIN grupo_produto B ON A.GRUPO_PRODUTO = B.GRUPO_PRODUTO
                                            INNER JOIN tipo_complemento C ON B.TIPO_COMPLEMENTO = C.IDTIPOCOMPLEMENTO
                                        WHERE
	                                        A.EMPRESA = ".$_SESSION["empresa"]."
                                        ORDER BY 2 ASC
                                        LIMIT 0,$QtdRegPorPagina";
	                $rsLstProdutos=mysqli_query($conn, $sqlLstProdutos);
	                while($row=mysqli_fetch_object($rsLstProdutos)){
                        if ($TotalReg==0){
                            $TotalReg = $row->TotalReg;
						}
	                ?>
                    <tr>
                        <td><?php echo $row->ID;?></td>
                        <td><?php echo utf8_decode($row->APELIDO_PRODUTO);?></td>
                        <td><?php echo utf8_decode($row->PRODUTO);?></td>
                        <td><?php echo utf8_decode($row->DESCRICAO_GRUPO_PRODUTO);?></td>
                        <td><?php echo utf8_decode($row->TIPO_COMPLEMENTO);?></td>
                        <td><?php echo utf8_decode($row->DESCRICAO_PRODUTO);?></td>
                        <td style="text-align:center"><a href="javascript:void(0)" onclick="fncAlterarProduto('<?php echo $row->ID;?>')" style="margin-right:5px" title="Alterar">[Alterar]</a> <a href="javascript:void(0)" onclick="fncExcluirProduto('<?php echo $row->ID;?>','<?php echo utf8_decode($row->APELIDO_PRODUTO);?>')" title="Excluir">[X]</a></td>
                    </tr>
                    <?php 
	                }
	                mysqli_free_result($rsLstProdutos);
	                ?>
                </tbody><input type="hidden" id="hddTotalReg" name="hddTotalReg" value="<?php echo $TotalReg;?>"><input type="hidden" id="hddQtdRegPorPagina" name="hddQtdRegPorPagina" value="<?php echo $QtdRegPorPagina;?>">
                <tfoot id="RodapeListaProdutos">
                    <?php
                    if ($TotalReg > $QtdRegPorPagina){
                    $lnk = " style='font-weight:bold'";
                    ?>
                    <tr style="background:#d6ffae">
                        <td colspan="7" style="text-align:center">
                            <?php
                            $TotalPag = ceil($TotalReg / $QtdRegPorPagina);
                            for ($i = 1; $i <= ($TotalPag); $i++){
                                if ($i>1){
                                    echo "<span style='margin-left:5px;margin-right:5px'>|</span>";
                                    $lnk = "href=\"javascript:void(0)\" onclick=\"fncPaginacao($i,$QtdRegPorPagina,$TotalReg)\"";
                                } 
                            ?>
                            <a <?php echo $lnk;?> title="<?php echo $i;?>"><?php echo $i;?></a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php        
				    }
                    ?>
                </tfoot>
            </table>
        </div>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>