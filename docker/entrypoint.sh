#!/bin/sh
set -e

cd /var/www/html

mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs
mkdir -p storage/app/public/media storage/app/public/uploads
chown -R www-data:www-data storage bootstrap/cache

# public/media dan public/uploads disimpan di storage/app/public (bind mount dari host)
for d in media uploads; do
    if [ -L "public/$d" ]; then
        continue
    elif [ -e "public/$d" ]; then
        echo "WARNING: public/$d bukan symlink, dilewati" >&2
    else
        ln -s "../storage/app/public/$d" "public/$d"
    fi
done

# File sitemap ditulis ke public/, simpan di storage supaya tidak hilang saat container dibuat ulang
for f in sitemap.xml news-sitemap.xml; do
    if [ -L "public/$f" ]; then
        continue
    elif [ -e "public/$f" ]; then
        echo "WARNING: public/$f bukan symlink, dilewati" >&2
    else
        ln -s "../storage/app/public/$f" "public/$f"
    fi
done

[ -L public/storage ] || php artisan storage:link --force || true

# Hanya dijalankan di service web (lihat docker-compose.yml)
if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
    php artisan migrate --force
fi

if [ "${APP_ENV}" = "production" ]; then
    php artisan config:cache
    php artisan view:cache
fi

exec "$@"
