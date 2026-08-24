<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
$mensagem = '';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $agora = time();
    if ((int) ($_SESSION['bloqueado_ate'] ?? 0) > $agora) {
        $mensagem = 'Aguarde antes de tentar novamente.';
    } elseif (password_verify((string) ($_POST['senha'] ?? ''), password_hash('Estudo#2026', PASSWORD_DEFAULT))) {
        unset($_SESSION['falhas'], $_SESSION['bloqueado_ate']);
        $mensagem = 'Autenticação concluída.';
    } else {
        $_SESSION['falhas'] = (int) ($_SESSION['falhas'] ?? 0) + 1;
        if ($_SESSION['falhas'] >= 3) { $_SESSION['bloqueado_ate'] = $agora + 30; }
        $mensagem = 'Credenciais inválidas.';
    }
}
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Tentativas</title><form method="post"><label>Senha <input type="password" name="senha" required></label><button>Testar</button></form><p><?= e($mensagem) ?></p></html>
