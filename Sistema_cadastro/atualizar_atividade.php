<?php
    session_start();
    include 'config.php';
    
    if (!isset($_SESSION['professor_id'])) {
        header("Location: login.php");
        exit();
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_empresa	 = $_POST["turma_id"];
        $nome_empresa = $_POST["nome_empresa"];
        $cnpj_empresa = $_POST["cnpj_empresa"];
        $turma = $_POST["turma_id"];
        $atividade = $_POST["atividade"];
        
        if($turma != "" && $atividade != "" ) {
        //$sql = "INSERT INTO tab_clientes (nome, cpf, email, telefone) VALUES ('$nome', '$cpf', '$email', '$telefone')";
        //$sql = "UPDATE tab_clientes SET nome = $nome, cpf = $cpf, email = $email, telefone = $telefone  WHERE id = $id";
        $sql = "UPDATE demanda SET atividade = '$atividade' ,turma_codigo = '$turma' WHERE codigo = '$turma_id'	'";
        // echo "$id_empresa	";
        if ($conn->query($sql) === TRUE) {
            echo "EMPRESA ATUALIZADA COM SUCESSO!";
            header("refresh:2;url=index.php");
        } else {
            echo "Erro ao atualizar empresa: " . $conn->error;
        }
     } else {
            echo "TODOS OS CAMPOS DEVEM SER PREENCHIDOS!";
            header("refresh:2;url=index.php");
        }
        }
    $conn->close();
?>