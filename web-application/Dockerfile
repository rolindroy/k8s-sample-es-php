## Dockerized Web-Application
###########################

# Downloading php:5.6-apache-jessie image
FROM php:5.6-apache-jessie

# File Author / Maintainer
MAINTAINER Rolind Roy

# Copying All the Files to /var/www/html/
COPY . /var/www/html/

# Creating config file from sample-main.php
RUN cp /var/www/html/WebContent/config/sample-main.php /var/www/html/WebContent/config/main.php

# Changing the working Directory
WORKDIR /etc/apache2/sites-available/

# Disabling default virtual host
RUN a2dissite 000-default.conf

# Uploading virtual host configuration
COPY 000-default.conf /etc/apache2/sites-available/

# Enabling default virtual host configuration
RUN a2ensite 000-default.conf

# TODO ------------------------------------------
# Setting host variable here or change in the sample-main.php
ENV API_HOST="localhost"
ENV API_PORT="80"
# ----------------------------------------------

# Changing working Directory
WORKDIR /var/www/html/WebContent/www

# Enable Re-write Module
RUN a2enmod rewrite

# Starting apache service
CMD ["apache2-foreground"]
