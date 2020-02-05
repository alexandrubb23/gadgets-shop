FROM php:7.2-apache

LABEL maintainer="alex_bb23@yahoo.co.uk"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
	&& apt-get update && apt-get install -y git libzip-dev unzip \
	&& docker-php-ext-install zip \
	&& a2enmod rewrite \
	&& a2enmod headers \
	&& docker-php-ext-install mysqli \
	&& docker-php-ext-enable mysqli

EXPOSE 8000

WORKDIR /var/www/html/

COPY ./src/composer.json ./
COPY ./src/composer.lock ./

RUN composer install
