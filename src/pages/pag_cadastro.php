<?php
require_once '../scripts_e_outros/config.php';
require_once '../scripts_e_outros/funcoes.php';

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!verificar_csrf_token($_POST['csrf'] ?? '')) {
        $error[] = 'O Token é inválido.';
    }

    $usuario = limpar($_POST['usuario'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'] ?? '';
    $confirme_senha = $_POST['confirme_senha'] ?? '';
    

    if (!$usuario) $error[] = "Nome de usuário obrigatório!";
    if (!$email) $error[] = "Email inválido.";
    if (strlen($senha) < 6) $error[] = "A senha deve ter pelo menos 6 caracteres.";
    if ($confirme_senha !== $senha) $error[] = "As senhas não estão iguais.";

    if (empty($error)) {
        $comando = $conexao->prepare('SELECT id_cliente FROM cliente WHERE nome_cliente = ? OR email_cliente = ? LIMIT 1');
        $comando->bind_param('ss', $usuario, $email);
        $comando->execute();
        $resultado = $comando->get_result();

        if ($resultado->fetch_assoc()) {

            $error[] = "Usuário ou email já cadastrado.";

        } else {
           
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        
            $inserir = $conexao->prepare('INSERT INTO cliente (`nome_cliente`,`email_cliente`,`senha_hash`) VALUES (?,?,?)');
            $inserir->bind_param('sss', $usuario, $email, $senha_hash);

            if ($inserir->execute()) {
                $_SESSION['user_id'] = (int)$conexao->insert_id;
                $_SESSION['username'] = $usuario;

                header('Location:pag_Eco.php');
                exit;

            } else {
                $error[] = "Erro ao tentar cadastrar.";
            }
        }
    }
}

$csrf = gerar_csrf_token();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBelém - Cadastro</title>
    <link rel="stylesheet" href="../style/style_cadastro.css">
</head>
<body>

<main class="container">
    <section class="cadastro-box">
        <h1>EcoBelém</h1>
        <p>Crie sua conta</p>

        <?php if(!empty($error)): ?>
            <div class="erro">
                <?php foreach($error as $e): ?>
                    <p><?= htmlspecialchars($e) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="hidden" name="csrf" value="<?= $csrf ?>">

            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" required
                   value="<?= isset($usuario) ? htmlspecialchars($usuario) : '' ?>">

            <label for="email">Email</label>
            <input type="text" name="email" required
                   value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

            <label for="senha">Senha</label>
            <input type="password" name="senha" required>

            <label for="confirme_senha">Repita a senha</label>
            <input type="password" name="confirme_senha" required>

            <button type="submit">Cadastrar</button>
        </form>

        <p class="login-voltar">
            Já possui cadastro? <a href="pag_login.php">Entrar</a>
        </p>
    </section>
</main>

</body>
</html>