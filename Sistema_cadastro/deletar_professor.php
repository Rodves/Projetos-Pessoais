<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_tela.php");
    exit();
}

$professor_id = isset($_GET['professor_id']) ? intval($_GET['professor_id']) : 0;

if ($professor_id <= 0) {
    header("Location: listar_professor.php");
    exit();
}

// REGRA DE NEGÓCIO: Verifica se o professor possui turmas vinculadas
$check_turmas = $conn->prepare("SELECT codigo FROM turmas WHERE professor_codigo = ?");
$check_turmas->bind_param("i", $professor_id);
$check_turmas->execute();
$res_turmas = $check_turmas->get_result();

if ($res_turmas->num_rows > 0) {
    // Não pode deletar pois existem turmas vinculadas a este professor
    header("Location: erro_prof.php");
    exit();
} else {
    // Pode deletar com segurança
    $stmt = $conn->prepare("DELETE FROM professores WHERE codigo = ?");
    $stmt->bind_param("i", $professor_id);
    
    if ($stmt->execute()) {
        header("Location: listar_professor.php");
        exit();
    } else {
        echo "Erro ao deletar o professor: " . $conn->error;
    }
}
?>
