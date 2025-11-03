<?php
require_once '../scripts_e_outros/funcoes.php';
require_once '../scripts_e_outros/config.php';
esta_logado();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
</head>
<body>
    <h2>Olá, <?= htmlspecialchars($_SESSION['username'])?></h2>
    <p>Funcionou?</p>
    <p><a href="../scripts_e_outros/deslogar.php">Sair</a></p>
</body>
</html>