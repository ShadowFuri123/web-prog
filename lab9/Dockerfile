FROM php:8.3-cli
WORKDIR /var/www/html

RUN apt-get update && apt-get install -y git zip unzip && rm -rf /var/lib/apt/lists/*
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json .
RUN composer install

EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80"]