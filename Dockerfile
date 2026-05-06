FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libcurl4-openssl-dev \
    libzip-dev \
    libsqlite3-dev \
    unzip \
    curl \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql pdo_sqlite curl zip bcmath

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install && npm run build

RUN touch /app/database/database.sqlite
RUN chmod -R 777 storage bootstrap/cache

CMD php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}