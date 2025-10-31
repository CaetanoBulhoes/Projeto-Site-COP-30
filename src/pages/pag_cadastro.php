<?php 
require_once('../scripts_e_outros/config.php');
require_once('../scripts_e_outros/funcoes.php');

$error = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!verificar_csrf_token($_POST('csrf') ?? '')){
        $error[] = 'O Token é inválido.';
    }

    $usuario = limpar($_POST['usuario'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'] ?? '';
    $confirme_senha = $_POST['confirme_senha'] ?? '';

    if(!$usuario) $error[] = "Nome de usário obrigatorio!";
    if(!$email) $error[] = "Email inválido.";
    if(strlen($senha) < 6) $error[] = "A senha deve ter pelo menos 6 caracteres.";
    if($confirme_senha !== $senha) $error[] = "As senhas não estão iguais ";

    if(empty($error)){
       $comando = $pdo -> prepare('SELECT id_cliente FROM cliente WHERE nome_cliente = :usuario OR email_cliente = :email LIMIT 1');
       $comando -> execute([':usuario' => $usuario,':email' => $email]);
       if($comando->fetch()){
            $error[] = 'Usuário ou email já cadastrado.'; 
       }
    }
    else{
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $comando = $pdo-> prepare('INSERT INTO cliente (`nome_cliente`,`email_cliente`,`senha_hash`) VALUES (:usuario,:email,:senha_hash)');
        $comando->execute([':usuario'=> $usuario, ':email' => $email,':senha_hash' => $senha_hash]);

        $_SESSION['user_id'] = (int)$pdo-> lastInsertId();
        $_SESSION['user'] = $usuario;
        header('Location:pag_principal.php');
        exit;
    }
}
$csrf = gerar_csrf_token();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title> 
</head>
<body>

    <h1>Cadastra-se</h1>
    <?php if(!empty($error)): ?>
     <ul style="color: red;"> 
        <?php
        foreach($error as $e) echo "<li>" . htmlspecialchars($e) . "</li>";
        ?>

     </ul>
     <?php endif;?>
    <form action="POST">
        <input type="hidden" name="csrf" id="<?= $csrf ?>">
        <label for="usuario">Usuário<:/label> <br>
        <input type="text" name="usuario" required <?= isset($usuario) ? htmlspecialchars($usuario) : '' ?>> <br><br>
        <label for="email">Email:</label> <br>
        <input type="text" name="email" required <?= isset($_POST['email']) ? htmlspecialchars($email) : '' ?>> <br><br>
        <label for="senha">Senha:</label> <br>
        <input type="password" name="senha" required > <br><br>
        <label for="confirma_senha">Repita a senha:</label> <br>
        <input type="password" name="confirma_senha" required > <br><br>
    </form>
    <p>Já possui cadastro? <a href="pag_login.php">Login</a></p>
</body>
</html>