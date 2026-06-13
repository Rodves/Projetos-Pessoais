<?php
session_start();
include 'config.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

$turma_id = $_GET['turma_id'];
$professor_id = $_SESSION['professor_id'];

// Obter nome do paciente
$sql_turma = "SELECT nome FROM turmas WHERE codigo='$turma_id'";
$result_turma = $conn->query($sql_turma);
$turma_nome = $result_turma->fetch_assoc()['nome'];

// Obter nome do médico
$sql_professor = "SELECT nome FROM professores WHERE codigo='$professor_id'";
$result_professor = $conn->query($sql_professor);
$professor_nome = $result_professor->fetch_assoc()['nome'];

// Obter prescrições
$sql = "SELECT * FROM demanda WHERE turma_codigo='$turma_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Listar Atividades</title>
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
        <h4>Atividades do(a)s turmas: <?php echo $turma_nome; ?></h4>
        <div class="row justify-content-end">
            <div class="col-3">
            <a href="listar_turmas.php" class="btn btn-primary mb-2">Voltar</a>
            <a href="cadastrar_atividade.php?turma_id=<?php echo $turma_id; ?>" class="btn btn-success mb-2">Cadastrar ATIVIDADES</a>
            </div>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Atividade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['codigo']."</td>";
                        echo "<td>".$row['atividade']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nenhuma Atividade cadastrada</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>