<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CADASTRO DE CLIENTES</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="detalhe.css">
</head>

<body>
   <?php require_once "../empresa/conexao.php";?>
    <nav id="navbar-main" class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="senai-logo-5.png" alt="" style="width: 200px; height: 50px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="listar_empresa.php">Listar Empresas</a>
            </li>
          </ul>
           
          <form method="post" action="pesquisa.php" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="dado" id="dado" placeholder="Pesquisar" aria-label="Search">
            <button class="btn btn-primary my-2 my-sm-0" type="submit">Pesquisar</button>
            <form method="post" action="deslogar.php" class="form-inline my-2 my-lg-0">
            <button class="btn btn-primary" type="submit">SAIR</button>
          </form> 
          </form>
          
        </div>
      </nav>
    
    </body>

</html>