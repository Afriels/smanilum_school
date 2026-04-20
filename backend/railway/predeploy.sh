#!/bin/sh
set -eu

echo "Preparing Laravel deployment..."

if [ -z "${APP_KEY:-}" ]; then
  echo "APP_KEY is required before deploying to Railway."
  exit 1
fi

php artisan optimize:clear
php artisan config:cache
php artisan migrate --force

if [ "${RAILWAY_RUN_SEEDERS:-false}" = "true" ]; then
  php artisan db:seed --force
fi

if [ "${RAILWAY_FIX_SUPABASE_URLS:-true}" = "true" ]; then
  php artisan media:fix-supabase-urls || true
fi

echo "Laravel pre-deploy tasks completed."
