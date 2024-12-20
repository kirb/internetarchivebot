FROM php:7.4-apache
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apt-get update \
    && apt-get install -y --no-install-recommends git zlib1g-dev libzip-dev libicu-dev g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install mysqli intl zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists
WORKDIR /var/www
ENV COMPOSER_VENDOR_DIR=/vendor \
    COMPOSER_ALLOW_SUPERUSER=1
COPY composer.json composer.lock docker-php-entrypoint /
RUN chmod a+x /docker-php-entrypoint \
    && cd / \
    && git config --global url."https://github.com/".insteadOf "git@github.com:" \
    && composer config --global github-protocols https \
    && composer update -q --no-ansi --no-interaction --no-scripts --no-suggest --no-progress --prefer-dist
ENTRYPOINT [ "/docker-php-entrypoint" ]
CMD ["apache2-foreground"]
