<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    if (!validCsrf($_POST['csrf'] ?? null)) { http_response_code(403); exit('Token CSRF inválido.'); }
    exit('Alteração aceita.');
}
$token = e(csrfToken());
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Validar CSRF</title><form method="post"><input type="hidden" name="csrf" value="<?= $token ?>"><button>Alterar</button></form></html>
