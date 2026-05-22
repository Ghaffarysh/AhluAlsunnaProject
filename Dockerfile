FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nodejs npm

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get install -y nginx

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# أنشئ ملف SQLite فارغ داخل الـ image
RUN mkdir -p /var/www/database && touch /var/www/database/database.sqlite

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/database

COPY docker/nginx.conf /etc/nginx/sites-available/default

EXPOSE 80

CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php-fpm -D && \
    nginx -g "daemon off;"