<?php
// Página para cadastrar novos professores
// Inicia a sessão para verificar se o admin está logado
session_start();
// Inclui o arquivo de configuração com dados de conexão ao banco de dados
include 'config.php';

// Verifica se o admin não está logado
if (!isset($_SESSION['admin_id'])) {
    // Redireciona para a página de login do admin
    header("Location: admin_login.php");
    exit();
}

// Armazena o ID do admin da sessão
$admin_id = $_SESSION['admin_id'];

// SQL para buscar os dados do admin logado
$sql_admin = "SELECT nome FROM adm WHERE id='$admin_id'";
$result_admin = $conn->query($sql_admin);
// Obtém o nome do admin do resultado da query
$admin_nome = $result_admin->fetch_assoc()['nome'];


// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe o nome do professor da sessão (deve estar armazenado previamente)
    $professor_nome = $_SESSION['nome'];
    // Recebe o email do formulário
    $professor_email = $_POST['email'];

    // SQL para inserir novo professor no banco de dados
    $sql = "INSERT INTO professores (nome,email) VALUES ('$professor_nome', '$professor_email')";
    
    // Executa a query e verifica se foi bem-sucedida
    if ($conn->query($sql) === TRUE) {
        // Se foi bem-sucedida, redireciona para página de sucesso
        header("Location: sucesso.php");
    } else {
        // Se houve erro, exibe a mensagem de erro
        echo "Erro ao cadastrar a turma: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Turma</title>
    <!-- Importa o CSS do Bootstrap para estilização -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Define a cor do navbar (barra de navegação) */
        .navbar-custom {
            background-color: #1B3954;
        }
    </style>
</head>
<body>
    <!-- Navbar customizada com cor escura -->
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <!-- Exibe mensagem de boas-vindas com o nome do admin -->
            <span class="navbar-brand mb-0 h1 text-white">Bem-vindo(a), ADMIN. <?php echo $admin_nome; ?></span>
            <!-- Botão para fazer logout -->
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </nav>
    <div class="container mt-5">
        <h4>Cadastrar Professor</h4>
        <!-- Linha com botão para voltar à listagem de professores -->
        <div class="row justify-content-end">
            <div class="col-2">            
            <a href="listar_professor.php" class="btn btn-primary mt-2">Voltar</a>
            </div>
        </div>
        <!-- Formulário para cadastro de professor -->
        <form method="post" action="professor_turma.php">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Professor</label>
                <!-- Campo de entrada para nome do professor -->
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nome" class="form-label">Email</label>
                <!-- Campo de entrada para email do professor -->
                <input type="email" name="email" class="form-control" required>
            </div>
            
            <!-- Botão para submeter o formulário -->
            <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
        
    </div>
</body>
</html>
