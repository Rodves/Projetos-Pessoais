
<?php require_once "../empresa/conexao.php";
    if (mysqli_num_rows == "F_senai") {
     header("refresh:2;url=../Empresa/cadastro_empresa.php");
     
    }else{}
     
     ?>

<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Empresa</title>
</head>
<body>
    
<center> 
    <div class="1" text-align="center">
        <print<b(DIGITE O CMRJ DA SUA EMPRESA ABAIXO:)>
    <label>CMRJ</label><input type="text" name="cmrj" id="cmrj"required><br>
    </div>
</center>
 <?php
    $cmrj_empresa = $_Post["cmrj_empresa"];
    $connect = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connect,"frequencia");
    $query($connect, "SELECT * FROM empresa WHERE cmrj_empresa = '$cmrj_empresa'");
    if ($cmrj_empresa == $cmrj){
      header("UPDATE login Set acesso = 'Em Uso' WHERE acesso = ''");
    }
        
?> 
</body> !-->
