# Staging Deployment

A single `app` container running **Laravel Octane on FrankenPHP** (PHP 8.3 +
sqlsrv, worker mode). FrankenPHP embeds both the web server (Caddy) and the
PHP runtime, so there's no separate nginx/php-fpm split. The application
connects to an **external** SQL Server instance — no database container is
included.

## Setup

1. Copy the env template and fill in your SQL Server credentials:
   ```bash
   cp deploy/staging/.env.staging.example deploy/staging/.env.staging
   ```
   Edit `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, and `APP_URL`.

2. Build the image:
   ```bash
   docker compose -f deploy/staging/docker-compose.yml build
   ```

3. Start the stack:
   ```bash
   docker compose -f deploy/staging/docker-compose.yml up -d
   ```

4. Visit `http://localhost:9091`.

## Notes

- **`route:cache` is intentionally skipped.** `routes/web.php` and
  `routes/api.php` contain closure-based routes, which `route:cache` cannot
  serialize. `config:cache` and `view:cache` are still run.
- **Migrations run automatically** on every container start
  (`php artisan migrate --force`), against the external legacy DB. Make sure
  a backup exists before the first deploy.
- **`APP_KEY`** is auto-generated on first run if left blank in
  `.env.staging`. To keep it stable across rebuilds, fetch it once and save
  it back into `.env.staging`:
  ```bash
  docker compose -f deploy/staging/docker-compose.yml exec app php artisan key:generate --show
  ```
- **Octane workers stay booted in memory** between requests for performance.
  After deploying new code, recreate the container so workers pick it up:
  ```bash
  docker compose -f deploy/staging/docker-compose.yml up -d --build --force-recreate app
  ```
- View logs:
  ```bash
  docker compose -f deploy/staging/docker-compose.yml logs -f app
  ```

## Troubleshooting

- **`curl http://localhost:9091` returns an error or connection refused**:
  check `docker compose logs app` for SQL Server connection errors or Octane
  worker startup failures. `DB_HOST` must be reachable from *inside* the
  `app` container - `localhost` refers to the container itself, not your
  Docker host. If SQL Server runs on the Docker host, set
  `DB_HOST=host.docker.internal` (the compose file maps this via
  `extra_hosts`). Otherwise point it at the real SQL Server hostname/IP.
  After fixing `.env.staging`, restart with
  `docker compose -f deploy/staging/docker-compose.yml up -d --force-recreate app`.
