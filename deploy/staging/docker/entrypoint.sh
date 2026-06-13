#!/bin/sh
set -e

cd /var/www/html

if [ -z "${APP_KEY}" ]; then
    echo "[entrypoint] APP_KEY not set, generating one..."
    # key:generate replaces an "APP_KEY=" line in .env, which isn't shipped
    # in the image - create one with an empty key for it to fill in.
    [ -f .env ] || echo "APP_KEY=" > .env
    php artisan key:generate --force
fi

php artisan storage:link || true

chown -R www-data:www-data storage bootstrap/cache

# Publish the built assets + storage symlink into a shared volume so the
# nginx container can serve them without duplicating the app image. Do this
# before the DB-dependent steps below so nginx always has something to serve
# (the app shell), even if the external SQL Server is unreachable on startup.
mkdir -p /shared-public
cp -r /var/www/html/public/. /shared-public/
chown -R www-data:www-data /shared-public

# Clear any stale bootstrap/cache/config.php that may have been baked into
# the Docker image or persisted across restarts via the bootstrap_cache volume.
# This ensures the DB connection timeout (set via DB_TIMEOUT) is picked up
# before running DB-dependent commands below.
php artisan config:clear 2>/dev/null || true

# Legacy DB already has 4300+ migrations applied; run any pending ones.
# Don't let a DB outage abort the entrypoint - log it and keep going so
# nginx can still serve the published assets above.
if ! php artisan migrate --force; then
    echo "[entrypoint] WARNING: migrate failed (DB unreachable?). Continuing without it." >&2
fi

# route:cache is intentionally OMITTED: routes/web.php and routes/api.php
# contain closure-based routes, which route:cache cannot serialize.
php artisan config:cache
php artisan view:cache

exec "$@"
