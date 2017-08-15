FROM centos/systemd

MAINTAINER "Thulana" <thulana@orangehrm.us.com>

WORKDIR /var/www/html

# -----------------------------------------------------------------------------
# Import the RPM GPG keys for Repositories
# -----------------------------------------------------------------------------

RUN rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm \
	&& rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm

# -----------------------------------------------------------------------------
# Apache + PHP
# -----------------------------------------------------------------------------

RUN yum -y install \
    httpd \
    gcc \
    mysql \
    libaio-devel \
    poppler-utils \
    supervisor \
    libreoffice-draw \
    libreoffice-writer \
    cronie \
    libssh2 \
    libssh2-devel \
    memcached \
    initscripts \
    mod_ssl \
    php70w \
   	php70w-cli \
   	php70w-mcrypt \
   	php70w-ldap \
   	php70w-bcmath \
   	php70w-devel \
   	php70w-mysql \
   	php70w-pdo \
   	php70w-pear \
   	php70w-mbstring \
   	php70w-soap \
   	php70w-gd \
   	php70w-xml \
   	php70w-pecl-apcu \
   	php70w-pecl-memcache \
   	php70w-pecl-memcached \
    zip \
    unzip \
    && yum -y update bash \
    && rm -rf /var/cache/yum/* \
    && yum clean all


#Compile ssh2 bindings extension for PHP7
#COPY pecl-networking-ssh2-master /pecl-networking-ssh2-master
#RUN cd /pecl-networking-ssh2-master && phpize \
#    && ./configure \
#    && make \
#    && make install
RUN yes |pecl install -f ssh2-1.1.2
RUN touch /etc/php.d/ssh2.ini
RUN echo extension=ssh2.so > /etc/php.d/ssh2.ini
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

# Copy files
COPY ioncube/ioncube_loader_lin_7.0.so /usr/local/lib/php/extensions/no-debug-non-zts-20121212/ioncube_loader_lin_7.0.so
COPY php.ini /etc/php.ini

# Add supervisor conf
RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/log/supervisor /var/log/memcached
COPY supervisord.conf /etc/supervisord.conf

RUN systemctl enable httpd.service
RUN systemctl enable memcached.service
RUN systemctl enable crond.service
# Docker startup
#CMD ["/usr/bin/supervisord"]