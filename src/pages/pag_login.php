<?php
require_once '../scripts_e_outros/config.php';
require_once '../scripts_e_outros/funcoes.php';

$error = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!verificar_csrf_token($_POST['csrf'] ?? '')){
        $error[] = 'Token csrf inválido.';
    }

    $usuariaOuEmail = limpar($_POST['username'] ?? '');
    $senha = $_POST['password'];

    if(!$usuariaOuEmail || !$senha){
        $error[] = 'Preencha o usuario/email e senha.';
    }
    else{
        $comando = $pdo -> prepare('SELECT id_cliente, nome_cliente, senha_hash FROM cliente WHERE nome_cliente = identificador OR email = :identificador LIMIT 1');
        $comando -> execute([':identificador' => $usuariaOuEmail]);
        $usuario = $comando -> fetch();
        if($usuario && password_verify($senha,$user['senha_hash'])){
            session_regenerate_id(1);
            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['username'] = $user['nome_cliente'];
            header('Location:pag_principal.php');
            exit;
        }
        else{
            $error[] = 'Usuario ou senha incorretos.';
        }
    } 
}      

$csrf = gerar_csrf_token();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBelém - Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
    if(!empty($error)):
    ?>
    <ul style="color: red;">  <?php foreach($error as $e) echo "<li>" . $e . "</li>"?>  </ul>

    <?php endif; ?>
    <main class="container">
        <section class="login-box">
            <h1>EcoBelém</h1>
            <p>Produtos Artesanais Amazônicos</p>
            <form action="#" method="post">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="seuemail@exemplo.com" required><br><br>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required><br><br>
                
                <button type="submit">Entrar</button>

                <p class="cadastro">Não tem cadastro?<br><a href="pag_cadastro.php">Cadastre-se</a></p>
            </form>
        </section>
    </main>
</body>
</html>
