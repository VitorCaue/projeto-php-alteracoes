<?php

include_once("templates/header_auth.php");
require_once("config/connections.php");

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}


$username = $password = "";
$username_err = $password_err = $login_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 

    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor, insira o nome de usuário.";
    } else{
        $username = trim($_POST["username"]);
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, insira sua senha.";
    } else{
        $password = trim($_POST["password"]);
    }
    

    if(empty($username_err) && empty($password_err)){
        // Prepare uma declaração selecionada
        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){

            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            
            $param_username = trim($_POST["username"]);
            
         
            if($stmt->execute()){
                
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                        
                            session_start();
                            
                          
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                        
                            header("location: index.php");
                        } else{
                        
                            $login_err = "Senha inválida.";
                        }
                    }
                } else{
              
                    $login_err = "Nome de usuário inválido.";
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

          
            unset($stmt);
        }
    }
    
   
    unset($pdo);
}


?>

    <div id="main-container" class="container-fluid">
        <div class="col-md-12">
            <div class="row" id="auth-row">
                <div class="col-md-4" id="login-container">
                    <h2>Entrar</h2>

                    <?php 
                        if(!empty($login_err)){
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                        }        
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="type" value="login">
                        <div class="form-group">
                            <label for="username">Nome:</label>
                            <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Digite seu nome">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Digite sua senha">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <input type="submit" class="btn card-btn" value="Entrar">
                        
                    </form>
                 <p>Ainda não é registrado? <a href="<?= $BASE_URL ?>register.php">Crie sua conta aqui!</a></p>   
                </div>
                
            </div>
        </div>
    </div>

    
<?php

include_once("templates/footer.php");

?>