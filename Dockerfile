# ===== Stage 1: Composer (cài vendor) =====
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# ===== Stage 2: Build FE assets (nếu dùng Vite) =====
FROM node:20-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci || npm install
COPY . .
# Nếu có Vite/Laravel Mix thì build, nếu không có cũng không sao
RUN npm run build || echo "No front-end build step"

# ===== Stage 3: Runtime PHP-FPM + Nginx =====
FROM php:8.3-fpm-alpine
WORKDIR /var/www/html

# Cài Nginx + extensions cần cho Laravel
RUN apk add --no-cache nginx supervisor bash git curl libpng-dev oniguruma-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copy source code
COPY . .

# Copy vendor & assets đã build
COPY --from=vendor /app/vendor ./vendor
# Nếu bạn dùng laravel-vite-plugin thì build ra public/build:
COPY --from=assets /app/public/build ./public/build

# Quyền thư mục storage + cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Nginx + Supervisor config
COPY ./docker/nginx.conf /etc/nginx/http.d/default.conf
COPY ./docker/supervisord.conf /etc/supervisord.conf

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
