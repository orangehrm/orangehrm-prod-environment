FROM centos/systemd
LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

WORKDIR /var/www/html

# Addind IUS repos : reffered guide : https://support.rackspace.com/how-to/centos-7-apache-and-php-install
RUN yum install https://$(rpm -E '%{?centos:centos}%{!?centos:rhel}%{rhel}').iuscommunity.org/ius-release.rpm

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
    mod_ssl \
#    php72w \
#   	php72w-cli \
#   	php72w-mcrypt \
#   	php72w-ldap \
#   	php72w-bcmath \
#   	php72w-devel \
#   	php72w-mysqlnd \
#   	php72w-pdo \
#   	php72w-pear \
#   	php72w-mbstring \
#   	php72w-soap \
#   	php72w-gd \
#   	php72w-xml \
#   	php72w-pecl-apcu \
#   	php72w-pecl-memcache \
#   	php72w-pecl-memcached \
#    zip \
#    unzip \
#    p7zip \
#    urw-fonts.noarch \
#    && yum -y update bash \
#    && rm -rf /var/cache/yum/* \
#    && yum clean all
#
#
#
#RUN yes |pecl install -f ssh2-1.1.2
#RUN pecl install -f mcrypt-1.0.1
#RUN touch /etc/php.d/ssh2.ini
#RUN echo extension=ssh2.so > /etc/php.d/ssh2.ini
#RUN mkdir /opt/oracle
#COPY oracle-db /opt/oracle
#
#
#RUN cd /opt/oracle;unzip instantclient-basic-linux-x86-64-11.2.0.2.0.zip \
#    && unzip instantclient-sdk-linux-x86-64-11.2.0.2.0.zip \
#    && unzip instantclient-sqlplus-linux-x86-64-11.2.0.2.0.zip \
#    && rm instantclient-basic-linux-x86-64-11.2.0.2.0.zip \
#    && rm instantclient-sdk-linux-x86-64-11.2.0.2.0.zip \
#    && rm instantclient-sqlplus-linux-x86-64-11.2.0.2.0.zip \
#    && ln -s /opt/oracle/instantclient_11_2/libclntsh.so.11.1 /opt/oracle/instantclient_11_2/libclntsh.so \
#    && ln -s /opt/oracle/instantclient_11_2/libocci.so.11.1 /opt/oracle/instantclient_11_2/libocci.so \
#    && ln -s /opt/oracle/instantclient_11_2/sqlplus /usr/local/bin/sqlplus \
#    && echo /opt/oracle/instantclient_11_2 > /etc/ld.so.conf.d/oracle-instantclient \
#    && ldconfig
#
#ENV ORACLE_HOME=/opt/oracle/instantclient_11_2
#ENV LD_LIBRARY_PATH="$ORACLE_HOME"
#ENV PATH="$ORACLE_HOME:$PATH"
#ENV container docker
#
#
## Update the default apache site with the config we created.
## RUN mkdir /etc/httpd/sites-available
## RUN mkdir /etc/httpd/sites-enabled
## RUN echo "IncludeOptional sites-enabled/*.conf" >> /etc/httpd/conf/httpd.conf
## COPY apache-config.conf /etc/httpd/sites-available/orangehrm.conf
## RUN ln -s /etc/httpd/sites-available/orangehrm.conf /etc/httpd/sites-enabled/
#
#
## Export port 443
## EXPOSE 443
#
## Copy files
## COPY ioncube/ioncube_loader_lin_7.2.so /usr/local/lib/php/extensions/no-debug-non-zts-20121212/ioncube_loader_lin_7.2.so
#
## COPY php.ini /etc/php.ini
#
#
## Add supervisor conf
## RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/log/supervisor /var/log/memcached
## COPY supervisord.conf /etc/supervisord.conf
#
## RUN systemctl enable httpd.service
## RUN systemctl enable memcached.service
## RUN systemctl enable crond.service
## Docker startup
##CMD ["/usr/bin/supervisord"]
#