<?php
 require_once "conexao.php";

 @$sql_query = "SELECT * FROM empresa WHERE cmrj_empresa = ".$_GET["cmrj_empresa"];

if(isset($_FILES)) {

print_r($_FILES);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
    <div id="main-container" class="container-fluid">
     <form action="<?= $BASE_URL ?>upload.php" method="POST" enctype="multipart/form-data"></form>
     <div class="col-md-4">
      <div id="profile-image-container">
      <input type="file" class="form-control-flie" name="image">
    </div>
</div>
    </div>

<!--<div class=" ">
    <form action="upload.php" method="POST" enctype="multipart/form-data"></form>
    <input type="file" name="imagem">
    <button type="submit">Enviar</button>
</div>!-->


</body>
</html>


