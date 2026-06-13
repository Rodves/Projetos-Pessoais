<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="config.css">
</head>
<body style="background-color: black;">
<h1 class="cadastro" style="text-align: center;margin: 40px 0;color:white;">Cadastro de Usuario</h1>
    <div class="row justify-content-center container-fluid">
    <div class="card" style="width: 28rem;background-color: black;">
    <div class="container">
        <form method="Post" action="cadastro_back.php">
            <div class="mb-3">
                <label class="form-label" style="color: white">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Informe seu Nome de Usuario" required>
            </div>
            <div class="mb-3">
                <label class="form-label"style="color: white">CPF</label>
                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Informe seu CPF" required>
            </div>
            <div class="mb-3">
                <label class="form-label"style="color: white">TELEFONE</label>
                <input type="tel" class="form-control" name="telefone" id="telefone" placeholder="Informe Telefone de Contato" required>
            </div>
            <div class="mb-3">
                <label class="form-label"style="color: white">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Informe seu Email" required>
            </div>
            <div class="mb-3">
                <label class="form-label"style="color: white">Endereço</label>
                <input type="text" class="form-control" name="endereço" id="endereço" placeholder="Informe seu Endereço" required>
            </div>
            <div class="mb-3">
                <label class="form-label"style="color: white">Bairro</label>
                <input type="text" class="form-control" name="bairro" id="bairro" placeholder="Informe seu Bairro" required>
            </div>
            <div class="mb-3">
                <label class="form-label" style="color: white; padding: 5px">Cidade</label>
                <select class="form-control" name="cidade" id="cidade">
                    <option selected>CEP</option>
                    <option value="Juiz de Fora">Juiz de Fora</option>
                    <option value="Amapa">Amápa</option>
                    <option value="Muriae">Múriae</option>
                    <option value="Barbacena">Barbacena</option>
                    <option value="Petropolis">Petrópolis</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"style="background-color:black;border-color:black;color:gold;">CADASTRAR</button>
        </form>     
    </div>
    </div>
    </div>
</body>
</html>