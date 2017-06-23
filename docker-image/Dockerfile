FROM php:7.1-apache
MAINTAINER Ridwan Shariffdeen <ridwan@orangehrmlive.com>

WORKDIR /var/www/html


#Install dependent software
RUN apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y --force-yes \
    cron \
    libreoffice-common \
    libreoffice-draw \
    libreoffice-writer \
    libpng12-dev \
    libjpeg-dev \
    libssl-dev \
    libxml2-dev \
    memcached \
    mysql-client \
    poppler-utils \
    supervisor \
    ttf-unifont \
    unzip \
    zip

#Install libraries required to compile PHP modules
RUN apt-get update && apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libgd-tools \
    libjpeg62-turbo-dev \
    libldap2-dev \
    libmcrypt-dev \
    libmemcached-dev \
    libssh2-1-dev \
    zlib1g-dev

# Configure PHP modules
RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu  \
    && docker-php-ext-configure gd --with-jpeg-dir=/usr/lib/x86_64-linux-gnu --with-png-dir=/usr/lib/x86_64-linux-gnu --with-freetype-dir=/usr/lib/x86_64-linux-gnu

# Install PHP modules
RUN  docker-php-ext-install \
     bcmath \
     calendar \
     exif \
     gd \
     gettext \
     ldap \
     mysqli \
     pdo \
     pdo_mysql \
     opcache \
     soap \
     zip

# Install PHP extended community libraries
RUN yes "" | pecl install apcu

#Compile ssh2 bindings extension for PHP7
COPY pecl-networking-ssh2-master /pecl-networking-ssh2-master
RUN cd /pecl-networking-ssh2-master && phpize \
    && ./configure \
    && make \
    && make install

# pecl/stats requires PHP (version >= 5.3.0, version <= 5.6.99), installed version is 7.1.6
#RUN pecl install stats-1.0.5

#enable php extensions
RUN docker-php-ext-enable \
         apcu \
         ssh2

# Remove apps not needed and clean apt cache
RUN apt-get purge -y --auto-remove \
        libfreetype6-dev \
        libgd-tools \
        libjpeg62-turbo-dev \
        libjpeg-dev \
        libldap2-dev \
        libpng12-dev \
        libssh2-1-dev \
    && rm -rf /var/lib/apt/lists/*

# Enable apache mods.
RUN a2enmod php7 rewrite expires headers ssl

# Update the default apache site with the config we created.
COPY apache-config.conf /etc/apache2/sites-enabled/000-default.conf

# Export port 443
EXPOSE 443

# Copy files
# ioncube is not supported in php 7.1 yet
#COPY ioncube/ioncube_loader_lin_5.6.so /usr/local/lib/php/extensions/no-debug-non-zts-20121212/ioncube_loader_lin_5.6.so
#COPY php.ini /usr/local/etc/php/php.ini

# Add supervisor conf
RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/log/supervisor /var/log/memcached
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Docker startup
CMD ["/usr/bin/supervisord"]