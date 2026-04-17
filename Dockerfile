FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql zip

RUN a2enmod rewrite

COPY . /var/www/html

WORKDIR /var/www/html

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php
RUN php composer.phar install

RUN chmod -R 777 storage bootstrap/cache

RUN php artisan key:generate || true
RUN php artisan config:clear || true
RUN php artisan cache:clear || true

EXPOSE 80