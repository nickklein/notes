FROM php:7.4-apache-buster

COPY . /var/www/html
COPY .docker/vhosts.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y nano cron build-essential

RUN useradd -ms /bin/bash tyrion
RUN chown -R tyrion:www-data /var/www/html/ && a2enmod rewrite

RUN apt-get install -y make nano build-essential python3 python3-pip libssl-dev zlib1g-dev libbz2-dev libreadline-dev libsqlite3-dev wget curl llvm libncurses5-dev libncursesw5-dev xz-utils libmcrypt-dev && docker-php-ext-install mysqli pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
