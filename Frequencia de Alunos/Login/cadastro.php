<html>
<head>
    <title>CADASTRO DE USUÁRIOS</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<?php

// Recuperando os dados vindos do formulário na página cadastro.html

$senha = $_POST["senha"];
$usuario = $_POST["usuario"];
$perfil = "F-Senai";

//Criar conexão com o banco de dados
$connect = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connect,"frequencia");

//busca as informações de login no bnco de dados
$query_select = "SELECT senha FROM login WHERE usuario = '$usuario' AND senha = '$senha' AND perfil = '$perfil'";
$select = mysqli_query($connect,$query_select);
$array = mysqli_fetch_array($select);
@$logarray = $array["usuario"];


//testa se o usuário não entrou com informação alguma
if($usuario == "" || $senha == null){
    echo"<div class=\"alert alert-warning\" role=\"alert\">O campo login deve ser preenchido!</div>";
    header("refresh:2;url=cadastro.html");
    }else{

    //testa se o login já existe, se existir, retorna para a página de cadastro
      if($logarray == $senha){
        echo"<div class=\"alert alert-warning\" role=\"alert\">Este login já existe!</div>";
        header("refresh:2;url=cadastro.html");
        die();

      }else{
        $query = "INSERT INTO login ( usuario,senha,perfil) VALUES ('$usuario', '$senha', '$perfil')";
        $insert = mysqli_query($connect, $query);

        if($insert){
            echo"<div class=\"alert alert-success\" role=\"alert\">USUÁRIO CADASTRADO COM SUCESSO!</div>";
            header("refresh:2;url=index.html");
        }else{
            echo "NÃO FOI POSSÍVEL CADASTRAR OUSUÁRIO!";
            header("refresh:2;url=cadastro.html");
        }
      }
    }

?>
</body>
</html>