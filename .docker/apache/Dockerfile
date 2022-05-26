FROM httpd:2.4.41

MAINTAINER Akash Bose

RUN usermod -u 1000 www-data && \
    groupmod -g 1000 www-data

COPY .docker/apache/config/httpd.conf /usr/local/apache2/conf/httpd.conf
COPY .docker/apache/config/httpd-vhosts.conf /usr/local/apache2/conf/extra/httpd-vhosts.conf
COPY .docker/apache/config/php-fpm.conf /usr/local/apache2/conf/php-fpm.conf

EXPOSE 80
EXPOSE 1111