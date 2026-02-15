FROM php:8.3-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel optimizations (optional safe mode)
RUN php artisan config:cache || true
RUN php artisan route:cache || true
RUN php artisan view:cache || true

# Railway will provide $PORT
EXPOSE 8080

CMD ["sh", "-c", "php -S 0.0.0.0:$PORT -t public"]
