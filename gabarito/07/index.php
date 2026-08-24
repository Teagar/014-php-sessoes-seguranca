<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
session_regenerate_id(true);
$_SESSION['autenticado'] = true;
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Autenticação</title><p>Sessão autenticada e renovada.</p></html>
