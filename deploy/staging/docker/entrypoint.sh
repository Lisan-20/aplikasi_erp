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

# Legacy DB already has 4300+ migrations applied; run any pending ones.
php artisan migrate --force

# route:cache is intentionally OMITTED: routes/web.php and routes/api.php
# contain closure-based routes, which route:cache cannot serialize.
php artisan config:cache
php artisan view:cache

# Publish the built assets + storage symlink into a shared volume so the
# nginx container can serve them without duplicating the app image.
mkdir -p /shared-public
cp -r /var/www/html/public/. /shared-public/
chown -R www-data:www-data /shared-public

chown -R www-data:www-data storage bootstrap/cache

exec "$@"
