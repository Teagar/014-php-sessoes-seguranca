<?php
declare(strict_types=1);

// Cookies são cabeçalhos e precisam ser definidos antes de qualquer saída HTML.
setcookie('tema', 'escuro', ['expires' => time() + 604800, 'path' => '/', 'samesite' => 'Lax']);
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Cookie</title><p>Preferência salva.</p></html>
