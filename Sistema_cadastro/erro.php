<?php
session_start();
if (!isset($_SESSION['professor_id'])) {
    header("Location: index.php");
    exit();
}

$professor_nome = $_SESSION['professor_nome'] ?? 'Professor';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso - Sistema EAD</title>
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
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow-sm border-danger">
                    <div class="card-body p-4 text-center">
                        <div class="text-danger display-4 mb-3">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <h4 class="card-title fw-bold text-danger">Operação Não Permitida</h4>
                        <p class="card-text text-muted fs-5 mt-2">
                            Você não pode excluir uma turma que possui atividades pedagógicas cadastradas.
                        </p>
                        <p class="text-muted small">
                            Para garantir a integridade dos registros acadêmicos, turmas com demandas associadas são protegidas contra exclusão acidental.
                        </p>
                        <div class="mt-4">
                            <a href="listar_turmas.php" class="btn btn-primary px-4">
                                <i class="bi bi-arrow-left me-1"></i>Voltar para Minhas Turmas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
