<?php
include_once("templates/header_auth.php");


$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
   
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            
            $param_username = trim($_POST["username"]);
            
           
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "Este nome de usuário já está em uso.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            
            unset($stmt);
        }
    }
    
   
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor insira uma senha.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
  
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirme a senha.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "A senha não confere.";
        }
    }
    
 
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
 
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $pdo->prepare($sql)){
        
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
        
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
         
            if($stmt->execute()){
                
                header("location: login.php");
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
                <div class="col-md-4" id="register-container">
                    <h2>Criar Conta</h2>
                    <p>Por favor preencha esse formulário para criar uma conta.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="type" value="register">
                        <!-- <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
                        </div> -->
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="name" name="username" value="<?php echo $username; ?>" placeholder="Digite seu nome">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <!-- <div class="form-group">
                            <label for="lastname">Sobrenome:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite seu sobrenome">
                        </div> -->
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?php echo $password; ?>" placeholder="Digite sua senha">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirme sua senha:</label>
                            <input type="password" class="form-control ?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" id="confirm_password" name="confirm_password" value = "<?php echo $confirm_password; ?>" placeholder="Confirme sua senha">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn card-btn" value="Cadastrar">
                        </div>
                        <p>Já tem uma conta? <a href="login.php">Entre aqui</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
<?php

include_once("templates/footer.php");

?>