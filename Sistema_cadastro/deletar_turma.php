<?php
session_start();
include 'config.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: index.php");
    exit();
}

$professor_id = $_SESSION['professor_id'];
$turma_id     = isset($_GET['turma_id']) ? intval($_GET['turma_id']) : 0;

if ($turma_id <= 0) {
    header("Location: listar_turmas.php");
    exit();
}

// Verifica se a turma realmente pertence ao professor logado
$stmt_check_dono = $conn->prepare("SELECT codigo FROM turmas WHERE codigo = ? AND professor_codigo = ?");
$stmt_check_dono->bind_param("ii", $turma_id, $professor_id);
$stmt_check_dono->execute();
if ($stmt_check_dono->get_result()->num_rows === 0) {
    // Turma não pertence ao professor logado
    header("Location: listar_turmas.php");
    exit();
}

// REGRA DE NEGÓCIO: Verifica se existem atividades vinculadas a esta turma
$stmt_check_atividades = $conn->prepare("SELECT codigo FROM demanda WHERE turma_codigo = ?");
$stmt_check_atividades->bind_param("i", $turma_id);
$stmt_check_atividades->execute();
$res_atividades = $stmt_check_atividades->get_result();

if ($res_atividades->num_rows > 0) {
    // BLOQUEIA: Não é permitido excluir turma com atividades cadastradas
    header("Location: erro.php");
    exit();
} else {
    // EXCLUI: Turma sem atividades pode ser removida
    $stmt_delete = $conn->prepare("DELETE FROM turmas WHERE codigo = ? AND professor_codigo = ?");
    $stmt_delete->bind_param("ii", $turma_id, $professor_id);
    
    if ($stmt_delete->execute()) {
        header("Location: listar_turmas.php");
        exit();
    } else {
        echo "Erro ao deletar a turma: " . $conn->error;
    }
}
?>
