FROM php:7.0-apache
RUN docker-php-ext-install mysqli

# Installing Composer
RUN curl -sS https://getcomposer.org/installer | php && mv ./composer.phar /usr/local/bin/composer

RUN apt-get update
RUN apt-get install -y \
        openssl \
        zip \
        unzip \
#        curl \
        libmemcached-dev
#   && pecl install memcached
RUN docker-php-ext-install -j$(nproc) iconv pdo pdo_mysql
#curl
#   && docker-php-ext-enable memcached

RUN a2enmod rewrite
#RUN a2enmod ssl

RUN service apache2 restart