FROM php:7.0-apache

COPY . /srv/app

RUN chown -R www-data:www-data /srv/app

ENV APACHE_DOCUMENT_ROOT /srv/app/src

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80