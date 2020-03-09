<?php
session_start();
include 'config/conexao.php';
header('Content-Type: text/html; charset=ISO-8859-1');
$id = $_GET["id"];
if(empty($id)){header('Location: /lista-produtos.php');}
elseif(!is_numeric($id)){header('Location: /lista-produtos.php');}
include 'include/edt-cadastros.php';
$sqlProd = "SELECT PRODUTO, DESCRICAO_PRODUTO, APELIDO_PRODUTO, GRUPO_PRODUTO, SUBGRUPO_PRODUTO, SITUACAO, PESO_LIQUIDO, CLASSIFICACAO_FISCAL, CODIGO_BARRAS, COLECAO FROM produto WHERE ID = '".$id."' AND EMPRESA = '".$_SESSION["empresa"]."'";
$rsProd=mysqli_query($conn, $sqlProd);
$row=mysqli_fetch_object($rsProd);
?>
<!DOCTYPE html><!--Deus é Fiel - Em nome de Jesus - Amém--><html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="ISO-8859-1"/>
    <title>:: Trovata :: Teste ::</title>
    <style>
    p{margin:0;padding:0}
    div{float:left;width:99.9%;border-spacing:0;border-collapse:separate}
    </style>
    <script src="lib/jquery-3.2.1.min.js"></script><script src="lib/trovata.js"></script>
</head>
<body>
    <div style="float:left;clear:both;width:99.9%;min-height:99.8%;left:0;top:0;border:0;z-index:1">
        <div style="float:left;clear:both;width:99.9%;left:0;top:0;border:0;margin-top:10px;z-index:2">
            <h1>Editar Produto</h1>
            <form id="frm" name="frm" onsubmit="return false"><input type="hidden" id="hddId" name="hddId" value="<?php echo $id; ?>"/>
                <div><label>Produto</label></div>
                <div><input type="text" id="txtProduto" name="txtProduto" placeholder="Nome do produto" value="<?php echo utf8_decode($row->PRODUTO); ?>" required/></div>
                <div><label>Apelido</label></div>
                <div><input type="text" id="txtApelido" name="txtApelido" placeholder="Apelido do produto" value="<?php echo utf8_decode($row->APELIDO_PRODUTO); ?>" required/></div>
                <div><label>Descrição</label></div>
                <div><textarea id="txtDescricao" name="txtDescricao" cols="50" rows="5" placeholder="Descrição do produto" required><?php echo utf8_decode($row->DESCRICAO_PRODUTO); ?></textarea></div>
                <div><label>Grupo</label></div>
                <div><?php fncGrupo($conn, $row->GRUPO_PRODUTO);?></div>
                <div><label>SubGrupo</label></div>
                <div><?php fncSubGrupo($conn, $row->SUBGRUPO_PRODUTO);?></div>
                <div><label>Peso</label></div>
                <div><input type="number" id="txtPeso" name="txtPeso" placeholder="Peso" value="<?php echo $row->PESO_LIQUIDO; ?>"/></div>
                <div><label>Classificação</label></div>
                <div><input type="text" id="txtClassificacao" name="txtClassificacao" placeholder="Classificação do produto" value="<?php echo utf8_decode($row->CLASSIFICACAO_FISCAL); ?>"/></div>
                <div><label>Código de barras</label></div>
                <div><input type="text" id="txtCodigoBarra" name="txtCodigoBarra" placeholder="Código de barra do produto" value="<?php echo utf8_decode($row->CODIGO_BARRAS); ?>"/></div>
                <div><label>Coleção</label></div>
                <div><input type="text" id="txtColecao" name="txtColecao" placeholder="Coleção do produto" value="<?php echo utf8_decode($row->COLECAO); ?>"/></div>
                <div style="margin-top:5px;width:200px"><button id="btnEdtProduto">Alterar</button> <button id="btnVoltar" style="float:right">Voltar</button></div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
mysqli_free_result($rsProd);
mysqli_close($conn);
?>