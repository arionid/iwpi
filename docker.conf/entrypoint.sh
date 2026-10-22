#!/bin/sh
set -e

cd /var/www/html

# Bind mount ./storage menutupi isi image, pastikan struktur dasar ada
mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs

# Volume hasil mount bisa dimiliki root/uid lain
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# public/storage & public/media -> storage/app/public (relatif, tidak tergantung path host)
mkdir -p storage/app/public
ln -sfn ../storage/app/public public/storage
ln -sfn ../storage/app/public public/media
ln -sfn ../storage/app/public public/uploads

for f in sitemap.xml news-sitemap.xml; do
    if [ -L "public/$f" ]; then
        continue
    elif [ -e "public/$f" ]; then
        echo "WARNING: public/$f bukan symlink, dilewati" >&2
    else
        ln -s "../storage/app/public/$f" "public/$f"
    fi
done

# Cache hanya di produksi; env sudah tersedia lewat env_file / environment
if [ "$APP_ENV" = "production" ]; then
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

exec supervisord -c /etc/supervisord.conf
