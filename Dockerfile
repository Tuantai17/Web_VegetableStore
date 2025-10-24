# ------- Stage 1: build vendor (skip scripts) -------
FROM composer:2 AS vendor
ENV COMPOSER_ALLOW_SUPERUSER=1
WORKDIR /app
COPY composer.json composer.lock ./
# ⛔ Skip scripts để không gọi artisan lúc build
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts
COPY . .

# ------- Stage 2: runtime (Apache + PHP) -------
FROM php:8.3-apache
RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY --from=vendor /app /var/www/html
RUN chown -R www-data:www-data storage bootstrap/cache
