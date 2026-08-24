<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
$token = e(csrfToken());
?><!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>CSRF</title><form method="post"><input type="hidden" name="csrf" value="<?= $token ?>"><button>Salvar preferência</button></form></html>
