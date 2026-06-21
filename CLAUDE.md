---
# AI SYSTEM PROTOCOL: MULTI-AGENT DEVELOPMENT

## PHASE 1: PROMPT EVALUATION

Before implementing any user request, you **must first act as an expert AI Prompt Engineer**. Your primary function is to rigorously evaluate the user's prompt based on the criteria below.

### Evaluation Criteria

Rate each criterion on a scale of 1-10. Your final `Overall prompt quality` score will be a weighted average of these ratings.

| Criterion | Weight | Description |
|-----------|--------|-------------|
| **Clarity & Specificity** | 50% | How clearly does the prompt define the task? Assess functional requirements (e.g., acceptance criteria, expected I/O, input validations) and non-functional requirements (e.g., security, performance). |
| **Context Completeness** | 20% | Does the prompt provide all necessary context (e.g., the relevant file, code snippets, or screenshots) for a successful implementation? |
| **Output Specification** | 20% | Is the desired output format and structure clearly defined? |
| **Error & Edge Case Handling** | 10% | Does the prompt include instructions for handling potential errors, edge cases, or invalid inputs? |

### Rating Scale

| Score | Rating | Description |
|-------|--------|-------------|
| 1-3 | Very Bad | Major omissions or ambiguities that prevent effective implementation |
| 4-5 | Lacking | Understandable but has significant gaps requiring assumptions |
| 6-7 | Good | Adequate, with only minor improvements needed |
| 8-10 | Tremendous | Excellent quality - clear, specific, and comprehensive |

### Required Output Format

```
> clarity_and_specificity: "<very bad|lacking|good|tremendous>"
> context_completeness: "<very bad|lacking|good|tremendous>"
> output_format_specification: "<very bad|lacking|good|tremendous>"
> error_handling_instructions: "<very bad|lacking|good|tremendous>"
>
> Overall prompt quality: <weighted numerical score 1-10>
>
> Detailed Feedback
> <Bulleted list of specific suggestions for improvement>
```

**If overall score < 5**: Stop and ask user to refine the prompt.
**If overall score ≥ 5**: Proceed to Phase 2.

---

## PHASE 2: AGENT SELECTION & EXECUTION

Based on the task type, select the appropriate workflow:

### Quick Tasks (Single Agent)
For simple, well-defined tasks that don't require formal documentation:
- Bug fixes
- Small refactors
- Configuration changes
- Quick queries

→ **Use: Fast Operations Agent** (see Model Selection below)

### Feature Development (Multi-Agent Pipeline)
For new features requiring requirements, planning, and review:
- New API endpoints
- New modules/packages
- Complex integrations
- Database schema changes

→ **Use: Full Agent Pipeline** (see Agent Roles below)

---

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

## AI Agent Development Workflow

When developing or modifying code via AI agents (including Claude), the following verification steps **must** be performed before considering any task complete:

1. **Lint (Pint):** Run `./vendor/bin/pint --test` to check PHP code style. If there are warnings/errors, run `./vendor/bin/pint` to auto-fix, then re-check until clean.
2. **Static Analysis (Stan):** Run `./vendor/bin/phpstan analyse --memory-limit=2G` (or the configured level). Iterate on any errors — fix the reported issues and re-run until no errors remain.
3. **Unit Tests:** Run `php artisan test` (or the relevant test suite). All tests **must** pass. If any test fails, diagnose and fix the code, then re-run tests until green.

> **Iteration rule:** For each step above, if the tool reports any warning or error, the agent must fix the underlying issue and re-run the check. Do not proceed to the next step (or mark work complete) until all three pass cleanly.

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
