FROM nginx:stable-alpine

ADD ./etc/nginx/nginx.conf /etc/nginx/nginx.conf
ADD ./etc/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/www/testraw.test

COPY ./etc/certs /etc/ssl

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/bash -D laravel

RUN chown laravel:laravel /var/www/testraw.test