<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_tela.php");
    exit();
}

$admin_nome = $_SESSION['admin_nome'];

// Busca todos os professores cadastrados
$sql = "SELECT codigo, nome, email FROM professores ORDER BY nome ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Professores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .navbar-custom {
            background-color: #1B3954;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar com campo de busca integrado ao lado do botão de sair -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 text-white">
                <i class="bi bi-shield-check me-2"></i>Admin: <strong><?php echo htmlspecialchars($admin_nome); ?></strong>
            </span>
            <div class="d-flex align-items-center gap-2">
                <form class="d-flex" role="search" method="get" action="pesquisar_professor.php">
                    <input class="form-control form-control-sm" type="search" name="termo" placeholder="Buscar professor por nome..." aria-label="Search" required>
                    <button class="btn btn-outline-light btn-sm ms-1" type="submit" title="Pesquisar">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
                <a href="logout_adm.php" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i>Sair
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Corpo Docente</h3>
                <p class="text-muted mb-0">Gerencie os professores cadastrados no sistema EAD</p>
            </div>
            <a href="cadastrar_professor.php" class="btn btn-success">
                <i class="bi bi-person-plus-fill me-1"></i>Cadastrar Novo Professor
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 100px;">Código</th>
                                <th>Nome do Professor</th>
                                <th>E-mail</th>
                                <th class="text-center" style="width: 150px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td class="fw-bold text-muted"><?php echo $row['codigo']; ?></td>
                                        <td class="fw-semibold"><?php echo htmlspecialchars($row['nome']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td class="text-center">
                                            <a href="deletar_professor.php?professor_id=<?php echo $row['codigo']; ?>" 
                                               class="btn btn-outline-danger btn-sm"
                                               onclick="return confirm('Tem certeza que deseja excluir o(a) professor(a) <?php echo htmlspecialchars($row['nome']); ?>? Esta ação será bloqueada caso ele possua turmas vinculadas.');">
                                                <i class="bi bi-trash-fill me-1"></i>Excluir
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                        Nenhum professor cadastrado no momento.
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
