#!/bin/bash
# entrypoint.sh

# Czekaj aż MySQL wystartuje
until php -r "new PDO('mysql:host=filament2_db;dbname=laravel', 'root', 'secret');" 2>/dev/null; do
  echo "Waiting for MySQL..."
  sleep 2
done

# Uruchom scheduler
php artisan schedule:work