<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
setcookie('densidade', 'confortavel', [
    'expires' => time() + 2592000,
    'path' => '/',
    'secure' => isHttps(),
    'httponly' => true,
    'samesite' => 'Lax',
]);
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Opções</title><p>Preferência não sensível salva.</p></html>
