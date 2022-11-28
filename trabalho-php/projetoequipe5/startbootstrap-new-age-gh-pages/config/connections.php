 <?php
 session_start();
//  $host = "localhost";
//  $dbname = "projeto5";
//  $user = "root";
//  $pass = "";
//  $email = $_POST['email'];
 
 define('DB_SERVER', 'localhost');
 define('DB_USERNAME', 'root');
 define('DB_PASSWORD', '');
 define('DB_NAME', 'projeto5');

   try{
      $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
      // Defina o modo de erro PDO para exceção
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e){
      die("ERROR: Não foi possível conectar." . $e->getMessage());
  }

//definindo variáveis e inicializando elas com valores vazios


// $username = $password = $confirm_password = "";
// $username_err = $password_err = $confirm_password_err = "";


// //registro de usuários
// if($_SERVER["REQUEST_METHOD"] == "POST"){

//    //validando nome de usuário
//    if(empty(trim($_POST["username"]))){
//       $username_err = "Por favor, insira um nome de usuário.";
//    }elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
//       $username_err = "O nome de usuário pode conter apenas letras e numeros.";
//    }else{
//       //preparando uma declaração selecionada
//       $sql = "SELECT id FROM users WHERE username = :username";

//       if($stmt = $pdo->prepare($sql)){
//          //vinculando as variáveis à instrução preparada como parâmetros
//          $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

//          //definindo parâmetros
//          $param_username = trim($_POST["username"]);

//          //tentando executar a declaração preparada
//          if($stmt->execute()){
//             if($stmt->rowCount() == 1){
//                $username_err = "Este nome já está em uso.";
//             }else{
//                $username = trim($_POST["username"]);
//             }
//          }else{
//             echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
//          }

//          //fechando declaração
//          unset($stmt);
//       }
//    }

//    //validando senha
//    if(empty(trim($_POST["password"]))){
//       $password_err = "Por favor insira uma senha";
//    }elseif(strlen(trim($_POST["password"])) < 6){
//       $password_err = "A senha deve ter pelo menos 6 caracteres";
//    }else{
//       $password = trim($_POST["password"]);
//    }

//    //confirmação da senha
//    if(empty(trim($_POST["confirm_password"]))){
//       $confirm_password_err = "Por favor, confirme a senha.";
//    }else{
//       $confirm_password = trim($_POST["confirm_password"]);
//       if(empty($password_err) && ($password != $confirm_password)){
//          $confirm_password_err = "As senhas não confere.";
//       }
//    }

//    //verificando os erros de entrada antes de inserir no banco de dados
//    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

//       //preparando uma declaração de inserção
//       $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";

//       if($stmt = $pdo->prepare($sql)){
//          //vinculando as variáveis a instrução preparada como parâmetros
//          $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
//          $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

//          //DEFININDO PARAMETROS
//          $param_username = $username;
//          $param_password = password_hash($password, PASSWORD_DEFAULT);//criando um password hash

//          //executando a delaração preparada
//          if($stmt->execute()){
//             //redirencionando para tela de login
//             header("location: login.php");
//          }else{
//             echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
//          }

//          //fechando declaração
//          unset($stmt);
//       }
//    }

//    //fechando conexão
//    usent($pdo);
// }

//login

// //definindo variáveis
// $username = $password = "";
// $username_err = $password_err = $loggin_err = "";

// //processando os dados do formulário quando o formulário é enviado
// if($_SERVER["REQUEST_METHOD"] == "POST"){

//    //verificando se o nome está vazio
//    if(empty(trim($_POST["username"]))){
//       $username_err = "Insira seu nome de usuário";
//    }else{
//       $username = trim($_POST["username"]);
//    }

//    //verificando se a senha ta vazia
//    if(empty(trim($_POST["password"]))){
//       $password_err = "Insira sua senha.";
//    }else{
//       $password = trim($_POST["password"]);
//    }

//    //validando credenciais
//    if(empty($username_err) && empty($password_err)){

//       //preparando uma declaração selecionanda
//       $sql = "SELECT id, username, password FROM user WHERE username = :username";

//       if($stmt = $pdo->prepare($sql)){
//          //vinculando as variáveis à instrução  preparada como parâmetros
//          $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

//          //definindo parametros
//          $param_username = trim($_POST["username"]);

//          //executando a declaração preparada 
//          if($stmt->execute()){
//             //verificando se o nome de usuário existe, se sim, verifique a senha
//             if($stmt->rowCount() == 1){
//                if($row = $stmt->fetch()){
//                   $id = $row["id"];
//                   $username = $row["username"];
//                   $hashed_password = $row["password"];
//                   if(password_verify($password, $hashed_password)){
//                      //a senha está correta, iniciando uma nova sessão
//                      session_start();

//                      //armazenando dados em variáveis de sessão
//                      $_SESSION["loggedin"] = true;
//                      $_SESSION["id"] = $id;
//                      $_SESSION["username"] = $username;

//                      //redirecionando para a pagina principal
//                      header("location: index.php");
//                   }else{
//                      //a senha não é válida, mensagem de erro genérica
//                      $loggin_err = "Nome de usuário ou senha inválidos.";
//                   }
//                }
//             }else{
//                //o nome do usuário não é válid
//                $loggin_err = "Nome de usuário ou senha inválidos.";
//             }
//          }else{
//             echo "Algo deu errado! Tente novamente mais tarde.";
//          }

//          //fechar declaração
//          unset($stmt);
//       }
//    }

//    //fechar conexão
//    unset($pdo);
// }


?>