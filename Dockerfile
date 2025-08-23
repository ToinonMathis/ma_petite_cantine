# Stage 1 : build frontend
FROM node:20 AS frontend
WORKDIR /app
COPY package*.json vite.config.ts ./
COPY resources/js ./resources/js
RUN npm install
RUN npm run build

# Stage 2 : backend Laravel
FROM php:8.2-fpm
WORKDIR /var/www/html
COPY --from=frontend /app/dist ./public
COPY . .

RUN apt-get update && apt-get install -y libzip-dev unzip git curl \
    && docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

EXPOSE 9000
CMD ["php-fpm"]
