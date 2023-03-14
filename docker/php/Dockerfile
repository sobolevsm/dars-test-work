FROM php:7.4-fpm

WORKDIR /app

RUN apt-get update && \
    apt-get install -y cron \
                       libpq-dev \
                       libicu-dev \
                       zlib1g-dev \
                       libzip-dev \
                       zip && \
    docker-php-ext-install zip  \
                           pdo_mysql  \
                           mysqli && \
    apt-get clean && \
    apt-get autoclean && \
    apt-get autoremove -y --allow-downgrades --allow-remove-essential --allow-change-held-packages && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --quiet && \
    env COMPOSER_ALLOW_SUPERUSER=1 && \
    rm -rf /var/lib/apt/lists/*