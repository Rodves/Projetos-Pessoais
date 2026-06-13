
<!DOCTYPE html>
<html>
<head>
    <title>ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #1B3954;
        }
        
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <span class="navbar-brand mb-1 h4 text-white">SISTEMA DE LOGIN ADMIN</span>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <img src="../diretorio/adm_imagem.png" class="rounded" alt="..."style="width:4000;">
                        </div>
                        <div class="text-center">
                            BEM VINDO ADM
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="login_adm.php">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="senha" class="form-control" required>
                            </div>
                                <button type="submit" class="btn btn-primary" style="margin:0;">ENTRAR</button>
                                <a href="index.php" class="btn btn-primary mb-2"style="text-align:right;">VOLTAR</a>
                        </form>
                        <?php if (isset($error_message)): ?>
                            <div class="alert alert-danger mt-3">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>