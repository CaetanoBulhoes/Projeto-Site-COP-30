<?php
require_once '../scripts_e_outros/config.php';
require_once '../scripts_e_outros/funcoes.php';

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!verificar_csrf_token($_POST['csrf'] ?? '')) {
        $error[] = 'Token CSRF inválido.';
    }

    $usuariaOuEmail = limpar($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (!$usuariaOuEmail || !$senha) {
        $error[] = 'Preencha o usuário/email e senha.';
    } else {
        $comando = $conexao->prepare(
            'SELECT id_cliente, nome_cliente, senha_hash FROM cliente WHERE nome_cliente = ? OR email_cliente = ? LIMIT 1'
        );
        $comando->bind_param('ss', $usuariaOuEmail, $usuariaOuEmail);
        $comando->execute();
        $resultado = $comando->get_result();
        $user = $resultado->fetch_assoc();

        if ($user && password_verify($senha, $user['senha_hash'])) {
            session_regenerate_id(true);
            $_SESSION['id_cliente'] = (int)$user['id_cliente'];
            $_SESSION['username'] = $user['nome_cliente'];
            header('Location: pag_principal.php');
            exit;

        } 
        else {
            $error[] = 'Usuário ou senha incorretos.';
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
    <link rel="stylesheet" href="../style/style_login.css">
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
            <form action="" method="POST">
                <input type="hidden" name="csrf" value="<?= $csrf ?>">
                <label for="email">Usuario ou E-mail</label> <br>
                <input name="usuario" placeholder="seuemail@exemplo.com" required><br><br>

                <label for="senha">Senha</label> <br>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required><br><br>
                
                <button type="submit">Entrar</button> <br>

    
            </form>
            <p class="cadastro">Não tem cadastro?<br><a href="pag_cadastro.php">Cadastre-se</a></p>
        </section>
    </main>
</body>
</html>
