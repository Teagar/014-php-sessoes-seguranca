<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();
header('Content-Type: text/plain; charset=utf-8');
if (!isset($_SESSION['usuario']['user_id'])) { http_response_code(401); echo "Autenticação necessária\n"; exit; }
if (($_SESSION['usuario']['papel'] ?? '') !== 'admin') { http_response_code(403); echo "Acesso negado\n"; exit; }
echo "Área administrativa\n";
