FROM composer AS Builder

ARG COMPOSER_ARGS="-o --no-dev --ignore-platform-reqs --no-scripts"

WORKDIR /application
COPY . /application
COPY database ./database

RUN composer install $COMPOSER_ARGS

FROM arquivei/php:7.4-fpm-alpine

WORKDIR /application

COPY --from=Builder /application /application
