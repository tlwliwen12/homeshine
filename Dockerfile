# Use PHP-FPM base image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy Laravel app files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Clear and cache Laravel config/routes/views
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan config:cache

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

CMD ["php-fpm"]
