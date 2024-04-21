FROM php:7.4-apache

RUN apt-get -y update
RUN apt-get -y upgrade
RUN apt-get -y install libsqlite3-dev php7.4-sqlite sqlite3 libbz2-dev

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY composer.json .
RUN composer install

COPY . .

RUN a2enmod rewrite