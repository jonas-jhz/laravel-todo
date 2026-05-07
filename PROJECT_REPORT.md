# Relatório do Projeto: Todo App Laravel

Este documento descreve o estado atual do projeto, as alterações realizadas, os comandos usados e os arquivos criados/modificados. Ele foi escrito para que outra inteligência artificial entenda o progresso e possa explicar o trabalho ponto a ponto.

---

## 1. Comandos e configurações via terminal

### Verificação e diagnóstico
- `php artisan migrate:status`
  - Usado para verificar se as migrações estavam aplicadas. A primeira execução revelou o erro `could not find driver` para SQLite.
- `php -m | findstr -i sqlite`
  - Confirmou que o driver SQLite não estava carregado no PHP CLI.
- `php -i | findstr "php.ini"`
  - Localizou o `php.ini` ativo (`C:\php74\php.ini`).
- `findstr /n /c:"pdo_pgsql" /c:"pgsql" /c:"pdo_mysql" /c:"sqlite3" C:\php74\php.ini`
  - Localizou as linhas de configuração das extensões de banco de dados no `php.ini`.
- `where psql`
  - Verificou se o cliente PostgreSQL estava instalado no PATH do Windows.

### Alteração de assets e frontend
- `npm run build`
  - Executado após adicionar novos assets ao Vite para gerar o manifest final. Foi necessário reconstruir para que o arquivo `resources/js/auth.js` fosse reconhecido.

### Operações de banco de dados
- `php artisan migrate --force`
  - Rodou as migrações existentes. O comando retornou `Nothing to migrate` quando o esquema já estava atualizado.
- `php artisan db:seed --force`
  - Semeou a base com dados iniciais. Gerou erro de duplicidade em `users.email` porque a seed já havia sido aplicada.
- `php artisan config:clear`
  - Limpei o cache de configuração após trocar a conexão de banco.

---

## 2. Alterações em arquivos existentes: motivações e efeitos

### `package.json`
- Removida dependência `vue`.
- Removido plugin `@vitejs/plugin-vue` do `devDependencies`.

**Motivação:** Simplificar o frontend para uso de HTML, CSS e JavaScript puro sem a complexidade do Vue.

### `vite.config.js`
- Atualizado o input do plugin Laravel Vite para incluir:
  - `resources/css/app.css`
  - `resources/js/app.js`
  - `resources/css/auth.css`
  - `resources/js/auth.js`

**Motivação:** Incluir os novos arquivos de estilo e script do login personalizável no manifest Vite.

### `resources/js/app.js`
- Substituiu todo o código Vue por JavaScript vanilla.
- Agora calcula o total de tarefas e o total de completas diretamente via DOM.
- Adiciona confirmação de exclusão para formulários com `data-confirm-delete`.

**Efeito:** A página de tarefas não depende mais de Vue; ela funciona com renderização Blade e JS leve.

### `resources/views/tasks/index.blade.php`
- Removeu sintaxe Vue (`v-if`, `v-for`, diretivas `:` e `{{ task }}` do Vue).
- Converteu o template para renderização server-side com Blade.
- Centralizou elementos de bloco e botões.
- Manteve links e formulários de ações (`edit`, `show`, `delete`).

**Motivação:** Simplificar a interface e torná-la funcional sem framework frontend.

### `app/Http/Controllers/AuthController.php`
- Atualizado login para usar `email` em vez de `name`.
- Adicionadas novas ações:
  - `showRegisterForm()` que exibe a mesma view de login
  - `register()` para criar novo usuário e efetuar login automático
- Usou `Hash::make()` para armazenar a senha criptografada.

**Efeito:** A aplicação passou a suportar cadastro de usuários e login via email.

### `routes/web.php`
- Manteve rota raiz `/` redirecionando para `tasks.index`.
- Adicionou rotas de registro:
  - `GET /register`
  - `POST /register`

**Motivação:** Permitir registro direto da interface de login.

### `.env`
- Alterado de SQLite para PostgreSQL:
  - `DB_CONNECTION=pgsql`
  - `DB_HOST=127.0.0.1`
  - `DB_PORT=5432`
  - `DB_DATABASE=teste_todo`
  - `DB_USERNAME=postgres`
  - `DB_PASSWORD=secret`
  - `DB_SSLMODE=prefer`

**Motivação:** Migrar a aplicação para usar PostgreSQL.

### `C:\php74\php.ini`
- Habilitado `extension=pdo_pgsql` e `extension=pgsql`.

**Efeito:** O PHP CLI passou a suportar conexão PostgreSQL.

---

## 3. Documentos/arquivos criados: motivações e resultados

### `resources/css/auth.css`
- Estilos específicos para a tela de login/register.
- Design inspirado no template `lovable` fornecido pelo usuário.
- Garante um visual moderno, responsivo e centrado para autenticação.

**Critério:** Criado para isolar o estilo do auth e não misturar com `resources/css/app.css`.

### `resources/js/auth.js`
- Script leve para alternar abas entre "Entrar" e "Cadastrar".
- Mantém dois formulários na mesma página, exibindo apenas o ativo.

**Critério:** Criado porque a interface de login precisava do comportamento de tabs sem Vue.

### `resources/views/layouts/auth.blade.php`
- Layout dedicado para páginas de autenticação.
- Inclui apenas `auth.css` e não carrega o layout do app principal.

**Critério:** Criado para separar o estilo da tela de login e evitar conflitos com o layout normal da aplicação.

### `PROJECT_REPORT.md`
- Documento atual de relatório consolidado.
- Permite que outra IA entenda o estado e o histórico do projeto.

**Critério:** Pedido explícito do usuário para documentar tudo em formato compreensível.

---

## 4. Demais modificações e considerações relevantes

### Frontend simplificado
- A aplicação foi guiada para um frontend limpo e simples.
- A dependência Vue foi removida e substituída por JavaScript nativo.
- O layout de tarefas permanece no Blade, evitando renderização cliente complexa.

### Autenticação
- A tela de login agora usa o design de `lovable` com duas abas.
- O fluxo de registro foi integrado ao mesmo view para facilitar o uso.
- O `AuthController` passou a ser responsável por login, logout e registro.

### Banco de dados PostgreSQL
- A configuração PostgreSQL foi aplicada, mas ainda depende de credenciais válidas.
- O comando `php artisan migrate:status` identificou que a conexão atualmente falha devido à autenticação com o usuário `postgres`.
- O estado atual é:
  - O driver PostgreSQL do PHP está habilitado.
  - A aplicação está configurada para usar PostgreSQL via `.env`.
  - O banco `teste_todo` precisa existir ou ser criado e as credenciais precisam ser ajustadas.

### Vite e assets
- O `manifest.json` do Vite foi atualizado quando o build foi executado com `npm run build`.
- Os novos arquivos `auth.css` e `auth.js` foram incluídos no pipeline Vite.

### Rotas e navegação
- Rota inicial `/` redireciona para `/tasks`.
- Página de login acessível em `/login`.
- Registro acessível em `/register`.
- As tasks exigem autenticação via middleware `auth`.

### Observações finais
- O projeto agora está em um estado híbrido entre backend Laravel completo e frontend simplificado.
- A inteligência artificial que for analisar este relatório deve entender as camadas:
  1. Configuração de ambiente e banco
  2. Alteração de build pipeline via Vite
  3. Ajuste do frontend para JS/Blade puro
  4. Ampliação da autenticação com cadastro
  5. Criação de arquivos específicos para login

---

## 5. Estado atual do projeto

### Funcionalidades presentes
- Login via email e senha
- Registro de novo usuário
- Logout
- Página de tarefas com listagem, criação, edição e exclusão
- Contagem de tarefas totais e completas
- Mensagens de status e layout centralizado

### Pontos pendentes
- Validação final da conexão PostgreSQL com credenciais reais
- Criação do banco `teste_todo` no servidor PostgreSQL, se ainda não existir
- Ajustes de roteamento e domínio do servidor Apache/Laragon caso necessário

---

## 6. Recomendações para continuidade

1. Verificar o usuário/senha PostgreSQL reais e atualizá-los em `.env`.
2. Criar o banco `teste_todo` no PostgreSQL.
3. Executar `php artisan migrate` novamente.
4. Testar o fluxo `/login`, `/register` e `/tasks` no navegador.
5. Se desejar, remover qualquer código Vue restante ou dependência não utilizada do `package.json`.
