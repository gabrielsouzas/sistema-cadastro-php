<?php
  // Classe que quando instanciada cria uma conexão com o banco de dados
  try {
    $host= 'localhost';
    $db = 'estudos';
    $user = 'postgres';
    $password = 'admin';
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
    // faz a conexão com a base de dados
    $connpdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
  } catch (PDOException $e) {
    die($e->getMessage());
  }

?>