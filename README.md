# Laravel Todo App

## Sobre o projeto

Este é um aplicativo de lista de tarefas simples, construído em Laravel com Blade para o frontend e PostgreSQL como banco de dados.

O objetivo é permitir que cada usuário controle suas próprias tarefas de forma rápida e segura. A aplicação combina um sistema de autenticação com gerenciamento completo de tarefas, oferecendo uma experiência leve e intuitiva.

## O que o app faz

- Permite que usuários criem uma conta e façam login.
- Garante que cada tarefa pertença apenas ao usuário que a criou.
- Exibe uma lista de tarefas pessoais após o login.
- Permite criar novas tarefas com título e descrição.
- Permite editar tarefas existentes.
- Permite marcar tarefas como concluídas.
- Permite excluir tarefas.
- Exibe contadores de tarefas totais e concluídas.

## Por que usar este projeto

- Ideal como um protótipo de gerenciamento pessoal de tarefas.
- Útil para aprender como autenticação e CRUD funcionam no Laravel.
- Boa base para expandir com recursos como prioridades, datas de vencimento e filtros.
- Fornece uma interface limpa com formulários de login, cadastro e gestão de tarefas.

## Como ele funciona

### Autenticação

- A página `/login` reúne os formulários de login e cadastro em abas.
- O `AuthController` trata a validação, criação de usuário, login e logout.
- Após o login, o usuário é redirecionado para a área de tarefas.

### Tarefas

- As rotas de tarefas estão protegidas por autenticação.
- O `TaskController` usa `Auth::user()->tasks()` para garantir que apenas tarefas do usuário atual sejam exibidas e manipuladas.
- Cada tarefa tem:
  - `title` (obrigatório)
  - `description` (opcional)
  - `completed` (booleano)
- A interface de tarefas permite criar, editar e excluir itens diretamente.

### Propriedade de dados

- O relacionamento `User->tasks()` garante que um usuário não veja ou edite tarefas de outro usuário.
- Todas as operações de visualização, edição e exclusão buscam a tarefa com `findOrFail` dentro do contexto do usuário autenticado.

## Estrutura principal

- `app/Http/Controllers/AuthController.php`: login, cadastro e logout.
- `app/Http/Controllers/TaskController.php`: criação, leitura, atualização e exclusão de tarefas.
- `app/Models/User.php`: define o relacionamento com tarefas.
- `app/Models/Task.php`: define os campos preenchíveis da tarefa.
- `routes/web.php`: rotas do app, incluindo recursos de tarefa e autenticação.
- `resources/views/auth/login.blade.php`: página de autenticação com abas.
- `resources/views/tasks/index.blade.php`: painel de tarefas do usuário.
- `resources/js/app.js`: contador de tarefas e confirmação de exclusão.
- `resources/css/auth.css`: estilo da tela de login.

## Configuração e instalação

1. Instale dependências PHP e Node:
   ```bash
   composer install
   npm install
   ```

2. Compile os assets:
   ```bash
   npm run build
   ```

3. Copie `.env.example` para `.env` e ajuste as credenciais de banco:
   ```bash
   cp .env.example .env
   ```

4. Gere a chave de aplicação:
   ```bash
   php artisan key:generate
   ```

5. Limpe o cache de configuração:
   ```bash
   php artisan config:clear
   ```

6. Execute as migrações:
   ```bash
   php artisan migrate
   ```

7. Inicie o servidor local:
   ```bash
   php artisan serve
   ```

8. Acesse no navegador:
   - `http://localhost:8000/login`

## Requisitos do ambiente

- PHP com extensões `pdo_pgsql` e `pgsql` habilitadas.
- PostgreSQL rodando localmente ou em um servidor acessível.
- Banco de dados criado e configurado no `.env`.

## Uso do aplicativo

### Login e registro

- Use a aba de login para entrar com email e senha.
- Use a aba de cadastro para criar um novo usuário.
- Após login, o sistema mantém a sessão segura e permite acessar a lista de tarefas.

### Gestão de tarefas

- Crie tarefas pelo formulário disponível na página de tarefas.
- Edite o título, a descrição e o status de conclusão.
- Exclua tarefas que não sejam mais necessárias.
- Veja a contagem de tarefas e quantas já foram concluídas.

## Utilidade prática

Este aplicativo é útil para:

- construir um sistema de tarefas pessoais com autenticação.
- entender como o Laravel organiza rotas, controladores, modelos e views.
- criar um ponto de partida para um app mais completo, adicionando categorias, prazos e notificações.
