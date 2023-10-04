FROM php:8.0-apache
WORKDIR /var/www/html
COPY ./src .

RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
RUN apt-get -y update && apt-get -y upgrade && apt-get install -y ffmpeg

EXPOSE 80
