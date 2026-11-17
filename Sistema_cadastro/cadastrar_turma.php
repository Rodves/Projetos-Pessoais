<?php
session_start();
include 'config.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: index.php");
    exit();
}

$professor_id = $_SESSION['professor_id'];

// Busca o nome do professor logado
$stmt_prof = $conn->prepare("SELECT nome FROM professores WHERE codigo = ?");
$stmt_prof->bind_param("i", $professor_id);
$stmt_prof->execute();
$professor_nome = $stmt_prof->get_result()->fetch_assoc()['nome'] ?? $_SESSION['professor_nome'];

$mensagem_erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $turma = trim($_POST['turma'] ?? '');

    if (empty($turma)) {
        $mensagem_erro = "Por favor, informe o nome da turma.";
    } else {
        $stmt = $conn->prepare("INSERT INTO turmas (nome, professor_codigo) VALUES (?, ?)");
        $stmt->bind_param("si", $turma, $professor_id);
        
        if ($stmt->execute()) {
            header("Location: sucesso.php");
            exit();
        } else {
            $mensagem_erro = "Erro ao cadastrar a turma: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Turma - Sistema EAD</title>
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
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Cadastrar Nova Turma</h5>
                        <a href="listar_turmas.php" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>Voltar
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <?php if (!empty($mensagem_erro)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($mensagem_erro); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="cadastrar_turma.php">
                            <div class="mb-3">
                                <label for="turma" class="form-label fw-semibold">Nome da Turma / Disciplina</label>
                                <input type="text" name="turma" id="turma" class="form-control" placeholder="Ex: Programação Web - Turma B" required>
                                <div class="form-text">Esta turma ficará vinculada ao seu usuário.</div>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-1"></i>Salvar Turma
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
