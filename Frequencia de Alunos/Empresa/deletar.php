<?php
    require_once "conexao.php";

    $cmrj = $_GET["cmrj"];

    $query = "DELETE FROM empresa WHERE cmrj = '$cmrj_empresa'";
    if (mysqli_query($conn, $query)) {
        echo "EMPRESA DELETADA COM SUCESSO!";
        header("refresh:2;url=Listar_Empresa.php");
    } else {
        echo "ERRO AO DELETAR EMPRESA!";
        header("refresh:2;url=Listar_Empresa.php");
    }
?>