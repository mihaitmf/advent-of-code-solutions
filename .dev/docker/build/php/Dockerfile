FROM php:7.2

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN apt-get update \
    && apt-get install -y \
        libxml2-dev \
        zlib1g-dev \
    && docker-php-ext-install \
        pcntl \
        bcmath \
        mbstring \
        opcache \
        xml \
        zip \
    && pecl install \
        xdebug-2.6.1 \
        apcu \
    && docker-php-ext-enable \
        xdebug \
        apcu

ENTRYPOINT ["php"]
