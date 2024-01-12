FROM php:8.0-apache

RUN apt-get update && apt-get install -y \
    openssl \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod ssl
RUN a2ensite default-ssl

RUN mkdir /etc/apache2/ssl

RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/apache2/ssl/apache.key \
    -out /etc/apache2/ssl/apache.crt \
    -subj "/C=US/ST=State/L=City/O=Organization/CN=localhost"

COPY project.conf /etc/apache2/sites-available/default.conf
COPY project.conf /etc/apache2/sites-available/default-ssl.conf
RUN a2ensite default
RUN a2ensite default-ssl

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY public_html/index.php index.php

EXPOSE 80
EXPOSE 443
