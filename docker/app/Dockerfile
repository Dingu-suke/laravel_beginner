FROM node:latest AS node
FROM php:8.3-fpm

ENV TZ Asia/Tokyo

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# install Library
RUN apt-get update && \
	apt-get install -y git unzip libzip-dev libicu-dev libonig-dev && \
	docker-php-ext-install intl pdo_mysql zip bcmath

# config file COPY
COPY ./docker/app/php.ini /usr/local/etc/php/php.ini

# install Composer
COPY --from=composer:2.8.5 /usr/bin/composer /usr/bin/composer

WORKDIR /app
