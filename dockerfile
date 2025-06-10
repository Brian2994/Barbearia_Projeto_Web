FROM php:8.1-apache

#Memórias de dor abaixo...
RUN apt-get update && \
    apt-get install -y nano && \
    docker-php-ext-install pdo pdo_mysql mysqli