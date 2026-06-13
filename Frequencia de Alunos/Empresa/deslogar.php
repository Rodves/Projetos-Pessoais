<?php
        require_once "conexao.php";
            $sql_query = "SELECT acesso FROM login WHERE acesso = Conectado";
            if ($result = $conn ->query($sql_query)) {
                while ($row = $result -> fetch_assoc()) { 
                  $acesso=$row['acesso'];
                }
            }
        
           if(isset($sql_query)){
           $query = "UPDATE login SET acesso = 'Desconectado' WHERE acesso = $acesso";
            if (mysqli_query($conn, $query)) {
                header("Location:2;url=../Login/index.html");
            } else {
                echo "ERRO AO TENTAR DESCONECTAR!";
                header("refresh:2;url=index.php");
            }
        }
        ?>
       