# -----------------------------
# Stage 1 : Build frontend
# -----------------------------
FROM node:20 AS frontend

WORKDIR /app

COPY package*.json vite.config.ts tsconfig.json ./
COPY resources ./resources

RUN apt-get update && apt-get install -y build-essential
RUN npm install
RUN npm run build

# -----------------------------
# Stage 2 : Backend Laravel
# -----------------------------
FROM php:8.3-fpm

WORKDIR /var/www/html

# Copier le frontend build dans public
COPY --from=frontend /app/public ./public

# Copier backend Laravel
COPY . .

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev libpq-dev unzip git curl \
    && docker-php-ext-install pdo_pgsql zip

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Nettoyer caches et lancer migrations
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan migrate --force

# Exposer le port FPM
EXPOSE 9000

# Commande par défaut
CMD ["php-fpm"]
