<?php

// CONECTANDO COM O BANCO DE DADOS
$dbname = "projeto5"; // nome do banco de dados
$dbhost = "localhost"; // local onde está o banco de dados
$dbuser = "root"; // nome do usuário do bando de dados
$dbpass = ""; // senha do usuário do bando de dados

$pdo = new PDO("mysql:dbname=" . $dbname . ";host:" . $dbhost . "", "" . $dbuser . "", $dbpass);

// SELECIONANDO DADOS NO BANCO DE DADOS

$sql = $pdo->query("SELECT * FROM users");

// COLOCANDO DADOS NO ARRAY
if ($sql->rowCount() > 0) {
  $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
}


?>
<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/navbar-fixedaaa/">
  <link href="./assets/bootstrap.min.css" rel="stylesheet">
  <link href="./assets/navbar-top-fixed.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark ">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Registro</a>
    </div>
  </nav>

  <a href="index.php" class="btn btn-info mb-3"> Voltar </a>
  
  <main class="container mt-5">
    <div class="bg-light p-5 rounded">
      <h1>Registro de Usuarios</h1>

      
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nome</th>
            <th scope="col">#</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($lista as $users) : ?>
            <tr>
              <th scope="row"><?php echo $users['id']; ?></th>
              <td><?php echo $users['username']; ?></td>
              <td>
                <a href="deletar.php?id=<?php echo $users['id']; ?>" class="btn btn-danger"> Deletar </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  </main>
  <script src="/CRUD_unipe/assets/bootstrap.bundle.min.js"></script>
</body>

</html>