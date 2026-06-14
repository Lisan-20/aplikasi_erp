# FrankenPHP + Laravel Octane

## 1. Overview

Staging runs the app under **Laravel Octane** with the **FrankenPHP** server
(`deploy/staging/Dockerfile`, `config/octane.php`). FrankenPHP combines the web
server (Caddy) and the PHP runtime into a single process. Octane boots the
Laravel application **once** and keeps it in memory, reusing it across many
requests via worker processes (`--workers=auto` in the Dockerfile `CMD`) instead
of bootstrapping the framework on every request.

This means request-handling code runs in a **long-lived process shared across
many users**. Any state that isn't properly scoped to a single request can leak
between requests — including between different patients/users in this hospital
system.

## 2. Writing Octane-safe code

- **DO**: keep all request-specific data in `$request`, method parameters,
  dependency-injected services, or framework-managed facades (`Session::`,
  `Auth::`, `DB::`) — this is the pattern already used throughout the codebase.
  ```php
  // DO
  public function show(Request $request)
  {
      $user = Auth::user();
      // ...
  }
  ```

- **DON'T**: store per-request or per-user data in static properties, class
  properties of singletons, or via `app()->instance(...)` — these persist across
  requests in the same worker and will leak data between users.
  ```php
  // DON'T
  class ReportService
  {
      public static ?Patient $currentPatient = null; // leaks across requests!
  }
  ```

- **DON'T** rely on "resolve once, cache forever" patterns in service providers
  (e.g. binding a singleton that captures the current request's user or
  database results at boot time). Octane's default listeners
  (`config/octane.php` → `listeners`) flush temporary container instances
  between requests, but custom singletons holding mutable state are not
  automatically reset.

## 3. Deploys & config changes

- Workers keep the booted application (including cached config/routes/views)
  in memory. After deploying new code or changing `.env`, **recreate the
  container** so workers restart with the new code:
  ```bash
  docker compose -f deploy/staging/docker-compose.yml up -d --build --force-recreate app
  ```
- `config:cache` and `view:cache` still run in `deploy/staging/docker/entrypoint.sh`
  before Octane starts — `route:cache` remains skipped (closure-based routes in
  `routes/web.php`/`routes/api.php`).

## 4. Database connections

- The `sqlsrv` connection (`config/database.php`) does **not** use
  `PDO::ATTR_PERSISTENT` — this is intentional. Octane workers may reuse a single
  PDO connection across multiple requests; Laravel automatically retries on
  "lost connection" errors. If SQL Server drops idle connections, watch staging
  logs for reconnect-related errors after long idle periods.

## 5. Runtime configuration reference

- `config/octane.php` — Octane server config (`OCTANE_SERVER=frankenphp`,
  `OCTANE_HTTPS`, listeners, flush/warm bindings).
- `public/frankenphp-worker.php` — the FrankenPHP worker entrypoint (do not
  remove; required by `php artisan octane:frankenphp`).
- `deploy/staging/Dockerfile` — builds on `dunglas/frankenphp:1-php8.3-alpine`,
  installs the `sqlsrv`/`pdo_sqlsrv` extensions, and runs
  `php artisan octane:frankenphp --host=0.0.0.0 --port=80 --workers=auto --max-requests=500`.
- `deploy/staging/php/conf.d/laravel.ini` — PHP tuning (memory limit, upload
  size, `max_execution_time`), unchanged from the previous php-fpm setup.
