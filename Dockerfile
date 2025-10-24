# ---- Stage 1: build vendor
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
COPY . .

# ---- Stage 2: runtime web (Apache + PHP)
FROM php:8.3-apache
# Cài ext cần thiết
RUN docker-php-ext-install pdo_mysql
# Bật rewrite cho Laravel
RUN a2enmod rewrite
# Đặt document root = public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

WORKDIR /var/www/html
COPY --from=vendor /app /var/www/html

# quyền storage/bootstrap (nếu cần)
RUN chown -R www-data:www-data storage bootstrap/cache

# Apache sẽ chạy foreground theo CMD mặc định của image => Render sẽ thấy tiến trình dài hạn
