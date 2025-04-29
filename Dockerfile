FROM php:8.0-apache
COPY . /var/www/html/
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite