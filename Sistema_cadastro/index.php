<?php
session_start();
if (isset($_SESSION['professor_id'])) {
    header("Location: listar_turmas.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema EAD</title>
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
            <span class="navbar-brand mb-1 h4 text-white">
                <i class="bi bi-mortarboard-fill me-2"></i>SISTEMA DE ATIVIDADES EAD
            </span>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-white py-4">
                        <div class="display-5 text-primary mb-2">
                            <i class="bi bi-person-workspace"></i>
                        </div>
                        <h4 class="mb-0 fw-bold text-dark">Portal do Professor</h4>
                        <small class="text-muted">Acesse para gerenciar suas turmas e atividades</small>
                    </div>
                    <div class="card-body p-4">
                        <?php if (isset($_GET['erro'])): ?>
                            <div class="alert alert-danger py-2" role="alert">
                                E-mail ou senha inválidos. Tente novamente.
                            </div>
                        <?php endif; ?>
                        
                        <form method="post" action="login.php">
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="professor@ead.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label fw-semibold">Senha</label>
                                <input type="password" name="senha" id="senha" class="form-control" placeholder="••••••••" required>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">ENTRAR</button>
                                <a href="admin_tela.php" class="btn btn-outline-secondary">Acesso Administrativo</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
