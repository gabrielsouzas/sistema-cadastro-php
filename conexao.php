<?php

  try {
    $host= 'localhost';
    $db = 'estudos';
    $user = 'postgres';
    $password = 'admin';
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
    // faz a conexão com a base de dados
    $connpdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    //return $pdo;
    
  } catch (PDOException $e) {
    die($e->getMessage());
  } /*finally {
    if ($pdo) {
      $pdo = null;
    }
  }*/
  
function buscar_carros(){
  // conecta ao banco de dados
  $con_string = "host=localhost port=5432 dbname=estudos user=postgres password=admin";
  $con = pg_connect($con_string) or die ("Nao foi possivel estabelecer uma conexao com o servidor PostGreSQL");
  // cria a instrução SQL que vai selecionar os dados
  $query = "SELECT * FROM carro;";
  // executa a query
  $dados = pg_query($con, $query) or die(pg_last_error());
  // transforma os dados em um array
  //$linha = pg_fetch_assoc($dados);
  // calcula quantos dados retornaram
  //$total = pg_num_rows($dados);

  return $dados;
}

function conectarbd(){
  // conecta ao banco de dados
  $con_string = "host=localhost port=5432 dbname=estudos user=postgres password=admin";
  $con = pg_connect($con_string) or die ("Nao foi possivel estabelecer uma conexao com o servidor PostGreSQL");

  return $con;
}

function conectarbdpdo(){
  try {
    $host= 'localhost';
    $db = 'estudos';
    $user = 'postgres';
    $password = 'admin';
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
    // faz a conexão com a base de dados
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  
    return $pdo;
    
  } catch (PDOException $e) {
    die($e->getMessage());
  } /*finally {
    if ($pdo) {
      $pdo = null;
    }
  }*/

  
}

// tira o resultado da busca da memória
//pg_free_result($dados);
?>