<?php

// CONECTANDO COM O BANCO DE DADOS
$dbname = "projeto5"; // nome do banco de dados
$dbhost = "localhost"; // local onde está o banco de dados
$dbuser = "root"; // nome do usuário do bando de dados
$dbpass = ""; // senha do usuário do bando de dados

$pdo = new PDO("mysql:dbname=" . $dbname . ";host:" . $dbhost . "", "" . $dbuser . "", $dbpass);

// Pegando o ID e lendo o ID via botão

$id = filter_input(INPUT_GET, 'id');

// VERIFICANDO E APAGANDO OS DADOS DO ID SELECIONADO

if ($id){

  $sql = $pdo->prepare("DELETE FROM users WHERE id = :id");
  $sql->bindValue(':id', $id);
  $sql->execute();

}

// REDIRENCIONANDO PARA URL ....
header("Location: lista.php")

?>