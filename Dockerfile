FROM php:8.4-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    unzip curl libpq-dev git zip \
    && docker-php-ext-install pdo pdo_pgsql

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

CMD php artisan serve --host=0.0.0.0 --port=$PORT