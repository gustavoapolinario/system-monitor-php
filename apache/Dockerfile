FROM php:7.0-apache
RUN docker-php-ext-install mysqli

# Installing Composer
RUN curl -sS https://getcomposer.org/installer | php && mv ./composer.phar /usr/local/bin/composer

RUN apt-get update -yq && apt-get upgrade -yq
RUN apt-get install -y \
        openssl \
        zip \
        unzip \
#        curl \
        libmemcached-dev
#   && pecl install memcached

RUN apt-get install -y cron vim
RUN apt-get install -y mysql-client

RUN docker-php-ext-install -j$(nproc) iconv pdo pdo_mysql
#curl
#   && docker-php-ext-enable memcached

RUN apt-get -qq update
RUN apt-get install -y nodejs npm
#RUN update-alternatives --install /usr/bin/node node /usr/bin/nodejs 10
RUN npm install -g gulp bower

RUN a2enmod rewrite
#RUN a2enmod ssl

RUN service apache2 restart


#RUN touch /etc/cron.d/apache
ADD crontab /etc/cron.d/apache
RUN crontab /etc/cron.d/apache

#RUN touch /etc/cron.d/logServer
#ADD crontab-log-server /etc/cron.d/logServer
#RUN crontab /etc/cron.d/logServer

#don't work here
RUN service cron start
#RUN cron
