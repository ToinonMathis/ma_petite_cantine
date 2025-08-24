# -----------------------------
# Stage 1 : Build frontend
# -----------------------------
FROM node:20 AS frontend

WORKDIR /app

# Copier package.json et package-lock.json pour installer les dépendances
COPY package*.json vite.config.ts tsconfig.json ./
COPY resources ./resources

# Installer les dépendances système utiles pour npm build
RUN apt-get update && apt-get install -y build-essential

# Installer les dépendances npm
RUN npm install

# Build frontend
RUN npm run build

# -----------------------------
# Stage 2 : Backend Laravel
# -----------------------------
FROM php:8.3-fpm

WORKDIR /var/www/html

# Copier le frontend build dans le dossier public
COPY --from=frontend /app/public ./public

# Copier tout le backend Laravel
COPY . .

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpq-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_pgsql zip


# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs
# Exposer le port PHP-FPM
EXPOSE 9000

# Commande par défaut
CMD ["php-fpm"]
