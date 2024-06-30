FROM php:8.2-cli-alpine

RUN apk add --no-cache zip libzip-dev bash
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
