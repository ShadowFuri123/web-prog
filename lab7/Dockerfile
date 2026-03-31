FROM php:8.2-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    librdkafka-dev \
    libz-dev \
    && rm -rf /var/lib/apt/lists/*

# Установка расширений PHP
# sockets и pcntl нужны для php-amqplib
# rdkafka нужен для nmred/kafka-php
RUN docker-php-ext-install sockets pcntl \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka

# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html

# Копируем только composer.json сначала для кэширования слоя
COPY composer.json .

# Устанавливаем зависимости (флаги для избежания интерактивных запросов)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Копируем исходный код приложения
COPY ./www /var/www/html

CMD ["php-fpm"]