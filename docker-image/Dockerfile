FROM orangehrm/orangehrm-environment-images:prod-php-7.3.5-redhat
LABEL authors = "OrangeHRM TechOps <techops@orangehrm.com>"

#setting up working directory
WORKDIR /var/www/html

COPY apache-config.conf /etc/httpd/sites-available/orangehrm.conf

# Export port 443
EXPOSE 443

COPY php.ini /usr/local/lib/php/lib/php.ini


# Add supervisor conf
RUN mkdir -p /var/lock/apache2 /var/run/apache2 /var/log/supervisor /var/log/memcached
COPY supervisord.conf /etc/supervisord.conf

RUN systemctl enable httpd.service
RUN systemctl enable memcached.service
RUN systemctl enable crond.service
# Docker startup
CMD ["/usr/sbin/init"]
