<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "serviço";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
    }
?>