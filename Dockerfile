# Étape 1 : build du frontend
FROM node:18-alpine AS frontend-build
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY resources/js ./resources/js
COPY vite.config.ts ./
RUN npm run build

# Étape 2 : setup Laravel
FROM php:8.2-fpm-alpine
WORKDIR /var/www/html

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier le projet
COPY . .

# Copier les assets buildés depuis l'étape 1
COPY --from=frontend-build /app/dist ./public/dist

# Installer composer et dépendances Laravel
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Exposer le port
EXPOSE 9000

CMD ["php-fpm"]
