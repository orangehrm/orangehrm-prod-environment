FROM ubuntu:18.04
MAINTAINER Nipuna Sankalpa <nipuna@orangehrmlive.com>

WORKDIR /var/www/html

#Install dependent software
RUN apt-get update &&  apt-get install -y \
    cron \
    systemd \
    software-properties-common \
    libssl-dev \
    libxml2-dev \
    poppler-utils \
    fonts-urw-base35 \
    unzip \
    zip

#add third party repository
RUN add-apt-repository ppa:ondrej/php

#install mariadb client
RUN apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0xF1656F24C74CD1D8
RUN add-apt-repository 'deb [arch=amd64] http://mirror.zol.co.zw/mariadb/repo/10.2/ubuntu bionic main'

#install middleware services
RUN apt-get update &&  apt-get install -y \
    apache2 \
    mariadb-client-10.2

#Install libraries required to compile PHP modules
RUN apt-get update && apt-get install -y \
    libaio1 \
    libfreetype6-dev \
    libmemcached-dev \
    libssh2-1-dev \
    zlib1g-dev

#Install PHP and pecl
RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y \
    php7.1 \
    php7.1-dev \
    pkg-config \
    libbson-1.0-0 \
    libmongoc-1.0-0 \
    php-pear \
    php-xml \
    php7.1-xml \
    php7.1-bcmath \
    php7.1-json \
    php7.1-bz2 \
    php7.1-curl \
    php7.1-gd \
    php7.1-gmp \
    php7.1-ldap \
    php7.1-mbstring \
    php7.1-mcrypt \
    php7.1-soap \
    php7.1-sqlite3 \
    php7.1-mysql \
    php7.1-zip

# Install PHP modules via pecl
RUN pecl install ssh2-1.1.2
RUN pecl install igbinary-2.0.8
RUN pecl install memcached-3.0.4
RUN pecl install stats-2.0.3
RUN pecl install ast-1.0.0
RUN pecl install apcu-5.1.14

RUN echo "extension=apcu.so" > /etc/php/7.1/mods-available/apcu.ini
RUN ln -s /etc/php/7.1/mods-available/apcu.ini /etc/php/7.1/cli/conf.d/apcu.ini
RUN ln -s /etc/php/7.1/mods-available/apcu.ini /etc/php/7.1/apache2/conf.d/apcu.ini

RUN echo "extension=ast.so" > /etc/php/7.1/mods-available/ast.ini
RUN ln -s /etc/php/7.1/mods-available/ast.ini /etc/php/7.1/cli/conf.d/ast.ini
RUN ln -s /etc/php/7.1/mods-available/ast.ini /etc/php/7.1/apache2/conf.d/ast.ini

RUN echo "extension=ssh2.so" > /etc/php/7.1/mods-available/ssh2.ini
RUN ln -s /etc/php/7.1/mods-available/ssh2.ini /etc/php/7.1/cli/conf.d/ssh2.ini
RUN ln -s /etc/php/7.1/mods-available/ssh2.ini /etc/php/7.1/apache2/conf.d/ssh2.ini

RUN echo "extension=igbinary.so" > /etc/php/7.1/mods-available/igbinary.ini
RUN ln -s /etc/php/7.1/mods-available/igbinary.ini /etc/php/7.1/cli/conf.d/igbinary.ini
RUN ln -s /etc/php/7.1/mods-available/igbinary.ini /etc/php/7.1/apache2/conf.d/igbinary.ini

RUN echo "extension=memcached.so" > /etc/php/7.1/mods-available/memcached.ini
RUN ln -s /etc/php/7.1/mods-available/memcached.ini /etc/php/7.1/cli/conf.d/memcached.ini
RUN ln -s /etc/php/7.1/mods-available/memcached.ini /etc/php/7.1/apache2/conf.d/memcached.ini

RUN echo "extension=stats.so" > /etc/php/7.1/mods-available/stats.ini
RUN ln -s /etc/php/7.1/mods-available/stats.ini /etc/php/7.1/cli/conf.d/stats.ini
RUN ln -s /etc/php/7.1/mods-available/stats.ini /etc/php/7.1/apache2/conf.d/stats.ini

# Enable apache mods.
RUN a2enmod rewrite expires headers ssl

# Update the default apache site with the config we created.
# COPY apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# Export port 443
EXPOSE 443

# Copy files
COPY ioncube/ioncube_loader_lin_7.1.so /usr/lib/php/20160303/ioncube_loader_lin_7.1.so
RUN echo "zend_extension=ioncube_loader_lin_7.1.so" > /etc/php/7.1/mods-available/ioncube.ini
RUN ln -s /etc/php/7.1/mods-available/ioncube.ini /etc/php/7.1/cli/conf.d/00-ioncube.ini
RUN ln -s /etc/php/7.1/mods-available/ioncube.ini /etc/php/7.1/apache2/conf.d/00-ioncube.ini

#remove php 7.2 additional modules
RUN apt-get remove -y php7.2-*

RUN service apache2 start

# Docker startup
CMD ["/sbin/init"]