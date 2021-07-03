FROM advent-of-code/php:latest

ENV COMPOSER_VERSION 1.7.3

RUN apt-get update \
    && apt-get install -y unzip \
    && curl -LS https://getcomposer.org/download/${COMPOSER_VERSION}/composer.phar -o /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer \
    && composer self-update

ENTRYPOINT ["/usr/local/bin/composer"]
