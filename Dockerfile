# Stage 1 - Backend (Laravel + PHP + Composer)
FROM php:8.2-fpm AS backend

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy Laravel app files
COPY . .

# Copy .env file (for local dev; in production use docker-compose env_file)
COPY .env .env

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Clear and cache Laravel config/routes/views
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan config:cache

# Set permissions for storage and cache
RUN chown -R www-data:www-data storage bootstrap/cache

CMD ["php-fpm"]
