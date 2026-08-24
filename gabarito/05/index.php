<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
$_SESSION['idioma'] = 'pt-BR';
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Sessão</title><p>Idioma: <?= e($_SESSION['idioma']) ?></p></html>
