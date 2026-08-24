<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
if (isset($_GET['criar'])) {
    $_SESSION['flash'] = 'Alteração salva.';
    header('Location: index.php');
    exit;
}
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Flash</title><?php if ($flash): ?><p role="status"><?= e($flash) ?></p><?php endif; ?><a href="?criar=1">Criar mensagem</a></html>
