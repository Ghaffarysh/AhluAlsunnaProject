FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip nodejs npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Nginx
RUN apt-get install -y nginx

WORKDIR /var/www

# Copy project
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copy Nginx config
COPY docker/nginx.conf /etc/nginx/sites-available/default

EXPOSE 80

CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php-fpm -D && \
    nginx -g "daemon off;"