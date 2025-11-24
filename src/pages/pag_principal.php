<?php
require_once '../scripts_e_outros/funcoes.php';
require_once '../scripts_e_outros/config.php';
precisa_logar();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBelém - Home</title>
</head>
<body>
    <h2>Olá, <?= htmlspecialchars($_SESSION['username'])?></h2>
    <p>Funcionou? não</p>
    <p><a href="pag_adicionar_produtos.php">Adicionar produto</a></p>
    <p><a href="../scripts_e_outros/deslogar.php">Sair</a></p>
</body>
</html>