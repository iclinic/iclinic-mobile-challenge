FROM php:8.0.3-fpm-alpine3.13

MAINTAINER Diogo Oliveira Mascarenhas <diogomascarenha@gmail.com>

# Set timezone
RUN apk add tzdata && \
    cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime && \
    echo "America/Sao_Paulo" > /etc/timezone && \
    apk del tzdata

# Install the PHP pdo_pgsql extention
RUN apk add --no-cache postgresql-dev && \
    docker-php-ext-install pdo_pgsql

# Install the PHP pdo_pgsql extention
RUN docker-php-ext-install pdo_mysql

## Install the PHP zip extention
RUN apk add --no-cache libzip-dev && \
    docker-php-ext-install zip

## Install the PHP opcache extention
RUN docker-php-ext-install -j$(nproc) opcache

## Install the PHP bcmath extension
RUN docker-php-ext-install -j$(nproc) bcmath

## Install the PHP sockets extension
RUN docker-php-ext-install -j$(nproc) sockets

## Install the PHP iconv extension
RUN docker-php-ext-install -j$(nproc) iconv

# Install the PHP gd extension
RUN apk add --no-cache freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev && \
    docker-php-ext-configure gd \
    --enable-gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd

# Install the PHP xdebug extension
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS && \
    docker-php-ext-enable xdebug && \
    apk del -f .build-deps

RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer && \
    curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig && \
    php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" && \
    php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --snapshot && \
    rm -f /tmp/composer-setup.* && \
    chown 1000.www-data /usr/local/bin/composer

RUN apk --no-cache add shadow && \
    usermod -u 1000 www-data && \
    apk del shadow

USER www-data

## Instalando laravel intaller
RUN composer global require "laravel/installer"

ENV PATH="/home/www-data/.composer/vendor/bin:${PATH}"

USER root

RUN apk add --no-cache bash fcgi

# Copy memory limit configuration
COPY ./.docker/php-fpm/memory-limit.ini /usr/local/etc/php/conf.d/memory-limit.ini

# Copy xdebug configration for remote debugging
COPY ./.docker/php-fpm/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Copy custom php.ini (medicina-e-backend.ini)
ADD ./.docker/php-fpm/medicina-e-backend.ini /usr/local/etc/php/conf.d

# Copy custom pool
ADD ./.docker/php-fpm/medicina-e-backend.pool.conf /usr/local/etc/php-fpm.d/

WORKDIR /var/www

RUN echo 'export PS1="${debian_chroot:+($debian_chroot)}\u@\h:\W\$ "' >> /root/.bashrc && \
    echo 'export PS1="${debian_chroot:+($debian_chroot)}\u@\h:\W\$ "' >> /home/www-data/.bashrc && \
    echo 'export PATH="/var/www/vendor/bin:${PATH}"' >> /root/.bashrc && \
    echo 'export PATH="/var/www/vendor/bin:${PATH}"' >> /home/www-data/.bashrc
