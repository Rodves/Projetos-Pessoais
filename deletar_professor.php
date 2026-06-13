<!DOCTYPE html>
<html>
<head>
    <title>Deletar Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #1B3954;
        }
    </style>
</head>
<body>
<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$professor_id = $_GET['professor_id'];

$sql = "SELECT * FROM professores WHERE codigo='$professor_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: erro.php");    
} else {
    $sql = "DELETE FROM professores WHERE codigo='$professor_id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: listar_professor.php");
    } else {
        echo "Erro ao deletar a turma: " . $conn->error;
    }
}
?>
<div class="row">
    <div class="col-12 d-flex justify-content-center">
    <a href="listar_professor.php" class="btn btn-primary mb-2">Voltar</a>
</div>

</body>
</html>