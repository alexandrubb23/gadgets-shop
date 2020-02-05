FROM php:7.2-apache

LABEL maintainer="alex_bb23@yahoo.co.uk"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
	&& apt-get update && apt-get install -y git libzip-dev unzip \
	&& docker-php-ext-install zip 

ENV MYSQL_HOST='localhost' \
    MYSQL_USER='user' \
    MYSQL_PASSWORD='pass' \
    MYSQL_DB='gadget' \
	APACHE_RUN_USER='www-data' \
    APACHE_RUN_GROUP='www-data'

RUN a2enmod rewrite
RUN a2enmod headers
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

EXPOSE 8000

WORKDIR /var/www/html
