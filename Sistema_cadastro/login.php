<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (empty($email) || empty($senha)) {
        header("Location: index.php?erro=1");
        exit();
    }

    // Consulta protegida com prepared statement
    $stmt = $conn->prepare("SELECT codigo, nome, senha FROM professores WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $professor = $result->fetch_assoc();
        
        // Suporta senha hash ou senha direta (legado de teste)
        $senha_valida = false;
        if (password_verify($senha, $professor['senha']) || $professor['senha'] === $senha) {
            $senha_valida = true;
        }

        if ($senha_valida) {
            $_SESSION['professor_id']   = $professor['codigo'];
            $_SESSION['professor_nome'] = $professor['nome'];
            header("Location: listar_turmas.php");
            exit();
        }
    }

    header("Location: index.php?erro=1");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
