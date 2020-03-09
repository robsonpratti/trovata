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
    </style>
    <script src="lib/jquery-3.2.1.min.js"></script><script src="lib/trovata.js"></script>
</head>
<body>
    <div style="float:left;clear:both;width:99.9%;min-height:99.8%;left:0;top:0;border:0;z-index:1">
        <div style="float:left;clear:both;width:99.9%;left:0;top:0;border:0;z-index:2">
            <fieldset style="background:#e4c8c8">
                <legend><b>Escolha a empresa na qual deseja trabalhar</b></legend>
                <p><?php include 'include/cbo-empresas.php';?></p>
            </fieldset>
        </div>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>