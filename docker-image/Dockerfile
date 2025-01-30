FROM ubuntu:24.04
LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

WORKDIR /var/www/html

RUN apt-get update \
    && apt install -y vim wget unzip

#set the TimeZone
ENV TZ="Asia/Colombo"
ARG DEBIAN_FRONTEND="noninteractive"


#Install Other server dependencies
RUN apt install -y \
    apt-transport-https \
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
    qpdf\
    apt-utils

#Start cron serviceRU
RUN service cron start

#Install MariaDB 10.4 client
RUN curl -LsS -O https://downloads.mariadb.com/MariaDB/mariadb_repo_setup
RUN bash mariadb_repo_setup --mariadb-server-version=10.11.10
RUN apt install -y mariadb-client

# -----------------------------------------------------------------------------
# Installing Apache 
# -----------------------------------------------------------------------------

RUN  apt install -y apache2 \
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
    libaio1t64 \  
    libfreetype6-dev \
    libmemcached-dev \
    libssh2-1-dev \
    libmcrypt-dev \
    zlib1g-dev

RUN apt update &&  apt install -y \
    php8.3 \
    php8.3-dev \
    pkg-config \
    libbson-1.0-0 \
    libmongoc-1.0-0 \
    php8.3-cli \
    php-pear \
    php8.3-tidy \
    php8.3-xml \
    php8.3-bcmath \
    # php8.3-json \
    php8.3-bz2 \
    php8.3-curl \
    php8.3-gd \
    php8.3-gmp \
    php8.3-ldap \
    php8.3-mbstring \
    php8.3-soap \
    php8.3-sqlite3 \
    php8.3-imap \
    php8.3-mysql \
    php8.3-zip \
    libapache2-mod-php8.3

#Installing the following packages via PECL
RUN pecl install ssh2-1.3.1 
RUN pecl install igbinary-3.2.16
RUN pecl install memcached-3.1.5 
RUN pecl install apcu-5.1.20 
RUN pecl install mcrypt-1.0.7

# Enable APCU Extension
RUN echo "extension=apcu.so" | tee /etc/php/8.3/mods-available/apcu.ini \
    && ln -s /etc/php/8.3/mods-available/apcu.ini /etc/php/8.3/cli/conf.d/apcu.ini \
    && ln -s /etc/php/8.3/mods-available/apcu.ini /etc/php/8.3/apache2/conf.d/apcu.ini

# Enable IGBINARY Extension
RUN echo "extension=igbinary.so" | tee /etc/php/8.3/mods-available/igbinary.ini \
    && ln -s /etc/php/8.3/mods-available/igbinary.ini /etc/php/8.3/cli/conf.d/igbinary.ini \
    && ln -s /etc/php/8.3/mods-available/igbinary.ini /etc/php/8.3/apache2/conf.d/igbinary.ini

# IonCube module
COPY ioncube/ioncube_loader_lin_8.3.so /usr/lib/php/20190902/ioncube_loader_lin_8.3.so

# Copy the PHP configuration file
COPY php.ini /etc/php/8.3/apache2/php.ini
COPY php.ini /etc/php/8.3/cli/php.ini

# Generating the report of installed packages
RUN apt list --installed > /var/log/installed_packages_detailed_report.txt

#Start apache 
CMD [ "/usr/sbin/apache2ctl" , "-D" , "FOREGROUND" ]

