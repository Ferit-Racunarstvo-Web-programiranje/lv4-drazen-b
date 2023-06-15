FROM php:7.4-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
RUN chown -R www-data:www-data /usr/src/myapp
CMD ["apache2-foreground"]