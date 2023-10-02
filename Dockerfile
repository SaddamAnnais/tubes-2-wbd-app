FROM php:8.0-apache
WORKDIR /var/www/html
COPY ./src .
# COPY .env .
# COPY .htaccess .


RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite

EXPOSE 80
