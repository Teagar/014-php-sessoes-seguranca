<?php
declare(strict_types=1);
$tema = htmlspecialchars((string) ($_COOKIE['tema'] ?? 'claro'), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Tema</title><p>Tema: <?= $tema ?></p></html>
