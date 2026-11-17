<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_tela.php");
    exit();
}

$admin_nome = $_SESSION['admin_nome'];
$mensagem_erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome  = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (empty($nome) || empty($email) || empty($senha)) {
        $mensagem_erro = "Por favor, preencha todos os campos.";
    } else {
        // Verifica se o e-mail já existe
        $check = $conn->prepare("SELECT codigo FROM professores WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $mensagem_erro = "Este e-mail já está cadastrado para outro professor.";
        } else {
            // Insere o novo professor
            $stmt = $conn->prepare("INSERT INTO professores (nome, email, senha) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nome, $email, $senha);

            if ($stmt->execute()) {
                header("Location: sucesso_prof.php");
                exit();
            } else {
                $mensagem_erro = "Erro ao cadastrar professor: " . $conn->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Professor - Sistema EAD</title>
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
                <i class="bi bi-shield-check me-2"></i>Bem-vindo(a), Admin <strong><?php echo htmlspecialchars($admin_nome); ?></strong>
            </span>
            <a href="logout_adm.php" class="btn btn-danger btn-sm">Sair</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Cadastrar Novo Professor</h5>
                        <a href="listar_professor.php" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>Voltar
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <?php if (!empty($mensagem_erro)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($mensagem_erro); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="cadastrar_professor.php">
                            <div class="mb-3">
                                <label for="nome" class="form-label fw-semibold">Nome Completo</label>
                                <input type="text" name="nome" id="nome" class="form-control" placeholder="Ex: Maria Fernandes" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">E-mail Acadêmico</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="maria.fernandes@ead.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label fw-semibold">Senha de Acesso Inicial</label>
                                <input type="password" name="senha" id="senha" class="form-control" placeholder="••••••••" required>
                                <div class="form-text">O professor utilizará esta senha para acessar o portal.</div>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-1"></i>Concluir Cadastro
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
