<DOCTYPE html>
<body>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $connect = mysqli_connect("localhost","root","","serviço");

    $query_select = "SELECT * FROM login WHERE nome = '$nome' AND cpf = '$cpf'";
    $select = mysqli_query($connect,$query_select);
    $array = mysqli_fetch_array($select);
    @$logarray = $array["cpf"];

    if($logarray == $cpf){
        echo"<div class=\"alert alert-warning\" role=\"alert\">Este login já existe!</div>";
        header("refresh:2;url=index.php");

    } else {
        header("Location: ../Solicitação/solicitacao.php");
    }
    }
    ?>
</html>
</body>