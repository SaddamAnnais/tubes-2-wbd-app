FROM php:8.0-apache
WORKDIR /var/www/html
COPY . .
COPY .env .


RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 80
