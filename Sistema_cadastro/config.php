<?php
// =============================================
// ARQUIVO DE CONFIGURAÇÃO E CONEXÃO COM O BANCO
// =============================================

$host     = 'localhost';
$usuario  = 'root';
$senha    = '';
$banco    = 'sistema_ead';

// Estabelece a conexão com o banco MySQL
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica se ocorreu erro na conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Configura o conjunto de caracteres para UTF-8
$conn->set_charset("utf8mb4");
?>
