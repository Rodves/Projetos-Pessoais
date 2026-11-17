<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (empty($email) || empty($senha)) {
        header("Location: admin_tela.php?erro=1");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, nome, senha FROM adm WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        $senha_valida = false;
        if (password_verify($senha, $admin['senha']) || $admin['senha'] === $senha) {
            $senha_valida = true;
        }

        if ($senha_valida) {
            $_SESSION['admin_id']   = $admin['id'];
            $_SESSION['admin_nome'] = $admin['nome'];
            header("Location: listar_professor.php");
            exit();
        }
    }

    header("Location: admin_tela.php?erro=1");
    exit();
} else {
    header("Location: admin_tela.php");
    exit();
}
?>
