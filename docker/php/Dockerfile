FROM php:8.2-fpm

# Update package lists and install essential dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    gnupg2 \
    apt-transport-https

# Add Microsoft repo for Microsoft ODBC Driver 17 for SQL Server
RUN mkdir -p /etc/apt/keyrings \
    && curl -fsSL https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor -o /usr/share/keyrings/microsoft-prod.gpg \
    && curl -fsSL https://packages.microsoft.com/config/debian/12/prod.list | tee /etc/apt/sources.list.d/mssql-release.list

# Install Microsoft ODBC Driver for SQL Server (Linux)
RUN apt-get update \
    && ACCEPT_EULA=Y apt-get install -y msodbcsql17 unixodbc-dev libbrotli-dev libssl-dev

# Install PHP extensions (termasuk pdo_sqlsrv, sqlsrv, opcache, redis, dan swoole)
RUN docker-php-ext-install pdo mbstring exif pcntl bcmath gd opcache \
    && pecl install sqlsrv-5.12.0 pdo_sqlsrv-5.12.0 redis \
    && yes "" | pecl install swoole \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv opcache redis swoole

# Copy OPcache configuration
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html
