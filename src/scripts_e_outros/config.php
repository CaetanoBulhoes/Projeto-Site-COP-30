<?php 
declare(strict_types = 1);

$nomedb = "cop_30_db";
$usuario = "root";
$senha = "";
$host = "localhost";

$dsn = "mysql:host=$host;nomedb=$nomedb;charset=utf8mb4";

$opcoes = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try{
    $pdo = new PDO($dsn,$usuario,$senha,$opcoes);
}
catch(PDOException $e){
    exit('Problema ao se conectar com o banco de dados');
}

ini_set('session.cookie.httponly','1')
?>