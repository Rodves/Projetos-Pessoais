<?php
    require_once "conexao.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cmrj_empresa = $_POST["cmrj_empresa"];
        $nome_empresa = $_POST["nome_empresa"];
        $telefone_empresarial = $_POST["telefone_empresarial"];
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        
        if($nome_empresa != "" && $cmrj_empresa != "" && $telefone_empresarial != "" && $usuario != "" && $senha != ""){
        $sql = "UPDATE empresa SET nome_empresa = '$nome_empresa', cmrj_empresa = '$cmrj_empresa', telefone_empresarial = '$telefone_empresarial', usuario = '$usuario', senha = '$senha'    WHERE cmrj_empresa = '$cmrj_empresa'";
        echo "$cmrj_empresa";
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