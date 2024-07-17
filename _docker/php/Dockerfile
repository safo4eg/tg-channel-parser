FROM php:8.3-fpm-alpine

RUN apk --no-cache add \
    bash \
    curl \
    libpng-dev \
    libzip-dev \
    libpq-dev \
    zip unzip\
    tzdata


RUN docker-php-ext-install pdo_mysql bcmath gd zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Настраиваем права
#RUN chown -R www-data:www-data /var/www
#RUN chmod -R 755 /var/www/storage /var/www/bootstrap/cache

WORKDIR /var/www

EXPOSE 9000

# Запуск PHP-FPM
CMD ["php-fpm"]