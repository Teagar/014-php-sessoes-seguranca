<?php
declare(strict_types=1);
require_once __DIR__ . '/../_shared/session.php';
startSecureSession();

$dataDir = dirname(__DIR__, 2) . '/data';
if (!is_dir($dataDir)) { mkdir($dataDir, 0700, true); }
$pdo = new PDO('sqlite:' . $dataDir . '/auth.sqlite', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
$pdo->exec('CREATE TABLE IF NOT EXISTS usuarios (id INTEGER PRIMARY KEY AUTOINCREMENT, nome TEXT NOT NULL, email TEXT NOT NULL UNIQUE, senha_hash TEXT NOT NULL)');

$action = (string) ($_GET['action'] ?? 'home');
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$error = null;

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    if (!validCsrf($_POST['csrf'] ?? null)) { http_response_code(403); exit('Token CSRF inválido.'); }
    if ($action === 'register') {
        $nome = trim((string) ($_POST['nome'] ?? ''));
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = (string) ($_POST['senha'] ?? '');
        if ($nome === '' || !$email || strlen($senha) < 10) {
            $error = 'Informe nome, email válido e senha com pelo menos 10 caracteres.';
        } else {
            try {
                $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :hash)');
                $stmt->execute(['nome' => $nome, 'email' => strtolower($email), 'hash' => password_hash($senha, PASSWORD_DEFAULT)]);
                $_SESSION['flash'] = 'Cadastro concluído. Entre com sua conta.';
                header('Location: ?action=login');
                exit;
            } catch (PDOException $exception) {
                if ((string) $exception->getCode() !== '23000') { error_log($exception->getMessage()); }
                $error = 'Não foi possível cadastrar com esses dados.';
            }
        }
    } elseif ($action === 'login') {
        $agora = time();
        if ((int) ($_SESSION['bloqueado_ate'] ?? 0) > $agora) {
            $error = 'Muitas tentativas. Aguarde alguns segundos.';
        } else {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $stmt = $pdo->prepare('SELECT id, nome, senha_hash FROM usuarios WHERE email = :email');
            $stmt->execute(['email' => strtolower((string) $email)]);
            $usuario = $stmt->fetch();
            if ($usuario && password_verify((string) ($_POST['senha'] ?? ''), $usuario['senha_hash'])) {
                session_regenerate_id(true);
                $_SESSION['usuario'] = ['id' => (int) $usuario['id'], 'nome' => $usuario['nome']];
                unset($_SESSION['falhas'], $_SESSION['bloqueado_ate']);
                $_SESSION['csrf'] = bin2hex(random_bytes(32));
                header('Location: ?action=private');
                exit;
            }
            $_SESSION['falhas'] = (int) ($_SESSION['falhas'] ?? 0) + 1;
            if ($_SESSION['falhas'] >= 3) { $_SESSION['bloqueado_ate'] = $agora + 30; }
            $error = 'Email ou senha inválidos.';
        }
    } elseif ($action === 'logout') {
        $_SESSION = [];
        $params = session_get_cookie_params();
        setcookie(session_name(), '', ['expires' => time() - 42000, 'path' => $params['path'], 'domain' => $params['domain'], 'secure' => $params['secure'], 'httponly' => $params['httponly'], 'samesite' => $params['samesite'] ?? 'Lax']);
        session_destroy();
        startSecureSession();
        session_regenerate_id(true);
        $_SESSION['flash'] = 'Sessão encerrada.';
        header('Location: ?action=login');
        exit;
    }
}

if ($action === 'private' && !isset($_SESSION['usuario']['id'])) {
    header('Location: ?action=login');
    exit;
}
$token = e(csrfToken());
?><!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Mini autenticação</title>
<style>body{font:1rem/1.5 system-ui;max-width:42rem;margin:3rem auto;padding:0 1rem}nav{display:flex;gap:1rem}form{display:grid;gap:.8rem;max-width:24rem}label{display:grid;gap:.25rem}input,button{font:inherit;padding:.65rem}.erro{color:#9b1c1c}</style></head><body>
<nav aria-label="Principal"><a href="?">Início</a><a href="?action=register">Cadastro</a><a href="?action=login">Login</a></nav>
<?php if ($flash): ?><p role="status"><?= e($flash) ?></p><?php endif; ?>
<?php if ($error): ?><p class="erro" role="alert"><?= e($error) ?></p><?php endif; ?>
<?php if ($action === 'register'): ?>
<h1>Criar conta</h1><form method="post"><input type="hidden" name="csrf" value="<?= $token ?>"><label>Nome <input name="nome" autocomplete="name" required></label><label>Email <input name="email" type="email" autocomplete="username" required></label><label>Senha <input name="senha" type="password" minlength="10" autocomplete="new-password" required></label><button>Cadastrar</button></form>
<?php elseif ($action === 'login'): ?>
<h1>Entrar</h1><form method="post"><input type="hidden" name="csrf" value="<?= $token ?>"><label>Email <input name="email" type="email" autocomplete="username" required></label><label>Senha <input name="senha" type="password" autocomplete="current-password" required></label><button>Entrar</button></form>
<?php elseif ($action === 'private'): ?>
<h1>Área privada</h1><p>Olá, <?= e((string) $_SESSION['usuario']['nome']) ?>.</p><form method="post" action="?action=logout"><input type="hidden" name="csrf" value="<?= $token ?>"><button>Sair</button></form>
<?php else: ?><h1>Mini autenticação segura</h1><p>Cadastre uma conta para acessar a área privada.</p><?php endif; ?>
</body></html>
