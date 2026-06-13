<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php require_once "menu_p.php" ?>
    <h1 style="text-align: center;margin: 50px 0;">Área de Serviços</h1>
    <section style="margin: 50px 0;">
    <div class="container">
    <form method="Post" action="solicitacao_back.php">
        <table class="table table-clear">
        <div class="mb-3">
            <label class="form-label" style="color: white">CPF</label>
            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Informe seu CPF" required>
        </div>
        <div class="mb-3">
            <label class="form-label" style="color: white">DATA</label>
            <input type="date" class="form-control" name="data" id="data" required>
        </div>
        <div class="mb-3">
            <label class="form-label" style="color: black; padding: 5px">Prioridade</label>
            <select class="form-control" name="prioridade" id="prioridade">
                <option selected>Prioridade</option>
                <option value="Baixa">Baixa</option>
                <option value="Media">Média</option>
                <option value="Alta">Alta</option>
            </select>
        </div>
        </table>
        <div class="mb-3">
            <label class="form-label" style="color: white">Descrição do Serviço</label>
            <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Informe os Detalhes do Serviço" required>
        </div>
        </form>
    </div>
    </section>
</body>
</html>