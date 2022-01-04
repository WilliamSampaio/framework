FROM php:7.4-apache

RUN a2enmod rewrite

ADD . /var/www/html

RUN apt update

RUN apt upgrade -y

RUN apt install -y unzip

RUN apt install -y libzip-dev

RUN docker-php-ext-install pdo

RUN docker-php-ext-install pdo_mysql

RUN rm -rf /var/cache/apk/*

RUN docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer self-update
