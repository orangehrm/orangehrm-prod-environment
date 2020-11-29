FROM centos/systemd
LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

WORKDIR /var/www/html

# Installing EPEL repository
RUN yum install -y epel-release

# Addind IUS repos : reffered guide : https://support.rackspace.com/how-to/centos-7-apache-and-php-install
# Alternative command : yum install -y https://repo.ius.io/ius-release-el7.rpm https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
#RUN yum install -y https://$(rpm -E '%{?centos:centos}%{!?centos:rhel}%{rhel}').iuscommunity.org/ius-release.rpm
RUN yum install \
    https://repo.ius.io/ius-release-el7.rpm \
    https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm

# Add MariaDB keys
RUN rpm --import https://yum.mariadb.org/RPM-GPG-KEY-MariaDB

COPY ./repos/mariadb.repo /etc/yum.repos.d/

# Install Font group
RUN yum -y groupinstall "Font"

# -----------------------------------------------------------------------------
# Apache + PHP
# -----------------------------------------------------------------------------

RUN yum -y install \
    httpd \
    gcc \
    MariaDB-client \
    libaio-devel \
    poppler-utils \
    supervisor \
    libreoffice-draw \
    libreoffice-writer \
    libmcrypt \
    libmcrypt-devel \
    cronie \
    libssh2 \
    libssh2-devel \
    memcached \
    initscripts \
    ImageMagick \
    ImageMagick-devel \
    ImageMagick-perl \
    mod_ssl \
    mod_php73 \
   	php73-cli \
   	php73-ldap \
   	php73-bcmath \
   	php73-devel \
    php73-gmp \   
    php73-imap \
   	php73-mysqlnd \
   	php73-pdo \
   	php73-mbstring \
   	php73-soap \
   	php73-gd \
   	php73-xml \
    php73-process \
   	php73-pecl-apcu \
   	php73-pecl-memcached \
    pear1u.noarch \
    zip \
    unzip \
    p7zip \
    wget \
    urw-fonts.noarch \
    && yum -y update bash \
    && rm -rf /var/cache/yum/* \
    && yum clean all

# Insrall ssh2 and mcrypt
RUN pecl install -f ssh2-1.2
RUN pecl install -f mcrypt-1.0.3

RUN mkdir /opt/oracle
COPY oracle-db /opt/oracle
RUN cd /opt/oracle;unzip instantclient-basic-linux-x86-64-11.2.0.2.0.zip \
   && unzip instantclient-sdk-linux-x86-64-11.2.0.2.0.zip \
   && unzip instantclient-sqlplus-linux-x86-64-11.2.0.2.0.zip \
   && rm instantclient-basic-linux-x86-64-11.2.0.2.0.zip \
   && rm instantclient-sdk-linux-x86-64-11.2.0.2.0.zip \
   && rm instantclient-sqlplus-linux-x86-64-11.2.0.2.0.zip \
   && ln -s /opt/oracle/instantclient_11_2/libclntsh.so.11.1 /opt/oracle/instantclient_11_2/libclntsh.so \
   && ln -s /opt/oracle/instantclient_11_2/libocci.so.11.1 /opt/oracle/instantclient_11_2/libocci.so \
   && ln -s /opt/oracle/instantclient_11_2/sqlplus /usr/local/bin/sqlplus \
   && echo /opt/oracle/instantclient_11_2 > /etc/ld.so.conf.d/oracle-instantclient \
   && ldconfig

ENV ORACLE_HOME=/opt/oracle/instantclient_11_2
ENV LD_LIBRARY_PATH="$ORACLE_HOME"
ENV PATH="$ORACLE_HOME:$PATH"
ENV container docker


# Update the default apache site with the config we created.
RUN mkdir /etc/httpd/sites-available
RUN mkdir /etc/httpd/sites-enabled
RUN echo "IncludeOptional sites-enabled/*.conf" >> /etc/httpd/conf/httpd.conf
COPY apache-config.conf /etc/httpd/sites-available/orangehrm.conf
RUN ln -s /etc/httpd/sites-available/orangehrm.conf /etc/httpd/sites-enabled/


# Export port 443
EXPOSE 443

# Copy files ioncube loader and php.ini
COPY ioncube/ioncube_loader_lin_7.3.so /usr/local/lib/php/extensions/no-debug-non-zts-20121212/ioncube_loader_lin_7.3.so
COPY php.ini /etc/php.ini


# Add supervisor conf
RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/log/supervisor /var/log/memcached
COPY supervisord.conf /etc/supervisord.conf

RUN systemctl enable httpd.service
RUN systemctl enable memcached.service
RUN systemctl enable crond.service
