<?php
declare(strict_types=1);
$hash = password_hash('Estudo#2026', PASSWORD_DEFAULT);
$info = password_get_info($hash);
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Hash</title><dl><dt>Hash</dt><dd><code><?= htmlspecialchars($hash) ?></code></dd><dt>Algoritmo</dt><dd><?= htmlspecialchars($info['algoName']) ?></dd></dl></html>
