# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a **SIMRS (Sistem Informasi Manajemen Rumah Sakit)** — a Hospital Information System — built with Laravel 12 + React + Inertia.js. It modernizes a legacy hospital system, bridging old database structures with a modern SPA frontend. The legacy database is deeply integrated (4,315+ auto-generated migrations from `kitloong/laravel-migrations-generator`).

## Commands

### PHP / Laravel
```bash
php artisan serve              # Start dev server
php artisan migrate            # Run migrations
php artisan migrate:rollback   # Rollback last migration batch
php artisan tinker             # REPL
php artisan route:list         # List all routes
php artisan cache:clear && php artisan config:clear && php artisan view:clear
composer install
composer dump-autoload
```

### Frontend (Vite + React)
```bash
npm install
npm run dev     # Start Vite dev server (hot reload)
npm run build   # Production build
```

### Testing
```bash
php artisan test                          # Run all tests
php artisan test --filter ExampleTest     # Run a single test class
./vendor/bin/phpunit tests/Unit/ExampleTest.php  # Run specific file
./vendor/bin/phpunit --testsuite Feature  # Run feature suite only
```

### Code Formatting
```bash
./vendor/bin/pint         # Run Laravel Pint (PHP formatter)
./vendor/bin/pint --test  # Lint only, no changes
```

## Architecture

### Stack
- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** React 18 + Inertia.js (via `@inertiajs/react`) — no separate API layer; pages are rendered server-side via Inertia
- **Bundler:** Vite 4 (`vite.config.js`), alias `@` → `resources/js/`
- **Auth:** Custom session auth against legacy `dd_user` table (MD5 passwords, case-sensitive SQL collation)
- **Database:** Microsoft SQL Server (driver: `sqlsrv`, default port 1433)

### Environment Setup

Copy `.env.example` to `.env`, fill in the SQL Server credentials, then:
```bash
php artisan key:generate
```

Key `.env` DB variables:
```
DB_CONNECTION=sqlsrv
DB_HOST=localhost
DB_PORT=1433
DB_DATABASE=simrs
DB_USERNAME=sa
DB_PASSWORD=your_password
DB_ENCRYPT=yes
DB_TRUST_SERVER_CERTIFICATE=true   # set false in production with a valid cert
```

Requires the `pdo_sqlsrv` PHP extension. On Linux, install the Microsoft ODBC driver and then:
```bash
pecl install sqlsrv pdo_sqlsrv
```

Tests use `DB_CONNECTION=array` (in-memory, no real DB needed).

### Key Patterns

**Inertia.js data flow:** Controllers call `Inertia::render('PageName', $data)` instead of returning Blade views. React pages live in `resources/js/Pages/`. The shared data (auth user, permissions) is passed via `HandleInertiaRequests` middleware (`app/Http/Middleware/HandleInertiaRequests.php`).

**Permission system:** Module access is controlled by `CheckPermission` middleware (`app/Http/Middleware/CheckPermission.php`), which checks the `admin_hak_user_v` database view. Routes requiring access control use the `check.permission` middleware alias.

**Legacy database helpers:** `app/Helpers/DatabaseHelper.php` exposes two global functions for legacy compatibility:
- `read_tabel()` — fetch multiple records
- `baca_tabel()` — fetch a single field value

These are autoloaded via `composer.json` `files` key and are used in controllers dealing with legacy tables.

**Patient data tables:** Core patient data lives in `mt_master_pasien`. Medical record numbers (`no_mr`) are zero-padded integers auto-generated in `PasienBaruController`.

**SQL Server notes:** The legacy schema uses case-sensitive collations. Raw queries using `DB::select()` must account for this. Avoid MySQL-specific syntax (`LIMIT`, backtick identifiers) — use `TOP` and bracket identifiers `[column]` where raw SQL is needed.

### Writing Idempotent Migrations

All migrations must be safe to re-run (e.g. against a database that already has the legacy schema applied). Follow these rules when writing or editing migration files:

1. **`Schema::create` (new tables):** guard with an early-return `hasTable()` check before the `Schema::create` call:
   ```php
   public function up(): void
   {
       if (Schema::hasTable('patients')) {
           return;
       }

       Schema::create('patients', function (Blueprint $table) {
           // ...
       });
   }
   ```

2. **Views:** use `CREATE OR ALTER VIEW` instead of `CREATE VIEW` in the raw `DB::statement()` SQL.

3. **Stored procedures:** use `CREATE OR ALTER PROCEDURE` (or `PROC`) instead of `CREATE PROCEDURE`/`CREATE PROC`.

4. **Foreign keys (`add_foreign_keys_to_*` migrations):** guard each `$table->foreign(...)` call with a `sys.foreign_keys` existence check via a private helper, early-returning if the constraint already exists:
   ```php
   public function up(): void
   {
       if ($this->foreignKeyExists('FK_dc_menu_dc_modul')) {
           return;
       }

       Schema::table('dc_menu', function (Blueprint $table) {
           $table->foreign(['id_dc_modul'], 'FK_dc_menu_dc_modul')->references(['id_dc_modul'])->on('dc_modul');
       });
   }

   private function foreignKeyExists(string $name): bool
   {
       return DB::select('SELECT 1 FROM sys.foreign_keys WHERE name = ?', [$name]) !== [];
   }
   ```
   Remember to `use Illuminate\Support\Facades\DB;`.

5. **Other raw `CREATE` statements** (indexes, triggers, etc.): check `sys.objects`/`sys.indexes` (or the relevant `sys.*` catalog view) for existence before creating, following the same early-return pattern.

### Directory Guide

| Path | Purpose |
|---|---|
| `app/Http/Controllers/` | Main request handlers |
| `app/Http/Controllers/Registrasi/` | Patient registration sub-controllers |
| `app/Http/Middleware/` | Auth, permission checks, Inertia setup |
| `app/Helpers/DatabaseHelper.php` | Legacy DB utility functions (global scope) |
| `resources/js/Pages/` | React page components (one per route) |
| `resources/js/Layouts/` | Shared React layout wrappers |
| `routes/web.php` | All web routes (auth + protected modules) |
| `database/migrations/` | 4,315+ migrations — mostly legacy schema, do not edit auto-generated ones |
| `config/database.php` | DB connections — default is `sqlsrv` |
