FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libcurl4-openssl-dev \
    libzip-dev \
    unzip \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql curl zip bcmath

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copy files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and build assets
RUN npm install && npm run build

EXPOSE 10000

CMD php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}