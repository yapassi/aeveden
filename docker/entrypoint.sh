#!/bin/bash

# Exit on error
set -e

# Update Nginx port if PORT variable is set (Render sends this)
if [ ! -z "$PORT" ]; then
    echo "Updating Nginx port to $PORT"
    sed -i "s/80/$PORT/g" /etc/nginx/sites-available/default
fi

# Run migrations (force is needed in production)
echo "Running migrations..."
php artisan migrate --force

# Optimize Application
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Supervisor
echo "Starting Supervisor..."
exec /usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf
