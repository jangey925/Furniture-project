# Multi-stage Dockerfile for Laravel app (suitable for Render)

# 1) Build frontend assets using Node
FROM node:18 AS node_builder
WORKDIR /app
COPY package*.json ./
RUN npm ci --silent
COPY . .
# Build production assets (adjust script name if needed)
RUN npm run build --silent || true

# 2) Final image with PHP and Composer
FROM php:8.2-fpm

# system deps and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zlib1g-dev \
    libonig-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) pdo_mysql gd zip bcmath exif pcntl \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Copy built assets from node stage
COPY --from=node_builder /app/public /var/www/html/public

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction || true

# Set permissions for storage and cache
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
 && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

EXPOSE 8000

# Start command: run migrations (best-effort), ensure app key and storage link, then start PHP built-in server on $PORT
# Render sets the $PORT environment variable; default to 8000 if not provided.
CMD ["sh", "-c", "php artisan migrate --force || true; php artisan key:generate --ansi || true; php artisan storage:link || true; php -S 0.0.0.0:${PORT:-8000} -t public"]
