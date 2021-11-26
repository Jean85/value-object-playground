FROM php:8.0.13-fpm-alpine
LABEL maintainer="alessandro.lai@facile.it"
ENV PATH="$PATH:/workspace/vendor/bin"

# local user
RUN adduser -D -u 1000 php-dev -G www-data \
    && mkdir -p /home/php-dev \
    && chown -R php-dev /home/php-dev

 ## Composer and accounts
RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin \
#        --version=2.1.12 \
        --filename=composer

USER php-dev
