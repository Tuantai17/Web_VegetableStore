# ===== Stage 1: Composer =====
FROM composer:2 AS vendor
WORKDIR /app

# cho phép chạy composer với quyền root trong container
ENV COMPOSER_ALLOW_SUPERUSER=1

COPY composer.json composer.lock ./
# TẮT scripts để không gọi artisan trong lúc build
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts
