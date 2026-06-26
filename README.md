# 24 Frames — Laravel

Laravel 12 marketing site and admin panel for **24 Frames** motion picture production (Sri Lanka).

## Stack

- Laravel 12, PHP 8.2+
- Tailwind CSS v4 (Vite), Alpine.js, Lucide icons
- Filament v3 admin panel
- SQLite (default) — swap to MySQL/Postgres in production

## Public routes

| URL | Page |
|-----|------|
| `/` | Home |
| `/about` | About |
| `/services` | Services |
| `/team` | Team |
| `/portfolio` | Portfolio & gallery |
| `/contact` | Contact form |

## Admin

| URL | Purpose |
|-----|---------|
| `/admin` | Filament dashboard |

**Default admin login** (after seeding):

- Email: `admin@24frames.lk`
- Password: `password`

Manage team members, portfolio items, gallery items, and view contact submissions.

## Database (XAMPP / MySQL)

Default local setup uses **XAMPP MySQL** database `24frames`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=24frames
DB_USERNAME=root
DB_PASSWORD=
```

Ensure MySQL is running in XAMPP, create the `24frames` database in phpMyAdmin if it does not exist, then:

```bash
php artisan migrate --seed
```

Tests still use in-memory SQLite (see `phpunit.xml`) so they do not touch your MySQL data.

## Setup

```bash
composer install
cp .env.example .env   # if needed
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

Visit `http://127.0.0.1:8000` — admin at `http://127.0.0.1:8000/admin`.

Dev mode (server + Vite + queue + logs):

```bash
composer dev
```

## Content

- Site settings and contact info: `config/frames.php`
- Dynamic content: database (seeded from config on first run)
- Contact form: saves to `contact_submissions` and emails `frames.contact.email` (uses `log` mail driver locally)

## Tests

```bash
php artisan test
```
