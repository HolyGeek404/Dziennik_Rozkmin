FROM php:8.0-apache

# Instaluje rozszerzenie MySQLi
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
# Aktualizuje system operacyjny
RUN apt-get update && apt-get upgrade -y
