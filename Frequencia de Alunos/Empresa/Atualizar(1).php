<?php
    require_once "Conexao.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cmrj_empresa = $_POST["cmrj"];
        $nome_empresa = $_POST["nome_empresa"];
        $telefone_empresarial = $_POST["telefone_empresarial"];
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        
        if($nome_empresa != "" && $cmrj != "" && $telefone_empresarial != "" ){
        $sql = "UPDATE empresa SET nome_empresa = '$nome_empresa', cmrj = '$cmrj', telefone_empresarial = '$telefone_empresarial' WHERE cmrj = '$cmrj'";
        echo "$id";
        if ($conn->query($sql) === TRUE) {
            echo "CLIENTE ATUALIZADO COM SUCESSO!";
            header("refresh:2;url=index.php");
        } else {
            echo "Erro ao atualizar cliente: " . $conn->error;
        }
     } else {
            echo "TODOS OS CAMPOS DEVEM SER PREENCHIDOS!";
            header("refresh:2;url=index.php");
        }
        }
    $conn->close();
?>