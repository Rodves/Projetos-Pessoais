<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE CLIENTES</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</head>

<body>
<?php require "config.php" ?>;
        <h1 style="text-align: center;margin: 50px 0;">RELAÇÃO DE CLIENTES</h1>
        <section style="margin: 50px 0;">
        <div class="container">
            <table class="table table-clear">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOME</th>
                    <th scope="col">CPF</th>
                    <th scope="col">E-MAIL</th>
                    <th scope="col">TELEFONE</th>
                    <th scope="col">DATA_NASCIMENTO</th>
                    <th scope="col">IDADE</th>
                    <th scope="col" colspan="2" style="text-align: jcenter;">AÇÕES</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once "Conexao.php";
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $dado = $_POST["dado"];
                        $sql_query = "SELECT * FROM empresa WHERE cmrj_empresa = $dado OR telefone_empresarial = $dado";
                        if ($result = $conn ->query($sql_query)) {
                            while ($row = $result -> fetch_assoc()) { 
                                $cmrj_empresa = $row['cmrj_empresa'];
                                $nome_empresa = $row['nome_empresa'];
                                $telefone_empresarial = $row['telefone_empresarial'];
                    ?>
                    
                    <tr class="trow">
                        <td><?php echo $cmrj_empresa; ?></td>
                        <td><?php echo $nome_empresa; ?></td>
                        <td><?php echo $telefone_empresarial; ?></td>
                        <td><a href="update.php?id=<?php echo $cmrj; ?>" class="btn btn-primary">Editar</a></td>
                        <td><a href="deletar.php?id=<?php echo $cmrj; ?>" onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn btn-danger">Excluir</a></td>
                    </tr>

                    <?php
                            } 
                        }
                    }
                    $conn->close(); 
                    ?>
                </tbody>
              </table>
        </div>
    </section>  
    
</body>

</html>