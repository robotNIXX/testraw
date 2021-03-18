FROM php:7.4-fpm

ADD ./etc/php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN groupadd -g 1000 laravel && useradd -G laravel -g laravel -s /bin/bash laravel

RUN mkdir -p /var/www/testraw.test

RUN chown laravel:laravel /var/www/testraw.test

WORKDIR /var/www/testraw.test

RUN docker-php-ext-install pdo pdo_mysql
