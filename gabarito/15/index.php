<?php
declare(strict_types=1);
$proxima = (string) ($_GET['proxima'] ?? '/');
if (!str_starts_with($proxima, '/') || str_starts_with($proxima, '//')) { $proxima = '/'; }
header('Location: ' . $proxima, true, 302);
exit;
