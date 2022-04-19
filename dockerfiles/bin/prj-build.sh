#!/bin/bash

supervisord -c /etc/supervisor.conf

# Install dependencies
composer install --prefer-dist --no-interaction

# Show outdated composer dependencies
composer outdated

# Generate application key
php artisan view:clear
php artisan config:clear
php artisan key:generate

# Verify environment config
cat .env

# Create database tables and populate seed data
php artisan migrate --seed --no-interaction

# Execute PHPUnit tests
vendor/bin/phpunit
