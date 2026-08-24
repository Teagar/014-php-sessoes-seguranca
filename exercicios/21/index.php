<?php
declare(strict_types=1);

// Mini autenticação final usando SQLite.
// TODO: implemente cadastro com password_hash, login com password_verify e
// regeneração de sessão, área privada, logout POST, mensagens flash e CSRF em
// todas as mudanças. Configure HttpOnly/SameSite/Secure, valide email e senha,
// use PDO preparado, mensagens genéricas e controle de tentativas.
// A solução pode ter múltiplos arquivos nesta pasta, mas deve iniciar o banco
// automaticamente sem guardar credenciais ou banco gerado no Git.
