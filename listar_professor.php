<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$professor_id = isset($_GET['professor_id']) ? $_GET['professor_id'] : '';
$admin_id = $_SESSION['admin_id'];

$sql_professor = "SELECT nome FROM professores WHERE codigo='$professor_id'";
$result_professor = $conn->query($sql_professor);
$professor_nome = ($result_professor->num_rows > 0) ? $result_professor->fetch_assoc()['nome'] : '';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Listar Professores</title>
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
            <span class="navbar-brand mb-0 h1 text-white">Bem-vindo, ADMIN: <?php echo $_SESSION['admin_nome']; ?></span>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h4>Professores: <?php echo $professor_nome; ?></h4>
        <div class="row justify-content-end">
            <div class="col-3">
                <a href="cadastrar_professor.php" class="btn btn-primary mb-2">Cadastrar Professor</a>
                <a href="deletar_professor.php?professor_id=<?php echo $professor_id; ?>" class="btn btn-success mb-2">Deletar Professor</a>
            </div>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM professores WHERE codigo='$professor_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['codigo']."</td>";
                        echo "<td>".$row['nome']."</td>"; 
                        echo "<td>".$row['email']."</td>"; 
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum Professor cadastrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
    </div>
</body>
</html>
```
