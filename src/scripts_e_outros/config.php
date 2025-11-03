<?php 
declare(strict_types = 1);

ini_set('session.cookie.httponly','1');

session_start();

$db_host = 'localhost';
$nome_db= 'cop30db';
$usuario = 'root';
$senha = '123456';


try {

    $conexao = new mysqli($db_host,$usuario,$senha,$nome_db);
} 
catch (mysqli_sql_exception $e) {
    exit('Problema ao se conectar com o banco de dados: ' . $e->getMessage());
}

?>