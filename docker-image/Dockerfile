FROM centos/systemd
LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

WORKDIR /var/www/html

# -----------------------------------------------------------------------------
# Adding IUS repository and MariaDB GPG Keys
# -----------------------------------------------------------------------------

RUN yum install -y epel-release https://repo.ius.io/ius-release-el$(rpm -E '%{rhel}').rpm \
        && rpm --import https://yum.mariadb.org/RPM-GPG-KEY-MariaDB

COPY ./repos/mariadb.repo /etc/yum.repos.d/

# Install Font group
RUN yum -y groupinstall "Font"

# -----------------------------------------------------------------------------
# Install Middlewares and modules
# -----------------------------------------------------------------------------

RUN yum -y install \
    yum-utils \
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
    libmemcached-devel \
    initscripts \
    mod_ssl \
    mod_php74 \
    php74-cli \
    php74-ldap \
    php74-bcmath \
    php74-devel \
    php74-mysqlnd \
    php74-pdo \
    php74-mbstring \
    php74-soap \
    php74-gd \
    php74-xml \
    php74-imap \
    php74-json \
    php74-gmp \
    php74-pecl-apcu \
    php74-pecl-igbinary \
    php74-pecl-zip \
    zip \
    unzip \
    p7zip \
    urw-fonts.noarch \
    pear1.noarch \
    && yum -y update bash \
    && rm -rf /var/cache/yum/* \
    && yum clean all

# Install PECL modules
RUN yes | pecl install -f ssh2-1.2
RUN yes | pecl install -f mcrypt-1.0.3 
RUN yes | pecl install -f memcached-3.1.5 


# Install oracledb clients
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

# Copy IonCube loader and PHP configuration files
COPY ioncube/ioncube_loader_lin_7.4.so /usr/local/lib/php/extensions/no-debug-non-zts-20121212/ioncube_loader_lin_7.4.so
COPY php.ini /etc/php.ini

# Add supervisor conf
RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/log/supervisor /var/log/memcached
COPY supervisord.conf /etc/supervisord.conf

# Enable services
RUN systemctl enable httpd.service
RUN systemctl enable memcached.service
RUN systemctl enable crond.service
