FROM php:8.3-cli

# System libs + PHP extensions CodeIgniter needs (intl, mysqli)
RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip libicu-dev libzip-dev \
    && docker-php-ext-install intl mysqli \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . /app

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && mkdir -p writable/cache writable/logs writable/session writable/uploads \
    && chmod -R 777 writable

CMD php spark migrate --no-interaction \
    && php spark db:seed DatabaseSeeder \
    ; php -S 0.0.0.0:${PORT:-8080} -t public vendor/codeigniter4/framework/system/rewrite.php