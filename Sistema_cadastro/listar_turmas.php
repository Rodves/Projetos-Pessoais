<?php
session_start();
include 'config.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: index.php");
    exit();
}

$professor_id = $_SESSION['professor_id'];

// Recupera o nome atualizado do professor
$stmt_prof = $conn->prepare("SELECT nome FROM professores WHERE codigo = ?");
$stmt_prof->bind_param("i", $professor_id);
$stmt_prof->execute();
$res_prof = $stmt_prof->get_result();
$professor_nome = $res_prof->fetch_assoc()['nome'] ?? $_SESSION['professor_nome'];

// Busca as turmas deste professor e conta quantas atividades cada turma possui
$sql = "SELECT t.codigo, t.nome, COUNT(d.codigo) AS total_atividades 
        FROM turmas t 
        LEFT JOIN demanda d ON t.codigo = d.turma_codigo 
        WHERE t.professor_codigo = ? 
        GROUP BY t.codigo, t.nome 
        ORDER BY t.nome ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $professor_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Turmas - Sistema EAD</title>
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
            <a href="logout.php" class="btn btn-danger btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>Sair
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Turmas sob sua Responsabilidade</h3>
                <p class="text-muted mb-0">Gerencie suas turmas e cadastre atividades para os estudantes</p>
            </div>
            <a href="cadastrar_turma.php" class="btn btn-success">
                <i class="bi bi-plus-circle me-1"></i>Cadastrar Nova Turma
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 100px;">Código</th>
                                <th>Nome da Turma</th>
                                <th class="text-center" style="width: 150px;">Atividades</th>
                                <th class="text-end" style="width: 320px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td class="fw-bold text-muted"><?php echo $row['codigo']; ?></td>
                                        <td class="fw-semibold"><?php echo htmlspecialchars($row['nome']); ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary rounded-pill">
                                                <?php echo $row['total_atividades']; ?> atividade(s)
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="listar_demandas.php?turma_id=<?php echo $row['codigo']; ?>" class="btn btn-info btn-sm text-white me-1">
                                                <i class="bi bi-card-checklist me-1"></i>Ver Atividades
                                            </a>
                                            <a href="cadastrar_atividade.php?turma_id=<?php echo $row['codigo']; ?>" class="btn btn-outline-primary btn-sm me-1">
                                                <i class="bi bi-plus-lg"></i>
                                            </a>
                                            <a href="deletar_turma.php?turma_id=<?php echo $row['codigo']; ?>" 
                                               class="btn btn-outline-danger btn-sm"
                                               onclick="return confirm('Tem certeza que deseja excluir esta turma? Se houver atividades cadastradas, a exclusão será bloqueada.');">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Você ainda não possui nenhuma turma cadastrada.
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
