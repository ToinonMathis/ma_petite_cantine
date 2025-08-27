#!/bin/sh
set -e

# -----------------------------
# Script de démarrage Laravel
# -----------------------------

echo "🔹 Nettoyage du cache Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear

echo "🔹 Exécution des migrations..."
php artisan migrate --force

echo "🔹 Démarrage de PHP-FPM..."
php artisan serv
