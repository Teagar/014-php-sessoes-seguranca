<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    if (!validCsrf($_POST['csrf'] ?? null)) {
        http_response_code(403);
        exit('Token CSRF inválido.');
    }
    $_SESSION['flash'] = 'Alteração salva.';
    header('Location: index.php');
    exit;
}
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$token = e(csrfToken());
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Flash</title><?php if ($flash): ?><p role="status"><?= e($flash) ?></p><?php endif; ?><form method="post"><input type="hidden" name="csrf" value="<?= $token ?>"><button type="submit">Criar mensagem</button></form></html>
