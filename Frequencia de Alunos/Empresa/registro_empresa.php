<?php
    require_once "conexao.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome_empresa = $_POST["nome_empresa"];
        $cmrj_empresa = $_POST["cmrj_empresa"];
        $telefone_empresarial = $_POST["telefone_empresarial"];
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        $perfil = "Empresa";
        $acesso = "Desconectado";
        
        if($nome_empresa != "" && $cmrj_empresa != "" && $telefone_empresarial != "" && $usuario != "" && $senha != ""){
        $sql = "INSERT INTO empresa (nome_empresa, cmrj_empresa, telefone_empresarial) VALUES ('$nome_empresa', '$cmrj_empresa','$telefone_empresarial')";
        $sqi = "INSERT INTO login(usuario,senha,perfil,acesso)VALUES('$usuario','$senha','$perfil','$acesso')";
        if ($conn->query($sql) === TRUE and $conn->query($sqi) === TRUE) {
            echo"<div class=\"alert alert-success\" role=\"alert\">CLIENTE CADASTRADO COM SUCESSO!</div>";
            header("refresh:2;url=index.php");
        } else {
            echo "Erro ao cadastrar cliente: " . $conn->error;
        }
     } else {
            echo "TODOS OS CAMPOS DEVEM SER PREENCHIDOS!";
            header("refresh:2;url=index.php");
        }
        }
    $conn->close();
?>