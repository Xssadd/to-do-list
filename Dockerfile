FROM php:8.2-fpm

WORKDIR /var/www/html

# Устанавливаем зависимости и расширения PHP
RUN apt-get update && apt-get install -y \
    git curl \
    && docker-php-ext-install pdo_mysql

# Берём Composer из официального образа
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer