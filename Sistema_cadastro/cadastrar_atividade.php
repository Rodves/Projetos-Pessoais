<?php
session_start();
include 'config.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

$professor_id = $_SESSION['professor_id'];

$sql_professor = "SELECT nome FROM professores WHERE codigo='$professor_id'";
$result_professor = $conn->query($sql_professor);
$professor_nome = $result_professor->fetch_assoc()['nome'];

$turma_id = $_GET['turma_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $atividade = $_POST['atividade'];

    $sql = "INSERT INTO demanda (atividade, turma_codigo) VALUES ('$atividade', '$turma_id')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: listar_turmas.php?turma_id=".$turma_id);
    } else {
        echo "Erro ao cadastrar Atividades: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Atividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #1B3954;
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 text-white">Bem-vindo(a), Pr(a). <?php echo $professor_nome; ?></span>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h3>Cadastrar Atividades</h3>
        <div class="row justify-content-end">
            <div class="col-2">            
            <a href="listar_turmas.php" class="btn btn-primary mt-2">Voltar</a>
            </div>
        </div>
        <form method="post" action="cadastrar_prescricao.php?turma_id=<?php echo $turma_id; ?>">
            <div class="mb-3">
                <label for="atividade" class="form-label">ATIVIDADE</label>
                <textarea name="atividade" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
        
    </div>
</body>
</html>