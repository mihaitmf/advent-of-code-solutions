FROM php:7.2

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN apt-get update \
    && docker-php-ext-install pcntl \
    && pecl install xdebug-2.6.1 \
    && docker-php-ext-enable xdebug

ENTRYPOINT ["php"]
