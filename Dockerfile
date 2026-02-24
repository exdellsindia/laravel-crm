FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl \
    libzip-dev libpng-dev libonig-dev libxml2-dev zip

# Install required extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    bcmath \
    gd \
    calendar

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN php artisan config:clear || true
RUN php artisan cache:clear || true

EXPOSE 8080

CMD sh -c "php artisan serve --host=0.0.0.0 --port=$PORT"