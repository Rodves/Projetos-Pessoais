<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE EMPRESAS</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</head>

<body>
    
        <h1 style="text-align: center;margin: 50px 0;">ATUALIZAR EMPRESA</h1>
        <div class="row justify-content-center container-fluid">
        <div class="card" style="width: 28rem;">
            <div class="container">
            <?php 
                require_once "conexao.php";
                @$sql_query = "SELECT * FROM empresa WHERE cmrj_empresa = ".$_GET["cmrj_empresa"];
                if ($result = $conn ->query($sql_query)) {
                    while ($row = $result -> fetch_assoc()) { 
                        $cmrj_empresa = $row['cmrj_empresa'];
                        $nome_empresa = $row['nome_empresa'];
                        $telefone_empresarial = $row['telefone_empresarial'];
                        $usuario = $row['usuario'];
                        $senha = $row['senha'];
                        
            ?>
                <form method="POST" action="atualizar.php">
                  <input type="hidden" class="form-control" value="<?php echo $cmrj_empresa; ?>" name="cmrj_empresa" id="cmrj_empresa" required>
                    
                    <div class="mb-3">
                        <label class="form-label">USUARIO:</label>
                        <input type="text" class="form-control" value="<?php echo $usuario; ?>" name="usuario" id="usuario" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Senha:</label>
                        <input type="text" class="form-control" value="<?php echo $senha; ?>" name="senha" id="senha" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nome_Empresa:</label>
                        <input type="text" class="form-control" value="<?php echo $nome_empresa; ?>" name="nome_empresa" id="nome_empresa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CMRJ:</label>
                        <input type="text" class="form-control" value="<?php echo $cmrj_empresa; ?>" name="cmrj_empresa" id="cmrj_empresa" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefone_Empresarial:</label>
                        <input type="text" class="form-control" value="<?php echo $telefone_empresarial; ?>" name="telefone_empresarial" id="telefone_empresarial" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">ATUALIZAR</button>
                    </div>
                </form>
                <?php 
                    }
                }
                //$conn->close();
            ?>
            </div>
        </div>
        </div>      
    
</body>

</html>