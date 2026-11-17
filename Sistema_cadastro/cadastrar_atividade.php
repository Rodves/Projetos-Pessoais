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

$mensagem_erro = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $atividade = trim($_POST['atividade'] ?? '');

    if (empty($atividade)) {
        $mensagem_erro = "Por favor, descreva a atividade antes de cadastrar.";
    } else {
        $stmt_ins = $conn->prepare("INSERT INTO demanda (atividade, turma_codigo) VALUES (?, ?)");
        $stmt_ins->bind_param("si", $atividade, $turma_id);

        if ($stmt_ins->execute()) {
            header("Location: listar_demandas.php?turma_id=" . $turma_id);
            exit();
        } else {
            $mensagem_erro = "Erro ao cadastrar atividade: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Atividade - Sistema EAD</title>
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
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Cadastrar Atividade para: <span class="text-primary"><?php echo htmlspecialchars($turma_nome); ?></span></h5>
                        <a href="listar_demandas.php?turma_id=<?php echo $turma_id; ?>" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>Voltar
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <?php if (!empty($mensagem_erro)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($mensagem_erro); ?>
                            </div>
                        <?php endif; ?>

                        <form method="post" action="cadastrar_atividade.php?turma_id=<?php echo $turma_id; ?>">
                            <div class="mb-3">
                                <label for="atividade" class="form-label fw-semibold">Descrição da Atividade</label>
                                <textarea name="atividade" id="atividade" rows="5" class="form-control" placeholder="Descreva as instruções, prazo e critérios da atividade para os alunos..." required></textarea>
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-1"></i>Salvar Atividade
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
