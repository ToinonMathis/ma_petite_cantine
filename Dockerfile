# -----------------------------
# Stage 1 : Build frontend
# -----------------------------
FROM node:20 AS frontend

WORKDIR /app

# Copier package.json, package-lock.json, vite config et sources
COPY package*.json vite.config.ts tsconfig.json ./
COPY resources ./resources

# Installer les dépendances système utiles
RUN apt-get update && apt-get install -y build-essential

# Installer les dépendances npm
RUN npm install

# Build frontend
RUN npm run build

# -----------------------------
# Stage 2 : Backend Laravel + Nginx
# -----------------------------
FROM php:8.3-fpm AS php

WORKDIR /var/www/html

# Copier frontend build dans public
COPY --from=frontend /app/public ./public

# Copier backend Laravel
COPY . .

# Installer extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_pgsql zip

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer dépendances PHP
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# -----------------------------
# Stage 3 : Nginx
# -----------------------------
FROM nginx:alpine

# Copier config Nginx
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copier l'application PHP
COPY --from=php /var/www/html /var/www/html

# Exposer le port Railway
EXPOSE 8080

# Commande par défaut
CMD ["nginx", "-g", "daemon off;"]
