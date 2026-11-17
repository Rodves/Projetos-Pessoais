<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_tela.php");
    exit();
}

$admin_nome = $_SESSION['admin_nome'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso Administrativo - Sistema EAD</title>
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
                <i class="bi bi-shield-check me-2"></i>Admin <strong><?php echo htmlspecialchars($admin_nome); ?></strong>
            </span>
            <a href="logout_adm.php" class="btn btn-danger btn-sm">Sair</a>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-success">
                    <div class="card-body p-4 text-center">
                        <div class="text-success display-4 mb-3">
                            <i class="bi bi-person-check-fill"></i>
                        </div>
                        <h4 class="card-title fw-bold text-success">Professor Cadastrado com Sucesso!</h4>
                        <p class="card-text text-muted fs-5 mt-2">
                            O novo docente já pode acessar a plataforma utilizando o e-mail e a senha cadastrados.
                        </p>
                        <div class="mt-4">
                            <a href="listar_professor.php" class="btn btn-success px-4">
                                <i class="bi bi-arrow-left me-1"></i>Voltar para Lista de Professores
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
