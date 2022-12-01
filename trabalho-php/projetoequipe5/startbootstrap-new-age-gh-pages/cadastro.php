<?php

include_once("config/connections.php");
include_once("config/url.php");
include_once("templates/header_auth.php");

 if($email == "" || $email == null){
    echo"<script language='javascript' type='text/javascript'>
    alert('O email deve ser preenchido corretamente!');window.location.href='
    cadastro.html';</script>";


      }else{
        $query = "INSERT INTO usuarios (email) VALUES ('$email')";
        $insert = mysql_query();

        if($insert){
          echo"<script language='javascript' type='text/javascript'>
          alert('Email cadastrado com sucesso!');window.location.
          href='login.html'</script>";
        }else{
          echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse );window.location
          .href='cadastro.html'</script>";
        }
      }

?>



<?php

include_once("templates/footer.php");
?>
    