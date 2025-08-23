# Étape 1 : builder le front
FROM node:18-bullseye AS frontend-build
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY resources/js ./resources/js
COPY vite.config.ts ./
RUN npm run build

# Étape 2 : préparer le backend Laravel
FROM php:8.2-fpm
WORKDIR /var/www/html

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Copier le backend
COPY --from=frontend-build /app /var/www/html

# Installer composer et dépendances Laravel
COPY composer.json composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Exposer le port 9000
EXPOSE 9000
CMD ["php-fpm"]
