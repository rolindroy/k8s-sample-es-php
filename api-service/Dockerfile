## Dockerized API-Service
###########################

# Downloading php:5.6-apache-jessie image
FROM php:5.6-apache-jessie

# File Author / Maintainer
MAINTAINER Rolind Roy

# Copying All the Files to /var/www/html/
COPY . /var/www/html/

# Creating symlink for index.php
RUN ln -s /var/www/html/WebContent/www/index.php /var/www/html/index.php

# Creating symlink for .htaccess
RUN ln -s /var/www/html/WebContent/www/.htaccess /var/www/html/.htaccess

# Creating config file from sample-main.php
RUN cp /var/www/html/WebContent/config/sample-main.php /var/www/html/WebContent/config/main.php

# TODO ------------------------------------------
# Setting host variable here or change in the sample-main.php
ENV ELASTIC_HOST="localhost"
ENV ELASTIC_PORT="9200"
ENV ELASTIC_USER="elastic"
ENV ELASTIC_PASS="elastic"
# ----------------------------------------------

# Changing working Directory
WORKDIR /var/www/html/WebContent/www

# Enabling Re-write Module for .htaccess
RUN a2enmod rewrite

# Running Appache Service
CMD ["apache2-foreground"]
