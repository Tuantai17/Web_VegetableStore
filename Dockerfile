# ===== Stage 1: Composer =====
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# ===== Stage 2: Node (build FE) =====
FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN if [ -f package-lock.json ]; then npm ci; else npm install; fi
COPY . .
RUN npm run build || echo "skip FE build"

# ===== Stage 3: Runtime (PHP-FPM + Nginx) =====
FROM php:8.3-fpm-alpine
WORKDIR /var/www/html

# packages + php-ext
RUN apk add --no-cache nginx supervisor bash git curl libpng-dev oniguruma-dev libxml2-dev zip unzip \
  && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# copy source
COPY . .

# vendor & FE assets
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

# Nginx & Supervisor & EntryPoint
COPY ./docker/nginx.conf /etc/nginx/http.d/default.conf
COPY ./docker/supervisord.conf /etc/supervisord.conf
COPY ./docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# quyền cho Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80
# Entry: chạy artisan tự động rồi khởi động nginx+php-fpm
CMD ["/entrypoint.sh"]
