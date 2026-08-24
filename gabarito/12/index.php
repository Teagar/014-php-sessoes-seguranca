<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
$hash = password_hash('Estudo#2026', PASSWORD_DEFAULT);
if (password_verify('Estudo#2026', $hash)) {
    session_regenerate_id(true);
    $_SESSION['usuario'] = ['user_id' => 7, 'nome' => 'Ana', 'papel' => 'estudante'];
}
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Identidade</title><p>Identidade mínima armazenada.</p></html>
