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
# Stage 2 : Backend Laravel + Nginx
# -----------------------------
FROM laravelphp/php-fpm-nginx:8.3

WORKDIR /var/www/html

# Copier le frontend build dans public
COPY --from=frontend /app/public ./public

# Copier tout le backend Laravel
COPY . .

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y libzip-dev libpq-dev unzip git curl \
    && docker-php-ext-install pdo_pgsql zip

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Nettoyer et migrer
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan migrate --force

# Exposer le port par défaut pour Nginx
EXPOSE 80

# L'image gère déjà php-fpm + Nginx, donc pas de CMD à ajouter
