FROM php:7.4-fpm

MAINTAINER Akash Bose

RUN usermod -u 1000 www-data && \
    groupmod -g 1000 www-data

COPY  .docker/php/config/fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY  .docker/php/config/php.ini /usr/local/etc/php/php.ini

RUN apt-get update

# 1. Install required libs for extyensions
RUN apt-get install libyaml-dev librabbitmq-dev \ 
libwebp-dev libjpeg-dev libpng-dev libz-dev libxpm-dev libfreetype6-dev libicu-dev -y

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install pdo_mysql gd exif intl

RUN pecl install yaml amqp 
RUN docker-php-ext-enable yaml amqp
