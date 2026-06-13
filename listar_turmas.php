<?php
session_start();
include 'config.php';

if (!isset($_SESSION['professor_id'])) {
    header("Location: login.php");
    exit();
}

//define o nome da sessão pelo id do médico
$professor_id = $_SESSION['professor_id'];

//recupera o nome do médico de acordo com o id da sessão
$sql_professor = "SELECT nome FROM professores WHERE codigo='$professor_id'";
$result_professor = $conn->query($sql_professor);
$professor_nome = $result_professor->fetch_assoc()['nome'];

$sql = "SELECT * FROM turmas WHERE professor_codigo='$professor_id'";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Listar Pacientes</title>
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
            <span class="navbar-brand mb-0 h1 text-white">Bem-vindo(a), Dr(a). <?php echo $professor_nome; ?></span>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h4>Turmas</h4>
        <div class="row justify-content-end">
            <div class="col-2">            
            <a href="cadastrar_turma.php" class="btn btn-success mb-2">Cadastrar Turma</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['codigo']."</td>";
                        echo "<td>".$row['nome']."</td>";
                        echo "<td><a href='listar_demandas.php?turma_id=".$row['codigo']."' class='btn btn-info btn-sm'>Ver Atividades</a> ";
                        echo "<a href='deletar_turma.php?turma_id=".$row['codigo']."' class='btn btn-danger btn-sm'>Deletar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhuma turma cadastrado</td></tr>";
                }
                ?>
            </tbody>
        </table>        
    </div>
</body>
</html>