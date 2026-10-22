# syntax=docker/dockerfile:1

# ---------- Stage 1: dependensi composer (tanpa dev) ----------
FROM composer:2 AS vendor
WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev --no-interaction --no-progress --prefer-dist \
    --no-scripts --no-autoloader --ignore-platform-reqs

# Source dibutuhkan untuk autoload (app/Helpers/Helper.php) dan package:discover
COPY . .
RUN composer dump-autoload --no-dev --optimize --no-interaction --no-scripts


# ---------- Stage 2: runtime PHP 8.3 + nginx + supervisor ----------
FROM php:8.3-fpm-alpine

LABEL maintainer="fernandoferry <teamdevnnd@gmail.com>"
LABEL description="Laravel 12 (PHP 8.3)"

ENV TZ=Asia/Jakarta

COPY --from=ghcr.io/mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/

# gd/imagick: intervention/image & simple-qrcode (PNG); zip/gd/xml: maatwebsite/excel
RUN apk add --no-cache nginx supervisor tzdata \
    && install-php-extensions gd imagick pdo_mysql bcmath intl zip exif opcache pcntl \
    && cp /usr/share/zoneinfo/$TZ /etc/localtime \
    && echo $TZ > /etc/timezone \
    && mkdir -p /run/nginx \
    && ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

COPY docker.conf/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker.conf/php/php.ini /usr/local/etc/php/conf.d/zz-app.ini
COPY docker.conf/php/php-fpm.conf /usr/local/etc/php-fpm.d/zzz-app.conf
COPY docker.conf/supervisord.conf /etc/supervisord.conf
COPY docker.conf/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www/html

COPY --chown=www-data:www-data . .
COPY --from=vendor --chown=www-data:www-data /app/vendor ./vendor

RUN php artisan package:discover --ansi \
    && mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs \
        storage/app/public bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache public

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=20s --retries=3 \
    CMD wget -q --spider http://127.0.0.1/ || exit 1

CMD ["/entrypoint.sh"]
