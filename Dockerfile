FROM php:8.2-apache

RUN apt-get update && apt-get install -y libzip-dev unzip libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring
RUN apt-get update && \
    apt-get install -y libicu-dev && \
    docker-php-ext-install intl
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libbz2-dev \
    libcurl4-openssl-dev \
    libxml2-dev \
    unzip \
    libsqlite3-dev \
    libonig-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libfreetype6-dev \
    libgettextpo-dev \
    && docker-php-ext-install intl bz2 curl fileinfo gettext exif mysqli pdo pdo_mysql pdo_sqlite zip

RUN a2enmod rewrite

COPY apache.conf /etc/apache2/sites-available/000-default.conf
COPY php.ini /usr/local/etc/php/

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html/writable \
    && chmod -R 777 /var/www/html/writable

WORKDIR /var/www/html