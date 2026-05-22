FROM node:22 AS node

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build


FROM php:8.4-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    unzip curl git zip libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

COPY --from=node /app/public/build ./public/build

CMD php artisan serve --host=0.0.0.0 --port=$PORT