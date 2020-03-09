<?php
session_start();
include 'config/conexao.php';
header('Content-Type: text/html; charset=ISO-8859-1');
include 'include/cbo-cadastros.php';
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
            <h1>Cadastrar Produto</h1>
            <form id="frm" name="frm" onsubmit="return false">
                <div><label>Produto</label></div>
                <div><input type="text" id="txtProduto" name="txtProduto" placeholder="Nome do produto" required/></div>
                <div><label>Apelido</label></div>
                <div><input type="text" id="txtApelido" name="txtApelido" placeholder="Apelido do produto" required/></div>
                <div><label>Descrição</label></div>
                <div><textarea id="txtDescricao" name="txtDescricao" cols="50" rows="5" placeholder="Descrição do produto" required></textarea></div>
                <div><label>Grupo</label></div>
                <div><?php fncGrupo($conn);?></div>
                <div><label>SubGrupo</label></div>
                <div><?php fncSubGrupo($conn);?></div>
                <div><label>Peso</label></div>
                <div><input type="number" id="txtPeso" name="txtPeso" placeholder="Peso"/></div>
                <div><label>Classificação</label></div>
                <div><input type="text" id="txtClassificacao" name="txtClassificacao" placeholder="Classificação do produto"/></div>
                <div><label>Código de barras</label></div>
                <div><input type="text" id="txtCodigoBarra" name="txtCodigoBarra" placeholder="Código de barra do produto"/></div>
                <div><label>Coleção</label></div>
                <div><input type="text" id="txtColecao" name="txtColecao" placeholder="Coleção do produto"/></div>
                <div style="margin-top:5px;width:200px"><button id="btnCadProduto">Cadastrar</button> <button id="btnVoltar" style="float:right">Voltar</button></div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>