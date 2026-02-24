FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev zip

RUN docker-php-ext-install \
    pdo pdo_mysql mbstring zip exif bcmath gd calendar

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN php artisan config:clear || true
RUN php artisan cache:clear || true

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t public"]