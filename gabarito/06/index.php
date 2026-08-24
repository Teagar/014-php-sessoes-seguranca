<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
$_SESSION['visitas'] = (int) ($_SESSION['visitas'] ?? 0) + 1;
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Visitas</title><p>Visita número <?= $_SESSION['visitas'] ?></p></html>
