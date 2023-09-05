FROM composer as builder
WORKDIR /api
COPY composer.* ./
RUN composer install --no-scripts

FROM php:7.2.7-apache

COPY --from=builder /api/vendor /var/www/vendor

RUN symfony.exe server:start