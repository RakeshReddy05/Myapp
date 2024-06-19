
# Using php:7.4-apache as the base image
FROM php:7.4-apache

# Installing mysqli extension for PHP
RUN docker-php-ext-install mysqli

# Copy the application source code to /var/www/html/
COPY src/ /var/www/html/

# Update database connection strings to point to a Kubernetes service named mysql-service
RUN sed -i 's/localhost/mariadb-service/g' /var/www/html/config.php

# Expose port 80 to allow traffic to the web server
EXPOSE 80

# Provide a command to run the Apache web server
CMD ["apache2-foreground"]

