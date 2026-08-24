<?php
declare(strict_types=1);
$mensagem = '';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = (string) ($_POST['senha'] ?? '');
    $mensagem = $email && $senha !== '' ? 'Dados recebidos para verificação.' : 'Credenciais inválidas.';
}
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Login</title><form method="post"><label>Email <input name="email" type="email" autocomplete="username" required></label><label>Senha <input name="senha" type="password" autocomplete="current-password" required></label><button>Entrar</button></form><?php if ($mensagem): ?><p><?= htmlspecialchars($mensagem) ?></p><?php endif; ?></html>
