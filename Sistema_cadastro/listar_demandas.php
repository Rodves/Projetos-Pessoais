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

// Verifica se a turma pertence ao professor logado e pega seu nome
$stmt_turma = $conn->prepare("SELECT nome FROM turmas WHERE codigo = ? AND professor_codigo = ?");
$stmt_turma->bind_param("ii", $turma_id, $professor_id);
$stmt_turma->execute();
$res_turma = $stmt_turma->get_result();

if ($res_turma->num_rows === 0) {
    header("Location: listar_turmas.php");
    exit();
}
$turma_nome = $res_turma->fetch_assoc()['nome'];

// Nome do professor
$stmt_prof = $conn->prepare("SELECT nome FROM professores WHERE codigo = ?");
$stmt_prof->bind_param("i", $professor_id);
$stmt_prof->execute();
$professor_nome = $stmt_prof->get_result()->fetch_assoc()['nome'] ?? $_SESSION['professor_nome'];

// Busca as atividades cadastradas para esta turma
$stmt_demanda = $conn->prepare("SELECT codigo, atividade, criado_em FROM demanda WHERE turma_codigo = ? ORDER BY codigo DESC");
$stmt_demanda->bind_param("i", $turma_id);
$stmt_demanda->execute();
$result_demandas = $stmt_demanda->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades da Turma - Sistema EAD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .navbar-custom {
            background-color: #1B3954;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 text-white">
                <i class="bi bi-mortarboard-fill me-2"></i>Prof.(a) <strong><?php echo htmlspecialchars($professor_nome); ?></strong>
            </span>
            <a href="logout.php" class="btn btn-danger btn-sm">Sair</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="listar_turmas.php" class="btn btn-outline-secondary btn-sm mb-2">
                    <i class="bi bi-arrow-left me-1"></i>Voltar para Turmas
                </a>
                <h3 class="fw-bold mb-1">Atividades da Turma: <span class="text-primary"><?php echo htmlspecialchars($turma_nome); ?></span></h3>
                <p class="text-muted mb-0">Listagem de conteúdos e demandas enviadas para os estudantes</p>
            </div>
            <a href="cadastrar_atividade.php?turma_id=<?php echo $turma_id; ?>" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i>Nova Atividade
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 100px;">Código</th>
                                <th>Descrição da Atividade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result_demandas && $result_demandas->num_rows > 0): ?>
                                <?php while ($row = $result_demandas->fetch_assoc()): ?>
                                    <tr>
                                        <td class="fw-bold text-muted"><?php echo $row['codigo']; ?></td>
                                        <td>
                                            <div style="white-space: pre-line;">
                                                <?php echo htmlspecialchars($row['atividade']); ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Nenhuma atividade cadastrada para esta turma até o momento.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
