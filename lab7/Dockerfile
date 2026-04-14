FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y git unzip curl && rm -rf /var/lib/apt/lists/*

# Установка расширений
RUN docker-php-ext-install sockets pcntl

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# 1. Копируем composer.json ИЗ ПАПКИ www
COPY www/composer.json .

# 2. Устанавливаем зависимости ПРЯМО В ОБРАЗ
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# 3. Копируем весь остальной код
COPY www/ .

CMD ["php-fpm"]