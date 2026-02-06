#FROM php:8.3-apache
#
#LABEL maintainer="Oliwer <oliwer.budnik@gmail.com>"
#
#RUN apt-get update \
#	&& apt-get install -y libmcrypt-dev libicu-dev
#
#RUN a2enmod rewrite
#RUN a2enmod ssl
#RUN a2enmod headers
#RUN a2enmod proxy
#RUN docker-php-ext-install mysqli pdo pdo_mysql intl gd
#RUN pecl install xdebug && docker-php-ext-enable xdebug

FROM php:8.3-apache

LABEL maintainer="Oliwer <oliwer.budnik@gmail.com>"

# Instalacja zależności systemowych dla rozszerzeń PHP
RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    libicu-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Włączenie potrzebnych modułów Apache
RUN a2enmod rewrite ssl headers proxy

# Instalacja rozszerzeń PHP
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    && docker-php-ext-install gd mysqli pdo pdo_mysql intl zip

# Instalacja Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# RUN apt-get update && apt-get install -y supervisor
# COPY supervisord.conf /etc/supervisor/supervisord.conf
# CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]