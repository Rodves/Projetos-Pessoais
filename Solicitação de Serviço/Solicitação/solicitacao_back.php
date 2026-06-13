<?php
    require_once "conexao.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cpf_s = $_POST["cpf"];
        $data = $_POST["data"];
        $prioridade = $_POST["prioridade"];
        $descricao = $_POST["descricao"];
        $status = "Em Processamento";

        $sql_query = "SELECT * FROM cadastro";
        if ($result = $conn ->query($sql_query)) {
            while ($row = $result -> fetch_assoc()) { 
                $cpf = $row['cpf'];
        
        if($cpf != "" && $data != "" && $prioridade != "" && $descricao != ""  && $status != ""){
        $sql = "INSERT INTO login (cpf_s, data, descricao, prioridade, status) VALUES ('$cpf_s','$data','$descricao','$prioridade','$status')";
        if ($conn->query($sql) === TRUE) {
            echo"<div class=\"alert alert-success\" role=\"alert\">CLIENTE CADASTRADO COM SUCESSO!</div>";
            header("refresh:2;url=solicitacao.php");
        } else {
            echo "Erro ao cadastrar cliente: " . $conn->error;
        }
        }
    }
        }
    $conn->close();
    }
?>