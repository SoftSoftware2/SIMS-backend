#!/bin/bash
set -e

echo "🚀 === SIMS Backend Initialization ==="

echo "⏳ Waiting for PostgreSQL at $DB_HOST:$DB_PORT..."
until nc -z "$DB_HOST" "$DB_PORT" 2>/dev/null; do
  sleep 1
done
echo "✅ PostgreSQL ready!"

echo "📦 Running root migrations..."
php artisan migrate --path="Modules/Users/Database/Migrations" --force
php artisan migrate --path="database/migrations" --force
php artisan migrate --path="Modules/Companies/Database/Migrations" --force
php artisan migrate --path="Modules/Auth/Database/Migrations" --force
echo "✅ Migrations completed!"

if [ "$APP_SEED" = "true" ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --force
    echo "✅ Seeders completed!"
else
    echo "⏭️  Skipping seeders (APP_SEED != true)"
fi

echo "🎉 === Initialization Complete - Starting PHP-FPM ==="
exec php-fpm
