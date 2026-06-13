# Staging Deployment

Two containers: `app` (PHP-FPM 8.3 + sqlsrv) and `nginx` (serves static assets,
proxies PHP requests to `app`). The application connects to an **external**
SQL Server instance — no database container is included.

## Setup

1. Copy the env template and fill in your SQL Server credentials:
   ```bash
   cp deploy/staging/.env.staging.example deploy/staging/.env.staging
   ```
   Edit `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, and `APP_URL`.

2. Build the images:
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
- Built frontend assets and the `public/storage` symlink are published into a
  shared `app_public` volume so `nginx` can serve them without bundling
  Node/Composer toolchains into the runtime image.
- View logs:
  ```bash
  docker compose -f deploy/staging/docker-compose.yml logs -f app
  ```

## Troubleshooting

- **`curl http://localhost:9091` returns `403 Forbidden`**: this means the
  `app_public` shared volume is empty (nginx has no `index.php` to serve and
  directory listing is disabled). Check `docker compose logs app` for SQL
  Server connection errors. `DB_HOST` must be reachable from *inside* the
  `app` container - `localhost` refers to the container itself, not your
  Docker host. If SQL Server runs on the Docker host, set
  `DB_HOST=host.docker.internal` (the compose file maps this via
  `extra_hosts`). Otherwise point it at the real SQL Server hostname/IP.
  After fixing `.env.staging`, restart with
  `docker compose -f deploy/staging/docker-compose.yml up -d --force-recreate app`.
