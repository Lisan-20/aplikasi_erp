# syntax=docker/dockerfile:1

#######################################
# Stage 1: PHP static analysis (Larastan)
#
# Pint formatting is intentionally NOT enforced here: the repo has
# pre-existing style issues outside this change's scope. Pint is run in CI
# scoped to changed files only (see .github/workflows/ci.yml).
#######################################
FROM composer:2 AS php_lint

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-interaction --prefer-dist

COPY . .
RUN ./vendor/bin/phpstan analyse --no-progress --memory-limit=512M


#######################################
# Stage 2: Composer dependencies
#######################################
FROM composer:2 AS composer_deps

WORKDIR /app

# Force this stage to depend on php_lint so `docker build` fails the whole
# build if static analysis fails.
COPY --from=php_lint /app/composer.lock /tmp/.php-lint-ok

COPY composer.json composer.lock ./
RUN composer install \
        --no-dev \
        --no-scripts \
        --no-autoloader \
        --no-interaction \
        --prefer-dist

COPY . .
RUN composer dump-autoload --optimize --no-dev \
    && composer run-script post-autoload-dump --no-dev


#######################################
# Stage 3: Frontend assets (Vite + ESLint)
#######################################
FROM node:20-alpine AS node_build

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run lint
RUN npm run build


#######################################
# Stage 4: Runtime (php-fpm + sqlsrv)
#######################################
FROM php:8.3-fpm-alpine3.20 AS runtime

ARG MSODBC_VERSION=18.6.2.1-1

# System libs + Microsoft ODBC driver + sqlsrv/pdo_sqlsrv extensions
RUN set -eux; \
    apk add --no-cache curl unixodbc libstdc++ icu-libs; \
    curl -fsSL -o /tmp/msodbcsql18.apk \
        "https://download.microsoft.com/download/0b3d5518-b4a7-4a2b-afc7-7ee9e967f93c/msodbcsql18_${MSODBC_VERSION}_amd64.apk"; \
    apk add --allow-untrusted /tmp/msodbcsql18.apk; \
    rm /tmp/msodbcsql18.apk; \
    apk add --no-cache --virtual .build-deps ${PHPIZE_DEPS} unixodbc-dev; \
    pecl install sqlsrv pdo_sqlsrv; \
    docker-php-ext-enable sqlsrv pdo_sqlsrv; \
    apk del .build-deps

COPY deploy/staging/php/conf.d/laravel.ini /usr/local/etc/php/conf.d/zz-laravel.ini

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .
COPY --chown=www-data:www-data --from=composer_deps /app/vendor ./vendor
COPY --chown=www-data:www-data --from=node_build /app/public/build ./public/build

RUN mkdir -p storage/framework/cache/data \
             storage/framework/sessions \
             storage/framework/views \
             storage/app/public \
             storage/logs \
             bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache

# Allow the nginx container to reach php-fpm (default pool only binds 127.0.0.1)
RUN sed -i 's/^listen = 127.0.0.1:9000/listen = 0.0.0.0:9000/' /usr/local/etc/php-fpm.d/www.conf

COPY deploy/staging/docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Run as root: the entrypoint needs to chown shared volumes on startup, and
# the php-fpm master process drops worker processes to www-data per
# www.conf's `user`/`group` directives.
EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
