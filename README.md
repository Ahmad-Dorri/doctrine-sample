# Bamooz Simplified

A PHP 8.4 project for learning Doctrine ORM and MySQL.

## Setup

Requires Docker with Docker Compose.

```bash
cp .env.example .env
docker compose up --build -d
docker compose exec app composer install
```

Check the containers:

```bash
docker compose ps
```

Stop the project:

```bash
docker compose down
```
