#!/bin/sh
set -e
cd /var/www/html

# Render (et autres PaaS) fournissent PORT ; Apache doit l'écouter.
if [ -n "${PORT}" ] && [ "${PORT}" != "80" ]; then
    sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
    sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf
fi

mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    touch database/database.sqlite
    chown www-data:www-data database/database.sqlite
fi

php artisan migrate --force --no-interaction
php artisan storage:link --force 2>/dev/null || true

php artisan config:cache
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

exec "$@"
