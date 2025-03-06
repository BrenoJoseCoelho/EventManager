# EventManager

**EventManager** é um sistema web de gerenciamento e inscrição em eventos desenvolvido com Laravel. O sistema permite dois tipos de usuários:

- **Administrador:** Pode gerenciar (criar, editar, excluir) eventos, gerenciar usuários e visualizar inscrições dos participantes.
- **Participante:** Pode visualizar os eventos disponíveis, inscrever-se neles e gerenciar suas próprias inscrições.

## Recursos

- **Autenticação Completa:** Registro, login, logout e recuperação de senha utilizando o sistema de autenticação do Laravel.
- **Controle de Acesso:** Usuários são diferenciados por papéis (role: `admin` ou `participant`), garantindo que cada usuário tenha acesso apenas às funcionalidades permitidas.
- **Gerenciamento de Eventos:** CRUD completo de eventos, com campos essenciais (título, descrição, datas, localização, capacidade e status).
- **Inscrições em Eventos:** Participantes podem se inscrever em eventos abertos, desde que não tenham excedido a capacidade; também podem cancelar inscrições.
- **Interface Responsiva:** Views construídas com Blade e estilizadas com Tailwind CSS.
- **Testes Automatizados:** Testes com PHPUnit para funcionalidades principais.
- **Seeders e Factories:** Para popular o banco de dados com dados fictícios durante o desenvolvimento e testes.
- **API RESTful (Opcional):** Endpoints para operações de CRUD e gerenciamento de inscrições, protegidos por token (Laravel Sanctum ou Passport).

## Requisitos

- PHP 8.0 ou superior
- Composer
- MySQL (ou outro banco de dados compatível)
- Node.js & npm (para compilação de assets, se necessário)
- Laravel (versão estável, ex.: Laravel 10)

## Instalação

### 1. Clonar o Repositório

```bash
git clone https://github.com/BrenoJoseCoelho/EventManager.git
cd EventManager
```

### 2. Instalar Dependências

### Com Docker

Se você preferir utilizar Docker para rodar o banco de dados, execute:

```bash
docker-compose up -d
```

Isso criará os containers necessários (banco de dados) já configurados.

---

```bash
composer install
npm install
npm run dev --Deve ficar rodando
```

### 3. Configurar o Ambiente

Copie o arquivo `.env.example` e configure as variáveis de ambiente.

```bash
cp .env.example .env
```

Configure seu arquivo `.env`:

```ini
APP_NAME=EventManager
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=event_manager
DB_USERNAME=admin
DB_PASSWORD=senhabanco123
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

### 4. Executar Migrations e Seeders

```bash
php artisan migrate
php artisan db:seed
```

### 5. Executar os Testes

```bash
php artisan test
```

### 6. Iniciar o Servidor

```bash
php artisan db:seed
php artisan serve
```

Acesse em [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Uso

### Participantes

- Registrar/Login
- Visualizar e se inscrever em eventos disponíveis
- Visualizar e cancelar suas inscrições

### Administradores

- Acesso ao painel administrativo (`/admin/dashboard`)
- CRUD de eventos
- CRUD de usuários
- Visualização detalhada das inscrições dos participantes

## Rotas Principais

### Públicas

- `/` – Lista de eventos
- `/events/{event}` – Detalhes de eventos

### Autenticadas (Participantes)

- `/dashboard` – Dashboard do usuário
- `/profile` – Gerenciar perfil
- `/events/{event}/register` – Inscrição em evento
- `/registrations` – Visualizar inscrições

### Administrativas (Admins)

- `/admin/dashboard` – Painel administrativo
- `/events/create` – Criar evento
- `/events/{event}/edit` – Editar evento
- `/events/{event}/details` – Detalhes dos eventos e inscrições
- `/users` – Gerenciar usuários

## Deploy

Para otimizar em produção, execute:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

## Contribuição

Pull requests são bem-vindos! Abra uma issue para discussões importantes.

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).
