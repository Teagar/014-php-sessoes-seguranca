<?php
declare(strict_types=1);
$hash = password_hash('Estudo#2026', PASSWORD_DEFAULT);
$resultados = [password_verify('Estudo#2026', $hash), password_verify('outra-senha', $hash)];
header('Content-Type: text/plain; charset=utf-8');
foreach ($resultados as $resultado) { echo $resultado ? "válida\n" : "inválida\n"; }
