# lo-maq - Sistema de Locação de Máquinas

Sistema de gerenciamento para locação de equipamentos. Desenvolvido com Laravel 12 e Vite.

## Pré-requisitos

- PHP 8.2 ou superior
- Composer
- Node.js 18+
- SQLite ou MySQL (configurável no `.env`)

## Instalação e Setup

### 1. Instalar dependências PHP
```bash
composer install
```

### 2. Instalar dependências Node.js
```bash
npm install
```

### 3. Configurar ambiente
```bash
cp .env.example .env
php artisan key:generate
```

Edite o arquivo `.env` conforme necessário (configurar banco de dados, etc).

### 4. Executar migrations e seeders
```bash
php artisan migrate
php artisan db:seed
```

## Iniciando o projeto

### Terminal 1 - Servidor Laravel
```bash
php artisan serve
```
A aplicação estará disponível em `http://localhost:8000`

### Terminal 2 - Vite (assets)
```bash
npm run dev
```

Para build de produção:
```bash
npm run build
```

## Banco de dados

As migrations criaram as seguintes tabelas:
- `users` - Usuários do sistema
- `categorias` - Categorias de equipamentos
- `equipamentos` - Máquinas/equipamentos para locação
- `locacoes` - Registros de locação
- `participantes_locacao` - Participantes envolvidos em locações
- `avaliacoes` - Avaliações de locações

## Comandos úteis

```bash
# Resetar banco de dados e rodar migrations com seeders
php artisan migrate:refresh --seed

# Apenas rodar migrations
php artisan migrate

# Desfazer última migration
php artisan migrate:rollback

# Ver status de migrations
php artisan migrate:status
```

## Usuários

### administrador
```bash
admin@lomaq.com
123456
```

### usuario comum
```bash
joao@email.com
123456
```