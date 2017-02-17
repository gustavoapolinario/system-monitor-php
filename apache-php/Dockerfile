FROM php:7.0-apache
RUN docker-php-ext-install mysqli

# Installing Composer
RUN curl -sS https://getcomposer.org/installer | php && mv ./composer.phar /usr/local/bin/composer

RUN apt-get update
RUN apt-get install -y \
        openssl \
        zip \
        unzip \
        curl \
        git-core \
        libxml2-dev \
        libcurl4-gnutls-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        libmemcached-dev \
#   && pecl install memcached
    && docker-php-ext-install -j$(nproc) iconv mcrypt gd pdo pdo_mysql dom hash curl
#   && docker-php-ext-enable memcached

RUN a2enmod rewrite
RUN a2enmod ssl

RUN service apache2 restart