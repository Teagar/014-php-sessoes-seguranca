<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
$seguro = isHttps();
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>HTTPS</title><p>Cookie Secure: <?= $seguro ? 'ativo' : 'inativo' ?>.</p><?php if (!$seguro): ?><p>Atenção: use HTTPS em produção. Cabeçalhos de proxy só devem ser aceitos de proxies confiáveis.</p><?php endif; ?></html>
