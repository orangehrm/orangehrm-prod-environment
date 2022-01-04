FROM ubuntu:20.04
LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

WORKDIR /var/www/html

RUN apt update \
    && apt install -y vim wget unzip

#set the TimeZone
ENV TZ="Asia/Colombo"

#Install MariaDB 10.4 client
RUN curl -LsS -O https://downloads.mariadb.com/MariaDB/mariadb_repo_setup
RUN bash mariadb_repo_setup --mariadb-server-version=10.4.22
RUN apt install -y mariadb-client

#Install Other server dependencies
RUN apt install -y \
    fonts-urw-base35\
    poppler-utils \
    libreoffice \
    default-jre \
    libssl-dev \
    libmagickwand-dev \
    imagemagick \
    curl \
    zip \
    unzip \
    p7zip \
    cron\
    apt-utils

# -----------------------------------------------------------------------------
# Installing Apache 
# -----------------------------------------------------------------------------

RUN DEBIAN_FRONTEND="noninteractive" apt install -y apache2 \
    && update-rc.d apache2 defaults \
    && service apache2 start

# Recommended Apache Server Configurations 

RUN a2enmod ssl \
    && a2enmod headers \
    && a2enmod rewrite \
    && service apache2 start

#verify modules

RUN apache2ctl -M | grep 'ssl\|rewrite\|header'

# -----------------------------------------------------------------------------
# Installing PHP 
# -----------------------------------------------------------------------------

RUN apt-get update 

RUN apt-get install -y \
    libaio1 \
    libfreetype6-dev \
    libmemcached-dev \
    libssh2-1-dev \
    libmcrypt-dev \
    zlib1g-dev

RUN apt update &&  apt install -y \
    php7.4 \
    php7.4-dev \
    pkg-config \
    libbson-1.0-0 \
    libmongoc-1.0-0 \
    php7.4-cli \
    php-pear \
    php7.4-tidy \
    php7.4-xml \
    php7.4-bcmath \
    php7.4-json \
    php7.4-bz2 \
    php7.4-curl \
    php7.4-gd \
    php7.4-gmp \
    php7.4-ldap \
    php7.4-mbstring \
    php7.4-soap \
    php7.4-sqlite3 \
    php7.4-imap \
    php7.4-mysql \
    php7.4-zip \
    libapache2-mod-php7.4

#Installing the following packages via PECL
RUN pecl install ssh2-1.3.1 
RUN pecl install igbinary-3.2.4 
RUN pecl install memcached-3.1.5 
RUN pecl install apcu-5.1.20 
RUN pecl install mcrypt-1.0.4 

#Enable APCU Extension
RUN echo "extension=apcu.so" | tee /etc/php/7.4/mods-available/apcu.ini \
    && ln -s /etc/php/7.4/mods-available/apcu.ini /etc/php/7.4/cli/conf.d/apcu.ini \
    && ln -s /etc/php/7.4/mods-available/apcu.ini /etc/php/7.4/apache2/conf.d/apcu.ini
#Enable Mcrypt Extension   
RUN echo "extension=mcrypt.so" |  tee /etc/php/7.4/mods-available/mcrypt.ini \
    && ln -s /etc/php/7.4/mods-available/mcrypt.ini /etc/php/7.4/cli/conf.d/mcrypt.ini \
    && ln -s /etc/php/7.4/mods-available/mcrypt.ini /etc/php/7.4/apache2/conf.d/mcrypt.ini 
#Enable SSH2 Extension
RUN echo "extension=ssh2.so" |  tee /etc/php/7.4/mods-available/ssh2.ini \
    && ln -s /etc/php/7.4/mods-available/ssh2.ini /etc/php/7.4/cli/conf.d/ssh2.ini \
    && ln -s /etc/php/7.4/mods-available/ssh2.ini /etc/php/7.4/apache2/conf.d/ssh2.ini
#Enable IGBINARY Extension
RUN echo "extension=igbinary.so" |  tee /etc/php/7.4/mods-available/igbinary.ini \
    && ln -s /etc/php/7.4/mods-available/igbinary.ini /etc/php/7.4/cli/conf.d/igbinary.ini \
    && ln -s /etc/php/7.4/mods-available/igbinary.ini /etc/php/7.4/apache2/conf.d/igbinary.ini
#Enable MEMCACHED Extension
RUN echo "extension=memcached.so" |  tee /etc/php/7.4/mods-available/memcached.ini \
    && ln -s /etc/php/7.4/mods-available/memcached.ini /etc/php/7.4/cli/conf.d/memcached.ini \
    && ln -s /etc/php/7.1/mods-available/memcached.ini /etc/php/7.4/apache2/conf.d/memcached.ini 

# IonCube module
RUN wget https://downloads.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.zip \
    && unzip ioncube_loaders_lin_x86-64.zip \
    && rm ioncube_loaders_lin_x86-64.zip \
    && cp /var/www/html/ioncube/ioncube_loader_lin_7.4.so /usr/lib/php/20190902/ioncube.so

#Enable IonCube module
RUN echo "zend_extension=ioncube.so" |  tee /etc/php/7.4/mods-available/00-ioncube.ini \
    && ln -s /etc/php/7.4/mods-available/00-ioncube.ini /etc/php/7.4/cli/conf.d/00-ioncube.ini \
    && ln -s /etc/php/7.4/mods-available/00-ioncube.ini /etc/php/7.4/apache2/conf.d/00-ioncube.ini

RUN service apache2 start

