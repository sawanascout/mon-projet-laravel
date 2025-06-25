# Utilise l'image officielle PHP 8.1 avec FPM
FROM php:8.1-fpm

# Installe les dépendances nécessaires et les extensions PHP utiles pour Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql zip gd mbstring

# Installe Composer globalement
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définit le dossier de travail
WORKDIR /var/www/html

# Copie le code source dans le conteneur
COPY . .

# Installe les dépendances PHP via Composer (sans les dépendances de dev)
RUN composer install --no-dev --optimize-autoloader

# Donne les droits nécessaires (optionnel mais recommandé)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose le port 9000 (PHP-FPM)
EXPOSE 9000

# Démarre PHP-FPM
CMD ["php-fpm"]
