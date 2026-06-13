<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="config.css">
</head>
<body style="background-color: black;">
<h1 style="text-align: center; padding-top: 50px; font-size: 50px;color:gold;">LOGIN</h1>
    <div class="row justify-content-center container-fluid">
    <div class="mb-4" style="width: 28rem; margin-top: 5%; margin-left: 11%;">
        <div class="centralizar">
        <form method="Post" action="login.php">
        <div class="nb-3"style="width: 70%;">
                <label class="form-label" style="color: white">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe seu Nome de Usuario" required>
            </div>
            <div class="nb-3"style="width: 70%;">
                <label class="form-label"style="color: white">CPF</label>
                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Informe seu CPF" required>
            </div>
            <div class="nb-3" style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary botao" style="background-color:black;border-color:gold;">Entrar</button>
                <a href="./cadastro.php" class="btt" style="padding-left: 80px; font-weight: 700; font-size: 20px; padding: 20px;color:gold;">Cadastre-se</a>
            </div>
        </form>
            </div>
        </div>
    </div>
    </div>        
</body>
</html>