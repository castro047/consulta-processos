<?php
session_start();
require_once '../config.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    $stmt = $pdo->prepare("
        SELECT usuarios.*, empresas.nome AS empresa_nome, empresas.slug AS empresa_slug
        FROM usuarios
        INNER JOIN empresas ON empresas.id = usuarios.empresa_id
        WHERE usuarios.usuario = ? AND usuarios.ativo = 1 AND empresas.ativo = 1
        LIMIT 1
    ");
    $stmt->execute([$usuario]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['empresa_id'] = $user['empresa_id'];
        $_SESSION['empresa_nome'] = $user['empresa_nome'];
        $_SESSION['empresa_slug'] = $user['empresa_slug'];

        header('Location: dashboard.php');
        exit;
    }

    $erro = 'Usuário ou senha incorretos.';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrativo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="login-body">

<section class="login-card">
    <h1>Painel Administrativo</h1>
    <p>Acesse para cadastrar e editar os processos da empresa.</p>

    <?php if ($erro): ?>
        <div class="alert-error"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>
            Usuário
            <input type="text" name="usuario" placeholder="Digite seu usuário" required>
        </label>

        <label>
            Senha
            <input type="password" name="senha" placeholder="Digite sua senha" required>
        </label>

        <button type="submit">Entrar</button>
    </form>

    <small>Usuário teste: <strong>admin</strong> · Senha: <strong>123456</strong></small>
</section>

</body>
</html>
