<?php
    require_once "conexao.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];
        $endereço = $_POST["endereço"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];
        
        if($nome != "" && $cpf != "" && $telefone != "" && $email != "" && $endereço != ""  && $bairro != "" && $cidade != ""){
        $sql = "INSERT INTO login (nome, cpf, telefone, email, endereço, bairro, cidade) VALUES ('$nome', '$cpf','$telefone','$email','$endereço','$bairro','$cidade')";
        if ($conn->query($sql) === TRUE) {
            echo"<div class=\"alert alert-success\" role=\"alert\">CLIENTE CADASTRADO COM SUCESSO!</div>";
            header("refresh:2;url=index.php");
        } else {
            echo "Erro ao cadastrar cliente: " . $conn->error;
        }
        }
        }
    $conn->close();
?>