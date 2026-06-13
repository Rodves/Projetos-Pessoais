<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

$sql_admin = "SELECT nome FROM adm WHERE id='$admin_id'";
$result_admin = $conn->query($sql_admin);
$admin_nome = $result_admin->fetch_assoc()['nome'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $professor_nome = $_SESSION['nome'];
    $professor_email = $_POST['email'];

    $sql = "INSERT INTO professores (nome,email) VALUES ('$professor_nome', '$professor_email')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: sucesso.php");
    } else {
        echo "Erro ao cadastrar a turma: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Turma</title>
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
            <span class="navbar-brand mb-0 h1 text-white">Bem-vindo(a), ADMIN. <?php echo $admin_nome; ?></span>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h4>Cadastrar Professor</h4>
        <div class="row justify-content-end">
            <div class="col-2">            
            <a href="listar_professor.php" class="btn btn-primary mt-2">Voltar</a>
            </div>
        </div>
        <form method="post" action="professor_turma.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Professor</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nome" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
        
    </div>
</body>
</html>