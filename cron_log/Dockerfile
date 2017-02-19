FROM amazonlinux

RUN yum update -y


ADD crontab /etc/cron.d/lumen-cron

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/lumen-cron


RUN yum install -y \
				php70 php70-opcache php70-mysqlnd \
				php70-devel php70-pecl-memcache php70-mcrypt

RUN yum install -y cronie
RUN yum install -y wget zip unzip gcc

RUN curl -sS https://getcomposer.org/installer | php && mv ./composer.phar /usr/local/bin/composer

RUN wget https://github.com/phpredis/phpredis/archive/php7.zip -O /tmp/phpredis.zip
RUN unzip -o /tmp/phpredis.zip -d /tmp && ls -lah /tmp/phpredi* && rm /tmp/phpredis.zip && mv /tmp/phpredi* /tmp/phpredis && cd /tmp/phpredis && phpize && ./configure && make && make install


#RUN docker-php-ext-install -j$(nproc) pdo_mysql

# Run the command on container startup
CMD cron

