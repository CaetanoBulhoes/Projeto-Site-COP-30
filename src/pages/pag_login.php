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
            header('Location: pag_Eco.php');
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
    <link rel="stylesheet" href="../style/style_login2.css">
</head>
<body>
    
    <main class="container">
    <section class="login-box">
        <h1>EcoBelém</h1>
        <p>Produtos Artesanais Amazônicos</p>

        <?php if (!empty($error)): ?>
    <div class="erro">
        <?php foreach ($error as $e): ?>
            <p><?= $e ?></p>
        <?php endforeach; ?>
    </div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="csrf" value="<?= $csrf ?>">

            <label for="email">Usuario ou E-mail</label>
            <input name="usuario" placeholder="seuemail@exemplo.com" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

            <button type="submit">Entrar</button>
        </form>

        <p class="cadastro">Não tem cadastro?<br><a href="pag_cadastro.php">Cadastre-se</a></p>
    </section>
</main>
</body>
</html>
