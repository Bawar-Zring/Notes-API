FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

WORKDIR /var/www/html

COPY . /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install --no-interaction --prefer-dist --no-dev

RUN php artisan passport:keys

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R ug+rw storage bootstrap/cache \
    && chmod 600 storage/oauth-private.key storage/oauth-public.key
