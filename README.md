# PHP: Sessões e Segurança

Exercícios graduais sobre cookies, sessões e fundamentos de autenticação web segura. A branch `main` contém apenas enunciados e scaffolds; a branch `gabarito` acrescenta soluções executáveis em `gabarito/` e preserva todos os enunciados.

## Pré-requisitos

- PHP 8.1 ou superior com `session` e `pdo_sqlite` habilitados.
- Navegador com ferramentas de desenvolvedor.
- `curl` opcional para observar cabeçalhos e cookies.
- HTTPS em produção. No servidor local HTTP, use `SESSION_SECURE=0` somente para estudo.

## Como executar

```bash
cp .env.example .env
php -S localhost:8000 -t .
```

Acesse `http://localhost:8000/exercicios/01/`. Na branch `gabarito`, as respostas ficam em `http://localhost:8000/gabarito/01/`. Para cookies via terminal: `curl -i -c /tmp/cookies.txt -b /tmp/cookies.txt URL`.

## Exercícios

| # | Tema | Entrega esperada |
|---:|---|---|
| 01 | Criar cookie | Definir preferência com atributos adequados |
| 02 | Ler cookie | Mostrar preferência com valor padrão e escape |
| 03 | Expirar cookie | Remover no navegador com os mesmos atributos |
| 04 | Opções de cookie | Aplicar `HttpOnly`, `SameSite` e `Secure` consciente |
| 05 | Iniciar sessão | Gravar e ler estado em `$_SESSION` |
| 06 | Contador de visitas | Manter contador por sessão |
| 07 | Regenerar identificador | Trocar id após mudança de privilégio |
| 08 | Encerrar sessão | Limpar dados, cookie e sessão no servidor |
| 09 | Formulário de login | Receber credenciais por POST sem vazamento |
| 10 | Hash de senha | Gerar hash com `password_hash()` |
| 11 | Verificar senha | Validar com `password_verify()` |
| 12 | Estado autenticado | Armazenar apenas identidade mínima na sessão |
| 13 | Controle de acesso | Bloquear página privada com redirecionamento |
| 14 | Papéis | Autorizar recurso exclusivo de administrador |
| 15 | Redirecionamento seguro | Impedir URL externa no parâmetro de retorno |
| 16 | Consciência de HTTPS | Detectar transporte e configurar cookie seguro |
| 17 | Token CSRF | Criar token aleatório por sessão |
| 18 | Validar CSRF | Comparar token em POST com tempo constante |
| 19 | Mensagem flash | Exibir uma mensagem uma única vez |
| 20 | Limite de tentativas | Aplicar espera simples por sessão |
| 21 | Mini autenticação | Integrar cadastro, login, logout, CSRF e área privada |

## Regras

- Chame `session_set_cookie_params()` antes de `session_start()`.
- Regenere o id da sessão após autenticação e destrua a sessão no logout.
- Nunca guarde senha em texto puro nem compare hashes manualmente.
- Toda ação que muda estado usa POST e token CSRF.
- `Secure` exige HTTPS; `HttpOnly` e `SameSite=Lax` devem ser padrão.
- Confira cada arquivo PHP com `php -l` e inspecione cookies no navegador.
