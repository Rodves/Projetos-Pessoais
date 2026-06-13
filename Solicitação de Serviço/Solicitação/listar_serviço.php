<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem das Solicitações</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</head>

<body>
<?php require_once "./menu_p.php"; ?>
        <h1 style="text-align: center;margin: 50px 0;">Solicitações</h1>
        <section style="margin: 50px 0;">
        <div class="container">
            <table class="table table-clear">
                <thead>
                <tr>
                    <th scope="col">CPF</th>
                    <th scope="col">DATA</th>
                    <th scope="col">PRIORIDADE</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once "./conexao.php";
                        $sql_query = "SELECT * FROM aluno";
                        if ($result = $conn ->query($sql_query)) {
                            while ($row = $result -> fetch_assoc()) { 
                                $cpf = $row['cpf'];
                                $data = $row['data'];
                                $prioridade = $row['prioridade'];
                    ?>
                    
                    <tr class="trow">
                        <td><?php echo $cpf; ?></td>
                        <td><?php echo $data; ?></td>
                        <td><?php echo $prioridade; ?></td>
                        <td><a href="update.php?id=<?php echo $cof; ?>" class="btn btn-primary">Editar</a></td>
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