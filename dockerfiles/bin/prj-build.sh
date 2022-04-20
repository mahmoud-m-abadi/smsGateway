#!/bin/bash

supervisord
supervisorctl start all

# Install dependencies
composer install --prefer-dist --no-interaction

# Show outdated composer dependencies
composer outdated

# Make .env file
cp .env.example .env

# Generate application key
php artisan view:clear
php artisan config:clear
php artisan key:generate

# Verify environment config
cat .env

# Create database tables and populate seed data
php artisan migrate --no-interaction
php artisan db:seed
npm install && npm run dev

# Execute PHPUnit tests
vendor/bin/phpunit
