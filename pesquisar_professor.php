<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENAI CFP JFN</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</head>

<body>
        <form method="post" action="pesquisar_professor.php" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" name="dado" id="dado" placeholder="Pesquisar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
          </form>
        <section style="margin: 50px 0;">
        <div class="container">
            <table class="table table-clear">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOME</th>
                    <th scope="col">EMAIL</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        session_start();
                        include 'config.php';
                        if (!isset($_SESSION['admin_id'])) {
                            header("Location: admin_login.php");
                            exit();
                        }
                        $professor_id = $_GET['professor_id'];
                        $sql_query = "SELECT * FROM professores WHERE codigo = $professor_id";
                        if ($result = $conn ->query($sql_query)) {
                            while ($row = $result -> fetch_assoc()) { 
                                $professor_id = $row['codigo'];
                                $nome_professor = $row['nome'];
                                $email = $row['email'];
                            
                    ?>
                    
                    <tr class="trow">
                        <td><?php echo $professor_id; ?></td>
                        <td><?php echo $nome_professor; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><a href="upload.php"?id=<?php echo $admin_id; ?> class="btn btn-primary">Upload</a></td>
                        <td><a href="atualizar_atividade.php?id=<?php echo $professor_id; ?>" class="btn btn-primary">Atualizar</a></td>
                        <td><a href="deletar_professor.php?id=<?php echo $admin_id; ?>" onclick="return confirm('Tem certeza que deseja deletar este registro?')" class="btn btn-danger">Excluir</a></td>
                    </tr>

                    <?php
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