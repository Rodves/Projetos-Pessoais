<DOCTYPE html>
  <body>
    <?php
    $entrar = $_POST["entrar"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $connect = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connect,"frequencia");
      if (isset($entrar)) {
    
        $verifica = mysqli_query($connect, "SELECT * FROM login WHERE senha = '$senha'")
        $verificador = mysqli_query($connect, "SELECT * FROM empresa WHERE senha = '$senha'")
        or die("erro ao selecionar");
          if (mysqli_num_rows($verifica)<=0) or (mysqli_num_rows($verificador)<=0){
            echo"<div class=\"alert alert-warning\" role=\"alert\">O campo login deve ser preenchido!</div>";
            header("refresh:2;url=index.html");
            die();

          }else{
              header("refresh:2;url=../Empresa/index.php");
            }
          }
    ?>  
  </body>
</html>
