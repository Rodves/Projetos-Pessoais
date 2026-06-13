<DOCTYPE html>
<body>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $connect = mysqli_connect("localhost","root","","serviço");

    $query_select = "SELECT * FROM admin WHERE usuario = '$usuario' AND senha = '$senha'";
    $select = mysqli_query($connect,$query_select);
    $array = mysqli_fetch_array($select);
    @$logarray = $array["senha"];

    if($logarray == $senha){
        echo"Erro ao cadastrar cliente: " . $conn->error;
        header("refresh:2;url=adm.php");

    } else {
        header("Location: ./adm_page.php");
    }
    }
    ?>
</html>
</body>