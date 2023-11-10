FROM php:8.0-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip

# Установка расширений
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Установка рабочего каталога
WORKDIR /var/www

# Копирование зависимостей
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Копирование приложения
COPY . .

# Завершение установки зависимостей
RUN composer dump-autoload --optimize

# Команда по умолчанию, запускающая сервер Laravel
CMD php artisan serve --host=0.0.0.0 --port=80
