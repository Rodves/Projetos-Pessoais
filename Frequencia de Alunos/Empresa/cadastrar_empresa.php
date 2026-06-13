<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE CLIENTES</title>
    <link rel="stylesheet" href="detalhe.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="detalhe.css">
</head>


<body>
    <?php require "config.php" ?>;
             <h1 style="text-align: center;margin: 40px 0;">Cadastro De Empresas</h1>
             <div class="row justify-content-center container-fluid">
              <div class="card" style="width: 28rem;">
               <div class="container">
                <form method="Post" action="registro_empresa.php">
                    <div class="mb-3">
                        <label class="form-label">USUARIO</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Informe seu Nome de Usuario" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SENHA</label>
                        <input type="text" class="form-control" name="senha" id="senha" placeholder="Informe sua Senha" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">TELEFONE EMPRESARIAL</label>
                        <input type="tel" class="form-control" name="telefone_empresarial" id="telefone_empresarial" placeholder="Informe Telefone de Contato" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CNPJ</label>
                        <input type="text" class="form-control" name="cmrj_empresa" id="cmrj_empresa" placeholder="Informe seu CNRJ" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">NOME DA EMPRESA</label>
                        <input type="text" class="form-control" name="nome_empresa" id="nome_empresa" placeholder="Informe o Nome da Empresa" required>
                    </div>
                       <button type="submit" class="btn btn-primary">CADASTRAR</button>
</form>
                </div>
        </div>
        </div>      
            </div>
        </div>
   
   
        
</body>

</html>

    