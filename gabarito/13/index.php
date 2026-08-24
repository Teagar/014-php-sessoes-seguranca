<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
if (!isset($_SESSION['usuario']['user_id'])) { header('Location: login.php', true, 302); exit; }
$nome = e((string) $_SESSION['usuario']['nome']);
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Privado</title><p>Olá, <?= $nome ?>.</p></html>
