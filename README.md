# laravel-qa

A small Q&A ("Stack Overflow clone") application built with Laravel. Started as a 2020 tutorial project on Laravel 6 and upgraded in place through every major version to Laravel 11.

- **Framework:** Laravel 11
- **PHP:** 8.2+
- **Database:** MySQL / MariaDB (SQLite for tests)
- **Frontend:** Bootstrap 4 (frontend rewrite pending — see [Roadmap](#roadmap))
- **Tests:** PHPUnit 11

## Features

- Register / login
- List, view, create, edit, delete questions
- Slug auto-generated from title
- Author-scoped question ownership

## Requirements

- PHP 8.2 or newer
- Composer 2
- MySQL 5.7+ or MariaDB 10.3+ (or SQLite for tests only)
- Node.js + npm (only needed if rebuilding frontend assets — pre-built assets ship in `public/`)

## Installation

```bash
git clone https://github.com/leo26dandy/laravel-qa.git
cd laravel-qa

composer install
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_qa
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

Create the database, then run migrations:

```bash
php artisan migrate
```

## Running the app

```bash
php artisan serve
```

Visit http://localhost:8000.

## Running tests

Tests use SQLite in-memory — no database setup required:

```bash
vendor/bin/phpunit --testdox
```

## Routes

| Method | URI                             | Action              | Auth |
|--------|---------------------------------|---------------------|------|
| GET    | `/questions`                    | List questions      | No   |
| GET    | `/questions/{question}`         | Show one question   | No   |
| GET    | `/questions/create`             | New question form   | Yes  |
| POST   | `/questions`                    | Create question     | Yes  |
| GET    | `/questions/{question}/edit`    | Edit question form  | Yes  |
| PUT    | `/questions/{question}`         | Update question     | Yes  |
| DELETE | `/questions/{question}`         | Delete question     | Yes  |

## Roadmap

- Replace `Auth::routes()` / `laravel/ui` with Laravel Breeze (Blade + Tailwind)
- Replace Laravel Mix (webpack) with Vite; drop Bootstrap 4 in favor of Tailwind
- Add Answer, Vote, and Tag models to bring the app closer to a real Stack-Overflow-style forum
- Enforce ownership on edit / update / destroy (currently any authenticated user can touch any question)

## Contributing

Pull requests welcome. Please:

1. Open an issue first for anything larger than a small fix, so the approach can be agreed on.
2. Include tests where behavior changes.
3. Keep commits focused; one logical change per commit.

## License

[MIT](LICENSE) © Leo Dandy
