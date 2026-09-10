#!/bin/bash

# Run migrations
# The --force flag is needed for production environments
php artisan migrate 
npx tailwindcss@3 --input ./resources/css/filament/admin/theme.css --output ./public/css/filament/admin/theme.css --config ./resources/css/filament/admin/tailwind.config.js --minify
php artisan view:clear
# Start the main process (supervisord)
exec "$@"